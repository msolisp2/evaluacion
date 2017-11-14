<?php
session_start();
include("../modelo/crear_evaluacion_modelo.php");
	if ($_SESSION["tipo"]=="3") 
	{
class eli_evaluacion{
		function elimina_evaluacion(){	
			
			$id_mej=$_REQUEST['id_mej'];
			$reg=new crear_evaluacion_modelo();
			$reg->eli_mejora($id_mej);
	}
}
$reg=new eli_evaluacion();
$reg->elimina_evaluacion();
	}	
	else{
		header("Location: ../index.php");
	}
?>