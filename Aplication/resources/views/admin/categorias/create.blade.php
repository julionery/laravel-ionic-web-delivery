@extends('layout')

@section('content')

    <h2>Nova Categoria</h2>

    @include('errors._check')

    <div class="panel panel-default">
        {!! Form::open(['route'=>'admin.categorias.store']) !!}
    </div>
    <div class="card">
        <div class="card-body card-padding">
            <div class="row" style="padding: 20px 20px 20px 20px">
                @include('admin.categorias._form')

                <br><br><br>
                <div class="panel panel-default">
                    {!! Form::submit('Criar Categoria', ['class'=> 'btn btn-primary']) !!}
                    <a href="{{ route('admin.categorias.index') }}" class="btn btn-primary"
                       style="width: 100px">Voltar</a>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

@endsection