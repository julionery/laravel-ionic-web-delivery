@extends('layout')

@section('content')
    <h2>Novo Pedido</h2>

    @include('errors._check')
    <div class="card">
        <br>
    <div class="panel panel-default">
        <div class="container">
            {!! Form::open(['route'=>'customer.pedido.store','class'=>'form']) !!}
            <div class="row col-sm-12" style="padding: 20px 20px 20px 20px">
            <div class="form-group">
                <br>
                <p style="font-size: 50px">Total:
                    <b><label id="total"></label></b><span> R$</span>
                </p>
                <br>
                <a href="#" id="btnNewItem" class="btn btn-default">Novo Item</a>
                <br><br>
                <div class="row col-sm-12">
                <table class="table table-bordered table-responsive">

                    <thead>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    </thead>
                    <tbody>
                    <tr>
                        <td><select class="form-control" name="items[0][produto_id]">
                                @foreach($produtos as $p)
                                    <option value="{{ $p->id }}" data-price="{{ $p->preco }}"> {{$p->nome}}
                                        --- {{$p->preco}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            {!! Form::text('items[0][qtd]',1,['class'=>'form-control']) !!}
                        </td>
                    </tr>
                    </tbody>
                </table></div>
                <div class="form-group">
                    {!! Form::submit('Criar Pedido',['class'=>'btn btn-primary']) !!}
                </div>
            </div>
</div>
            {!! Form::close() !!}
        </div>
    </div></div>

@endsection

@section('post-script')
    <script>
        $('#btnNewItem').click(function () {
            var row = $('table tbody > tr:last'),
                    newRow = row.clone(),
                    length = $("table tbody tr").length;
            newRow.find('td').each(function () {
                var td = $(this),
                        input = td.find('input, select'),
                        name = input.attr('name');
                input.attr('name', name.replace((length - 1) + "", length + ""));

            });
            newRow.find('input').val(1);
            newRow.insertAfter(row);
            calculateTotal();
        });

        $(document.body).on('click', 'select', function () {
            calculateTotal();
        });

        $(document.body).on('blur', 'input', function () {
            calculateTotal();
        });

        function calculateTotal() {
            var total = 0,
                    trLen = $('table tbody tr').length,
                    tr = null, price, qtd;
            for (var i = 0; i < trLen; i++) {
                tr = $('table tbody tr').eq(i);
                price = tr.find(':selected').data('price');
                qtd = tr.find('input').val();
                total += price * qtd;
            }
            $('#total').html(total);

        }

    </script>
@endsection
