<?php
session_start();
include("../modelo/crear_evaluacion_modelo.php");
	if ($_SESSION["tipo"]=="2") 
	{
class crea_evaluacion{
		function creando_evaluacion(){	
			
			$cod_eva=$_REQUEST[cod_eva];
			$estado_eva=$_REQUEST[estado_eva];		
			$reg=new crear_evaluacion_modelo();
			$reg->act_mejoras_estado_jefe($cod_eva,$estado_eva);
	}
}
$reg=new crea_evaluacion();
$reg->creando_evaluacion();
	}	
	else{
		header("Location: ../index.php");
	}
?>