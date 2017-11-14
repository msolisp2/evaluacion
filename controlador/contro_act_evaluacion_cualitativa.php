<?php
session_start();
include("../modelo/crear_evaluacion_modelo.php");
	if ($_SESSION["tipo"]=="2" || $_SESSION["tipo"]=="3")
	{
class act_evaluacion{
		function actuali_evaluacion(){	
			
			$cod_eva=$_REQUEST["cod_eva_trab"];
			$estado_eval=$_REQUEST["estado_eval"];
			$evaluacion_cualitativa=$_REQUEST["evaluacion_cualitativa"];
			$reg=new crear_evaluacion_modelo();
			$reg->act_evaluacion_cualitativa($cod_eva,$evaluacion_cualitativa,$estado_eval);
	}
}
$reg=new act_evaluacion();
$reg->actuali_evaluacion();
	}	
	else{
		header("Location: ../index.php");
	}
?>