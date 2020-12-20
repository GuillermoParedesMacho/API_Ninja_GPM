<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mision;
use App\Models\Cliente;
use App\Moddels\Ninja;

class MisionController extends Controller
{
	function crear(Request $request){
    	//cracion de variable necesarias
    	$respuesta = "";
    	$datos = $request;

    	//comprovacion de datos presentes
    	if($datos){

    		//crear nueva linea de la tabla
    		$mision = new Mision();

    		//buscar al cliente
    		$cliente = Cliente::find($datos->id_Cliente);

    		//asignar valores a la nueva linea
    		$mision->Fecha_Encargo = date("Y-m-d");
    		$mision->Descripcion = $datos->Descripcion;
    		$mision->Ninjas_Estimados = $datos->Ninjas_Estimados;
    		$mision->Prioritario = $cliente->VIP;
    		$mision->Pago = $datos->Pago;
    		$mision->id_Cliente = $datos->id_Cliente;

    		//enviar datos a bbdd
    		try{
    			$mision->save();

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

    		//comprobar id existe
    		if($id){

	    		//encontrar la mision
	    		$mision = Mision::find($id);

	    		//asignar nuevos valores
	    		if($datos->Fecha_Encargo){
	    			$mision->Fecha_Encargo = $datos->Fecha_Encargo;
	    		}
	    		if($datos->Descripcion){
	    			$mision->Descripcion = $datos->Descripcion;
	    		}
	    		if($datos->Ninjas_Estimados){
	    			$mision->Ninjas_Estimados = $datos->Ninjas_Estimados;
	    		}
	    		if($datos->Pago){
	    			$mision->Pago = $datos->Pago;
	    		}

	    		//enviar datos a bbdd
	    		try{
	    			$mision->save();

	    			$respuesta = "OK";
	    		}catch(\Exception $e){
	    			$respuesta = $e->getMessage();
	    		}
    		}
    	}
    	else{
    		$respuesta = "Datos incorrectos";
    	}

    	//respuesta
    	return response($respuesta);
	}

	function asignarNinjas(Request $request){
		//cracion de variable necesarias
		$respuesta = "";
		$datos = $request;

		if($datos){
			$ninja = Ninja::find($datos->Ninja_id);

			$mision = Mision::find($datos->Mision_id);

			$mision->Estado = "En_Curso";

			try{
				$ninja->save();
			}catch(\Exception $e){
				$respuesta = $e->getMessage();
				return response($respuesta);
			}

			//enviar datos a bbdd
			try{
				$mision->save();
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

	function completar(Request $request,$id){
		//cracion de variable necesarias
		$respuesta = "";
		$datos = $request;

		if($datos){
			$mision = Mision::find($id);

			if($mision){
				$mision->Estado = $datos->$Estado;
				$mision->Fecha_Completado = date("Y-m-d");

				//enviar datos a bbdd
				try{
					$mision->save();

					$respuesta = "OK";
				}catch(\Exception $e){
					$respuesta = $e->getMessage();
				}
			}
			else{
				$respuesta = "Mision no encontrada";
			}
		}
		else{
			$respuesta = "Datos incorrectos";
		}

		//respuesta
		return response($respuesta);
	}
}