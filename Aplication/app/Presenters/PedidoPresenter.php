<?php

namespace WebDelivery\Presenters;

use WebDelivery\Transformers\PedidoTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PedidoPresenter
 *
 * @package namespace WebDelivery\Presenters;
 */
class PedidoPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PedidoTransformer();
    }
}
