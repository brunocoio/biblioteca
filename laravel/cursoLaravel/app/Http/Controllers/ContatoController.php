<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContatoController extends Controller
{
  public function index()
  {
    $contatos = [
      (object)["nome" => "maria", "tel" => "123456789"],
      (object)["nome" => "manoel", "tel" => "654987321"],
    ];
    // return "index ContatoController";
    return view('contato.index', compact('contatos'));
  }
  public function criar(Request $reg)
  {
    // dd($reg['nome']);
    dd($reg->all());
    return "criar ContatoController";
  }
  public function editar()
  {
    return "editar ContatoController";
  }
}
