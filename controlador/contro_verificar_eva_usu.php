<?php
session_start();
	if ($_SESSION["tipo"]=="2") 
	{
     $id_trabajador=$_REQUEST["valor1"];
	 $ano=$_REQUEST["valor2"];   
	require("../modelo/clase_trabajador.php");
	$vot=new clase_trabajador();
	$vot->valores_clase_eva_usu($id_trabajador,$ano);

	 $fechaGuardada = $_SESSION["ultimoAcceso"]; 
	 date_default_timezone_set('America/Bogota');
     $ahora = date("Y-n-j H:i:s");
     $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));	
 if($tiempo_transcurrido >= 900) {	
	    session_destroy();
        header("Location: ../controlador/cerrar.php"); 
	     }	
	    else { 
    $_SESSION["ultimoAcceso"] = $ahora; 
             } 
}
elseif($_SESSION["tipo"]!="2") {
		header("Location: ../index.php");
	} 
?>