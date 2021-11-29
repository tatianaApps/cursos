<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuariosController extends Controller
{
    public function crear(Request $req){

    	$respuesta = ["status" => 1, "msg" => ""];
    	$datos = $req->getContent();

    	//Validar el json
    	$datos = json_decode($datos);

    	//Validar los datos
    	$usuario = new Usuario();

    	$usuario->nombre = $datos->nombre;
    	$usuario->foto = $datos->foto;
    	$usuario->email = $datos->email;
    	$usuario->pass = $datos->pass;
        $usuario->activado = $datos->activado = 1;

    	//Escribir en la base de datos
    	try{
    		$usuario->save();
    		$respuesta['msg'] = "Usuario guardado con id ".$usuario->id;
    	}catch(\Exception $e){
    		$respuesta['status'] = 0;
    		$respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
    	}

    	return response()->json($respuesta);
    }

    public function desactivar_usuario($id){

        $respuesta = ["status" => 1, "msg" => ""];

        //Buscar al usuario
        try{
            $usuario = Usuario::find($id);
           if($usuario && $usuario->activado == 1){
                $usuario->activado = 0;
                $usuario->save();
                $respuesta['msg'] = "Usuario desactivado";
            
            }else if($usuario->activado == 0){
                $respuesta['msg'] = "Usuario ya desactivado";
            }else{
                $respuesta["msg"] = "Usuario no encontrado";
                $respuesta["status"] = 0;
            }
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }
        return response()->json($respuesta);
    }

    public function editar(Request $req,$id){

        $respuesta = ["status" => 1, "msg" => ""];

        $datos = $req->getContent();

        $datos = json_decode($datos); 

        //Buscar al usuario
        try{
            $usuario = Usuario::find($id);

            if($usuario){
                //VALIDAR LOS DATOS
                if(isset($datos->nombre))
                    $usuario->nombre = $datos->nombre;
                if(isset($datos->foto))
                    $usuario->foto = $datos->foto;
                if(isset($datos->pass))
                    $usuario->pass = $datos->pass;
         
                //Escribir en la base de datos
                    $usuario->save();
                    $respuesta['msg'] = "Usuario actualizado";
            }else{
                $respuesta["msg"] = "Usuario no encontrado";
                $respuesta["status"] = 0;
            }
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }

        return response()->json($respuesta);
    }

    public function ver($id){
        $respuesta = ['status' => 1, "msg" => ""];

        //Buscar a la persona
        try{
            $usuario = Usuario::find($id);
            $respuesta['datos'] = $usuario;
        }catch(\Exception $e){
            $respuesta['status'] = 0;
            $respuesta['msg'] = "Se ha producido un error: ".$e->getMessage();
        }

        return response()->json($respuesta);
    }
}
