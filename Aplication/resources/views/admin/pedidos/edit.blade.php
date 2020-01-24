@extends('layout')

@section('content')
    <h1>Pedido #{{$pedido->id}} - R$ {{$pedido->total}}</h1>
    <div class="card">
        <div class="card-body card-padding">
            <div class="panel-body">
                <div class="row col-sm-6">
                    <h2>Cliente: {{$pedido->cliente->usuario->nome}}</h2>
                    <h2>Telefone: {{$pedido->cliente->telefone}}</h2>
                    <br />
                    <h3>Data: {{date('d/m/Y - H:i:s', strtotime($pedido->created_at))}}</h3>

                    <h4>
                        <b>Entregar em:</b> <br><br>
                           <div  style="color: #0a68b4">
                            Endereço: {{$pedido->cliente->endereco}} - Bairro: {{$pedido->cliente->bairro}} <br>
                            {{$pedido->cliente->cidade}} - {{$pedido->cliente->estado}}<br>
                            CEP: {{$pedido->cliente->cep}}
                            <br>
                       </div>
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
                        <h3>Troco: {{$pedido->troco - $pedido->total}} R$</h3>
                    @endif
                </div>


                {!! Form::model($pedido, ['route'=>['admin.pedidos.update', $pedido->id]]) !!}

                <div class="row">
                    <div class="col-sm-12">
                        <br>
                        <br>

                        <table class="table table-striped table-responsive">
                            <thead>
                            <tr>
                                <th>Qtd</th>
                                <th>Produto</th>
                                <th>Tamanho</th>
                                <th>Meia</th>
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
                            {!! Form::label('Status', 'Status: ') !!}
                            {!! Form::select('status', $list_status, null, ['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="fg-line">
                                {!! Form::label('Tempo', 'Tempo estimado da entrega: ') !!}
                                {!! Form::select('tempo', array(
                                '0' => 'Não definido',
                                '5' => '5 minutos',
                                '10' => '10 minutos',
                                '15' => '15 minutos',
                                '20' => '20 minutos',
                                '25' => '25 minutos',
                                '30' => '30 minutos',
                                '35' => '35 minutos',
                                '40' => '40 minutos',
                                '45' => '45 minutos',
                                '50' => '50 minutos',
                                '55' => '55 minutos',
                                '60' => '1 hora',
                                '70' => '1 hora e 10 min',
                                '80' => '1 hora e 20 min',
                                '90' => '1 hora e 30 min',
                                '100' => '1 hora e 40 min'
                                ), null, ['class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('Entregador', 'Entregador: ') !!}
                            {!! Form::select('usuario_entregador_id', $entregador, null, ['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::submit('Salvar',['class'=>'btn btn-primary', 'style'=>'width: 100px']) !!}
                            <a href="{{ route('admin.pedidos.index') }}" class="btn btn-primary"
                               style="width: 100px">Voltar</a>
                        </div>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection