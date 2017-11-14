<?php
session_start();
include("../modelo/crear_evaluacion_modelo.php");
	if ($_SESSION["tipo"]=="3") 
	{
class crea_evaluacion{
		function creando_evaluacion(){	
			
			$id_objetivo=$_REQUEST[id_objetivo];
			$objetivo=$_REQUEST[objetivo];
			$evidencia=$_REQUEST[evidencia];
			$meta=$_REQUEST[meta];
			$meta_valor=$_REQUEST[meta_valor];
			$peso=$_REQUEST[peso];		
			$reg=new crear_evaluacion_modelo();
			$reg->act_objetivos($id_objetivo,$objetivo,$evidencia,$meta,$meta_valor,$peso);
	}
}
$reg=new crea_evaluacion();
$reg->creando_evaluacion();
	}	
	else{
		header("Location: ../index.php");
	}
?>