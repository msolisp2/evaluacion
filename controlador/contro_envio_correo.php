<?php
session_start();
include("../modelo/crear_evaluacion_modelo.php");
	if ($_SESSION["tipo"]=="2") 
	{
class crea_evaluacion{
		function creando_evaluacion(){	
			
			$correos=$_REQUEST["correos"];
		    $titulo=$_REQUEST["titulo"];
			$contenido=$_REQUEST["contenido"];
			$reg=new crear_evaluacion_modelo();
			$reg->crear_envio_correo_jefe($correos,$titulo,$contenido);
	}
}
$reg=new crea_evaluacion();
$reg->creando_evaluacion();
	}	
	else{
		header("Location: ../index.php");
	}
?>