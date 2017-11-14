<?php
session_start();
include("../modelo/verificar_disponible.php");
	if ($_SESSION["tipo"]=="1") 
	{
class veri_usuario{
		function verificar_usuario(){	
			
			$username = strtolower($_REQUEST['codigo']);
			$reg=new clase_verifica();
			$reg->valores_clase_verifica_codigo($username);
	}
}
$reg=new veri_usuario();
$reg->verificar_usuario();
	}	
	else{
		header("Location: ../index.php");
	}
?>