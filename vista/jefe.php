<?php
session_start();
	if($_SESSION["tipo"]=="2") 
	{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="../estilos/images/favicon.ico">

    <title>Jefe | Inicio</title>

   <!--Core CSS -->
    <link href="../estilos/bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="../estilos/css/bootstrap-reset.css" rel="stylesheet">
    <link href="../estilos/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!--dynamic table-->
    <link href="../estilos/js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
    <link href="../estilos/js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
    <link rel="stylesheet" href="../estilos/js/data-tables/DT_bootstrap.css" />
    
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
                <a class="active" href="../vista/jefe.php">
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
                <a href="../vista/generar_evaluaciones.php">
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
				     <li><a href="../vista/listado_eval_trab_jefe.php"><i class="fa fa-angle-double-right"></i> Pendientes</a></li>
                    <li><a href="../vista/historial_eval_trab_jefe.php"><i class="fa fa-angle-double-right"></i> Historial</a></li>
                </ul>
            </li>
			<li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-archive"></i>
                    <span>Recursos</span>
                </a>
                <ul class="sub">
				     <li><a href="../vista/listado_recurso_jefe.php"><i class="fa fa-angle-double-right"></i>  Pendientes</a></li>
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
</aside>
<!--sidebar end-->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        <font style="text-transform:capitalize; "><strong>Conograma</strong></font>
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>
                    </header>	
                    <div class="panel-body">
						<div class="adv-table">
					   <?php
						     		include_once("../controlador/contro_clase_configuracion.php");
									$config=new clase_usuario();
									$config->valores_configuracion_consulta();
						?>
						</br>
						<h5>Descargue aquí el instructivo como <a href="../archivos/MANUAL _EMPLEADO.pdf" download="Manual_Empleado">EMPLEADO</a> o <a href="../archivos/MANUAL_JEFE.pdf" download="Manual_Jefe">JEFE</a></h5>
						<h5>Para realizar un ticket de soporte de ayuda pulse aquí: <a href="http://sistemas.unicartagena.edu.co/soporte/osticket/" target="popup">SOPORTE DE AYUDA</a></h5>
					   </div>
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
<script>
$(document).ready(function() {  
$("#id_departamento").select2({
		maximumSelectionSize: 1,
        formatSelectionTooBig: function (limit) {
            return 'Maximo un Departamento';
        }
		});
	});
	</script>
<script>
  $(document).ready(function(){
    $('[id="id_departamento"]').change(function(){
    $.ajax({
      url:"../controlador/contro_clase_municipio_lista.php",
      type: "POST",
      data:"id_municipio="+$('[id="id_departamento"]').val(),
      success: function(opciones){
        $('[id="id_muni"]').html(opciones);
      }
    })
  });
});
$(document).ready(function() {
    $("#id_muni").select2({
        placeholder: "Seleccione un municipio",
        allowClear: true
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