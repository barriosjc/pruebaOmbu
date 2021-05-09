<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Http;
use GuzzleHttp\Client;

class MuseosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    //    $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function listar() {

        $eleccion = $_GET['servicios'];

        $url = $this->obt_url($eleccion);
        $response = Http::get($url);
        $n = json_decode($response);
        $result = $n->results;
        $resultado = array_slice($result, 0 , 7);
        $titulo = ucfirst($eleccion);
// dd($resultado, $titulo);

        return view('welcome', compact('titulo', 'resultado'));
    }

    private function obt_url($eleccion) {
      
        $valores = [
            "usuarios" => "https://www.cultura.gob.ar/api/v2.0/usuarios/?format=json",
            "organismos" => "https://www.cultura.gob.ar/api/v2.0/organismos/?format=json",
            "programas" =>"https://www.cultura.gob.ar/api/v2.0/programas/?format=json",
            "museos" => "https://www.cultura.gob.ar/api/v2.0/museos/?format=json",
            "institutos" => "https://www.cultura.gob.ar/api/v2.0/institutos/?format=json",
            "tramites" => "https://www.cultura.gob.ar/api/v2.0/tramites/?format=json",
            "convocatorias" => "https://www.cultura.gob.ar/api/v2.0/convocatorias/?format=json"
        ];

        $result = $valores[$eleccion];
     
        return $result;
    }


}