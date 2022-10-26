@extends('layouts.principal')
@section('titulo', 'Opções')
@section('conteudo')
    <div class="options">
        <ul>
            <li><a class="warning" href="{{ route('opcoes', 1) }}">warning</a></li>
            <li><a class="info" href="{{ route('opcoes', 2) }}">info</a></li>
            <li><a class="success" href="{{ route('opcoes', 3) }}">success</a></li>
            <li><a class="error" href="{{ route('opcoes', 4) }}">error</a></li>
        </ul>
    </div>
    @if (isset($opcao))
        @switch($opcao)
            @case(1)
                @alerta(['titulo' => 'Erro fatal', 'tipo' => 'warning'])
                <p><strong>Warning</strong></p>
                <p>Ocorreu um erro inesperado</p>
                @endalerta
            @break

            @case(2)
                @alerta(['titulo' => 'Erro fatal', 'tipo' => 'info'])
                <p><strong>Info</strong></p>
                <p>Ocorreu um erro inesperado</p>
                @endalerta
            @break

            @case(3)
                @alerta(['titulo' => 'Erro fatal', 'tipo' => 'success'])
                <p><strong>Success</strong></p>
                <p>Ocorreu um erro inesperado</p>
                @endalerta
            @break

            @case(4)
                @alerta(['titulo' => 'Erro fatal', 'tipo' => 'error'])
                <p><strong>Error</strong></p>
                <p>Ocorreu um erro inesperado</p>
                @endalerta
            @break

            @default
                @alerta(['titulo' => 'Erro fatal', 'tipo' => 'info'])
                <p><strong>Info</strong></p>
                <p>Ocorreu um erro inesperado</p>
                @endalerta
        @endswitch
    @endif

@endsection
