<?php
session_start();
	if($_SESSION["tipo"]=="2") 
	{
$id_cod_obj=$_REQUEST["id_cod_obj"];
require_once("../controlador/contro_clase_trabajador.php");
$eva=new clase_trabajador();
$eva->valores_clase_evaluacion($id_cod_obj);
$trab=new clase_trabajador();
$trab->valores_clase_trabajador($eva->cod_trabajador);
require_once("../controlador/contro_clase_evaluacion.php");
$mejor=new clase_evaluacion();
$mejor->valores_clase_mejora($id_cod_obj);
date_default_timezone_set('America/Bogota');
$hoy=date("Y-m-d");
if($id_cod_obj){
?>
<style type="text/css">
table , td, th {
    border-collapse: collapse !important;
}
table + table, table + table tr:first-child th, table + table tr:first-child td {
    border-top: 0 !important;
}
.panel-group .panel {
  overflow: visible;
}
#dynamic-table .my-table-center{ text-align: center; line-height: 100px;}
</style><br><br>
<center>
Mostrar Cabecera e Instrucciones
<input type="checkbox" name="check_objetivo" id="check_objetivo" value="1" onchange="javascript:showContent()" />
</center>
<br>
<div id="content_objetivo" style="display: none;">
				<table class="table table-bordered">
                                <tr>
                                    <td rowspan="3" align="center"><img src="../estilos/images/UCartagena1.png" alt="Smiley face" height="100" width="100"></td>
                                    <td colspan="2" align="center"><strong>UNIVERSIDAD DE CARTAGENA</strong></td>
                                    <td><strong>CÓDIGO:</strong> FO-TH/AL-034</td>
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
                                    <td colspan="4" align="justify"><strong>Referencia:</strong> Formato <strong>D - Plan de mejora laboral</strong></td>
                                </tr>
								<tr>
                                    <td colspan="4" align="justify"><strong>Objetivo:</strong> establecer compromisos medibles y metas realizables, que permitan mejorar las evaluaciones que presentaron dificultades y hacerle seguimiento.</td>
                                </tr>	
				</table>
								<table class="table table-bordered">
								<tr>
                                    <td colspan="4" align="center"><strong>INSTRUCCIONES</strong></td>
                                </tr>
								<tr>
                                    <td colspan="4" align="justify">
									<p>El plan de mejora laboral debe ser aplicado a los funcionarios con calificación insatisfactoria, quien con el acompañamiento del jefe inmediato, deberán describir las dificultades que serán objeto de mejoramiento específico durante el periodo de evaluación siguiente.  Se recomienda establecer compromisos concretos y medibles expresados en metas realistas y tiempos precisos que serán objeto de seguimiento.   La definición clara de estos aspectos permitirá en buena medida el éxito del plan de mejora. 									
									</p>
									</td>
                                </tr>
								</table>	
				<table class="table table-bordered">		
								<tr>
								  <td width="22%" align="center"><strong>Nombre del Empleado</strong></td>
								  <td width="40%"><?php echo ucwords(strtolower($trab->nombre_trab))  ?></td>
								  <td width="13%" align="center"><strong>Dependencia</strong></td>
								  <td width="25%"><?php  echo $eva->area ?></td>
								</tr>							
                </table>				
				</div>				
				<table class="table table-bordered">								
								<tr>
                                    <td colspan="4" align="center"><strong>I. Dificultades, Análisis de Causa, Plan de Acción </strong>
									</td>
                                </tr>
				</table>
				<?php
									$lis_objd=new clase_evaluacion();
									$lis_objd->valores_listado_mejorar_jefe($mejor->cod_plan);
				?>
				<div id="footer_objetivo" style="display: none;">
				<table class="table table-bordered">		
								<tr>
								  <td width="22%"><strong>Firma del evaluador:</strong></td>
								  <td width="28%"><?php  echo $eva->nombre_jefe  ?></td>
								  <td width="22%"><strong>Firma del empleado:</strong></td>
								  <td width="28%"><?php echo ucwords(strtolower($trab->nombre_trab))  ?></td>
								</tr>
								  <td colspan="4"><strong>Ciudad y fecha: </strong><?php  echo $trab->ciudad.','.$hoy  ?></td>
								<tr>
								</tr>															
                </table>
				</div>				
<!-- Modificar Objetivo -->	
		<div id="editar_info" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Actualizar Plan Mejora</h4>
			</div>
			<div class="modal-body">
			<div id="modalContent_editar" style="display:none;">

			</div>                        
			</div><!-- End of Modal body -->
			</div><!-- End of Modal content -->
			</div><!-- End of Modal dialog -->
        </div><!-- End of Modal Meta -->  
 <?php 	
} 
 else {
  echo "Debes seleccionar un Año";
 }	
 ?>
<script src="../estilos/js/wizard.js"></script>
<script type="text/javascript">	
$("#form_eval").parsley();
</script>
<script type="text/javascript">
    function showContent() {
        element = document.getElementById("content_objetivo");
		elementa = document.getElementById("footer_objetivo");
        check = document.getElementById("check_objetivo");
        if (check.checked) {
            element.style.display='block';
			elementa.style.display='block';
        }
        else {
            element.style.display='none';
			elementa.style.display='none';
        }
    }
</script> 
<script>
$(".editar_pri").click(function() 
{   
    var essay_id = $(this).attr('id');
	var primera = 1;
    $.ajax({
        cache: false,
        type: 'POST',
        url: '../vista/ver_mejora_jefe.php',
        data: 'id_obj='+essay_id+'&tipo='+primera,
        success: function(data) 
        {
            $('#editar_info').show();
            $('#modalContent_editar').show().html(data);
        }
    });
});
$(".editar_seg").click(function() 
{   
    var essay_id = $(this).attr('id');
	var segunda = 2;
    $.ajax({
        cache: false,
        type: 'POST',
        url: '../vista/ver_mejora_jefe.php',
        data: 'id_obj='+essay_id+'&tipo='+segunda,
        success: function(data) 
        {
            $('#editar_info').show();
            $('#modalContent_editar').show().html(data);
        }
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