<?php

namespace WebDelivery\Services;


use Dmitrovskiy\IonicPush\PushProcessor;
use WebDelivery\Models\Pedido;
use WebDelivery\Repositories\ComponenteRepository;
use WebDelivery\Repositories\CupomRepository;
use WebDelivery\Repositories\EmpresaRepository;
use WebDelivery\Repositories\PedidoRepository;
use WebDelivery\Repositories\ProdutoRepository;

class PedidoService
{
    /**
     * @var PedidoRepository
     */
    private $pedidoRepository;
    /**
     * @var CupomRepository
     */
    private $cupomRepository;
    /**
     * @var ProdutoRepository
     */
    private $produtoRepository;
    /**
     * @var PushProcessor
     */
    private $pushProcessor;
    /**
     * @var ComponenteRepository
     */
    private $componenteRepository;
    /**
     * @var EmpresaRepository
     */
    private $empresaRepository;

    public function __construct(PedidoRepository $pedidoRepository,
                                CupomRepository $cupomRepository,
                                ProdutoRepository $produtoRepository,
                                PushProcessor $pushProcessor,
                                ComponenteRepository $componenteRepository,
                                EmpresaRepository $empresaRepository
    )
    {
        $this->pedidoRepository = $pedidoRepository;
        $this->cupomRepository = $cupomRepository;
        $this->produtoRepository = $produtoRepository;
        $this->pushProcessor = $pushProcessor;
        $this->componenteRepository = $componenteRepository;
        $this->empresaRepository = $empresaRepository;
    }

    public function create(array $data)
    {
        \DB::beginTransaction();
        try {
            $data['status'] = 0;

            if (isset($data['cupom_id'])) {
                unset($data['cupom_id']);
            }
            if (isset($data['cupom_codigo'])) {
                $cupom = $this->cupomRepository->findByField('codigo', $data['cupom_codigo'])->first();
                $data['cupom_id'] = $cupom->id;
                $cupom->usado = 1;
                $cupom->save();
                unset($data['cupom_codigo']);
            }

            $items = $data['items'];

            unset($data['items']);

            $pedido = $this->pedidoRepository->create($data);
            $total = 0;

            foreach ($items as $item) {
                $item['preco'] = $this->produtoRepository->find($item['produto_id'])->preco;
                $itemPedido = $pedido->itens()->create($item);

                if (!empty($item['adicionar']) && !empty($item['remover'])) {
                    $componentes = array_merge($item['adicionar'], $item['remover']);
                    $itemPedido->componentes()->sync($componentes);
                } elseif (!empty($item['adicionar'])) {
                    $itemPedido->componentes()->sync($item['adicionar']);
                } elseif (!empty($item['remover'])) {
                    $itemPedido->componentes()->sync($item['remover']);
                }

                $subtotal = $item['preco'] * $item['qtd'];

                if (isset($item['meia'])) {
                    if ($item['meia'] == '1') {
                        $subtotal = $subtotal / 2;
                    }
                }

                if (!empty($item['adicionar'])) {
                    $add = $item['adicionar'];
                    $adicionais = $this->componenteRepository->findByField('empresa_id', $data['empresa_id']);

                    foreach ($adicionais as $adicional) {
                        foreach ($add as $i => $value) {
                            if ($adicional['id'] == $add[$i]) {
                                $subtotal += (float)($adicional['preco']);
                            }
                        }
                    }
                }

                $total += $subtotal;

            }

            $pedido->total = $total;

            if (isset($cupom)) {
                $pedido->total = $total - $cupom->valor;
            }

            $pedido->save();

            \DB::commit();
            return $pedido;

        } catch (\Exception $e) {
            \DB::rollback();
            throw $e;
        }
    }

    public function updateStatus($id, $idEntregador, $status)
    {
        $pedido = $this->pedidoRepository->getByIdAndEntregador($id, $idEntregador);
        $pedido->status = $status;
        $user = $pedido->cliente->usuario;
        $empresa = $this->empresaRepository->find($pedido['empresa_id']);
        switch ((int)$status) {
            case 1: //Recebido
                $pedido->save();
                $this->pushProcessor->notify([$user->device_token], [
                    'title' => "{$empresa->nome_fantasia}",
                    'message' => "Seu pedido #{$pedido->id} foi recebido!"
                ]);
                break;
            case 2: //Em preparação
                $pedido->save();
                $this->pushProcessor->notify([$user->device_token], [
                    'title' => "{$empresa->nome_fantasia}",
                    'message' => "Seu pedido #{$pedido->id} está em preparação!"
                ]);
                break;
            case 3: //A caminho
                if (!$pedido->hash) {
                    $pedido->hash = md5((new \DateTime())->getTimestamp());
                }
                $pedido->save();
                $this->pushProcessor->notify([$user->device_token], [
                    'title' => "{$empresa->nome_fantasia}",
                    'message' => "Seu pedido #{$pedido->id} está a caminho!"
                ]);
                break;
            case 4: //Entregue
                $pedido->save();
                $this->pushProcessor->notify([$user->device_token], [
                    'title' => "{$empresa->nome_fantasia}",
                    'message' => "Seu pedido #{$pedido->id} acabou de ser entregue!"
                ]);
                break;
            case 5: //Cancelado
                $pedido->save();
                $this->pushProcessor->notify([$user->device_token], [
                    'title' => "{$empresa->nome_fantasia}",
                    'message' => "Seu pedido #{$pedido->id} foi cancelado!"
                ]);
                break;
            case 6: //Notificando chegada do entregador
                $this->pushProcessor->notify([$user->device_token], [
                    'title' => "{$empresa->nome_fantasia}",
                    'message' => "O entregador está no local de entrega!"
                ]);
                break;
        }
        return $pedido;
    }

}