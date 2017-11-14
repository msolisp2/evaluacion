<?php
session_start();
include("../modelo/crear_evaluacion_modelo.php");
	if ($_SESSION["tipo"]=="2") 
	{
class crea_evaluacion{
		function creando_evaluacion(){	
			
			$id_objetivo=$_REQUEST[id_objetivo];
			$meta_alc=$_REQUEST[meta_alc];		
			$reg=new crear_evaluacion_modelo();
			$reg->act_objetivos_meta($id_objetivo,$meta_alc);
	}
}
$reg=new crea_evaluacion();
$reg->creando_evaluacion();
	}	
	else{
		header("Location: ../index.php");
	}
?>