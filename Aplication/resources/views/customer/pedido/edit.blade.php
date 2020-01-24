@extends('layout')

@section('content')
    <h1>Pedido #{{$pedido->id}} - R$ {{$pedido->total}}</h1>
    <div class="card">
        <div class="card-body card-padding">
            <div class="panel-body">
                <div class="row col-sm-6">
                    <h3>Status:
                        @if($pedido->status==0)Pendente
                        @endif
                        @if($pedido->status==1)Recebido
                        @endif
                        @if($pedido->status==2)Em preparação
                        @endif
                        @if($pedido->status==3)A caminho
                        @endif
                        @if($pedido->status==4)Entregue
                        @endif
                        @if($pedido->status==5)Cancelado
                        @endif
                    </h3>
                    <h3>Data da compra: {{date('d/m/Y - H:i:s', strtotime($pedido->created_at))}}</h3>

                    <h4>
                        <b>Entrege em:</b> <br>
                        {{$pedido->cliente->endereco}} - {{$pedido->cliente->cidade}} - {{$pedido->cliente->estado}}
                        <br>
                    </h4>
                </div>


                <div class="row col-sm-5 col-sm-offset-1">
                    <h3>Modelo de Retirada:
                        @if($pedido->retirada=="0")Delivery
                        @endif
                        @if($pedido->retirada=="1")Balcão
                        @endif
                    </h3>
                    <h3>Forma de Pagamento:
                        @if($pedido->pagamento=="0")Dinheiro
                        @endif
                        @if($pedido->pagamento=="1")Cartão
                        @endif
                        @if($pedido->pagamento=="2")Cheque
                        @endif
                    </h3>
                    @if($pedido->troco>0)
                    <h3>Troco para: {{$pedido->troco}} R$</h3>
                    @endif
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <br>
                        <h3>Itens:</h3>
                        <br>

                        <table class="table table-striped table-responsive">
                            <thead>
                            <tr>
                                <th>Qtd</th>
                                <th>Produto</th>
                                <th>Tamanho</th>
                                <th>Meia</th>
                                <th>Itens</th>
                                <th>Adicionar</th>
                                <th>Remover</th>
                                <th>Observação</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($pedido->itens as $item)
                                <tr>
                                    <td>{{$item->qtd}}</td>
                                    <td>{{$item->produto->nome}}</td>
                                    <td>
                                        @if($item->produto->tamanho=="N")
                                        @endif
                                        @if($item->produto->tamanho=="B")Broto
                                        @endif
                                        @if($item->produto->tamanho=="P")Pequena
                                        @endif
                                        @if($item->produto->tamanho=="M")Média
                                        @endif
                                        @if($item->produto->tamanho=="G")Grande
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->meia == 1)Sim
                                        @endif
                                    </td>
                                    <td>
                                        @foreach($item->produto->componentes as $componente)
                                            {{$componente->nome}};
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($item->componentes as $componente)
                                            @if($componente->tipo=="A")
                                                <li>{{$componente->nome}}</li>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($item->componentes as $componente)
                                            @if($componente->tipo=="I")
                                                <li>{{$componente->nome}}</li>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        {{$item->obs}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <a href="{{ route('customer.pedido.index') }}" class="btn btn-primary"
                               style="width: 100px">Voltar</a>
                        </div>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection