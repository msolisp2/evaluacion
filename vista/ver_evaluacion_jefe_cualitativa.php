<?php
session_start();
	if($_SESSION["tipo"]=="2" || $_SESSION["tipo"]=="3") 
	{
$cod_eva=$_REQUEST["cod_eva"];
$id_config=2;
require_once("../controlador/contro_clase_evaluacion.php");
$eval=new clase_evaluacion();
$eval->valores_clase_evaluacion($cod_eva); 
$config=new clase_evaluacion();
$config->valores_clase_configuracion($id_config);
$eval_cua=new clase_evaluacion();
$eval_cua->valores_clase_evaluacion_trabajador($eval->codigo_eva);
date_default_timezone_set('America/Bogota');
$hoy=date("Y-m-d")
?>
<style type="text/css">
table , td, th {
    border-collapse: collapse !important;
}
table + table, table + table tr:first-child th, table + table tr:first-child td {
    border-top: 0 !important;
}
.td_center {
text-align:center !important;
vertical-align:middle !important;
}
/*
   Vertical text
   by @kizmarh
*/
.vertical-text {
	display: inline-block;
	overflow: hidden;
	width: 1.5em;
	position:relative;
    top:250px;
}
.vertical-text_dos {
	display: inline-block;
	overflow: hidden;
	width: 1.5em;
	position:relative;
    top:150px;
}
.vertical-text__inner {
	display: inline-block;
	white-space: nowrap;
	line-height: 1.5;
	transform: translate(0,100%) rotate(-90deg);
	transform-origin: 0 0;
}
/* This element stretches the parent to be square
   by using the mechanics of vertical margins  */
.vertical-text__inner:after {
	content: "";
	display: block;
	margin: -1.5em 0 100%;
}
}
</style>
<form id="form_eval" class="form-horizontal" method="post" data-validate="parsley">
<input type="hidden" id="cod_eva" name="cod_eva" value="<?php echo $cod_eva ?>">
<input type="hidden" id="cod_eva_trab" name="cod_eva_trab" value="<?php echo $eval->codigo_eva ?>">
<br>
<center>
<div id="info_c"></div>
Mostrar Cabecera
<input type="checkbox" name="check_objetivo" id="check_objetivo" value="1" onchange="javascript:showContent()" />
</center>
<br>
<div id="content_objetivo" style="display: none;">
				<table class="table table-bordered">
                                <tr>
                                    <td rowspan="3" align="center"><img src="../estilos/images/udc2.png" alt="Smiley face" height="100" width="100"></td>
                                    <td colspan="2" align="center"><strong>UNIVERSIDAD DE CARTAGENA</strong></td>
                                    <td><strong>CÓDIGO:</strong> FO-TH/AL-033</td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center"><strong>OFICINA ASESORA DE GESTIÓN HUMANA Y DESARROLLO DE PERSONAL</strong></td>
									<td><strong>VERSIÓN:</strong> 03</td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center"><strong>GESTIÓN DEL DESEMPEÑO PARA EMPLEADOS PÚBLICOS NO DOCENTES Y TRABAJADORES OFICIALES</strong></td>
									<td><strong>FECHA:</strong> 13/12/2010</td>
                                </tr>
								<tr>
                                    <td colspan="4" align="justify"><strong>Referencia:</strong> Formato <strong>C - Descripción cualitativa del desempeño laboral del evaluado y notificación</strong></td>
                                </tr>
								<tr>
                                    <td colspan="4" align="justify"><strong>Objetivo:</strong> Describir aspectos generales del empleado con relación a compromisos establecidos con la institución y evidenciar las notificaciones del evaluado respecto al proceso de gestión de desemepeño.</td>
                                </tr>
								<tr>
                                    <td colspan="4" align="justify">El evaluador deberá describir el cumplimiento laboral del empleado, teniendo en cuenta como minimo los siguientes criterios: cumplimiento del horario laboral, cumplimiento de asistencia a los cursos establecidos en el Plan Institucional de Capacitación, transferencia del conocimiento o habilidad aprendida por el empleado en las capacitaciones realizadas en el puesto de trabajo, cumplimiento del porte y uso adecuado de la dotación institucional (Aplica para empleados que reciben dotación.) </td>
									
                                </tr>								
				</table>
				<table class="table table-bordered">
								<tr>
                                    <td width="30%" align="left"><strong>Fecha de diligenciamiento:</strong></td>
									<td align="left"><?php   echo date("Y-m-d");  ?></td>
                                </tr>	
                </table>
				<table class="table table-bordered">
								<tr>
								  <td width="20%" align="center"><strong>Evaluado</strong></td>
								  <td width="40%"><?php  echo $eval->empleado ?></td>
								  <td width="10%" align="center"><strong>Cargo</strong></td>
								  <td width="30%"><?php   echo $eval->empleado_cargo ?></td>
								</tr>	
								<tr>
								  <td width="20%" align="center"><strong>Evaluador</strong></td>
								  <td width="40%"><?php  echo $eval->jefe ?></td>
								  <td width="10%" align="center"><strong>Cargo</strong></td>
								  <td width="30%"><?php  echo $eval->jefe_cargo ?></td>
								</tr>
				</table>
				</div>	
								<table class="table table-bordered">
								<tr>
                                    <td colspan="4" width="30%" align="left"><strong>Descripcion Cualitativa por parte del Evaluador hacia el empleado evaluado.</strong></td>
                                </tr>	
								<tr>
								     <td colspan="4" align="center">	

								<div class="compose-editor">
											<textarea class="form-control" id="evaluacion_cualitativa" name="evaluacion_cualitativa" rows="9" data-required="true"><?php echo $eval_cua->eva_cualitativa; ?></textarea>	
										</div>
										</td>
                                </tr>
                </table>
                <br><br>
                <div class="row">
										<div class="col-lg-5"></div>
										<div class="col-lg-3">
									     <div class="form-group" align="center">  
										 <strong>Estado</strong><br>
												  <select class="form-control m-bot15" id="estado_eval" name="estado_eval" data-required="true">
													<option value="">Seleccione Estado</option>
													<option value="Pendiente">Sin Finalizar</option>
													<option value="Finalizada">Finalizada</option>
												  </select>  <span class="label label-warning"><?php echo $eval_cua->estado_eva_cualitativa; ?></span> 
										  </div> 
									  </div> 
									  </div>
									<br>
									<div class="row">
										<div class="col-lg-5"></div>
										<div class="col-lg-3">
											<div class="box-footer" align="center">
												<button type="submit" class="btn btn-primary">Actualizar</button>
												<button type="reset" class="btn btn-danger">Cancelar</button>
											</div>
									  </div> 
									  </div>	
</table>									  
	</form>								  
<script type="text/javascript">
$("#form_eval").parsley();
$('#info_c').html('<img src="../estilos/images/input-spinner.gif" alt="" />').fadeOut(1000);
    function showContent() {
        element = document.getElementById("content_objetivo");
        check = document.getElementById("check_objetivo");
        if (check.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }
	//Suma
$('.m-bot5').blur(function () {
    var sum = 0;
    $('.m-bot5').each(function() {
        if($(this).val()!="")
         {
            sum += parseFloat($(this).val());
         }

    });
		$('#total').val(sum);
        //alert(sum);
});	
</script>
<script type="text/javascript">
$(document).ready(function()
{		
	$(document).on('submit', '#form_eval', function()
	{
		var data = $(this).serialize();
		$.ajax({		
		type : 'POST',
		url  : '../controlador/contro_act_evaluacion_cualitativa.php',
		data : data,
		success :  function(data)
				   {					
					$("#form_eval").fadeOut(500).hide(function()
						{	
						var mydata= jQuery.parseJSON(data);						
						notif({
								msg: mydata.suceso,
								type: mydata.evento
								});
						});				
				   }
		});
		return false;
	});
});
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