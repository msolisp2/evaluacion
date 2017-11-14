<?php
session_start();
	if ($_SESSION["tipo"]=="2") 
	{
$id_cod_obj=$_REQUEST["id_cod_obj"];
$num_seg=$_REQUEST["num_seg"];
require_once("../controlador/contro_clase_trabajador.php");
$trab=new clase_trabajador();
$trab->valores_clase_trabajador($_SESSION["codigo"]);
$eva=new clase_trabajador();
$eva->valores_clase_evaluacion($id_cod_obj);
	?>
<form class="form-horizontal" action="../controlador/contro_act_estado.php" method="post">
<input type="hidden" id="num_seg" name="num_seg"   value="<?php echo $num_seg ?>" readonly/>
<input type="hidden" id="cod_pro" name="cod_pro" readonly/>
<input type="hidden" id="cod_eva" name="cod_eva" value="<?php echo $id_cod_obj ?>" readonly/>
           <div class="form-group">
              <label for="inputprograma" class="col-lg-2 col-sm-2 control-label"> Estado</label>
               <div class="col-lg-5">
					<select class="form-control input-sm m-bot15" id="estado_eva" name="estado_eva" required>
					  <option value="">Seleccione un Estado</option>
					  <option value="Aprobado">Aprobar</option>
					  <option value="Sin Aprobar">No Aprobar</option>
					  <option value="Finalizada">Finalizar</option>
				   </select>
               </div>
               - <font size="+1">(<?php echo $eva->estado; ?>)</font>
            </div>   
            <div id="div_observacion"  style="display:none"> 
              <br>
              <h5 class="text-center">¿Observación?</h5>
                <div class="row">
                <div class="col-lg-12">
                <div class="compose-editor">
                    <textarea class="wysihtml5 form-control" rows="9" id="si_obs" name="si_obs"></textarea>  
                </div>
                </div>  
                </div>
              </div>
            <div class="modal-footer">
                 <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
                 <button id="enviar" type="submit" class="btn btn-primary"><i class='fa fa-refresh'>  </i> Actualizar</button>           	
              </div>
		   </form>  
		   <div id="info"></div>
<script>
  $(document).ready(function(){
  $("#estado_eva").change(function(){
    $.ajax({
      url:"../controlador/contro_verificar_pesos.php",
      type: "POST",
      data:"valor1="+$("#estado_eva").val()+"&valor2="+$("#cod_eva").val()+"&valor3="+$("#num_seg").val(),
      success: function(opciones){
        $('#info').html(opciones);
        
      }
    })
  });
});
</script> 
<script type="text/javascript">
$(function() {
        $('#estado_eva').change(function(){
            //$('.colors').hide();
            if($(this).val()=="Sin Aprobar"){
              $('#div_observacion').show();
              $("#si_obs").prop('required',true);
            }
            else{
              $('#div_observacion').hide();
            }
            
        });
    });
</script>
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