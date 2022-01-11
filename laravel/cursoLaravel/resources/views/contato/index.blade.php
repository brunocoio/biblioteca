
<h3>View index</h3>

@foreach($contatos as $contato)
<p>{{$contato->nome}}</p>
<p>{{$contato->tel}}</p>
@endforeach
