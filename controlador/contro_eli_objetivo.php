<?php
session_start();
include("../modelo/crear_evaluacion_modelo.php");
	if ($_SESSION["tipo"]=="3") 
	{
class eli_evaluacion{
		function elimina_evaluacion(){	
			
			$id_obj=$_REQUEST['id_obj'];
			$reg=new crear_evaluacion_modelo();
			$reg->eli_objetivo($id_obj);
	}
}
$reg=new eli_evaluacion();
$reg->elimina_evaluacion();
	}	
	else{
		header("Location: ../index.php");
	}
?>