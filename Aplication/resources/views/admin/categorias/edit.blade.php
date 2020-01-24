@extends('layout')

@section('content')

    <h2>Editando Categoria: <font color="#1e90ff">{{$categoria->nome}} </font></h2>

    @include('errors._check')

    <div class="panel panel-default">
        {!! Form::model($categoria, ['route'=>['admin.categorias.update', $categoria->id]]) !!}
    </div>
    <div class="card">
        <div class="card-body card-padding">
            <div class="row" style="padding: 20px 20px 20px 20px">

                @include('admin.categorias._form')

                <br><br><br>
                <div class="panel panel-default">
                    {!! Form::submit('Salvar Categoria', ['class'=> 'btn btn-primary']) !!}
                    <a href="{{ route('admin.categorias.index') }}" class="btn btn-primary"
                       style="width: 100px">Voltar</a>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

@endsection

