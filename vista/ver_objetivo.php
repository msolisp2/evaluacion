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

date_default_timezone_set('America/Bogota');
$fecha=date("Y-m-d");
        if($eva_ob->estado=='Aprobado'){?>
        <div class="alert alert-warning fade in">
        <button data-dismiss="alert" class="close close-sm" type="button">
        <i class="fa fa-times"></i>
        </button>
            <strong>Atención!</strong> Sus objetivos han sido aprobados por su jefe, no puede editarlos.
        </div>
        <?php
        }       
        elseif(($fecha >= $eva_ob->inicio) && ($fecha <= $eva_ob->fin)){?>
                <div class="panel-body">
                <form id="editar_objetivo" class="form-horizontal" role="form" action="../controlador/contro_act_objetivos.php" method="post" data-validate="parsley">
                <input type="hidden" id="id_objetivo" name="id_objetivo" value="<?php echo $id_obj ?>"/>
                <div class="form-group">
                                        <label class="col-sm-1 control-label col-lg-1" ><strong>1°</strong></label>
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
                                                    <textarea style="display:none;" class="form-control" name="meta" id="meta" placeholder="Meta Propuesta" rows="3"><?php  echo $eva->meta_pro  ?></textarea>
                                                </div>
                                                <div class="col-lg-3">
                                                <strong>Valor</strong><br>
                                                <input type="number" class="form-control" name="meta_valor" id="meta_valor" value="<?php  echo $eva->meta_va  ?>">
                                                <p class="help-block">Meta.</p>
                                                </div>
                                                <div class="col-lg-4">
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                <div class="modal-footer">
                                     <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
                                     <button type="submit" class="btn btn-primary"><i class='fa fa-refresh'>  </i> Actualizar</button>              
                                  </div>
                        </form>           
                                </div>
        <?php } 
        else{
        ?>
        <div class="alert alert-info fade in">
        <button data-dismiss="alert" class="close close-sm" type="button">
        <i class="fa fa-times"></i>
        </button>
            <strong>Atención!</strong> La fecha de hoy no se encuentra en el rango de fechas definidas por el administrador.
        </div>
        <?php 
        }
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