<?php
session_start();
include("../modelo/crear_evaluacion_modelo.php");
	if ($_SESSION["tipo"]=="3") 
	{
class crea_evaluacion{
		function creando_evaluacion(){	
			
			$cod_eva=$_REQUEST["cod_eva"];
			$dificultad=$_REQUEST["dificultad"];
			$analisis=$_REQUEST["analisis"];
			$actividad=$_REQUEST["actividad"];
			$responsable=$_REQUEST["responsable"];
			$reg=new crear_evaluacion_modelo();
			$reg->crear_mejoras($cod_eva,$dificultad,$analisis,$actividad,$responsable);
	}
}
$reg=new crea_evaluacion();
$reg->creando_evaluacion();
	}	
	else{
		header("Location: ../index.php");
	}
?>