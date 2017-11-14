<?php
session_start();
include("../modelo/validarlogin.php");
class validacion{

    function validando(){

        $cod=$_REQUEST["codigo"];
        $cla=$_REQUEST["clave"];
		$tipo_usu=$_REQUEST["tipo_usuario"];

		$vali=new ValidarEntrada();
		$vali->validar($cod,$cla,$tipo_usu);
		
    }

}
$val=new validacion();
$val->validando();
?>