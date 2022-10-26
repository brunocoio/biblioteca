@extends('layouts.principal')
@section('titulo', 'Clientes - Detalhe')
@section('conteudo')
    <h3>Info Clientes</h3>
    <p>ID: {{ $cliente['id'] }}</p>
    <p>Nome: {{ $cliente['nome'] }}</p>
    <br>
    <a href="{{ route('clientes.index') }}">Voltar</a>
@endsection
