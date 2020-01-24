@extends('layout')

@section('content')

    <h2>Editando Cupom: <font color="#1e90ff">{{$cupom->codigo}} </font></h2>

    @include('errors._check')

    <div class="panel panel-default">
        {!! Form::model($cupom, ['route'=>['admin.cupoms.update', $cupom->id]]) !!}
    </div>
    <div class="card">
        <br/><br/>
        <div class="card-body card-padding">
            <div class="row" style="padding: 20px 20px 20px 20px">

                @include('admin.cupoms._form')

                <br><br><br>
                <div class="panel panel-default">
                    {!! Form::submit('Salvar Cupom', ['class'=> 'btn btn-primary']) !!}
                    <a href="{{ route('admin.cupoms.index') }}" class="btn btn-primary" style="width: 100px">Voltar</a>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

@endsection

