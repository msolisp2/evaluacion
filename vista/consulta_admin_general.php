<?php
session_start();
	if($_SESSION["tipo"]=="1") 
	{
?>
<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="../estilos/images/favicon.ico">

    <title>Administrador | Consulta Lider</title>
	
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
</head>

<body>

<section id="container" >
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="../vista/admin.php" class="logo">
        <img src="../estilos/images/admin.png" alt="" height="50" width="200">
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
                <li><a href="../vista/editar_info_admin.php"><i class=" fa fa-suitcase"></i> Perfil</a></li>
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
                <a href="../vista/admin.php">
                    <i class="fa fa-dashboard"></i>
                    <span>Inicio</span>
                </a>
            </li>
		<!-- 	<li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-sitemap"></i>
                    <span>Actualización</span>
                </a>
                <ul class="sub">
				    <li><a href="../vista/registro_departamento.php"><i class="fa fa-angle-double-right"></i> Departamento</a></li>
                    <li><a href="../vista/registro_municipio.php"><i class="fa fa-angle-double-right"></i> Cargo</a></li>
                    <li><a href="../vista/registro_localidad.php"><i class="fa fa-angle-double-right"></i> Nivel</a></li>
                </ul>
            </li> -->
            <li class="sub-menu">
                <a href="javascript:;" class="active">
                    <i class="fa fa-bars"></i>
                    <span>Consultas</span>
                </a>
                <ul class="sub">
                    <li class="active"><a href="../vista/consulta_admin_general.php"><i class="fa fa-angle-double-right"></i> General</a></li>				
                    <li><a href="../vista/consulta_admin.php"><i class="fa fa-angle-double-right"></i> Departamentos</a></li>	
                    <li><a href="../vista/consulta_admin_resultados.php"><i class="fa fa-angle-double-right"></i> Resultados</a></li>					
                </ul>
            </li>
			<li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-archive"></i>
                    <span>Recursos</span>
                </a>
                <ul class="sub">
				     <li><a href="../vista/listado_recurso_admin.php"><i class="fa fa-angle-double-right"></i> Listado</a></li>
					 <li><a href="../vista/historial_recurso_admin.php"><i class="fa fa-angle-double-right"></i> Historial</a></li>
                </ul>
            </li>			
            <li>
                <a href="../vista/configuracion.php">
                    <i class="fa fa-cog"></i>
                    <span>Configuración</span>
                </a>
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
</aside>
<!--sidebar end-->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->
       <!--LIDERES-->
       <div class="row">
       		            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        <font style="text-transform:capitalize; "><strong>Consulta</strong> Años/Departamentos</font>
						<span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-up"></a>
                                <a href="javascript:;" class="fa fa-times"></a>
                            </span>
                    </header>
                    <div class="panel-body">
                    <form class="form-horizontal" role="form" action="../modelo/ver_reporte_pdf.php" target="_blank">
                     <div class="row">                     
                            <div class="col-md-14 form-group">
                            <label class="col-lg-3 col-sm-3 control-label">Departamentos</label>
                            <div class="col-lg-4">
                                    <?php
									include_once("../controlador/contro_clase_evaluacion.php");
									$lis_dep=new clase_evaluacion();
									$lis_dep->valores_clase_select_dependencia();
									?>      									
                            </div>
							<div class="col-sm-1">
									<div class="form-group">
										<select class="form-control input-sm" id="ano_eval" name="ano_eval" data-required="true"></select>
									</div>
                            </div>
							<div class="col-lg-2">
								<input type="checkbox" id="checkbox" >Todos
							</div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-5 col-lg-12">
                                    <a name="boton" id="boton" class="btn btn-primary"><i class="fa fa-eye"></i> Ver</a> 																	
                                    <button class="btn btn-default" id="cancel" type="button"><i class="fa fa-refresh"></i></button>
									<!--
									<a name="generar" id="generar" class="btn btn-success"><i class="fa fa-download"> </i></a>
									<a name="estadistica" id="estadistica" class="btn btn-warning"><i class="fa fa-bar-chart-o"> </i></a>
									-->
                                </div>
                            </div>
                       </div> 
                       </form> 
                       <div id="capa">Elija un Departamento</div>                          
                    </div> 
                    
                </section>
            </div>
       
        </div>
		
        <!-- page end-->
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
var evento="<?php echo $_SESSION["evento"] ?>";	
if(evento){	
notif({
			msg: "<?php if (is_array($_SESSION["suceso"]) || is_object($_SESSION["suceso"])){foreach ($_SESSION["suceso"] as $msg) { echo  $msg; }}?>",
 		 	type: "<?php echo $_SESSION["evento"] ?>"
			});			
}				
</script>
<script type="text/javascript">
  $(document).ready(function() {
        $("#id_depen_consulta").select2({
        placeholder: "Seleccione los departamentos"
		});
		$("#checkbox").click(function(){
			if($("#checkbox").is(':checked') ){
				$("#id_depen_consulta > option").prop("selected","selected");
				$("#id_depen_consulta").trigger("change");
			}else{
				$("#id_depen_consulta > option").removeAttr("selected");
				 $("#id_depen_consulta").trigger("change");
			 }
		});
		$("#cancel").click(function() {
			$("#id_depen_consulta").select2("val", "");
	  });   
	});
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
<script type="text/javascript">
            $(document).ready(function() {
                $("#boton").click(function(event) {;
					var uno = $('#id_depen_consulta').val();
					var dos = $('#ano_eval').val();
					total = uno.filter(function(e){return e});					
                    $("#capa").load("../vista/ver_consulta_admin_general.php",{valor1: total, valor2: dos}, function(response, status, xhr) {
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