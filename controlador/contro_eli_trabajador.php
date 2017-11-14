<?php
session_start();
include("../modelo/clase_usuario.php");
	if ($_SESSION["tipo"]=="2") 
	{
class eli_trabaja{
		function elimina_trabajador(){	
			
			$id_trab=$_REQUEST['id_trab'];
			$reg=new clase_usuario();
			$reg->eli_trabajador($id_trab);
	}
}
$reg=new eli_trabaja();
$reg->elimina_trabajador();
	}	
	else{
		header("Location: ../index.php");
	}
?>