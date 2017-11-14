<?php
session_start();
include("../modelo/crear_evaluacion_modelo.php");
	if ($_SESSION["tipo"]=="2") 
	{
class crea_evaluacion{
		function creando_evaluacion(){	
			
			$id_trab=$_REQUEST["id_trab_select"];
			$id_cargo_trab=$_REQUEST["id_cargo_trab"];
			$id_nivel_trab=$_REQUEST["id_nivel_trab"];
			$id_par=$_REQUEST["id_par_select"];	
			$id_cargo_par=$_REQUEST["id_cargo_par"];
			$id_usuario=$_REQUEST["id_usuario_select"];			
			$id_cargo_usuario=$_REQUEST["id_cargo_usuario"];				
			$ano_eval=$_REQUEST["ano_eval"];
			$fecha_inicio=$_REQUEST["fecha_inicio"];
			$fecha_fin=$_REQUEST["fecha_fin"];
			$id_jefe=$_REQUEST["id_jefe"];
			$id_cargo_jefe=$_REQUEST["id_cargo_jefe"];
			$id_depe=$_REQUEST["id_depe"];
			$correo_trab=$_REQUEST["correo_trab"];
			$correo_usuario=$_REQUEST["correo_usuario"];
			$correo_par=$_REQUEST["correo_par"];	
			$id_valida_anio=$_REQUEST["id_valida_anio"];
			$id_valida_par=$_REQUEST["id_valida_par"];
			$id_valida_usuario=$_REQUEST["id_valida_usuario"];	
		    $total = $id_valida_anio+$id_valida_usuario+$id_valida_par;		
			date_default_timezone_set('America/Bogota');
			$fecha=date("ymd");	
			$prefijo = substr(rand(),0,3);
			$cod_eval = $fecha.$prefijo;
			$reg=new crear_evaluacion_modelo();
			$reg->crear_evaluacion($id_trab,$id_cargo_trab,$id_nivel_trab,$id_par,$id_cargo_par,$id_usuario,$id_cargo_usuario,$ano_eval,$fecha_inicio,$fecha_fin,$id_jefe,$id_cargo_jefe,$id_depe,$cod_eval,$correo_par,$correo_usuario,$correo_trab,$total);
	}
}
$reg=new crea_evaluacion();
$reg->creando_evaluacion();
	}	
	else{
		header("Location: ../index.php");
	}
?>