<h3>View index</h3>

@foreach($contatos as $contato)
<!-- array -->
<!-- <p>{{$contato['nome']}}</p>
<p>{{$contato['tel']}}</p> -->
<!-- obj -->
<p>{{$contato -> nome}}</p>
<p>{{$contato -> tel}}</p>
@endforeach
