<?php
session_start();
	if ($_SESSION["tipo"]=="2") 
	{
     $estado=$_REQUEST["valor1"];
	 $id_eva=$_REQUEST["valor2"];   
	 $num_seg=$_REQUEST["valor3"];   
	require("../modelo/clase_trabajador.php");
	$vot=new clase_trabajador();
	$vot->valores_clase_peso($id_eva,$estado,$num_seg);

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