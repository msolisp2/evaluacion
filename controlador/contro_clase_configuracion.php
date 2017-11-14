<?php
//session_start();
	if ($_SESSION["tipo"]=="1" || $_SESSION["tipo"]=="2" || $_SESSION["tipo"]=="3") 
	{	
include_once("../modelo/clase_usuario.php");
	class controla_clase_configuracion{ 

		function val_clase_configuracion(){ 
			$facu=new clase_usuario();
			$facu->valores_configuracion();
											
		}
		
		function val_clase_configuracion_consulta(){ 
			$facu=new clase_usuario();
			$facu->valores_configuracion_consulta();
											
		}
		
			}
$depa=new controla_clase_configuracion();
	}
	else{
		header("Location: ../index.php");
	}		
?>