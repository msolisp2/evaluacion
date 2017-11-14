<?php
session_start();
include("../modelo/crear_evaluacion_modelo.php");
	if ($_SESSION["tipo"]=="3") 
	{
class crea_evaluacion{
		function creando_evaluacion(){	
			
			$dificultad=$_REQUEST[dificultad];
			$analisis=$_REQUEST[analisis];
			$actividad=$_REQUEST[actividad];
			$responsable=$_REQUEST[responsable];
			$id_mejora=$_REQUEST[id_mejora];	
			$reg=new crear_evaluacion_modelo();
			$reg->act_mejoras($dificultad,$analisis,$actividad,$responsable,$id_mejora);
	}
}
$reg=new crea_evaluacion();
$reg->creando_evaluacion();
	}	
	else{
		header("Location: ../index.php");
	}
?>