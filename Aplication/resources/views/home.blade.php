@extends('layout')

@section('content')
    <div class="container">
        @if(Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
        @endif
        @if(Auth::user()->tipo == "admin")
            <div class="panel-heading"><h1>Painel Administrativo</h1></div>

            <div class="panel-body">
                <p>
                    Seja bem-vindo ao Painel Administrativo.<br>
                    Pelo menu na parte esquerda você tem acesso a todas áreas do site.<br>
                    Você tem total controle nas áreas (inserção, alteração, exclusão, etc).<br>
                    Caso surja alguma dúvida entre em contato com o suporte.
                </p>
            </div>
        @else

            <div class="panel-heading"><h1>Painel Os PrintF</h1></div>

            <div class="panel-body">
                <p>
                    Seja bem-vindo ao Painel.<br>
                    Pelo menu na parte esquerda você tem acesso aos seus pedidos.<br>
                    Você poderá visualizar e acompanhar as informações sobre os seus pedidos realizados.<br>
                    Caso surja alguma dúvida entre em contato com o suporte.
                </p>

            </div>
                <a class="btn btn-link" href="https://play.google.com/store/apps/details?id=osprintf.com&hl=pt_BR" target="_blank">Baixe nosso APP para fazer os pedidos!<br>Clique aqui!</a>
            @endif
    </div>
@endsection