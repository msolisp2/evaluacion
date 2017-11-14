<?php
session_start();
	if($_SESSION["tipo"]=="1" || $_SESSION["tipo"]=="2" || $_SESSION["tipo"]=="3") 
	{
$cod_eva=$_REQUEST["cod_eva"];
require_once("../controlador/contro_clase_evaluacion.php");
$eval=new clase_evaluacion();
$eval->valores_clase_evaluacion_total($cod_eva);
$eval_obj=new clase_evaluacion();
$eval_obj->valores_clase_objetivos_total($cod_eva);
$recur=new clase_evaluacion();
$recur->valores_clase_recurso($cod_eva);
$resp=new clase_evaluacion();
$resp->valores_clase_respuesta($recur->id_recurso);
?>
<br>
<center>
<div id="info_c"></div>
Mostrar Resultado
<input type="checkbox" name="check_objetivo" id="check_objetivo" value="1" onchange="javascript:showContent()" />
</center><br>
<div id="content_objetivo" style="display: none;">
				<table class="table table-bordered">
								<tr>
                                    <td colspan="4" align="center"><strong>CALIFICACIÓN DEFINITIVA</strong></td>
                                </tr>
								<tr>
                                    <td colspan="4" align="center">
									 <ul>
									<li align="justify"> El cálculo de la evaluación definitiva será realizado únicamente por el superior inmediato.</li>
									 </ul>
									<ol>
										 <li align="justify"> El resultado de la Concertación de Objetivos, Metas y Logros (Formato A), se multiplica por <strong>70%.</strong></li>
										 <li align="justify"> El resultado de la Evaluación de Competencias (Formato B-8), se obtiene sumando los subtotales de los formatos (B-8) diligenciados por evaluado, superior inmediato,
															  par y usuario (si lo hubiere), dividiendo el valor obtenido entre 3 o 4 según sea el caso. Este su puntaje se multiplica por el <strong>30%.</strong></li>											
									</ol>											
									</td>
                                </tr>
								<tr>
								<td colspan="4">
                        <div class="row">
                            <div class="col-md-6">
								<br><br>
									<div class="form-group">
										<label class="col-sm-9" for="inputSuccess">Evaluación de Competencias (Autoevaluación)</label>
											<div class="row">
												<div class="input-group col-lg-3">
													<input type="text" class="form-control" value="<?php echo $eval->total_auto; ?>" readonly>
													<span class="input-group-addon btn-label">%</span>
												</div>
											</div>
									</div>
									<div class="form-group">
										<label class="col-sm-9" for="inputSuccess">Evaluación de Competencias (Superior)</label>
											<div class="row">
												<div class="input-group col-lg-3">
													<input type="text" class="form-control" value="<?php echo $eval->total_jefe; ?>" readonly>
													<span class="input-group-addon btn-label">%</span>
												</div>
											</div>
									</div>
									<div class="form-group">
										<label class="col-sm-9" for="inputSuccess">Evaluación de Competencias (Par)</label>
											<div class="row">
												<div class="input-group col-lg-3">
													<input type="text" class="form-control" value="<?php echo $eval->total_par; ?>" readonly>
													<span class="input-group-addon btn-label">%</span>
												</div>
											</div>
									</div>								
									<div class="form-group">
										<label class="col-sm-9" for="inputSuccess"> Evaluación de Competencias (Usuario)</label>
											<div class="row">
												<div class="input-group col-lg-3">
													<input type="text" class="form-control" value="<?php echo $eval->total_usuario; ?>" readonly>
													<span class="input-group-addon btn-label">%</span>
												</div>
											</div>
									</div>
									<div class="form-group">
										<label class="col-sm-9" for="inputSuccess" align="right"> Subtotal</label>
											<div class="row">
												<div class="input-group col-lg-3">
													<input type="text" class="form-control" value="<?php echo $eval->subtotal; ?>" readonly>
													<span class="input-group-addon btn-label">%</span>
												</div>
											</div>
									</div>
									<div class="form-group">
										<label class="col-sm-9" for="inputSuccess" align="right"> Promedio</label>
											<div class="row">
												<div class="input-group col-lg-3">
													<input type="text" class="form-control" value="<?php echo $promedio=($eval->subtotal/4); ?>" readonly>
													<span class="input-group-addon btn-label">%</span>
												</div>
											</div>
									</div>
									<div class="form-group">
										<label class="col-sm-9" for="inputSuccess" align="right"> Calificación Parcial 30%</label>
											<div class="row">
												<div class="input-group col-lg-3">
													<input type="text" class="form-control input-lg" value="<?php echo $final_eva=($promedio*0.3) ?>" readonly>
													<span class="input-group-addon btn-warning">%</span>
												</div>
											</div>
									</div>																
                            </div>
                            <div class="col-md-6">
								<br><br>
									<div class="form-group">
										<label class="col-sm-8" for="inputSuccess">Concertación de Objetivos, Metas y Logros</label>
											<div class="row">
												<div class="input-group col-lg-3">
													<input type="text" class="form-control" value="<?php echo $eval_obj->subtotal ?>" readonly>
													<span class="input-group-addon btn-label">%</span>
												</div>
											</div>
									</div>
									<div class="form-group">
										<label class="col-sm-8" for="inputSuccess">Calificación Parcial 70%</label>
											<div class="row">
												<div class="input-group col-lg-3">
													<input type="text" class="form-control input-lg" value="<?php echo $final_obj=($eval_obj->subtotal*0.7) ?>" readonly>
													<span class="input-group-addon btn-warning">%</span>
												</div>
											</div>
									</div>
									<br>
									<hr><br>
									<div class="form-group">
										<label class="col-sm-8" for="inputSuccess">Calificación Definitiva (70% + 30%)</label>
											<div class="row">
												<div class="input-group col-lg-3">
													<input type="text" class="form-control input-lg" value="<?php echo $total=($final_obj+$final_eva) ?>" readonly>
													<span class="input-group-addon btn-success">%</span>
												</div>
											</div>
									</div>
									<?php 
									if($total>=90){ ?>
									 <form class="form-horizontal bucket-form" method="get">
										<div class="form-group">
											<label class="col-sm-3 control-label"></label>
											<div class="col-sm-9 icheck minimal">
												<div class="checkbox single-row">
													<input type="checkbox" disabled="" checked="">
													<label><strong>Sobresaliente</strong></label>
												</div>
												<div class="checkbox single-row">
													<label class="disabled"><input type="checkbox" disabled="" ></label>
													<label>Satisfactoria</label>
												</div>
												<div class="checkbox checked single-row">
													<label class=" disabled"><input type="checkbox" disabled=""></label>
													<label>Insatisfactoria</label>
												</div>
											</div>
										</div>
									</form>
									<?php } elseif($total<=69) {?>
									 <form class="form-horizontal bucket-form" method="get">
										<div class="form-group">
											<label class="col-sm-3 control-label"></label>
											<div class="col-sm-9 icheck minimal">
												<div class="checkbox single-row">
													<input type="checkbox" disabled="">
													<label>Sobresaliente</label>
												</div>
												<div class="checkbox single-row">
													<label class="disabled"><input type="checkbox" disabled="" ></label>
													<label>Satisfactoria</label>
												</div>
												<div class="checkbox checked single-row">
													<label class=" disabled"><input type="checkbox" disabled="" checked="" id=""></label>
													<label><strong>Insatisfactoria</strong></label>
												</div>
											</div>
										</div>
									</form>									
									<?php } else { ?>
									 <form class="form-horizontal bucket-form" method="get">
										<div class="form-group">
											<label class="col-sm-3 control-label"></label>
											<div class="col-sm-9 icheck minimal">
												<div class="checkbox single-row">
													<input type="checkbox" disabled="">
													<label>Sobresaliente</label>
												</div>
												<div class="checkbox single-row">
													<label class="disabled"><input type="checkbox" disabled="" checked="" id=""></label>
													<label><strong>Satisfactoria</strong></label>
												</div>
												<div class="checkbox checked single-row">
													<label class=" disabled"><input type="checkbox" disabled=""></label>
													<label>Insatisfactoria</label>
												</div>
											</div>
										</div>
									</form>									
									<?php } ?>	
									<br>									
								 <div class="alert alert-warning alert-block fade in">
									<button data-dismiss="alert" class="close close-sm" type="button">
										<i class="fa fa-times"></i>
									</button>
									<h5>			
										NOTA:
									</h5>
									<p>Se determina como sobresaliente cuando una calificación está en un rango de 90 a 100 y satisfactoria de 70 a 89.</p>
								</div>
                            </div>
                        </div>								
								</td>
								</tr>			
				</table>	
 </div>	
 <br>
							<table class="table table-bordered">
								<tr>
                                    <td colspan="4" align="center"><strong>Recurso Enviado</strong></td>
                                </tr>
								<tr>
									<td colspan="4" align="jusftify">
										Contra los resultados de esta evaluación procede el recurso de reposición y, en subsidio el de apelación, interpuesto ante el evaluador dentro de los cinco (5) días hábiles siguientes a la fecha de notificación. 
										<strong>Este recurso debe presentarse con la exposición de los motivos de inconformidad.</strong>
									</td>
								</tr>
								<tr>
                                    <td colspan="4" align="center">		
										<div class="compose-editor">
											<textarea class="wysihtml5 form-control" rows="9" data-required="true"><?php echo $recur->recurso; ?></textarea>	
										</div>
									</td>
                                </tr>
								<tr>
                                    <td colspan="4" align="center"><strong>Respuesta Recibida</strong></td>
                                </tr>
								<tr>
                                    <td colspan="4" align="center">		
										<div class="compose-editor">
											<textarea class="wysihtml5 form-control" rows="9" data-required="true"><?php if(isset($resp->respuesta) && ($resp->respuesta!=null) ){echo $resp->respuesta;} ?>
											</textarea>	
										</div>
									</td>
                                </tr>							
							</table> 
<script type="text/javascript">
$('#info_c').html('<img src="../estilos/images/input-spinner.gif" alt="" />').fadeOut(1000);
$('.wysihtml5').wysihtml5();
/*$('#no_obs').data("wysihtml5").editor.on("focus", function() {
      $('#no_obs').data("wysihtml5").editor.setValue('');
    })*/
$(function() {
        $('#notificacion').change(function(){
            $('.colors').hide();
            $('#' + $(this).val()).show();
        });
    });
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