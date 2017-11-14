<?php
session_start();
	if($_SESSION["tipo"]=="2") 
	{
?>
<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="../estilos/images/favicon.ico">

    <title>Jefe | Registro Evaluaciones</title>

     <!--Core CSS -->
    <link href="../estilos/bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="../estilos/css/bootstrap-reset.css" rel="stylesheet">
    <link href="../estilos/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!--dynamic table-->
    <link href="../estilos/js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
    <link href="../estilos/js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
    <link rel="stylesheet" href="../estilos/js/data-tables/DT_bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="../estilos/js/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="../estilos/js/bootstrap-timepicker/css/timepicker.css" />
    <link rel="stylesheet" type="text/css" href="../estilos/js/bootstrap-colorpicker/css/colorpicker.css" />
    <link rel="stylesheet" type="text/css" href="../estilos/js/bootstrap-daterangepicker/daterangepicker-bs3.css" />
    <link rel="stylesheet" type="text/css" href="../estilos/js/bootstrap-datetimepicker/css/datetimepicker.css" />
	<link rel="stylesheet" type="text/css" href="../estilos/js/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />	
    <!-- NotifIt -->
    <link href='../estilos/css/notifIt.css' rel='stylesheet'>
    <!-- Multi Select -->
    <link rel="stylesheet" type="text/css" href="../estilos/js/select2/select2.css" />
    <!-- Custom styles for this template -->
    <link href="../estilos/css/style.css" rel="stylesheet">
    <link href="../estilos/css/style-responsive.css" rel="stylesheet" />

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
<style type="text/css">
.datepicker {
z-index: 9999;
top: 0;
left: 0;
padding: 4px;
margin-top: 1px;
-webkit-border-radius: 4px;
-moz-border-radius: 4px;
border-radius: 4px;
}
</style>
<!--
.modal .modal-dialog {
  width: 90%;
}-->
</head>

<body>

<section id="container" >
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">

    <a href="../vista/jefe.php" class="logo">
        <img src="../estilos/images/jefe.png" alt="" height="50" width="200">
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->

<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder=" Busqueda">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="../estilos/images/avatar1_small.jpg">
                <span class="username"><?php echo $_SESSION["nombre"]; ?></span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="../vista/editar_info_jefe.php"><i class=" fa fa-suitcase"></i> Perfil</a></li>
                <li><a href="../controlador/cerrar.php"><i class="fa fa-key"></i> Cerrar Sesión</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
        <li>
            <div class="toggle-right-box">
                <div class="fa fa-bars"></div>
            </div>
        </li>
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->           
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
            <li>
                <a href="../vista/jefe.php">
                    <i class="fa fa-dashboard"></i>
                    <span>Inicio</span>
                </a>
            </li>
			 <li>
                <a href="../vista/configuracion_jefe.php">
                    <i class="fa fa-users"></i>
                    <span>Lista de Empleados</span>
                </a>
			</li>
            <li>
                <a  class="active"  href="../vista/generar_evaluaciones.php">
                    <i class="fa fa-cogs"></i>
                    <span>Generación de Periodo</span>
                </a>
            </li>			
			<li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-check-square-o"></i>
                    <span>Concertación de Objetivos</span>
                </a>
                <ul class="sub">
					<li><a href="../vista/listado_objetivos.php"><i class="fa fa-angle-double-right"></i> Pendientes</a></li>
					<li><a href="../vista/historial_objetivos_jefe.php"><i class="fa fa-angle-double-right"></i> Historial</a></li>
                </ul>
            </li>
			<li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-sitemap"></i>
                    <span>Evaluación Competencias</span>
                </a>
                <ul class="sub">
				     <li><a href="../vista/listado_eval_trab_jefe.php"><i class="fa fa-angle-double-right"></i>Pendientes</a></li>
                    <li><a href="../vista/historial_eval_trab_jefe.php"><i class="fa fa-angle-double-right"></i> Historial</a></li>
                </ul>
            </li>
			<li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-archive"></i>
                    <span>Recursos</span>
                </a>
                <ul class="sub">
				     <li><a href="../vista/listado_recurso_jefe.php"><i class="fa fa-angle-double-right"></i>Pendientes</a></li>
                    <li><a href="../vista/historial_recurso_jefe.php"><i class="fa fa-angle-double-right"></i> Historial</a></li>
                </ul>
            </li>
			<li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-bookmark"></i>
                    <span>Plan de Mejora Laboral</span>
                </a>
                <ul class="sub">
                    <li><a href="../vista/listado_mejora_trab_jefe.php"><i class="fa fa-angle-double-right"></i> Pendientes</a></li>			
					<li><a href="../vista/historial_mejora_trab_jefe.php"><i class="fa fa-angle-double-right"></i> Historial</a></li>
                </ul>
            </li>			
            			
            <li>
                <a href="../controlador/cerrar.php">
                    <i class="fa fa-sign-out"></i>
                    <span>Cerrar Sesión </span>
                </a>
            </li>
        </ul></div>        
<!-- sidebar menu end-->
    </div>
</aside><!--sidebar end-->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->

       <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        <font style="text-transform:capitalize; "><strong>Objetivos</strong> Registro, Edición y Eliminación de Objetivos, Metas y Peso %</font>
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>
                    </header>
                    <div class="panel-body">
						<div class="adv-table">
                       <div class="btn-group">
                       <button href="#myModal" role="button" class="btn btn-success" data-toggle="modal"><i class="fa fa-plus"></i> Agregar</button>
                       </div>
					   <?php
						     		include_once("../controlador/contro_clase_evaluacion.php");
									$lis_eva_total=new clase_evaluacion();
									$lis_eva_total->valores_clase_listado_evaluaciones_obj($_SESSION["codigo"]);
						?>
					   </div>
					   <br><br><br>
								<div class="text-center">
									<div class="col-lg-3">
									</div>
								   <div class="btn-group">
								   <button role="button" id="boton" class="btn btn-primary"><i class="fa fa-envelope"></i> Correo</button>
								   </div>
							   </div>
				   <hr><br>
							   <div id="capa"> 
							   </div>
                   </div>
                </section>
            </div>
        </div>
        <!-- page end-->
        <!-- Modal Agregar-->
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Generar matriz de co-evaluadores</h4>
        </div>
        <div class="modal-body">
		   <?php
		   require_once("../controlador/contro_clase_trabajador.php");
			$jefe=new clase_trabajador();
			$jefe->valores_clase_trabajador($_SESSION["codigo"]);
			//CC Trabajador, Id Cargo Trab, CC Par, Id Cargo Par 
		?>																																
                                    <form id="form_eval" class="form-horizontal bucket-form" action="../controlador/contro_crea_eval.php" method="post" data-validate="parsley">
                                    <input type="hidden" name="id_valida_anio" id="id_valida_anio" value="0">
                                    <input type="hidden" name="id_valida_par" id="id_valida_par" value="0">
                                    <input type="hidden" name="id_valida_usuario" id="id_valida_usuario" value="0">
									<input type="hidden" id="id_jefe" name="id_jefe" value="<?php echo $_SESSION["codigo"] ?>"/>
									<input type="hidden" id="id_cargo_jefe" name="id_cargo_jefe" value="<?php  echo $jefe->id_cargo ?>"/>
									<input type="hidden" id="id_depe" name="id_depe" value="<?php  echo $jefe->id_area ?>"/>									
                                    <table class="table table-bordered">
										<tr>
                                          <td colspan="3" align="center"><strong>Jefe</strong></td>
                                        </tr>
                                        <tr>
                                          <td colspan="3" align="center">
											<div class="form-group">
												<div class="col-md-2">	
												</div>	
												<div class="col-sm-8">	
												<?php  echo $jefe->nombre_trab ?>
												</div>
											</div>
										  </td>
                                        </tr>
										<tr>
                                          <td colspan="3" align="center"><strong>Empleado</strong></td>
                                        </tr>
                                        <tr>
                                          <td colspan="3" align="center">
											<div class="form-group">
											<div class="col-sm-2">	
												</div>
												<div class="col-sm-8">	
												<?php
													include_once("../controlador/contro_clase_trabajador.php");
													$select_trab=new clase_trabajador();
													$select_trab->valores_select_trabajador($_SESSION["codigo"]);
												?> 
												</div>												
											</div>
											<div class="form-group">
											<div class="col-sm-2">	
												</div>
												<div class="col-sm-4">	 
												<input type="hidden" id="id_cargo_trab" name="id_cargo_trab" value=""/>
												<input type="text" class="form-control" id="nombre_cargo_trab" name="nombre_cargo_trab" value="" readonly>
												</div>
												<div class="col-sm-4">	 
												<input type="hidden" id="id_nivel_trab" name="id_nivel_trab" value=""/>
                                                <input type="hidden" class="form-control" id="correo_trab" name="correo_trab" value="" readonly> 
                                                <input type="text" class="form-control" id="nombre_nivel_trab" name="nombre_nivel_trab" value="" readonly>
												</div>													
											</div>											
										  </td>
                                        </tr>
										<tr>
                                          <td colspan="3" align="center"><strong>Par</strong></td>
                                        </tr>
                                        <tr>
                                          <td colspan="3" align="center">
											<div class="form-group">
											<div class="col-sm-2">	
												</div>
												<div class="col-sm-8">	
												<select name="id_par_select" id="id_par_select" style="width:100%" class="populate" data-required="true" multiple="multiple">
												</select>
												</div>												
											</div>
											<div class="form-group">
											<div class="col-sm-2">	
												</div>
												<div class="col-sm-4">	 
												<input type="hidden" id="id_cargo_par" name="id_cargo_par" value=""/>
												<input type="text" class="form-control" id="nombre_cargo_par" name="nombre_cargo_par" value="" readonly>
												</div>
												<div class="col-sm-4">	 
												<input type="hidden" id="id_nivel_par" name="id_nivel_par" value=""/>
                                                <input type="hidden" class="form-control" id="correo_par" name="correo_par" value="" readonly>
												<input type="text" class="form-control" id="nombre_nivel_par" name="nombre_nivel_par" value="" readonly>
												</div>													
											</div>											
										  </td>
                                        </tr>
										<tr>
                                          <td colspan="3" align="center"><strong>Usuario</strong></td>
                                        </tr>
                                        <tr>
                                          <td colspan="3" align="center">
											<div class="form-group">
											<div class="col-sm-2">	
												</div>
												<div class="col-sm-8">	
												<select name="id_usuario_select" id="id_usuario_select" style="width:100%" class="populate" data-required="true" multiple="multiple">
												</select>
												</div>													
											</div>
											<div class="form-group">
											<div class="col-sm-2">	
												</div>
												<div class="col-sm-4">	 
												<input type="hidden" id="id_cargo_usuario" name="id_cargo_usuario" value=""/>
												<input type="text" class="form-control" id="nombre_cargo_usuario" name="nombre_cargo_usuario" value="" readonly>
												</div>
												<div class="col-sm-4">	 
												<input type="hidden" id="id_nivel_usuario" name="id_nivel_usuario" value=""/>
                                                <input type="hidden" class="form-control" id="correo_usuario" name="correo_usuario" value="" readonly>
												<input type="text" class="form-control" id="nombre_nivel_usuario" name="nombre_nivel_usuario" value="" readonly>
												</div>													
											</div>											
										  </td>
                                        </tr>						
										<!--<tr>
                                          <td colspan="3" align="center"><strong>Periodo de Evaluación</strong></td>
                                        </tr>
                                        <tr>
                                          <td colspan="3" align="center">
										    <div class="form-group">
												<div class="col-md-3">	
												</div>	
												<div class="col-md-6">												
													<div class="input-group input-large" data-date-format="mm/dd/yyyy">
														<input type="text" class="form-control dpd1" name="fecha_inicio" data-required="true">
														<span class="input-group-addon">a</span>
														<input type="text" class="form-control dpd2" name="fecha_fin" data-required="true">
													</div>												
												</div>
											</div>
										  </td>
                                        </tr>-->
									  <tr>
                                          <td colspan="3" align="center"><strong>Año</strong></td>
                                        </tr>
                                        <tr>
                                          <td colspan="3" align="center">
											<div class="form-group">
												<div class="col-md-4">	
												</div>	
												<div class="col-sm-4">	
                                                <input type="text" class="form-control" id="ano_eval" name="ano_eval" value="<?php echo date('Y');?>" readonly>
                                                <!--<select class="form-control" id="ano_eval" name="ano_eval" data-required="true">
												<option value="">Seleccione Año</option>
												</select>-->
												</div>
											</div>
										  </td>
                                        </tr>
									</table> 
                                    <br>
									<div id="info"></div><br><div id="info_usu"></div><br><div id="info_par"></div>
                                    <div class="box-footer" align="center">
                                        <button id="generar" type="submit" class="btn btn-primary"><i class="fa fa-cogs"></i> Generar</button>
                                        <button type="reset" class="btn btn-danger">Cancelar</button>
                                    </div>
                                    </form>
									<div class="capa"></div>
        </div><!-- End of Modal body -->
        </div><!-- End of Modal content -->
        </div><!-- End of Modal dialog -->
    </div><!-- End of Modal -->
        <!-- Modal Actualizar -->
       <div id="localidad_info" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Actualizar Localidad</h4>
        </div>
        <div class="modal-body">
        <div id="modalContent" style="display:none;">

        </div>                        
        </div><!-- End of Modal body -->
        </div><!-- End of Modal content -->
        </div><!-- End of Modal dialog -->
        </div><!-- End of Modal Actualizar -->   
        </section>
    </section>
    <!--main content end-->
<!--right sidebar start-->
<div class="right-sidebar">
<div class="search-row">
    <input type="text" placeholder="Busqueda" class="form-control">
</div>
<div class="right-stat-bar">
<ul class="right-side-accordion">
<li class="widget-collapsible">
    <a href="#" class="head widget-head yellow-bg active clearfix">
        <span class="pull-left">Información</span>
        <span class="pull-right widget-collapse"><i class="ico-minus"></i></span>
    </a>
    <ul class="widget-container">
        <li>
               <div class="prog-row">
                <div class="side-graph-info">
                    <h4>Universidad de Cartagena</h4>
                    <p>
                        Universidad Desarrolladora
                    </p>
                </div>
                <div class="side-mini-graph">
                    <div class="target-sell">
                    </div>
                     <div class="thumb">
                     <a href="http://www.unicartagena.edu.co/" target="_blank"><img src="../estilos/images/UCartagena1.png" alt="" width="45" height="45"></a>
                </div>
                </div>
            </div>
        </li>
    </ul>
</li>
<li class="widget-collapsible">
    <a href="#" class="head widget-head terques-bg active clearfix">
        <span class="pull-left">Grupo Desarrollador</span>
        <span class="pull-right widget-collapse"><i class="ico-minus"></i></span>
    </a>
    <ul class="widget-container">
        <li>
            <div class="prog-row">
                <div class="user-thumb">
                    <img src="../estilos/images/avatar1_small.jpg" alt="">
                </div>
                <div class="user-details">
                    <h4>Sistemas</h4>
                    <p>
                        Universidad de Cartagena
                    </p>
                </div>
                <div class="user-status text-danger">
                    <i class="fa fa-comments-o"></i>
                </div>
            </div>

            <p class="text-center">
                <a href="http://www.unicartagena.edu.co/" class="view-btn" target="_blank">
			Universidad de Cartagena 2015. &nbsp;&nbsp; Derechos Reservados.</a>
            Telefax: (+57-5) 6600974 <font size="1">sistemas@unicartagena.edu.co</font><br>&nbsp;&nbsp;&nbsp;&nbsp;
			Cartagena de Indias – Colombia
            </p>
        </li>
    </ul>
</li>
</ul>
</div>
</div>
<!--right sidebar end-->

</section>

<!-- Placed js at the end of the document so the pages load faster -->

<!--Core js-->
<script type="text/javascript" src="../estilos/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../estilos/js/bootstrap-3.2.0.min.js"></script>
<script type="text/javascript" src="../estilos/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="../estilos/js/bootstrap-multiselect.css" type="text/css"/>
<script class="include" type="text/javascript" src="../estilos/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="../estilos/js/jquery.scrollTo.min.js"></script>
<script src="../estilos/js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
<script src="../estilos/js/jquery.nicescroll.js"></script>
<!--dynamic table-->
<script type="text/javascript" language="javascript" src="../estilos/js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="../estilos/js/data-tables/DT_bootstrap.js"></script>
<!--dynamic table-->
<script type="text/javascript" src="../estilos/js/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="../estilos/js/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="../estilos/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="../estilos/js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<!--common script init for all pages-->
<script src="../estilos/js/scripts.js"></script>
<script src="../estilos/js/advanced-form.js"></script>

<script type="text/javascript" src="../estilos/js/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="../estilos/js/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<!--dynamic table initialization -->
<script src="../estilos/js/dynamic_table_init.js"></script>
<!-- Multi Select --> 
<script src="../estilos/js/select2/select2.js"></script>
<script src="../estilos/js/select-init.js"></script>
<!-- Parsley-->
<script src="../estilos/js/parsley.js"></script>
<!-- NotifIt -->
<script type="text/javascript" src="../estilos/js/notifIt.js"></script>
<!-- Confirmacion -->
<script src="../estilos/js/jquery.confirm.js"></script>
<!-- Notificacion -->
<script type="text/javascript">
//$("#generar").hide();
var evento="<?php echo $_SESSION["evento"] ?>";	
if(evento){	
notif({
			msg: "<?php if (is_array($_SESSION["suceso"]) || is_object($_SESSION["suceso"])){foreach ($_SESSION["suceso"] as $msg) { echo  $msg; }}?>",
 		 	type: "<?php echo $_SESSION["evento"] ?>"
			});			
}				
</script>
<!-- Modal Edit / Delete -->
<script>
$(document).ready(function() {  
$("#id_trab_select").select2({
		placeholder: "Seleccione un Empleado",
       allowClear: true,
		maximumSelectionSize: 1,
        formatSelectionTooBig: function (limit) {
            return 'Maximo un Empleado';
        }
		});
$("#id_par_select").select2({
		placeholder: "Seleccione un Par",
       allowClear: true,
		maximumSelectionSize: 1,
        formatSelectionTooBig: function (limit) {
            return 'Maximo un Par';
        }
		});	
$("#id_usuario_select").select2({
		placeholder: "Seleccione un Usuario",
       allowClear: true,
		maximumSelectionSize: 1,
        formatSelectionTooBig: function (limit) {
            return 'Maximo un Usuario';
        }
		});			
	});
$('.dpd1').datepicker({
    format: 'yyyy-mm-dd',
	orientation: "top auto"
})
$('.dpd2').datepicker({
    format: 'yyyy-mm-dd',
	orientation: "top auto"
})
function eli_evaluaciones(id){
		 var num=id;
	$.confirm({
	title:"Confirmacion de Eliminación",	
    text: "Seguro desea eliminar estas evaluaciones?",
    confirm: function(button) {
     window.location = "../controlador/contro_eli_evaluacion.php?id_eva=" + num;
    },
    cancel: function(button) {
    },
	confirmButton: "Si, estoy seguro",
        cancelButton: "Cancelar"
	});
	};
    </script>
<script type="text/javascript">
function addYear() {
   var currentYear = new Date().getFullYear();  
   
    for (var i = 1; i <= 5; i++ ) {
        $("#ano_eval").append(
            
            $("<option></option>")
                .attr("value", currentYear)
                .text(currentYear)
            
        );
        currentYear++;
    }
}

addYear(); 
</script>
<script>
  $(document).ready(function(){
  $("#id_trab_select").change(function(){
    $.ajax({
      url:"../controlador/contro_verificar_anio.php",
      type: "POST",
      data:"valor1="+$("#id_trab_select").val()+"&valor2="+$("#ano_eval").val(),
      success: function(opciones){
        $('#info').html(opciones);
      }
    })
  });
});
</script>
<script>
  $(document).ready(function(){
  $("#id_par_select").change(function(){
    $.ajax({
      url:"../controlador/contro_verificar_eva_par.php",
      type: "POST",
      data:"valor1="+$("#id_par_select").val()+"&valor2="+$("#ano_eval").val(),
      success: function(opciones){
        $('#info_usu').html(opciones);
      }
    })
  });
});
</script>
<script>
  $(document).ready(function(){
  $("#id_usuario_select").change(function(){
    $.ajax({
      url:"../controlador/contro_verificar_eva_usu.php",
      type: "POST",
      data:"valor1="+$("#id_usuario_select").val()+"&valor2="+$("#ano_eval").val(),
      success: function(opciones){
        $('#info_par').html(opciones);
      }
    })
  });
});
</script>
<script>
  $(document).ready(function(){
  $("#id_trab_select").change(function(){
    $.ajax({
      url:"../controlador/contro_verificar_cargo.php",
      type: "POST",
      data:"valor1="+$("#id_trab_select").val(),
      success: function(opciones){
        $('#id_par_select').html(opciones);
      }
    })
  });
});
</script>
<script>
  $(document).ready(function(){
  $("#id_par_select").change(function(){
    $.ajax({
      url:"../controlador/contro_verificar_usuario_general.php",
      type: "POST",
	   data:"valor1="+$("#id_trab_select").val()+"&valor2="+$("#id_par_select").val()+"&valor3="+$("#id_jefe").val(),
      success: function(opciones){
        $('#id_usuario_select').html(opciones);
		//$("#capa").html(msg + xhr.status + " " + xhr.statusText);
      }
    })
  });
});
</script>
<script>
  $(document).ready(function(){
  $("#id_trab_select").change(function(){
    $.ajax({
      url:"../controlador/contro_verificar_datos.php",
      type: "POST",
	  dataType: "json",
      data:"valor1="+$("#id_trab_select").val(),
      success: function(opciones){
         $('#id_cargo_trab').val(opciones["id_cargo"]);
		$('#nombre_cargo_trab').val(opciones["nombre_cargo"]);
		$('#id_nivel_trab').val(opciones["id_nivel"]);
		 $('#nombre_nivel_trab').val(opciones["nombre_nivel"]);
        $('#correo_trab').val(opciones["correo_usuario"]); 	
		//$(".the-return").html("Favorite beverage: " + opciones["id_cargo"] + "<br />Favorite restaurant: " + opciones["id_cargo"] + "<br />Gender: " + opciones["id_cargo"] + "<br />JSON: " + opciones["id_cargo"]);
      }
    })
  });
});
</script>
<script>
  $(document).ready(function(){
  $("#id_par_select").change(function(){
    $.ajax({
      url:"../controlador/contro_verificar_datos.php",
      type: "POST",
	  dataType: "json",
      data:"valor1="+$("#id_par_select").val(),
      success: function(opciones){
         $('#id_cargo_par').val(opciones["id_cargo"]);
		 $('#nombre_cargo_par').val(opciones["nombre_cargo"]);
         $('#id_nivel_par').val(opciones["id_nivel"]);
		 $('#nombre_nivel_par').val(opciones["nombre_nivel"]);		 
         $('#correo_par').val(opciones["correo_usuario"]);  
		//$(".the-return").html("Favorite beverage: " + opciones["id_cargo"] + "<br />Favorite restaurant: " + opciones["id_cargo"] + "<br />Gender: " + opciones["id_cargo"] + "<br />JSON: " + opciones["id_cargo"]);
      }
    })
  });
});
</script>
<script>
  $(document).ready(function(){
  $("#id_usuario_select").change(function(){
    $.ajax({
      url:"../controlador/contro_verificar_datos.php",
      type: "POST",
	  dataType: "json",
      data:"valor1="+$("#id_usuario_select").val(),
      success: function(opciones){
         $('#id_cargo_usuario').val(opciones["id_cargo"]);
		 $('#nombre_cargo_usuario').val(opciones["nombre_cargo"]);
         $('#id_nivel_usuario').val(opciones["id_nivel"]);
		 $('#nombre_nivel_usuario').val(opciones["nombre_nivel"]);	
         $('#correo_usuario').val(opciones["correo_usuario"]);	 
		//$(".the-return").html("Favorite beverage: " + opciones["id_cargo"] + "<br />Favorite restaurant: " + opciones["id_cargo"] + "<br />Gender: " + opciones["id_cargo"] + "<br />JSON: " + opciones["id_cargo"]);
      }
    })
  });
});
</script>
<script type="text/javascript">
            $(document).ready(function() {
                $("#boton").click(function(event) {;
					var final = ''
					$('.ads_Checkbox:checked').each(function(){        
						var values = $(this).val()+',';
						final += values;
					});
							
                    $("#capa").load("../vista/ver_correo_jefe.php",{valor1: final}, function(response, status, xhr) {
                          if (status == "error") {
                            var msg = "Error!, algo ha sucedido: ";
                            $("#capa").html(msg + xhr.status + " " + xhr.statusText);
                          }
                        });
                });
            });            
</script>
</body>
</html>
<?php
	 $Listado="";$Evento="";  
	 $_SESSION["suceso"] = $Listado;   
	 $_SESSION["evento"] = $Evento;
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