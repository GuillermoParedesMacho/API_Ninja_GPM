<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    function crear(Request $request){
    	//cracion de variable necesarias
    	$respuesta = "";
    	$datos = $request;

    	//comprovacion de datos presentes
    	if($datos){

    		//crear nueva linea de la tabla
    		$cliente = new Cliente();

    		//asignar valores a la nueva linea
    		$cliente->Codigo = $datos->Codigo;
    		$cliente->VIP = $datos->VIP;
    		$cliente->Fecha_Registro = date("Y-m-d");

    		//enviar datos a bbdd
    		try{
    			$cliente->save();

    			$respuesta = "OK";
    		}catch(\Exception $e){
    			$respuesta = $e->getMessage();
    		}
    	}
    	else{
    		$respuesta = "Datos incorrectos";
    	}

    	//respuesta
    	return response($respuesta);
    }

    function modificar(Request $request,$id){
		//cracion de variable necesarias
    	$respuesta = "";
    	$datos = $request;

    	//comprovacion de datos presentes
    	if($datos){

    		//encontrar al cliente
    		$cliente = Cliente::find($id);

    		//comprovacion de encontrar al cliente
    		if($cliente){
    			//asignar valores a la nueva linea
    			if($datos->Codigo){
	    			$cliente->Codigo = $datos->Codigo;
    			}
    			if($datos->VIP){
	    			$cliente->VIP = $datos->VIP;
    			}

				//enviar datos a bbdd
				try{
					$cliente->save();

					$respuesta = "OK";
				}catch(\Exception $e){
					$respuesta = $e->getMessage();
				}
			}
			else{
				$respuesta = "Cliente no encontrado";
			}
    	}
    	else{
    		$respuesta = "Datos incorrectos";
    	}

    	//respuesta
    	return response($respuesta);
    }

    function lista(){
    	//variables necesarias
    	$ninjas = Cliente::all();
    	$resultado = [];

    	foreach($ninjas as $cliente){
    		$resultado[] = [
    			"Codigo" => $cliente->Codigo,
    			"VIP" => $cliente->VIP,
    			"Fecha_Registro" => $cliente->Fecha_Registro
    		];
    	}

    	return response()->json($resultado);
    }
}
