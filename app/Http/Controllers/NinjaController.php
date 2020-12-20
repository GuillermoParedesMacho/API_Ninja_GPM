<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ninja;

class NinjaController extends Controller
{
    function crear(Request $request){
    	//cracion de variable necesarias
    	$respuesta = "";
    	$datos = $request;

    	//comprovacion de datos presentes
    	if($datos){

    		//crear nueva linea de la tabla
    		$ninja = new Ninja();

    		//asignar valores a la nueva linea
    		$ninja->Nombre = $datos->Nombre;
    		$ninja->Rango = $datos->Rango;
    		$ninja->Fecha_Registro = date("Y-m-d");
    		$ninja->Informe_Habilidades = $datos->Informe_Habilidades;
    		$ninja->Estado = 'Activo';

    		//enviar datos a bbdd
    		try{
    			$ninja->save();

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

    		//encontrar al ninja
    		$ninja = Ninja::find($id);

    		//comprovacion de encontrar al ninja
    		if($ninja){
    			//asignar valores a la nueva linea
    			if($datos->Nombre){
	    			$ninja->Nombre = $datos->Nombre;
    			}
    			if($datos->Rango){
	    			$ninja->Rango = $datos->Rango;
    			}
    			if($datos->Fecha_Registro){
	    			$ninja->Fecha_Registro = $datos->Fecha_Registro;
    			}
    			if($datos->Informe_Habilidades){
	    			$ninja->Informe_Habilidades = $datos->Informe_Habilidades;
    			}
    			if($datos->Estado){
	    			$ninja->Estado = $datos->Estado; //nota: esta linea tambien cumple con la condicion de baja
    			}

				//enviar datos a bbdd
				try{
					$ninja->save();

					$respuesta = "OK";
				}catch(\Exception $e){
					$respuesta = $e->getMessage();
				}
			}
			else{
				$respuesta = "Ninja no encontrado";
			}
    	}
    	else{
    		$respuesta = "Datos incorrectos";
    	}

    	//respuesta
    	return response($respuesta);
    }

    function lista(Request $request){
    	//variables necesarias
    	$ninjas = Ninja::all();
    	$resultado = [];

    	$datos = $request;

    	if($datos->Nombre){
    		$ninjas = $ninjas->where('Nombre','=',$datos->Nombre);
    	}
    	if($datos->Estado){
    		$ninjas = $ninjas->where('Estado','=',$datos->Estado);
    	}

    	foreach($ninjas as $ninja){
    		$resultado[] = [
    			"Nombre" => $ninja->Nombre,
    			"Fecha_Registro" => $ninja->Fecha_Registro,
    			"Rango" => $ninja->Rango,
    			"Estado" => $ninja->Estado
    		];
    	}

    	return response()->json($resultado);
    }
}
