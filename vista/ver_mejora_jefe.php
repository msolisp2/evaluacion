<?php
session_start();
	if($_SESSION["tipo"]=="2") 
	{
$id_mej=$_REQUEST["id_obj"];
$tipo=$_REQUEST["tipo"];
require_once("../controlador/contro_clase_evaluacion.php");
$eva=new clase_evaluacion();
$eva->valores_clase_mejoras($id_mej);
require_once("../controlador/contro_clase_trabajador.php");
$mejor=new clase_evaluacion();
$mejor->valores_clase_mejora($eva->codigo);
date_default_timezone_set('America/Bogota');
$fecha=date("Y-m-d");
		if($mejor->estado_plan=='Pendiente'){?>
		<div class="alert alert-warning fade in">
		<button data-dismiss="alert" class="close close-sm" type="button">
		<i class="fa fa-times"></i>
		</button>
			<strong>Atención!</strong> Las mejoras aun no han sido aprobados, no puede editarlos.
		</div>
		<?php
		}		
		else{?>
 				<div class="panel-body">
				<form id="editar_objetivo" class="form-horizontal" role="form" action="../controlador/contro_act_mejoras_jefe.php" method="post" data-validate="parsley">
				<input type="hidden" id="id_mejora" name="id_mejora" value="<?php echo $id_mej ?>"/>
				<input type="hidden" id="tipo" name="tipo" value="<?php echo $tipo ?>"/>				
				<div class="form-group">
										<label class="col-sm-1 control-label col-lg-1" ><strong>1°</strong></label>
										<div class="col-lg-11">
											<div class="input-group m-bot20 col-sm-12">
												<textarea class="form-control" name="dificultad" id="objetivo_1" placeholder="Dificultad 1" rows="3" data-required="true" readonly><?php  echo $eva->difcultades  ?></textarea>
											</div>
											<div class="input-group m-bot15 col-sm-12">
												<textarea class="form-control" name="analisis" id="evidencia_1" placeholder="Analisis de las Causa 1" rows="3" data-required="true" readonly><?php  echo $eva->analisis  ?></textarea>
											</div>
											<div class="row">
												<div class="col-lg-6">
													<textarea class="form-control" name="actividad" id="actividad_1" placeholder="Actividad 1" rows="3" data-required="true" readonly><?php  echo $eva->actividad  ?></textarea>
												</div>
												<div class="col-lg-6">
													<textarea class="form-control" name="responsable" id="responsable_1" placeholder="Responsable 1" rows="3" data-required="true" readonly><?php  echo $eva->responsable  ?></textarea>
												</div>
											</div>
											<br>
											<hr>
											<?php 
											if($tipo==1){ ?>
											<div class="form-group">
												<label class="col-sm-3 control-label">Primer Periodo</label>
												<div class="col-sm-9">
												<textarea class="form-control" name="primer_periodo" id="primer_periodo" placeholder="Primer Periodo" rows="3" data-required="true"><?php  echo $eva->justf_1  ?></textarea>
												</div>
											</div>											
											<?php  }											
											else{ ?>
											<div class="form-group">
												<label class="col-sm-4 control-label">Segundo Periodo</label>
												<div class="col-sm-8">
												<textarea class="form-control" name="segundo_periodo" id="segundo_periodo" placeholder="Segundo Periodo" rows="3" data-required="true"><?php  echo $eva->justf_2  ?></textarea>
												</div>
											</div>																					
											<?php }
											?>
										</div>
									</div>	
								<div class="modal-footer">
									 <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
									 <button type="submit" class="btn btn-primary"><i class='fa fa-refresh'>  </i> Actualizar</button>           	
								  </div>
						</form> 		  
								</div>
		<?php }	
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