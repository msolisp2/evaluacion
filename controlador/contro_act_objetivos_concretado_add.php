<?php
session_start();
include("../modelo/crear_evaluacion_modelo.php");
	if ($_SESSION["tipo"]=="3") 
	{
class crea_evaluacion{
		function creando_evaluacion(){	
			
			$id_objetivo=$_REQUEST["id_objetivo"];
			$objetivo=$_REQUEST["objetivo"];
			$evidencia=$_REQUEST["evidencia"];
			$meta=$_REQUEST["meta"];
			$meta_valor=$_REQUEST["meta_valor"];
			$peso=$_REQUEST["peso"];
			$cod_eva=$_REQUEST["cod_eva"];
			$num_seg=$_REQUEST["num_seg"];	
			$obj_con=$_REQUEST["objetivo_conc"];
			$respuesta=$_REQUEST["respuesta"];		
			$reg=new crear_evaluacion_modelo();
			$reg->act_objetivos_add($id_objetivo,$objetivo,$evidencia,$meta,$meta_valor,$peso,$cod_eva,$num_seg,$obj_con,$respuesta);
	}
}
$reg=new crea_evaluacion();
$reg->creando_evaluacion();
	}	
	else{
		header("Location: ../index.php");
	}
?>