@extends('layouts.principal')
@section('titulo', 'Departamentos')
@section('conteudo')
    <h3>Departamentos</h3>
    <ul>
        <li>Pcs</li>
        <li>Eletrônicos</li>
        <li>Acessórios</li>
        <li>Roupas</li>
    </ul>

    @alerta(['titulo' => 'Erro fatal', 'tipo' => 'info'])
    <p><strong>Erro inesperado</strong></p>
    <p>Ocorreu um erro inesperado</p>
    @endalerta

    @alerta(['titulo' => 'Erro fatal', 'tipo' => 'success'])
    <p><strong>Erro inesperado</strong></p>
    <p>Ocorreu um erro inesperado</p>
    @endalerta

    @alerta(['titulo' => 'Erro fatal', 'tipo' => 'error'])
    <p><strong>Erro inesperado</strong></p>
    <p>Ocorreu um erro inesperado</p>
    @endalerta

    @alerta(['titulo' => 'Erro fatal', 'tipo' => 'warning'])
    <p><strong>Erro inesperado</strong></p>
    <p>Ocorreu um erro inesperado</p>
    @endalerta
@endsection
