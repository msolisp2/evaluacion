<?php
session_start();
    if($_SESSION["tipo"]=="3") 
    {
$id_obj=$_REQUEST["id_obj"];
require_once("../controlador/contro_clase_evaluacion.php");
$eva=new clase_evaluacion();
$eva->valores_clase_objetivos($id_obj);
require_once("../controlador/contro_clase_trabajador.php");
$eva_ob=new clase_trabajador();
$eva_ob->valores_clase_evaluacion($eva->codigo_eva);
$num_obj=$_REQUEST["num_obj"];
 $codigo_eva=$eva->codigo_eva;
?>
<style type="text/css">
 .caja{
        display: none;
    }
 .azul{ background: #FFFFFF; }   
</style>
                <div class="panel-body">
                <form id="editar_objetivo" class="form-horizontal" role="form" action="../controlador/contro_act_objetivos_concretado_add.php" method="post" data-validate="parsley">
                <input type="hidden" id="cod_eva" name="cod_eva" value="<?php echo $codigo_eva ?>"/>    
                <input type="hidden" id="num_seg" name="num_seg" value="<?php echo $num_obj ?>"/>                   
                <input type="hidden" id="id_objetivo" name="id_objetivo" value="<?php echo $id_obj ?>"/>
                                    <p>En este seguimiento realizado a los objetivos, <b> ¿Identifico dificultades y/o modificación de los objetivos? </b></p>
                                    <input class="div1" type="radio" name="respuesta" value="Si" required> Si<br>
                                    <input class="div2" type="radio" name="respuesta" value="No" required> No<br><br><br>
                <div class="form-group roja caja">
                                        <label class="col-sm-1 control-label col-lg-1" ><strong><?php echo $num_obj ?></strong></label>
                                        <div class="col-lg-11">
                                            <div class="input-group m-bot20 col-sm-12">
                                            <strong>Objetivo</strong><br>
                                                <textarea class="form-control" name="objetivo" id="objetivo" placeholder="Objetivo" rows="3"><?php  echo $eva->objetivo  ?></textarea>
                                            </div>

                                            <div class="input-group m-bot15 col-sm-12">
                                            <strong>Evidencia</strong><br>
                                                <textarea class="form-control" name="evidencia" id="evidencia" placeholder="Evidencia" rows="3"><?php  echo $eva->evidencia  ?></textarea>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-8">
                                                     <div class="input-group m-bot15 col-lg-7">
                                                            <strong>Peso</strong><br>
                                                            <input type="number" class="form-control" name="peso" id="peso" value="<?php  echo $eva->peso  ?>">
                                                            <p class="help-block">Peso %.</p>
                                                        </div>
                                                    <textarea class="form-control" style="display:none;" name="meta" id="meta" placeholder="Meta Propuesta" rows="3"><?php  echo $eva->meta_pro  ?></textarea>
                                                </div>
                                                <div class="col-lg-3">
                                                <strong>Meta propuesta</strong><br>
                                                <input type="number" class="form-control" name="meta_valor" id="meta_valor" value="<?php  echo $eva->meta_va  ?>">
                                                <p class="help-block">Meta %.</p>
                                                </div>
                                                <div class="col-lg-4">
                                                </div>
                                            </div>
                                        </div>
                                            <table class="table table-bordered">
                                        <tr>
                                            <td colspan="4" align="center"><strong>IDENTIFICACIÓN DE DIFICULTADES Y/O MODIFICACIÓN DE LOS OBJETIVOS CONCERTADOS</strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" align="justify"><strong>Describa el nuevo objetivo concertado o aspecto modificado (evidencia, meta propuesta y peso %):</strong> el nuevo objetivo concertado debe contener evidencia, meta propuesta y peso %.</td>
                                        </tr>                                
                                        <tr>
                                            <td colspan="4" align="center">     
                                                <div class="compose-editor">
                                                    <textarea class="wysihtml5 form-control" id="objetivo_conc" name="objetivo_conc" rows="9" data-required="true"></textarea>  
                                                </div>
                                            </td>
                                        </tr>                           
                                    </table>
                                        <div class="modal-footer">
                                             <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
                                             <button type="submit" class="btn btn-primary"><i class='fa fa-refresh'>  </i> Actualizar</button>              
                                          </div>                                        
                                    </div>
                        </form>           
                                </div>
<script type="text/javascript" charset="utf-8">
$('.wysihtml5').wysihtml5();
$(document).ready(function(){
    $('input[type="radio"]').click(function(){
        if($(this).attr("value")=="Si"){
            $(".caja").not(".roja").hide();
            $(".roja").show();
        }
        if($(this).attr("value")=="No"){
              $(".modal").modal("hide");
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