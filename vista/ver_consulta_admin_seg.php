<?php
session_start();
	if($_SESSION["tipo"]=="1") 
	{
$id_depar=$_REQUEST["valor1"];
$ano=$_REQUEST["valor2"];
$id_departamento = implode(",", $id_depar);
	require("../controlador/contro_clase_evaluacion.php");
	$vot=new clase_evaluacion();
	$vot->consulta_evaluacion_departamento_seg($ano,$id_depar);
?>
<?php
	 $fechaGuardada = $_SESSION["ultimoAcceso"]; 
     date_default_timezone_set('America/Bogota'); $ahora = date("Y-n-j H:i:s");	
     $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));	
 if($tiempo_transcurrido >= 8800) {	
	    session_destroy();
        header("Location: ../controlador/cerrar.php"); 
	     }	
	    else { 
    $_SESSION["ultimoAcceso"] = $ahora; 
             } 
}
elseif($_SESSION["tipo"]!="1") {
		header("Location: ../index.php");
	} 
?>