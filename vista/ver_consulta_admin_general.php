<?php
session_start();
	if($_SESSION["tipo"]=="1") 
	{
	$id_departamento=$_REQUEST["valor1"];
	$ano=$_REQUEST["valor2"];
	$id_depar = implode(",", $id_departamento);
?>	.
<style type="text/css">
.a {
    width: 30%;
}
.b {
    vertical-align: middle !important;
}
</style>
<?php	
	require("../controlador/contro_clase_evaluacion.php");
	$vot=new clase_evaluacion();
	$vot->consulta_evaluacion_general($ano,$id_depar);
?>
	<div class="text-center">
		<div class="btn-group">
			<button role="button" id="boton" class="btn btn-primary" onClick="env_correo()"><i class="fa fa-envelope"></i> Correo</button>
		</div>
	</div>	
<hr><br>
		<div id="capas"> 
		</div>	
<script type="text/javascript">   
function env_correo () {
var final = ''
					$('.ads_Checkbox:checked').each(function(){        
						var values = $(this).val()+',';
						final += values;
					});
						
//alert ("Este seria el mensaje de alerta desde boton!"+final);
$("#capas").load("../vista/ver_correo_admin.php",{valor1: final}, function(response, status, xhr) {
                          if (status == "error") {
                            var msg = "Error!, algo ha sucedido: ";
                            $("#capas").html(msg + xhr.status + " " + xhr.statusText);
                          }
                        });
}			
</script>
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