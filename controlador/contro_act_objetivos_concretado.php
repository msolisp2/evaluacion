<?php
session_start();
include("../modelo/crear_evaluacion_modelo.php");
	if ($_SESSION["tipo"]=="3") 
	{
class crea_evaluacion{
		function creando_evaluacion(){	
			
			$cod_eva=$_REQUEST["cod_eva"];
			$num_seg=$_REQUEST["num_seg"];
			$obj_con=$_REQUEST["num_seg"];		
			$reg=new crear_evaluacion_modelo();
			$reg->act_objetivos_concretado($cod_eva,$num_seg,$obj_con);
	}
}
$reg=new crea_evaluacion();
$reg->creando_evaluacion();
	}	
	else{
		header("Location: ../index.php");
	}
?>