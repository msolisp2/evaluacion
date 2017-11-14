<?php
session_start();
include("../modelo/crear_evaluacion_modelo.php");
	if ($_SESSION["tipo"]=="2") 
	{
class eli_evaluacion{
		function elimina_evaluacion(){	
			
			$id_eva=$_REQUEST['id_eva'];
			$reg=new crear_evaluacion_modelo();
			$reg->eli_evaluacion($id_eva);
	}
}
$reg=new eli_evaluacion();
$reg->elimina_evaluacion();
	}	
	else{
		header("Location: ../index.php");
	}
?>