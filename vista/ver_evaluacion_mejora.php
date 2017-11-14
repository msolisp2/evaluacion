<?php
session_start();
	if($_SESSION["tipo"]=="3") 
	{
$id_cod_obj=$_REQUEST["id_cod_obj"];
require_once("../controlador/contro_clase_trabajador.php");
$trab=new clase_trabajador();
$trab->valores_clase_trabajador($_SESSION["codigo"]);
$eva=new clase_trabajador();
$eva->valores_clase_evaluacion($id_cod_obj);
require_once("../controlador/contro_clase_evaluacion.php");
$mejor=new clase_evaluacion();
$mejor->valores_clase_mejora($id_cod_obj);
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
#dynamic-table .my-table-center{ text-align: center; line-height: 100px;}
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
                                    <td><strong>CÓDIGO:</strong> FO-TH/AL-034</td>
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
                                    <td colspan="4" align="justify"><strong>Referencia:</strong> Formato <strong>D - Plan de mejora laboral</strong></td>
                                </tr>
								<tr>
                                    <td colspan="4" align="justify"><strong>Objetivo:</strong> establecer compromisos medibles y metas realizables, que permitan mejorar las evaluaciones que presentaron dificultades y hacerle seguimiento.</td>
                                </tr>	
				</table>
								<table class="table table-bordered">
								<tr>
                                    <td colspan="4" align="center"><strong>INSTRUCCIONES</strong></td>
                                </tr>
								<tr>
                                    <td colspan="4" align="justify">
									<p>El plan de mejora laboral debe ser aplicado a los funcionarios con calificación insatisfactoria, quien con el acompañamiento del jefe inmediato, deberán describir las dificultades que serán objeto de mejoramiento específico durante el periodo de evaluación siguiente.  Se recomienda establecer compromisos concretos y medibles expresados en metas realistas y tiempos precisos que serán objeto de seguimiento.   La definición clara de estos aspectos permitirá en buena medida el éxito del plan de mejora. 									
									</p>
									</td>
                                </tr>
								</table>	
				<table class="table table-bordered">		
								<tr>
								  <td width="22%" align="center"><strong>Nombre del Empleado</strong></td>
								  <td width="40%"><?php echo ucwords(strtolower($trab->nombre_trab))  ?></td>
								  <td width="13%" align="center"><strong>Dependencia</strong></td>
								  <td width="25%"><?php  echo $eva->area ?></td>
								</tr>							
                </table>				
				</div>				
				<table class="table table-bordered">								
								<tr>
                                    <td colspan="4" align="center"><strong>I. Dificultades, Análisis de Causa, Plan de Acción </strong>
									<button href="#myModal" role="button" class="btn btn-success" data-toggle="modal"><i class="fa fa-plus"></i></button>
									</td>
                                </tr>
				</table>
				<?php
									$lis_objd=new clase_evaluacion();
									$lis_objd->valores_listado_mejorar($id_cod_obj);
				?>
				<div id="footer_objetivo" style="display: none;">
				<table class="table table-bordered">		
								<tr>
								  <td width="22%"><strong>Firma del evaluador:</strong></td>
								  <td width="28%"><?php  echo $eva->nombre_jefe  ?></td>
								  <td width="22%"><strong>Firma del empleado:</strong></td>
								  <td width="28%"><?php echo ucwords(strtolower($trab->nombre_trab))  ?></td>
								</tr>
								  <td colspan="4"><strong>Ciudad y fecha: </strong><?php  echo $trab->ciudad.','.$hoy  ?></td>
								<tr>
								</tr>															
                </table>
				</div>
<!-- Agregar Objetivos -->
	 <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Formato D - Plan de mejora laboral.</h4>
        </div>
        <div class="modal-body">
        <form id="form_eval" class="form-horizontal bucket-form" action="../controlador/contro_crea_mejoras.php" method="post" data-validate="parsley">
                                  <!--  <input type="text" id="cod_eva" name="cod_eva" value="<?php echo $mejor->cod_plan ?>"/> -->
									<input type="hidden" id="cod_eva" name="cod_eva" value="<?php echo $id_cod_obj ?>"/>
	                               
								<p align="center"><strong>I. Dificultades, Análisis de Causa, Plan de Acción</strong>
										  <a id="agregarCampo" data-rel="tooltip" title="Agregar" class="btn btn-success" href="#"><i class="fa fa-plus"></i></a>
										  		</p>  
										<br>			
                            <div id="contenedor">
                                <div class="added">							
									<div class="form-group">
										<label class="col-sm-1 control-label col-lg-1" ><strong>1°</strong></label>
										<div class="col-lg-11">
											<div class="input-group m-bot20 col-sm-12">
												<textarea class="form-control" name="dificultad[]" id="objetivo_1" placeholder="Dificultad 1" rows="3" data-required="true"></textarea>
											</div>
											<div class="input-group m-bot15 col-sm-12">
												<textarea class="form-control" name="analisis[]" id="evidencia_1" placeholder="Analisis de las Causa 1" rows="3" data-required="true"></textarea>
											</div>
											<div class="row">
												<div class="col-lg-6">
													<textarea class="form-control" name="actividad[]" id="actividad_1" placeholder="Actividad 1" rows="3" data-required="true"></textarea>
												</div>
												<div class="col-lg-6">
													<textarea class="form-control" name="responsable[]" id="responsable_1" placeholder="Responsable 1" rows="3" data-required="true"></textarea>
												</div>
											</div>
											<br>
										</div>
									</div>								
                                </div>
                            </div>
                                    <div class="box-footer" align="center">
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                        <button type="reset" class="btn btn-danger">Cancelar</button>
                                    </div>
         </form>
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
				<h4 class="modal-title">Actualizar Plan Mejora</h4>
			</div>
			<div class="modal-body">
			<div id="modalContent_editar" style="display:none;">

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
          <p>No es posible eliminar mejoras, de una evaluación aprobada.</p>
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
												<textarea class="form-control" name="dificultad[]" id="objetivo_'+ FieldCount +'" placeholder="Dificultad '+ FieldCount +'" rows="3" required></textarea> \
											</div> \
											<div class="input-group m-bot15 col-sm-12"> \
												<textarea class="form-control" name="analisis[]" id="evidencia_'+ FieldCount +'" placeholder="Analisis de Causa '+ FieldCount +'" rows="3" required></textarea> \
											</div> \
											<div class="row"> \
												<div class="col-lg-6"> \
													<textarea class="form-control" name="actividad[]" id="actividad_'+ FieldCount +'" placeholder="Actividad '+ FieldCount +'" rows="3" data-required="true"></textarea> \
												</div> \
												<div class="col-lg-6"> \
													<textarea class="form-control" name="responsable[]" id="responsable_'+ FieldCount +'" placeholder="Responsable '+ FieldCount +'" rows="3" data-required="true"></textarea> \
												</div> \
											</div> \
											<br> \
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
		elementa = document.getElementById("footer_objetivo");
        check = document.getElementById("check_objetivo");
        if (check.checked) {
            element.style.display='block';
			elementa.style.display='block';
        }
        else {
            element.style.display='none';
			elementa.style.display='none';
        }
    }
</script> 
<script>
function eli_mej(id){
		 var num=id;
		 var estado="<?php echo $mejor->estado_plan; ?>";		 
	if (estado == 'Aprobado') { 
		$('#notificacion').modal('show'); 
		}
	else{  
			$.confirm({
			title:"Confirmacion de Eliminación",	
			text: "Seguro desea eliminar este Plan de Mejora?",
			confirm: function(button) {
			 window.location = "../controlador/contro_eli_mejora.php?id_mej=" + num;
			},
			cancel: function(button) {
			},
			confirmButton: "Si, estoy seguro",
				cancelButton: "Cancelar"
			});	
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
        url: '../vista/ver_mejora.php',
        data: 'id_obj='+essay_id,
        success: function(data) 
        {
            $('#editar_info').show();
            $('#modalContent_editar').show().html(data);
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