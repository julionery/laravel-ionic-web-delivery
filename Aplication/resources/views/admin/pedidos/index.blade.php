@extends('layout')

@section('content')

    <h2>Pedidos</h2>
    <div id="frase"></div>
    <br>
    <div class="row">
        @if(Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
        @endif
        <div class="col-sm-4">
        </div>
        <div class="col-sm-8 text-right">
            <b style="margin-right: 10px;"> Relatório:</b>
            <a href="{{ route('admin.pedidos.pdf', 1) }}" target="_blank" class="btn btn-primary">Visualizar</a>
            <a href="{{ route('admin.pedidos.pdf', 2) }}" class="btn btn-primary">Download</a>
        </div>
    </div>
    <br>

    <div class="card">
        <br>
        <table id="data-table-command" class="table table-hover table-vmiddle">
            <thead>
            <tr>
                <th data-column-id="id" data-type="numeric" data-order="desc">ID</th>
                <th data-column-id="total">Total</th>
                <th data-column-id="data">Data</th>
                <th data-column-id="itens">Itens</th>
                <th data-column-id="entregador">Entregador</th>
                <th data-column-id="statusEntrega">Status</th>
                <th data-column-id="link" data-formatter="link" data-sortable="false">Ações</th>
                <th data-column-id="status" data-visible="false">Status</th>
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
                                    <li>{{$item->produto->nome}};</li>
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
                        <td></td>
                        @if($pedido->status==0)
                        <td>3</td>
                        @endif
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
    $(document).ready(function () {
        //Command Buttons
        $("#data-table-command").bootgrid({
            selection: true,
            multiSelect: true,
            rowSelect: true,
            keepSelection: true,
            reload: true,
            formatters: {
                "link": function (column, row) {
                    return "<a class=\"btn\" href=\"pedidos/" + row.id + "\"><i class=\"zmdi zmdi-edit zmdi-hc-fw\"></i></a>";
                }
            }
        });
    });
    function atualizar()
    {
        location.reload();
    }

    // Definindo intervalo que a função será chamada
    setInterval("atualizar()", 30000);

</script>
@endpush
