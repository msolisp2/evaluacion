<?php
session_start();
    if($_SESSION["tipo"]=="3") 
    {
$id_cod_obj=$_REQUEST["id_cod_obj"];
$id_config=1;
require_once("../controlador/contro_clase_trabajador.php");
$trab=new clase_trabajador();
$trab->valores_clase_trabajador($_SESSION["codigo"]);
$eva=new clase_trabajador();
$eva->valores_clase_evaluacion($id_cod_obj);
require_once("../controlador/contro_clase_evaluacion.php");
$eval_obj=new clase_evaluacion();
$eval_obj->valores_clase_objetivos_total($id_cod_obj);
$config=new clase_evaluacion();
$config->valores_clase_configuracion($id_config);
$seg_1=1;
$seg_a=new clase_evaluacion();
$seg_a->valores_clase_evaluacion_fecha($id_cod_obj,$seg_1); 
$seg_2=2;
$seg_b=new clase_evaluacion();
$seg_b->valores_clase_evaluacion_fecha($id_cod_obj,$seg_2);
$seg_3=3;
$seg_c=new clase_evaluacion();
$seg_c->valores_clase_evaluacion_fecha($id_cod_obj,$seg_3);
date_default_timezone_set('America/Bogota');
$hoy=date("Y-m-d");
if($id_cod_obj){
?>
<style type="text/css">
table , td, th {
    border-collapse: collapse !important;
}
table + table, table + table tr:first-child th, table + table tr:first-child td {
    border-top: 0 !important;
}
.panel-group .panel {
  overflow: visible;
}
</style>
<center>
Mostrar Cabecera e Instrucciones
<input type="checkbox" name="check_objetivo" id="check_objetivo" value="1" onchange="javascript:showContent()" />
</center>
<br>
<div id="content_objetivo" style="display: none;">
                <table class="table table-bordered">
                                <tr>
                                    <td rowspan="3" align="center"><img src="../estilos/images/UCartagena1.png" alt="Smiley face" height="100" width="100"></td>
                                    <td colspan="2" align="center"><strong>UNIVERSIDAD DE CARTAGENA</strong></td>
                                    <td><strong>CÓDIGO:</strong> FO-TH/AL-024</td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center"><strong>OFICINA ASESORA DE GESTIÓN HUMANA Y DESARROLLO DE PERSONAL</strong></td>
                                    <td><strong>VERSIÓN:</strong> 03</td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center"><strong>GESTIÓN DEL DESEMPEÑO PARA EMPLEADOS PÚBLICOS NO DOCENTES Y TRABAJADORES OFICIALES</strong></td>
                                    <td><strong>FECHA:</strong> 13/12/2010</td>
                                </tr>
                                <tr>
                                    <td colspan="4" align="justify"><strong>Referencia:</strong> Formato <strong>A - Concertación de objetivos, metas y peso %</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="4" align="justify"><strong>Objetivo:</strong> concertar y establecer objetivos, metas y peso porcentual, que sean medibles y cuantificables con base en las competencias y funciones de cada cargo.</td>
                                </tr>   
                                <tr>
                                    <td colspan="4" align="center"><strong>I.DATOS DE IDENTIFICACIÓN</strong></td>
                                </tr>
                </table>
                <table class="table table-bordered">
                                <tr>
                                    <td width="30%" align="left"><strong>Fecha de diligenciamiento:</strong></td>
                                    <td align="left"><?php  echo $eva->fecha  ?></td>
                                </tr>   
                </table>
                <table class="table table-bordered">
                                <tr>
                                  <td width="10%" align="center"><strong>Nº Cédula</strong></td>
                                  <td width="12%"><?php  echo $trab->cedula ?></td>
                                  <td width="20%" align="center"><strong>Nombre del evaluado</strong></td>
                                  <td width="40%"><?php echo ucwords(strtolower($trab->nombre_trab))  ?></td>
                                  <td width="8%" align="center"><strong>Genero</strong></td>
                                  <td width="10%"><?php echo $trab->genero ?></td>
                                </tr>   
                </table>
                <table class="table table-bordered">
                                <tr>
                                  <td width="8%" align="center"><strong>Ciudad</strong></td>
                                  <td width="22%"><?php  echo $trab->ciudad  ?></td>
                                  <td width="35%" align="center"><strong>Periodo de evaluación</strong></td>
                                  <td width="35%" align="center"><strong>Tipo de vinculación</strong></td>
                                </tr>
                </table>
                <table class="table table-bordered">        
                                <tr>
                                  <td width="12%" align="center"><strong>Dependencia</strong></td>
                                  <td width="18%"><?php  echo $eva->area  ?></td>
                                  <td width="6%"><strong>Desde:</strong></td>
                                  <td width="5%"><strong>Dia</strong></td>
                                  <td width="4%"><?php $time=strtotime($eva->fecha_in); echo date('d', $time);?></td>
                                  <td width="5%"><strong>Mes</strong></td>
                                  <td width="4%"><?php echo date('m', $time);?></td>
                                  <td width="5%"><strong>Año</strong></td>                                
                                  <td width="6%"><?php echo date('Y', $time);?></td>
                                  <td width="35%" rowspan="2" align="center"><br><?php  echo $eva->vinculo  ?></td>
                                </tr>   
                                <tr>
                                  <td width="12%" align="center"><strong>Cargo</strong></td>
                                  <td width="18%"><?php  echo $eva->cargo_trab  ?></td>                               
                                  <td width="6%"><strong>Desde:</strong></td>
                                  <td width="5%"><strong>Dia</strong></td>
                                  <td width="4%"><?php $time_fin=strtotime($eva->fecha_fin); echo date('d', $time_fin);?></td>
                                  <td width="5%"><strong>Mes</strong></td>
                                  <td width="4%"><?php echo date('m', $time_fin);?></td>
                                  <td width="5%"><strong>Año</strong></td>                                
                                  <td width="6%"><?php echo date('Y', $time_fin);?></td>
                                </tr>                                   
                </table>    
                <table class="table table-bordered">        
                                <tr>
                                  <td width="22%" align="center"><strong>Nombre del evaluador</strong></td>
                                  <td width="40%"><?php  echo $eva->nombre_jefe  ?></td>
                                  <td width="13%" align="center"><strong>Cargo</strong></td>
                                  <td width="25%"><?php  echo $eva->cargo_jefe  ?></td>
                                </tr>                           
                </table>
                
                <?php if($config->estado=='Inactiva') { ?>
                                  <div class="alert alert-warning fade in">
                                        <button data-dismiss="alert" class="close close-sm" type="button">
                                            <i class="fa fa-times"></i>
                                        </button>
                                        <strong>Espere!</strong> El administrador del sistema no ha habilitado esta opción.
                                    </div>                                                                
                                 <?php  }
                                 else { ?>              
                <table class="table table-bordered">
                                <tr>
                                    <td colspan="4" align="center"><strong>INSTRUCCIONES</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="4" align="center">
                                    <ul>
                                         <li align="justify">Diligencie este formato al inicio del periodo anual y cuando se inicie el período de prueba.</li>
                                         <li align="justify">Las estrategias u objetivos a realizar en el período respectivo, se redactan en conjunto con el superior inmediato.</li>
                                         <li align="justify">Se sugiere definir máximo 5 objetivos, minímo 2.</li>                                          
                                            <br>
                                            <ol>
                                                <li align="justify">
                                                    Defina los objetivos del evaluado de acuerdo con la misión, meta o finalidad de la Dependencia y dentro del marco de las responsabilidades del cargo. Plantee objetivos realizables, medibles y cuantificables.
                                                </li>
                                                <li align="justify">
                                                    Establezca para cada objetivo las evidencias o soportes los cuales deben ser veraces, proporcionales, suficientes, actualizadas y pertinentes.
                                                </li>
                                                <li align="justify">
                                                    Establezca la Meta Propuesta en números enteros o en porcentaje, para cada objetivo planteado.
                                                </li>
                                                <li align="justify">
                                                    Establezca el Peso % para cada uno de los objetivos.
                                                </li>
                                                <li align="justify">
                                                    Por ultimo se registra la Fecha de Concertación de Objetivos, y firma tanto el evaluado como el evaluador.
                                                </li>
                                            </ol> <br>
                                    <li align="justify">En cuanto a la evaluación al final del período:</li>
                                    <li align="justify">El superior inmediato, realiza el cálculo matemático que define la evaluación de los objetivos del personal a cargo. Para ello:</li>
                                            <br>
                                            <ol>
                                                <li align="justify">
                                                    Registra el número de metas alcanzadas por Objetivo.
                                                </li >
                                                <li align="justify">
                                                    Calcula el % de Logro del objetivo alcanzado durante el periodo de evaluación, dividiendo la Meta Alcanzada entre la Meta Propuesta y multiplicando el resultado por 100.
                                                </li>
                                                <li align="justify">
                                                    Multiplica el Peso % del objetivo por el Logro % del mismo, el resultado lo divide entre 100, para obtener el subtotal que representa a ese objetivo.
                                                </li>
                                            </ol>
                                            </ul>
                                            <ul class="list-unstyled">
                                                <li align="justify">
                                                    Por ultimo, se suman todos los subtotales para obtener la Calificación Total de la evaluación.
                                                </li>     
                                            </ul>                                   
                                    </td>
                                </tr>
                                </table>
                </div>              
                <table class="table table-bordered">                                
                                <tr>
                                    <td colspan="4" align="center"><strong>II. CONCERTACIÓN DE OBJETIVOS, METAS Y PESO %</strong>
                                    <button href="#myModal" role="button" class="btn btn-success" data-toggle="modal" data-rel="0"><i class="fa fa-plus"></i></button>
                                    </td>
                                </tr>
                </table>
<div class="stepwizard">
    <div class="stepwizard-row setup-panel">
        <div class="stepwizard-step">
            <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
            <p>Objetivos Iniciales</p>
            <p><?php echo"(".$eva->inicio." <b>a</b> ".$eva->fin.")"?></p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
            <p>Seguimientos</p>
            <p><?php echo"(".$seg_a->inicio." <b>a</b> ".$seg_c->fin.")"?></p>          
        </div>
        <div class="stepwizard-step">
            <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
            <p>Consolidado</p>
            <p><?php echo"(".$seg_a->inicio." <b>a</b> ".$seg_c->fin.")"?></p>          
        </div>
    </div>
</div>
<form role="form">
    <div class="row setup-content" id="step-1">
        <div class="col-xs-12">
            <div class="col-md-12">
                        <br><br>
                                   <?php
                                    $seg=0;
                                    $lis_obj=new clase_evaluacion();
                                    $lis_obj->valores_listado_inicio_per_evl($id_cod_obj,$seg);
                                    ?>
                        <br><br>            
                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button"><i class="fa fa-arrow-right"></i></button>
            </div>
        </div>
    </div>
    <div class="row setup-content" id="step-2">
        <div class="col-xs-12">
            <div class="col-md-12">
                    <br><br>
                        <div aria-multiselectable="true" role="tablist" id="accordion" class="panel-group">
                                <div class="panel panel-default"> <a title="Tab 2" aria-controls="collapse2" aria-expanded="false" href="#collapse2" data-parent="#accordion" data-toggle="collapse" id="heading2" role="tab" class="panel-heading collapsed"><span class="glyphicon icon-indicator"></span> <span class="panel-title">Primer Seguimiento</span> <?php echo"(".$seg_a->inicio." <b>a</b> ".$seg_a->fin.")"?></a>
                                    <div aria-labelledby="heading2" role="tabpanel" class="panel-collapse collapse" id="collapse2" aria-expanded="false">
                                        <div class="panel-body">
                                        <?php                                   
                                        if($eva->estado!='Aprobado'){
                                            echo "No puede realizar actividades en este seguimiento, la evaluación no ha sido aprobada aún.";
                                        }                                       
                                        elseif(($hoy >= $seg_a->inicio) && ($hoy <= $seg_a->fin)){ 
                                            $lis_obja=new clase_evaluacion();
                                            $lis_obja->valores_listado_inicio_per_evl_seg($id_cod_obj,$seg_1);
                                        } 
                                        else{
                                            echo "No puede realizar actividades en este seguimiento. La fecha de Hoy, no coincide con la definida por el administrador";
                                        }                                       
                                        ?>  
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default"> <a title="Tab 3" aria-controls="collapse3" aria-expanded="false" href="#collapse3" data-parent="#accordion" data-toggle="collapse" id="heading3" role="tab" class="panel-heading collapsed"><span class="glyphicon icon-indicator"></span> <span class="panel-title">Segundo Seguimiento</span> <?php echo"(".$seg_b->inicio." <b>a</b> ".$seg_b->fin.")"?></a>
                                    <div aria-labelledby="heading3" role="tabpanel" class="panel-collapse collapse" id="collapse3" aria-expanded="false">
                                        <div class="panel-body">
                                        <?php                                   
                                        if($eva->estado!='Aprobado'){
                                            echo "No puede realizar actividades en este seguimiento, la evaluación no ha sido aprobada aún.";
                                        }                                       
                                        elseif(($hoy >= $seg_b->inicio) && ($hoy <= $seg_b->fin)){ 
                                            $lis_obja=new clase_evaluacion();
                                            $lis_obja->valores_listado_inicio_per_evl_seg($id_cod_obj,$seg_2);
                                        } 
                                        else{
                                            echo "No puede realizar actividades en este seguimiento. La fecha de Hoy, no coincide con la definida por el administrador";
                                        }                                       
                                        ?>                                      
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default"> <a title="Tab 4" aria-controls="collapse4" aria-expanded="false" href="#collapse4" data-parent="#accordion" data-toggle="collapse" id="heading4" role="tab" class="panel-heading collapsed"><span class="glyphicon icon-indicator"></span> <span class="panel-title">Tercer Seguimiento</span> <?php echo"(".$seg_c->inicio." <b>a</b> ".$seg_c->fin.")"?></a>
                                    <div aria-labelledby="heading4" role="tabpanel" class="panel-collapse collapse" id="collapse4" aria-expanded="false">
                                        <div class="panel-body">
                                        <?php                                   
                                        if($eva->estado!='Aprobado'){
                                            echo "No puede realizar actividades en este seguimiento, la evaluación no ha sido aprobada aún.";
                                        }                                       
                                        elseif(($hoy >= $seg_c->inicio) && ($hoy <= $seg_c->fin)){ 
                                            $lis_obja=new clase_evaluacion();
                                            $lis_obja->valores_listado_inicio_per_evl_seg($id_cod_obj,$seg_3);
                                        } 
                                        else{
                                            echo "No puede realizar actividades en este seguimiento. La fecha de Hoy, no coincide con la definida por el administrador";
                                        }                                       
                                        ?>
                                        </div>
                                    </div>
                                </div>                              
                            </div>
                        <br><br>
                <button class="btn btn-default prevBtn btn-lg pull-left" type="button" ><i class="fa fa-arrow-left"></i></button>
                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" ><i class="fa fa-arrow-right"></i></button>
            </div>
        </div>
    </div>
    <div class="row setup-content" id="step-3">
        <div class="col-xs-12">
            <div class="col-md-12">
        <br><br>
        <div class="row">
                        <div class="col-sm-7">
                                    <?php
                                    $seg=3;
                                    $lis_objd=new clase_evaluacion();
                                    $lis_objd->valores_listado_inicio_per_evl($id_cod_obj,$seg);
                                    ?>                          
                        </div> 
                        <div class="col-sm-5">
                                   <?php
                                    $lis_obje=new clase_evaluacion();
                                    $lis_obje->valores_listado_fin_per_evl($id_cod_obj);
                                    ?>
                                    <table class="table table-bordered"><td colspan="6" align="right">Subtotal</td><td>
                                    <?php 
                                    if( isset($eval_obj->subtotal) && ($eval_obj->subtotal!=null) ){
                                    echo $eval_obj->subtotal; } 
                                    ?> %</td></table>
                        </div> 
                </div>
                <br>
                <div class="row">
                        <div class="col-sm-7">
                            <table class="table table-bordered">
                                <tr>
                                    <td colspan="8" align="center"><strong>Primer Período</strong></td>
                                </tr>
                                <tr>
                                  <td width="56%" align="center"><strong>Objetivos Concertados</strong></td>
                                  <?php 
                                   if($eva->fecha_con){
                                  $time_con=strtotime($eva->fecha_con); 
                                  $dia=date('d', $time_con); 
                                  $mes=date('m', $time_con);
                                  $ano=date('Y', $time_con);
                                  }
                                   else{
                                  $dia="";
                                  $mes="";
                                  $ano="";
                                   }
                                  ?>
                                  <td width="10%"><strong>Dia</strong></td>
                                  <td width="4%"><?php echo $dia;?></td>
                                  <td width="10%"><strong>Mes</strong></td>
                                  <td width="4%"><?php echo $mes;?></td>
                                  <td width="10%"><strong>Año</strong></td>                               
                                  <td width="6%"><?php echo $ano;?></td>
                                </tr>                                       
                            </table>
                            <table class="table table-bordered">
                                <tr>
                                    <td colspan="4" align="center"><strong>Firma del Evaluado</strong></td>
                                    <td colspan="4" align="center"><strong>Firma del Evaluador</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="4" align="center"><?php echo ucwords(strtolower($trab->nombre_trab))  ?></td>
                                    <td colspan="4" align="center"><?php  echo $eva->nombre_jefe  ?></td>
                                </tr>                                   
                            </table>
                        </div> 
                </div>
            <br>    
            <hr>
            <div class="row">
            <div class="col-sm-12">
                                   <?php
                                    $lis_objf=new clase_evaluacion();
                                    $lis_objf->valores_listado_obj_concertados($id_cod_obj);
                                    ?>
                        </div>
            </div>          
                <br><br>
                <button class="btn btn-default prevBtn btn-lg pull-left" type="button" ><i class="fa fa-arrow-left"></i></button>
                <button class="btn btn-success btn-lg pull-right" type="submit"><i class="fa fa-times"></i></button>
            </div>
        </div>
    </div>
</form>
<!-- Seguimiento -->        
        <div id="editar_seguimiento" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Actualizar Objetivo Concretado</h4>
            </div>
            <div class="modal-body">
            <div id="modalContent_seguimiento" style="display:none;">

            </div>                        
            </div><!-- End of Modal body -->
            </div><!-- End of Modal content -->
            </div><!-- End of Modal dialog -->
        </div><!-- End of Modal Meta -->    
<!-- Agregar Objetivos -->
     <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Formato A - Concertación de objetivos, metas y peso %</h4>
        </div>
        <div class="modal-body">
        <?php
        if($eva->estado=='Aprobado'){?>
        <div class="alert alert-warning fade in">
        <button data-dismiss="alert" class="close close-sm" type="button">
        <i class="fa fa-times"></i>
        </button>
            <strong>Atención!</strong> Sus objetivos han sido aprobados por su jefe, no puede agregar mas.
        </div>
        <?php
        }       
        elseif(($hoy >= $eva->inicio) && ($hoy <= $eva->fin)){?>
        <form id="form_eval" class="form-horizontal bucket-form" action="../controlador/contro_crea_objetivos.php" method="post" data-validate="parsley">
                                    <input type="hidden" id="cod_eva" name="cod_eva" value="<?php echo $id_cod_obj ?>"/>
                                   
                                <p align="center"><strong>II. CONCERTACIÓN DE OBJETIVOS, METAS Y PESO %</strong>
                                          <a id="agregarCampo" data-rel="tooltip" title="Agregar" class="btn btn-success" href="#"><i class="fa fa-plus"></i></a>
                                                </p>  
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
          } ?>  
        </div><!-- End of Modal body -->
        </div><!-- End of Modal content -->
        </div><!-- End of Modal dialog -->
    </div><!-- End of Modal -->
<!-- Modificar Objetivo --> 
        <div id="editar_info" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Actualizar Objetivo</h4>
            </div>
            <div class="modal-body">
            <div id="modalContent_editar" style="display:none;">

            </div>                        
            </div><!-- End of Modal body -->
            </div><!-- End of Modal content -->
            </div><!-- End of Modal dialog -->
        </div><!-- End of Modal Meta --> 
<!-- Agregar Objetivo Seg --> 
        <div id="agregar_info_seg" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Actualizar Objetivo</h4>
            </div>
            <div class="modal-body">
            <div id="modalContent_agregar_seg" style="display:none;">

            </div>                        
            </div><!-- End of Modal body -->
            </div><!-- End of Modal content -->
            </div><!-- End of Modal dialog -->
        </div><!-- End of Modal Meta -->         
<!-- Modificar Objetivo Seg --> 
        <div id="editar_info_seg" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Actualizar Objetivo</h4>
            </div>
            <div class="modal-body">
            <div id="modalContent_editar_seg" style="display:none;">

            </div>                        
            </div><!-- End of Modal body -->
            </div><!-- End of Modal content -->
            </div><!-- End of Modal dialog -->
        </div><!-- End of Modal Meta -->        
<!-- Modificar Objetivo --> 
        <div id="editar_obj_info" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Actualizar Objetivo Concretado</h4>
            </div>
            <div class="modal-body">
            <div id="modalContent_editar_obj" style="display:none;">

            </div>                        
            </div><!-- End of Modal body -->
            </div><!-- End of Modal content -->
            </div><!-- End of Modal dialog -->
        </div><!-- End of Modal Meta -->    
  <!-- Modal -->
  <div  id="notificacion" class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Aviso!</h4>
        </div>
        <div class="modal-body">
          <p>No es posible eliminar objetivos, de una evaluación aprobada.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      
    </div>
  </div>
  <!-- Modal 2-->
  <div  id="notificacion_2" class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Aviso!</h4>
        </div>
        <div class="modal-body">
          <p>La fecha de hoy no se encuentra en el rango de fechas definidas por el administrador.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      
    </div>
  </div>  
 <?php 
 }      
 else {
  echo "Debes seleccionar un Año";
 }  
 ?>
<script src="../estilos/js/wizard.js"></script>
<script type="text/javascript"> 
$('.wysihtml5').wysihtml5();
$("#form_eval").parsley();
$(document).ready(function() {

    var MaxInputs       = 30; //Número Maximo de Campos
    var contenedor       = $("#contenedor"); //ID del contenedor
    var AddButton       = $("#agregarCampo"); //ID del Botón Agregar

    //var x = número de campos existentes en el contenedor
    var x = 2;
    var FieldCount = x-1; //para el seguimiento de los campos

    $(AddButton).click(function (e) {
        if(x <= MaxInputs) //max input box allowed
        {
            FieldCount++;
            //agregar campo
            $(contenedor).append(
            '<div> <hr>\
            <div class="form-group"> \
                                        <label class="col-sm-1 control-label col-lg-1" ><strong>'+ FieldCount +'°</strong></label> \
                                        <div class="col-lg-11"> \
                                            <div class="input-group m-bot20 col-sm-12"> \
                                                <textarea class="form-control" name="objetivo[]" id="objetivo_'+ FieldCount +'" placeholder="Objetivo '+ FieldCount +'" rows="3" required></textarea> \
                                            </div> \
                                            <div class="input-group m-bot15 col-sm-12"> \
                                                <textarea class="form-control" name="evidencia[]" id="evidencia_'+ FieldCount +'" placeholder="Evidencia '+ FieldCount +'" rows="3" required></textarea> \
                                            </div> \
                                            <div class="row"> \
                                                <div class="col-lg-7"> \
                                                        <strong>Peso</strong> \
                                                     <div class="input-group m-bot15 col-lg-7"> \
                                                        <input type="number" class="form-control" name="peso[]" id="peso_'+ FieldCount +'" required> \
                                                        <span class="input-group-addon btn-label">%</span> \
                                                    </div>\
                                                <textarea style="display:none;" class="form-control" name="meta[]" id="meta_'+ FieldCount +'" placeholder="Meta Propuesta '+ FieldCount +'" rows="3"></textarea> \
                                                </div> \
                                                <div class="input-group col-lg-4"> \
                                                <input type="text" class="form-control" name="meta_valor[]" id="meta_valor_'+ FieldCount +'" pattern="([0-9])+(?:-?\d){0,5} (?:Cant.|%)" required> \
                                                    <div class="input-group-btn"> \
                                                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Tipo <span class="caret"></span></button> \
                                                        <ul class="dropdown-menu pull-right"> \
                                                            <li><a onClick="porcentaje(id='+ FieldCount +')">%</a></li> \
                                                            <li><a onClick="cantidad(id='+ FieldCount +')">Cantidad</a></li> \
                                                        </ul> \
                                                    </div> \
                                                </div> \
                                                <strong>&nbsp;&nbsp;Valor Meta (Num %|Cant.)</strong>\
                                                <div class="col-lg-4"> \
                                                </div> \
                                            </div> \
                                            <br> \
                                             <div style="display:none;" class="input-group m-bot15 col-sm-3"> \
                                                <span class="input-group-addon btn-label">%</span> \
                                            </div>\
                                        </div>\
                                    </div>\
            <a class="btn btn-danger eliminar" href="#"><i class="fa fa-trash-o"></i></a><br><br>\  </div>');           
            x++; //text box increment
        }
        return false;
    });

    $("body").on("click",".eliminar", function(e){ //click en eliminar campo
        if( x > 1 ) {
            $(this).parent('div').remove(); //eliminar el campo
            x--;
        }
        return false;
    });
});
    </script>
    <script type="text/javascript">
    function showContent() {
        element = document.getElementById("content_objetivo");
        check = document.getElementById("check_objetivo");
        if (check.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }
</script> 
<script>
function porcentaje(id){    
        var num=id;
        var dato = parseFloat($('#meta_valor_'+num).val());
        $("#meta_valor_"+num).val(dato+" %");   
    };
function cantidad(id){
        var num=id;
        var dato = parseFloat($('#meta_valor_'+num).val()); 
        $("#meta_valor_"+num).val(dato+" Cant.");   
    };
</script>
<script>
function eli_obj(id){
         var num=id;
         var estado="<?php echo $eva->estado; ?>";
         var hoy="<?php echo $hoy; ?>";
         var inicio="<?php echo $eva->inicio; ?>";
         var fin="<?php echo $eva->fin; ?>";         
    if (estado == 'Aprobado') { 
        $('#notificacion').modal('show'); 
        }
    else if (hoy >= inicio && hoy <= fin){  
            $.confirm({
            title:"Confirmacion de Eliminación",    
            text: "Seguro desea eliminar este Objetivo?",
            confirm: function(button) {
             window.location = "../controlador/contro_eli_objetivo.php?id_obj=" + num;
            },
            cancel: function(button) {
            },
            confirmButton: "Si, estoy seguro",
                cancelButton: "Cancelar"
            }); 
        }
    else{           
             $('#notificacion_2').modal('show'); 
        }           
    };
</script>
<script>
$(".editar").click(function() 
{   
    var essay_id = $(this).attr('id');

    $.ajax({
        cache: false,
        type: 'POST',
        url: '../vista/ver_objetivo.php',
        data: 'id_obj='+essay_id,
        success: function(data) 
        {
            $('#editar_info').show();
            $('#modalContent_editar').show().html(data);
        }
    });
});
$(".agregar_seg").click(function() 
{   
    var num_seg = $(this).attr('id');
    var cod_eva = $(this).attr('rel');
    $.ajax({
        cache: false,
        type: 'POST',
        url: '../vista/agregar_objetivo_seg.php',
        data: 'id_obj='+cod_eva+'&num_seg='+num_seg,
        success: function(data) 
        {
            $('#agregar_info_seg').show();
            $('#modalContent_agregar_seg').show().html(data);
        }
    });
});
$(".editar_seg").click(function() 
{   
    var essay_id = $(this).attr('id');
    var essay_rel = $(this).attr('rel');
    $.ajax({
        cache: false,
        type: 'POST',
        url: '../vista/ver_objetivo_seg.php',
        data: 'id_obj='+essay_id+'&num_obj='+essay_rel,
        success: function(data) 
        {
            $('#editar_info_seg').show();
            $('#modalContent_editar_seg').show().html(data);
        }
    });
});
$(".editar_obj").click(function() 
{   
    var essay_id = $(this).attr('id');

    $.ajax({
        cache: false,
        type: 'POST',
        url: '../vista/ver_objetivo_concretado.php',
        data: 'id_obj='+essay_id,
        success: function(data) 
        {
            $('#editar_obj_info').show();
            $('#modalContent_editar_obj').show().html(data);
        }
    });
});
$(".seguimiento").click(function() 
{   
    var essay_id = $(this).attr('id');
    var essay_rel = $(this).attr('rel');
    $.ajax({
        cache: false,
        type: 'POST',
        url: '../vista/ver_objetivo_seguimiento.php',       
        data: 'id_obj='+essay_rel+'&num_obj='+essay_id,
        success: function(data) 
        {
            $('#editar_seguimiento').show();
            $('#modalContent_seguimiento').show().html(data);
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