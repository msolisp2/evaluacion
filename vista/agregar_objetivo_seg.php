<?php
session_start();
    if($_SESSION["tipo"]=="3") 
    {
$id_obj=$_REQUEST["id_obj"];
$num_seg=$_REQUEST["num_seg"];
?>
<style type="text/css">
 .caja{
        display: none;
    }
 .azul{ background: #FFFFFF; }   
</style>
                <div class="panel-body">
<form id="form_eval" class="form-horizontal bucket-form" action="../controlador/contro_crea_objetivos.php" method="post" data-validate="parsley">
                                    <input type="text" id="cod_eva" name="cod_eva" value="<?php echo $id_obj ?>"/>
                                   <input type="text" id="num_seg" name="num_seg" value="<?php echo $num_seg ?>"/>
                                <p align="center"><strong>II. CONCERTACIÓN DE OBJETIVOS, METAS Y PESO %</strong></p>  
                                        <br>            
                            <div id="contenedor">
                                <div class="added">                         
                                    <div class="form-group">
                                        <label class="col-sm-1 control-label col-lg-1" ><strong>1°</strong></label>
                                        <div class="col-lg-11">
                                            <div class="input-group m-bot20 col-sm-12">
                                                <textarea class="form-control" name="objetivo[]" id="objetivo_1" placeholder="Objetivo 1" rows="3" data-required="true"></textarea>
                                            </div>

                                            <div class="input-group m-bot15 col-sm-12">
                                                <textarea class="form-control" name="evidencia[]" id="evidencia_1" placeholder="Evidencia 1" rows="3" data-required="true"></textarea>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-7">
                                                       <strong>Peso</strong>
                                                        <div class="input-group m-bot15 col-lg-7">
                                                        <input type="number" class="form-control" name="peso[]" id="peso_1" data-required="true">
                                                        <span class="input-group-addon btn-label">%</span>
                                                    </div>
                                                    <textarea style="display:none;" class="form-control" name="meta[]" id="meta_1" placeholder="Meta Propuesta 1" rows="3"></textarea>
                                                </div>
                                                <div class="input-group col-lg-4">
                                                <input class="form-control" id="meta_valor_1" name="meta_valor[]" type="text" pattern="([0-9])+(?:-?\d){0,5} (?:Cant.|%)" data-required="true">
                                                <div class="input-group-btn">
                                                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Tipo <span class="caret"></span></button>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li><a onClick="porcentaje(id='1')">%</a></li>
                                                            <li><a onClick="cantidad(id='1')">Cantidad</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <strong>&nbsp;&nbsp;Valor Meta</strong> (Num %|Cant.)
                                                <div class="col-lg-4">
                                                </div>
                                            </div>
                                           <!-- <br>
                                            <strong>Peso</strong>
                                            <div class="input-group m-bot15 col-sm-3">
                                                <input type="number" class="form-control" name="peso[]" id="peso_1" data-required="true">
                                                <span class="input-group-addon btn-label">%</span>
                                            </div>-->
                                        </div>
                                    </div>                              
                                </div>
                            </div>
                                    <div class="box-footer" align="center">
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                        <button type="reset" class="btn btn-danger">Cancelar</button>
                                    </div>
                                    </form>
           
                                </div>
<script type="text/javascript" charset="utf-8">
$("#form_eval").parsley();
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