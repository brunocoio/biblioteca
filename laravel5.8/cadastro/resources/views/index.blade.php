@extends('layout.app', ['current' => 'home'])
@section('body')
    <div class="jumbotron bg-light border-secondary">
        <div class="row">
            <div class="card-deck">
                <div class="card border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Cadastro</h5>
                        <p class="card-text">Produtos</p>
                        <a href="/produtos" class="btn btn-primary">Cadastro</a>
                    </div>
                </div>
                <div class="card border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Cadastro</h5>
                        <p class="card-text">Categorias</p>
                        <a href="/categorias" class="btn btn-primary">Cadastro</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
