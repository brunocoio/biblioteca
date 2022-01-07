<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContatoController extends Controller
{
    public function index()
    {
        return "index ContatoController";
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
