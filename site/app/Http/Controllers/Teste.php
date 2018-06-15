<?php

namespace exemplo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use exemplo\Categoria;

class Teste extends Controller
{
    public function teste($value=0)
    {
      return $value;
    }
    public function coisa() {

      // $coisas = DB::table('categorias')->get();

      $coisas = \exemplo\Categoria::where('id', '<', '3')->orderBy('id', 'desc')->get();

      // foreach ($coisas as $c) {
      //   echo $c->negocin."<br>";
      // }

      return $coisas;

    }
}
