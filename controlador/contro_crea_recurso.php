<?php
session_start();
include("../modelo/crear_evaluacion_modelo.php");
	if ($_SESSION["tipo"]=="3") 
	{
class crea_evaluacion{
		function creando_evaluacion(){	
			
			$cod_eva=$_REQUEST['cod_eva'];
			$notificacion=$_REQUEST['notificacion'];
			$si_obs=$_REQUEST['si_obs'];
			$no_obs=$_REQUEST['no_obs'];
			$correo=$_REQUEST['correo_jefe'];
			$reg=new crear_evaluacion_modelo();
			$reg->crear_recursos($cod_eva,$notificacion,$si_obs,$no_obs,$correo);
	}
}
$reg=new crea_evaluacion();
$reg->creando_evaluacion();
	}	
	else{
		header("Location: ../index.php");
	}
?>