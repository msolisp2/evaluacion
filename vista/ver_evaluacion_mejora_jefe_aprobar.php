<?php
session_start();
	if ($_SESSION["tipo"]=="2") 
	{
$id_cod_obj=$_REQUEST["id_cod_obj"];
require_once("../controlador/contro_clase_evaluacion.php");
$eva=new clase_evaluacion();
$eva->valores_clase_mejora($id_cod_obj);
	?>
<form class="form-horizontal" action="../controlador/contro_act_estado_mejora.php" method="post">
<input type="hidden" id="cod_eva" name="cod_eva" value="<?php echo $id_cod_obj ?>" readonly/>
           <div class="form-group">
              <label for="inputprograma" class="col-lg-2 col-sm-2 control-label"> Estado</label>
               <div class="col-lg-5">
					<select class="form-control input-sm m-bot15" id="estado_eva" name="estado_eva">
					  <option value="">Seleccione un Estado</option>
					  <option value="Aprobado">Aprobar</option>
					  <option value="Sin Aprobar">No Aprobar</option>
					  <option value="Finalizada">Finalizar</option>
				   </select>
               </div>
               - <font size="+1">(<?php echo $eva->estado_plan; ?>)</font>
            </div>   
            <div class="modal-footer">
                 <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
                 <button type="submit" class="btn btn-primary"><i class='fa fa-refresh'>  </i> Actualizar</button>           	
              </div>
		   </form>   
<?php
	 $fechaGuardada = $_SESSION["ultimoAcceso"]; 
     date_default_timezone_set('America/Bogota'); $ahora = date("Y-n-j H:i:s");
     $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));	
 if($tiempo_transcurrido >= 900) {	
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