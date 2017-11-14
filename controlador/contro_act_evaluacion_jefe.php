<?php
session_start();
include("../modelo/crear_evaluacion_modelo.php");
	if ($_SESSION["tipo"]=="1" || $_SESSION["tipo"]=="2")
	{
class act_evaluacion{
		function actuali_evaluacion(){	
			
			$cod_eva=$_REQUEST["cod_eva"];
			$cod_eva_trab=$_REQUEST["cod_eva_trab"];
			$nota=$_REQUEST["nota"];
			$estado=$_REQUEST["estado_eval"];
			$reg=new crear_evaluacion_modelo();
			$reg->act_evaluacion_jefe($cod_eva_trab,$cod_eva,$nota,$estado);	
	}
}
$reg=new act_evaluacion();
$reg->actuali_evaluacion();
	}	
	else{
		header("Location: ../index.php");
	}
?>