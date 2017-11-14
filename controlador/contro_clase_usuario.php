<?php
//session_start();
	if ($_SESSION["tipo"]=="1" || $_SESSION["tipo"]=="2" || $_SESSION["tipo"]=="3") 
	{	
include_once("../modelo/clase_usuario.php");
	class controla_clase_usuario{ //Clase Facultad
	
		function val_clase_usuario($id_usuario){ //Valores Facultad
			$facu=new clase_usuario();
			$facu->valores_clase_usuario($id_usuario);									
		}
		
	}
$depa=new controla_clase_usuario();
	}
	else{
		header("Location: ../index.php");
	}		
?>