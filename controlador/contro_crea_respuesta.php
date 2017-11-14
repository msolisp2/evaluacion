<?php
session_start();
include("../modelo/crear_evaluacion_modelo.php");
	if ($_SESSION["tipo"]=="2") 
	{
class crea_evaluacion{
		function creando_evaluacion(){	
			
			$id_recurso=$_REQUEST['id_recurso'];
			$cod_usuario=$_REQUEST['id_usuario'];
			$respuesta=$_REQUEST['respuesta'];
			$reg=new crear_evaluacion_modelo();
			$reg->crear_respuesta($id_recurso,$cod_usuario,$respuesta);
	}
}
$reg=new crea_evaluacion();
$reg->creando_evaluacion();
	}	
	else{
		header("Location: ../index.php");
	}
?>