<?php
session_start();
include("../modelo/crear_evaluacion_modelo.php");
	if ($_SESSION["tipo"]=="2" || $_SESSION["tipo"]=="3")
	{
class act_evaluacion{
		function actuali_evaluacion(){	
			
			$cod_eva=$_REQUEST["cod_eva"];
			$cod_eva_trab=$_REQUEST["cod_eva_trab"];
			$nota=$_REQUEST["nota"];
			$estado=$_REQUEST["estado_eval"];
			$total=$_REQUEST["total"];
			$reg=new crear_evaluacion_modelo();
			$reg->act_evaluacion($cod_eva_trab,$cod_eva,$nota,$estado,$total);	
	}
}
$reg=new act_evaluacion();
$reg->actuali_evaluacion();
	}	
	else{
		header("Location: ../index.php");
	}
?>