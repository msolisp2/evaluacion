<?php
session_start();
include("../modelo/clase_usuario.php");
	if ($_SESSION["tipo"]=="1") 
	{
class crea_evaluacion{
		function creando_evaluacion(){	
			
			$id_configuracion=$_REQUEST["id_config"];
			$from=$_REQUEST["from"];
			$to=$_REQUEST["to"];				
			$reg=new clase_usuario();
			$reg->act_configuracion($id_configuracion,$from,$to);
	}
}
$reg=new crea_evaluacion();
$reg->creando_evaluacion();
	}	
	else{
		header("Location: ../index.php");
	}
?>