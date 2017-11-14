<?php
session_start();
include("../modelo/clase_usuario.php");
	if ($_SESSION["tipo"]=="1"||$_SESSION["tipo"]=="2"||$_SESSION["tipo"]=="3") 
	{
class actu_coordinador{
		function actuali_coordinador(){	
			
			$cod_usu=$_REQUEST[cod_usu];			
			$nombre_usu=$_REQUEST[nombre_usu];	
			$apellido_usu=$_REQUEST[apellido_usu];		
			$clave_usu=$_REQUEST[clave_usu];			
			$re_clave_usu=$_REQUEST[re_clave_usu];	
			$correo_usu=$_REQUEST[correo_usu];			
			$reg=new clase_usuario();
			$reg->act_usuario($cod_usu,$nombre_usu,$apellido_usu,$clave_usu,$re_clave_usu,$correo_usu);
	}
}
$reg=new actu_coordinador();
$reg->actuali_coordinador();
	}	
	else{
		header("Location: ../index.php");
	}
?>