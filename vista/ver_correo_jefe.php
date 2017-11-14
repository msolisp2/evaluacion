<?php
session_start();
	if($_SESSION["tipo"]=="2") 
	{
$id_correos=$_REQUEST["valor1"];
$id_evas = substr($id_correos, 0, -1);
	require("../controlador/contro_clase_evaluacion.php");
	$cor=new clase_evaluacion();
	$cor->consulta_evaluacion_correos_jefe($id_evas);
  ?> 
                       <h4 class="gen-case"> Redacción del Correo</h4>
                        <div class="compose-mail">
                            <form role="form-horizontal" method="post" action="../controlador/contro_envio_correo.php">
							<input type="hidden" id="correos" name="correos" class="form-control" value="<?php echo $cor->correos ?>">
                                <div class="form-group">
                                    <label for="to" class="">Para:</label>
                                    <input type="text" tabindex="1" id="to" class="form-control" value=" <?php echo $cor->correos ?>">
                                </div>

                                <div class="form-group">
                                    <label for="subject" class="">Titulo:</label>
                                    <input type="text" tabindex="1" id="titulo" name="titulo" class="form-control" value="Recordatorio de Evaluaciones Pendientes">
                                </div>

                                <div class="compose-editor">
                                    <textarea class="wysihtml5 form-control" id="contenido" name="contenido" rows="9">
									<h2>Cordial Saludo</h2>
										Actualmente usted tiene pendiente evaluaciones en nuestro sistema.</p>
										<ul>
										  <li>Ingrese al sistema y realizar las actividades pendientes, gracias.</li>
										</ul>
										<br>
									<h4>Universidad de Cartagena</h4>	
									</textarea>
                                </div>
                                <div class="compose-btn">
                                    <button class="btn btn-primary btn-sm"><i class="fa fa-check"></i> Enviar</button>
                                    <button class="btn btn-sm"><i class="fa fa-times"></i> Cancerlar</button>
                                </div>
                            </form>
						</div>
<script type="text/javascript">
    $('.wysihtml5').wysihtml5();
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