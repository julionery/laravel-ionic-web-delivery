@extends('layout')

@section('content')

    <h2>Meus Pedidos</h2>
    <br>
    <div class="row">
        <div class="col-sm-4">
        </div>
    <div class="col-sm-8 text-right">
        <b style="margin-right: 10px;"> Relatório:</b>
        <a href="{{ route('customer.pedido.pdf', 1) }}" target="_blank" class="btn btn-primary">Visualizar</a>
        <a href="{{ route('customer.pedido.pdf', 2) }}" class="btn btn-primary">Download</a>
    </div>
    </div>
    <br>

    <div class="card">
        <br>
        <table id="data-table-command" class="table table-striped table-vmiddle">
            <thead>
            <tr>
                <th data-column-id="id" data-type="numeric" data-order="desc">ID</th>
                <th data-column-id="total">Total</th>
                <th data-column-id="data">Data</th>
                <th data-column-id="itens">Itens</th>
                <th data-column-id="entregador">Entregador</th>
                <th data-column-id="status">Status</th>
                <th data-column-id="link" data-formatter="link" data-sortable="false">Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pedidos as $pedido)
                <tr>
                    <td>{{$pedido->id}}</td>
                    <td>R$ {{$pedido->total}}</td>
                    <td>{{date('d/m/Y - H:i', strtotime($pedido->created_at))}}</td>
                    <td>
                        <ul>
                            @foreach($pedido->itens as $item)
                                <li>{{$item->produto->nome}}; </li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        @if($pedido->entregador)
                            {{$pedido->entregador->nome}}
                        @else
                            --
                        @endif
                    </td>
                    <td>
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
                    </td>
                    <td ></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@stop

@push('scripts')
{!!  Html::script('design/vendors/bower_components/Waves/dist/waves.min.js') !!}

<!-- Data Table -->
<script type="text/javascript">
    $(document).ready(function(){
        //Command Buttons
        $("#data-table-command").bootgrid({
            selection: true,
            multiSelect: true,
            rowSelect: true,
            keepSelection: true,
            formatters: {
                "link": function(column, row)
                {
                    return "<a class=\"btn\" href=\"pedido/" + row.id + "\"><i class=\"zmdi zmdi-search zmdi-hc-fw\"></i></a>";
                },

            }
        });
    });
</script>
@endpush