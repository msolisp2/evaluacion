<?php
session_start();
	if($_SESSION["tipo"]=="3") 
	{
 $num_obj=$_REQUEST["num_obj"];
 $id_obj=$_REQUEST["id_obj"];
?>
		<div class="panel-body">
		<form id="form_eval" class="form-horizontal bucket-form" action="../controlador/contro_act_objetivos_concretado.php" method="post" data-validate="parsley">
			<input type="hidden" id="cod_eva" name="cod_eva" value="<?php echo $id_obj ?>"/>	
			<input type="hidden" id="num_seg" name="num_seg" value="<?php echo $num_obj ?>"/>			
					<!-- 		<table class="table table-bordered">
								<tr>
                                    <td colspan="4" align="center"><strong>IDENTIFICACIÓN DE DIFICULTADES Y/O MODIFICACIÓN DE LOS OBJETIVOS CONCERTADOS</strong></td>
                                </tr>
								<tr>
                                    <td colspan="4" align="center">		
										<div class="compose-editor">
											<textarea class="wysihtml5 form-control" id="objetivo_conc" name="objetivo_conc" rows="9" data-required="true"></textarea>	
										</div>
									</td>
                                </tr>							
							</table> 
					<br>			
                 <div class="box-footer">
                       <button type="submit" class="btn btn-primary">Actualizar</button>
                        <button type="reset" class="btn btn-danger">Cancelar</button>
                </div>	-->
		</form>			  
		</div>
<script type="text/javascript">	
document.getElementById('form_eval').submit(); // SUBMIT FORM
$('.wysihtml5').wysihtml5();
$("#form_eval").parsley();
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