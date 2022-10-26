<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo')</title>
    <link rel="stylesheet" href="{{ asset('css/principal.css') }}">
</head>

<body>
    <div class="row">
        <div class="col1">
            <div class="menu">
                <ul>
                    <li class="{{ request()->routeIs('clientes.*') ? 'active' : '' }}"><a
                            href="{{ route('clientes.index') }}">Clientes</a></li>
                    <li class="{{ request()->routeIs('produtos') ? 'active' : '' }}"><a
                            href="{{ route('produtos') }}">Produtos</a></li>
                    <li class="{{ request()->routeIs('departamentos') ? 'active' : '' }}"><a
                            href="{{ route('departamentos') }}">Departamentos</a></li>
                    <li class="{{ request()->routeIs('opcoes') ? 'active' : '' }}"><a
                            href="{{ route('opcoes') }}">Opções</a></li>
                </ul>
            </div>
        </div>
        <div class="col2">
            @yield('conteudo')
        </div>
    </div>
</body>

</html>
