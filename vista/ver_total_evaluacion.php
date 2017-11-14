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
$verifi=new clase_evaluacion();
$verifi->valores_clase_verifica($cod_eva);
$eval_cua=new clase_evaluacion();
$eval_cua->valores_clase_evaluacion_trabajador($cod_eva);
$jefe=new clase_evaluacion();
$jefe->valores_clase_evaluacion_jefe($cod_eva);
?>
<br>
<center>
<div id="info_c"></div>
</center><br>
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
					<?php 
					if($_SESSION["tipo"]=="3"){ ?>
										<tr><td>
					<center>					
					<?php if($verifi->existe>0){ ?>
								 <div class="alert alert-success alert-block fade in">
									<button data-dismiss="alert" class="close close-sm" type="button">
										<i class="fa fa-times"></i>
									</button>
									<p>Si usted envió un recurso por el resultado de esta evaluación, <a href="../vista/listado_recurso_trab.php">Click acá para ver la respuesta.</a></p>
								</div>					
					<?php  }else{ ?>							
				<button type="button" href="#myModal" data-toggle="modal" class="btn btn-primary btn-lg">Notificación del Resultado</button>	
					<?php 
					
					} ?>	
				</center>
					</td></tr>
					<?php }?>					
				</table>
				
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
        <!-- Modal Notificación-->
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Notificación del proceso de gestión del desempeño.</h4>
        </div>
		<form name="correo" id="correo" action="../controlador/contro_crea_recurso.php" method="post" data-validate="parsley">
		<input type="hidden" id="correo_jefe" name="correo_jefe" value="<?php echo $jefe->correo; ?>">
		<input type="hidden" id="cod_eva" name="cod_eva" value="<?php echo $cod_eva ?>">
        <div class="modal-body">
                            <h5 class="text-center">¿Está de acuerdo con los resultados del proceso de gestión de su desempeño?</h5>
                            <div class="row">
                                <div class="col-lg-3">
                                </div>
                                <div class="col-lg-5">
									<select class="form-control" style="width: 295px" id="notificacion" name="notificacion" data-required="true">
										<option value="">Seleccione un Respuesta</option>
										<option value="1">Si, Estoy de Acuerdo</option>
										<option value="2">No, Estoy de Acuerdo</option>										
									</select>								
                                </div>
                                <div class="col-lg-3">
                                </div>
                            </div>
							<div id="1" class="colors" style="display:none"> 
							<br>
							<h5 class="text-center">¿Alguna Observación?</h5>
								<div class="row">
								<div class="col-lg-12">
								<div class="compose-editor">
										<textarea class="wysihtml5 form-control" rows="9" id="si_obs" name="si_obs">N/A</textarea>	
								</div>
								</div>	
								</div>
							</div>
							<div id="2" class="colors" style="display:none"> 
							<br>
							<table class="table table-bordered">
								<tr>
                                    <td colspan="4" align="center"><strong>NOTIFICACIÓN</strong></td>
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
											<textarea class="wysihtml5 form-control" rows="9" id="no_obs" name="no_obs" data-required="true">N/A</textarea>	
										</div>
									</td>
                                </tr>
							</table>
							</div>
							<br>								
        </div><!-- End of Modal body -->
		    <div class="modal-footer">
                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
                          <button class="btn btn-success" type="submit">Enviar</button>
                      </div>
				</form>	  
        </div><!-- End of Modal content -->
        </div><!-- End of Modal dialog -->
		</div><!-- End of Modal -->			
<script type="text/javascript">
$('#correo').parsley();
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