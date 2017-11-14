<?php
session_start();
include("../modelo/crear_evaluacion_modelo.php");
	if ($_SESSION["tipo"]=="2") 
	{
class crea_evaluacion{
		function creando_evaluacion(){	
			
			$id_mejora=$_REQUEST[id_mejora];
			$tipo=$_REQUEST[tipo];			
			$primer_periodo=$_REQUEST[primer_periodo];
			$segundo_periodo=$_REQUEST[segundo_periodo];
			$reg=new crear_evaluacion_modelo();
			$reg->act_mejoras_jefe($id_mejora,$tipo,$primer_periodo,$segundo_periodo);
	}
}
$reg=new crea_evaluacion();
$reg->creando_evaluacion();
	}	
	else{
		header("Location: ../index.php");
	}
?>