<?php
session_start();
include("../modelo/clase_usuario.php");
	if ($_SESSION["tipo"]=="2") 
	{
class config_jefe{
		function configuracion_jefe(){	
			
			$id_jefe=$_REQUEST["id_jefe"];
			$id_trab=$_REQUEST["empleados"];				
			$reg=new clase_usuario();
			$reg->act_configuracion_jefe($id_jefe,$id_trab);
	}
}
$reg=new config_jefe();
$reg->configuracion_jefe();
	}	
	else{
		header("Location: ../index.php");
	}
?>