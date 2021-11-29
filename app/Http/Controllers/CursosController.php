<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Curso;
use App\Models\Video;

class CursosController extends Controller
{
    public function crear(Request $req){

    	$respuesta = ["status" => 1, "msg" => ""];
    	$datos = $req->getContent();

    	//Validar el json
    	$datos = json_decode($datos);

    	//Validar los datos
    	$curso = new Curso();

    	$curso->titulo = $datos->titulo;
    	$curso->descripcion = $datos->descripcion;
    	$curso->foto = $datos->foto;
    
    	//Escribir en la base de datos
    	try{
    		$curso->save();
    		$respuesta['msg'] = "Curso guardado con id ".$curso->id;
    	}catch(\Exception $e){
    		$respuesta['status'] = 0;
    		$respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
    	}

    	return response()->json($respuesta);
    }

    public function listar(Request $req){

        $respuesta = ["status" => 1, "msg" => ""];
        $datos = $req->getContent();
    	$datos = json_decode($datos);

        try{
        	$cursos = DB::table('cursos');

        	if($req->has('titulo')){
        		$curso = Curso::withCount('videos as cantidad')
        		->where('titulo','like','%'.$req->input('titulo').'%')
        		->get();
            	$respuesta['datos'] = $curso;
        	}else{
        		$curso = Curso::withCount('videos as cantidad')->get();
            	$respuesta['datos'] = $curso;
        	}
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }
        return response()->json($respuesta);
    }
}
