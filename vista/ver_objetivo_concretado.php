<?php
session_start();
	if($_SESSION["tipo"]=="3") 
	{
$id_obj=$_REQUEST["id_obj"];
$id_config=3;
require_once("../controlador/contro_clase_evaluacion.php");
$eva=new clase_evaluacion();
$eva->valores_clase_objetivos($id_obj);
$config=new clase_evaluacion();
$config->valores_clase_configuracion($id_config);
require_once("../controlador/contro_clase_trabajador.php");
$eva_ob=new clase_trabajador();
$eva_ob->valores_clase_evaluacion($eva->codigo_eva);
?>
				<div class="panel-body">
				<form id="editar_objetivo" class="form-horizontal" role="form" action="../controlador/contro_act_objetivos_concretado.php" method="post" data-validate="parsley">
				<input type="hidden" id="id_objetivo" name="id_objetivo" value="<?php echo $id_obj ?>"/>
				<div class="form-group">
										<label class="col-sm-1 control-label col-lg-1" ><strong>1°</strong></label>
										<div class="col-lg-11">
											<div class="input-group m-bot20 col-sm-12" align="justify">
												<strong>Objetivo</strong><br>
												<?php  echo $eva->objetivo  ?>
											</div>

											<div class="input-group m-bot15 col-sm-12" align="justify">
											<strong>Evidencia</strong><br>
												<?php  echo $eva->evidencia  ?>
											</div>

											<div class="row">
												<div class="col-lg-8" align="justify">
												<strong>Meta Propuesta</strong><br>
													<?php  echo $eva->meta_pro  ?>  -  Valor:<?php  echo $eva->meta_va  ?> %.
												</div>
												<div class="col-lg-3">
												</div>
												<div class="col-lg-4">
												</div>
											</div>
											<br>
											<div class="input-group m-bot15 col-sm-3">
												<strong>Peso</strong><br> <?php  echo $eva->peso  ?> %.
											</div>
										</div>
									</div>	
									<?php if($eva_ob->estado!='Aprobado') {  ?>  
								  <div class="alert alert-warning fade in">
										<button data-dismiss="alert" class="close close-sm" type="button">
											<i class="fa fa-times"></i>
										</button>
										<strong>Espere!</strong> Sus objetivos no han sido aprobados por su jefe.
									</div>	
								  <?php  } 
								  elseif($config->estado=='Inactiva') { ?>
								  <div class="alert alert-warning fade in">
										<button data-dismiss="alert" class="close close-sm" type="button">
											<i class="fa fa-times"></i>
										</button>
										<strong>Espere!</strong> El administrador del sistema no ha habilitado esta opción.
									</div>								  								  
								 <?php  }
								 else { ?>								  
								  	<center>
												<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp Modificación  del Objetivo</strong>
									</center>								
									<div class="row">
												<div class="col-lg-1">
												</div>
												<div class="col-lg-11">
												<textarea class="form-control" name="objetivo_conc" id="objetivo_conc" placeholder="Modificación  del Objetivo" rows="3"></textarea>
												</div>												
												<div class="col-lg-1">
												</div>
									</div>
								 <div class="modal-footer">
									 <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
									 <button type="submit" class="btn btn-primary"><i class='fa fa-refresh'>  </i> Actualizar</button>           	
								  </div>
								   <?php  } ?>
						</form> 		  
								</div>
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