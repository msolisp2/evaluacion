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

    <title>Administrador | Listado Recursos</title>

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
	<!--icheck-->
    <link href="../estilos/js/iCheck/skins/minimal/minimal.css" rel="stylesheet">
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
.modal.modal-wide .modal-dialog {
  width: 70%;
}
.modal-wide .modal-body {
  overflow-y: auto;
}
</style>
</head>

<body>

<section id="container" >
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">

    <a href="../vista/jefe.php" class="logo">
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
                <a href="javascript:;">
                    <i class="fa fa-bars"></i>
                    <span>Consultas</span>
                </a>
                <ul class="sub">
                    <li><a href="../vista/consulta_admin_general.php"><i class="fa fa-angle-double-right"></i> General</a></li>					
                    <li><a href="../vista/consulta_admin.php"><i class="fa fa-angle-double-right"></i> Departamentos</a></li>
                    <li><a href="../vista/consulta_admin_resultados.php"><i class="fa fa-angle-double-right"></i> Resultados</a></li>					
                </ul>
            </li>
			<li class="sub-menu">
                <a href="javascript:;" class="active">
                    <i class="fa fa-archive"></i>
                    <span>Recursos</span>
                </a>
                <ul class="sub">
				     <li class="active"><a href="../vista/listado_recurso_admin.php"><i class="fa fa-angle-double-right"></i> Listado</a></li>
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
</aside><!--sidebar end-->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->

       <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        <font style="text-transform:capitalize; "><strong>Listado</strong> Recursos</font>
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>
                    </header>
                    <div class="panel-body">
                    <div class="adv-table">
					   <?php
						     		$estado="Pendiente";
									$dia=11;
									include_once("../controlador/contro_clase_evaluacion.php");
									$lis_rec=new clase_evaluacion();
									$lis_rec->valores_clase_listado_recursos_admin($estado,$dia);
						?>
					   </div>
					   <br><br><br><br>
				   <hr><br>
				   <div class="adv-table">
							<div id="capa"></div>
						 </div>
                   </div>
                </section>
            </div>
        </div>
        <!-- page end-->
        <!-- Modal Actualizar -->
       <div id="recurso_info" class="modal modal-wide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Desarrollo del Recurso</h4>
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
<!--dynamic table initialization -->
<script src="../estilos/js/dynamic_table_init.js"></script>
<!-- Multi Select --> 
<script src="../estilos/js/select2/select2.js"></script>
<script src="../estilos/js/select-init.js"></script>
<!--jQuery Flot Chart-->
<script type="text/javascript" src="../estilos/js/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="../estilos/js/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>	
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
$("a[data-toggle=modal]").click(function() 
{   
    var essay_id = $(this).attr('id');

    $.ajax({
        cache: false,
        type: 'POST',
        url: '../vista/ver_total_evaluacion_recurso_admin.php',
        data: 'cod_eva='+essay_id,
        success: function(data) 
        {
            $('#recurso_info').show();
            $('#modalContent').show().html(data);
        }
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