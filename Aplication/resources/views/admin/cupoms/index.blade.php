@extends('layout')

@section('content')

    <h2>Cupom</h2>

    <br>
    <div class="row">
        @if(Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
        @endif
        <div class="col-sm-4">
            <a href="{{ route('admin.cupoms.create') }}" class="btn btn-primary">Novo Cupom</a>
        </div>
        <div class="col-sm-8 text-right">
            <b style="margin-right: 10px;"> Relatório:</b>
            <a href="{{ route('admin.cupoms.pdf', 1) }}" target="_blank" class="btn btn-primary">Visualizar</a>
            <a href="{{ route('admin.cupoms.pdf', 2) }}" class="btn btn-primary">Download</a>
        </div>
    </div>
    <br>

    <div class="card">
        <br>
        <table id="data-table-command" class="table table-striped table-vmiddle">
            <thead>
            <tr>
                <th data-column-id="id" data-type="numeric" data-order="desc">ID</th>
                <th data-column-id="codigo">Código</th>
                <th data-column-id="valor">Valor</th>
                <th data-column-id="link" data-formatter="link" data-sortable="false">Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cupoms as $cupom)
                <tr>
                    <td>{{$cupom->id}}</td>
                    <td>{{$cupom->codigo}}</td>
                    <td>{{$cupom->valor}}</td>
                    <td></td>
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
            formatters: {
                "link": function (column, row) {
                    return "<a class=\"btn\" href=\"cupoms/edit/" + row.id + "\"><i class=\"zmdi zmdi-edit zmdi-hc-fw\"></i></a>"
                            + "<a class=\"btn\" href=\"cupoms/destroy/" + row.id + "\"><i class=\"zmdi zmdi-delete zmdi-hc-fw\"></i></a>";
                },

            }
        });
    });
</script>
@endpush
