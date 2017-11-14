<?php
session_start();
	if($_SESSION["tipo"]=="2" || $_SESSION["tipo"]=="3") 
	{
$id_cod_obj=$_REQUEST["id_cod_obj"];
require_once("../controlador/contro_clase_trabajador.php");
$eva=new clase_trabajador();
$eva->valores_clase_evaluacion($id_cod_obj);
$trab=new clase_trabajador();
$trab->valores_clase_trabajador($eva->cod_trabajador);
require_once("../controlador/contro_clase_evaluacion.php");
$eval_obj=new clase_evaluacion();
$eval_obj->valores_clase_objetivos_total($id_cod_obj);
if($id_cod_obj){
?>
<style type="text/css">
table , td, th {
    border-collapse: collapse !important;
}
table + table, table + table tr:first-child th, table + table tr:first-child td {
    border-top: 0 !important;
}
</style>
<br>
<center>
Mostrar Cabecera
<input type="checkbox" name="check_objetivo" id="check_objetivo" value="1" onchange="javascript:showContent()" />
</center>
<br>
<div id="content_objetivo" style="display: none;">
				<table class="table table-bordered">
                                <tr>
                                    <td rowspan="3" align="center"><img src="../estilos/images/UCartagena1.png" alt="Smiley face" height="100" width="100"></td>
                                    <td colspan="2" align="center"><strong>UNIVERSIDAD DE CARTAGENA</strong></td>
                                    <td><strong>CÓDIGO:</strong> FO-TH/AL-024</td>
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
                                    <td colspan="4" align="justify"><strong>Referencia:</strong> Formato <strong>A - Concertación de objetivos, metas y peso %</strong></td>
                                </tr>
								<tr>
                                    <td colspan="4" align="justify"><strong>Objetivo:</strong> concertar y establecer objetivos, metas y peso porcentual, que sean medibles y cuantificables con base en las competencias y funciones de cada cargo.</td>
                                </tr>	
								<tr>
                                    <td colspan="4" align="center"><strong>I.DATOS DE IDENTIFICACIÓN</strong></td>
                                </tr>
				</table>
				<table class="table table-bordered">
								<tr>
                                    <td width="30%" align="left"><strong>Fecha de diligenciamiento:</strong></td>
									<td align="left"><?php  echo $eva->fecha  ?></td>
                                </tr>	
                </table>
				<table class="table table-bordered">
								<tr>
								  <td width="10%" align="center"><strong>Nº Cédula</strong></td>
								  <td width="12%"><?php  echo $trab->cedula ?></td>
								  <td width="20%" align="center"><strong>Nombre del evaluado</strong></td>
								  <td width="40%"><?php echo ucwords(strtolower($trab->nombre_trab))  ?></td>
								  <td width="8%" align="center"><strong>Genero</strong></td>
								  <td width="10%"><?php echo $trab->genero ?></td>
								</tr>	
                </table>
				<table class="table table-bordered">
								<tr>
								  <td width="8%" align="center"><strong>Ciudad</strong></td>
								  <td width="22%"><?php  echo $trab->ciudad  ?></td>
								  <td width="35%" align="center"><strong>Periodo de evaluación</strong></td>
								  <td width="35%" align="center"><strong>Tipo de vinculación</strong></td>
								</tr>
				</table>
				<table class="table table-bordered">		
								<tr>
								  <td width="12%" align="center"><strong>Dependencia</strong></td>
								  <td width="18%"><?php  echo $eva->area  ?></td>
								  <td width="6%"><strong>Desde:</strong></td>
								  <td width="5%"><strong>Dia</strong></td>
								  <td width="4%"><?php $time=strtotime($eva->fecha_in); echo date('d', $time);?></td>
								  <td width="5%"><strong>Mes</strong></td>
								  <td width="4%"><?php echo date('m', $time);?></td>
								  <td width="5%"><strong>Año</strong></td>								  
								  <td width="6%"><?php echo date('Y', $time);?></td>
								  <td width="35%" rowspan="2" align="center"><br><?php  echo $eva->vinculo  ?></td>
								</tr>	
								<tr>
								  <td width="12%" align="center"><strong>Cargo</strong></td>
								  <td width="18%"><?php  echo $eva->cargo_trab  ?></td>								  
								  <td width="6%"><strong>Desde:</strong></td>
								  <td width="5%"><strong>Dia</strong></td>
								  <td width="4%"><?php $time_fin=strtotime($eva->fecha_fin); echo date('d', $time_fin);?></td>
								  <td width="5%"><strong>Mes</strong></td>
								  <td width="4%"><?php echo date('m', $time_fin);?></td>
								  <td width="5%"><strong>Año</strong></td>								  
								  <td width="6%"><?php echo date('Y', $time_fin);?></td>
								</tr>									
                </table>	
				<table class="table table-bordered">		
								<tr>
								  <td width="22%" align="center"><strong>Nombre del evaluador</strong></td>
								  <td width="40%"><?php  echo $eva->nombre_jefe  ?></td>
								  <td width="13%" align="center"><strong>Cargo</strong></td>
								  <td width="25%"><?php  echo $eva->cargo_jefe  ?></td>
								</tr>							
                </table>
				</div>
				<table class="table table-bordered">
								<tr>
                                    <td colspan="4" align="center"><strong>INSTRUCCIONES</strong></td>
                                </tr>
								<tr>
                                    <td colspan="4" align="center">
									<ul>
										 <li align="justify">Diligencie este formato al inicio del periodo anual y cuando se inicie el período de prueba.</li>
										 <li align="justify">Las estrategias u objetivos a realizar en el período respectivo, se redactan en conjunto con el superior inmediato.</li>
									     <li align="justify">Se sugiere definir máximo 5 Objetivos, minímo 2.</li>											
											<br>
											<ol>
												<li align="justify">
													Defina los objetivos del evaluado de acuerdo con la misión, meta o finalidad de la Dependencia y dentro del marco de las responsabilidades del cargo. Plantee objetivos realizables, medibles y cuantificables.
												</li>
												<li align="justify">
													Establezca para cada objetivo las evidencias o soportes los cuales deben ser veraces, proporcionales, suficientes, actualizadas y pertinentes.
												</li>
												<li align="justify">
													Establezca la Meta Propuesta en números enteros o en porcentaje, para cada objetivo planteado.
												</li>
												<li align="justify">
													Establezca el Peso % para cada uno de los objetivos.
												</li>
												<li align="justify">
													Por ultimo se registra la Fecha de Concertación de Objetivos, y firma tanto el evaluado como el evaluador.
												</li>
											</ol> <br>
									<li align="justify">En cuanto a la evaluación al final del período:</li>
									<li align="justify">El superior inmediato, realiza el cálculo matemático que define la evaluación de los objetivos del personal a cargo. Para ello:</li>
											<br>
											<ol>
												<li align="justify">
													Registra el número de metas alcanzadas por Objetivo.
												</li >
												<li align="justify">
													Calcula el % de Logro del objetivo alcanzado durante el periodo de evaluación, dividiendo la Meta Alcanzada entre la Meta Propuesta y multiplicando el resultado por 100.
												</li>
												<li align="justify">
													Multiplica el Peso % del objetivo por el Logro % del mismo, el resultado lo divide entre 100, para obtener el subtotal que representa a ese objetivo.
												</li>
											</ol>
											</ul>
											<ul class="list-unstyled">
												<li align="justify">
													Por ultimo, se suman todos los subtotales para obtener la Calificación Total de la evaluación.
												</li>	  
											</ul>									
									</td>
                                </tr>
								<tr>
                                    <td colspan="4" align="center"><strong>II. CONCERTACIÓN DE OBJETIVOS, METAS Y PESO %</strong>
									</td>
                                </tr>
				</table>
				 <div class="row">
						<div class="col-sm-7">
				                   <?php
									$seg=3;
						     		include_once("../controlador/contro_clase_evaluacion.php");
									$lis_obj=new clase_evaluacion();
									$lis_obj->valores_listado_inicio_per_evl_jefe_final($id_cod_obj,$seg);
									?>
						</div> 
						<div class="col-sm-5">
				                   <?php
						     		include_once("../controlador/contro_clase_evaluacion.php");
									$lis_obj=new clase_evaluacion();
									$lis_obj->valores_listado_fin_per_evl($id_cod_obj);
									?>
								<table class="table table-bordered"><td colspan="6" align="right">Subtotal</td><td><?php echo $eval_obj->subtotal ?> %</td></table>
						</div> 
				</div>
				<br>
				<div class="row">
						<div class="col-sm-7">
							<table class="table table-bordered">
								<tr>
									<td colspan="8" align="center"><strong>Primer Período</strong></td>
								</tr>
								<tr>
								  <td width="56%" align="center"><strong>Objetivos Concertados</strong></td>
								  <?php 
								   if($eva->fecha_con){
								  $time_con=strtotime($eva->fecha_con); 
								  $dia=date('d', $time_con); 
								  $mes=date('m', $time_con);
								  $ano=date('Y', $time_con);
								  }
								   else{
								  $dia="";
								  $mes="";
								  $ano="";
								   }
								  ?>
								  <td width="10%"><strong>Dia</strong></td>
								  <td width="4%"><?php echo $dia;?></td>
								  <td width="10%"><strong>Mes</strong></td>
								  <td width="4%"><?php echo $mes;?></td>
								  <td width="10%"><strong>Año</strong></td>								  
								  <td width="6%"><?php echo $ano;?></td>
								</tr>										
							</table>
							<table class="table table-bordered">
								<tr>
									<td colspan="4" align="center"><strong>Firma del Evaluado</strong></td>
									<td colspan="4" align="center"><strong>Firma del Evaluador</strong></td>
								</tr>
								<tr>
									<td colspan="4" align="center"><?php echo ucwords(strtolower($trab->nombre_trab))  ?></td>
									<td colspan="4" align="center"><?php  echo $eva->nombre_jefe  ?></td>
								</tr>									
							</table>
						</div> 
				</div>
			<br>	
			<hr>
			<div class="row">
					<div class="col-sm-12">
				                   <?php
						     		include_once("../controlador/contro_clase_evaluacion.php");
									$lis_obj=new clase_evaluacion();
									$lis_obj->valores_listado_obj_concertados($id_cod_obj);
									?>
					</div>
			</div>		
<!-- Modificar Meta -->	
		<div id="meta_info" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Actualizar Meta Alcanzada</h4>
			</div>
			<div class="modal-body">
			<div id="modalContent_meta" style="display:none;">

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
<script type="text/javascript">
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
</script> 
<script>
$(".meta").click(function() 
{   
    var essay_id = $(this).attr('id');

    $.ajax({
        cache: false,
        type: 'POST',
        url: '../vista/ver_objetivo_meta.php',
        data: 'id_obj='+essay_id,
        success: function(data) 
        {
            $('#meta_info').show();
            $('#modalContent_meta').show().html(data);
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