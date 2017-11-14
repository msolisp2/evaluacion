<?php
session_start();
	if($_SESSION["tipo"]=="3") 
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

    <title>Trabajador | Editar Perfil</title>

    <!--Core CSS -->
    <link href="../estilos/bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="../estilos/css/bootstrap-reset.css" rel="stylesheet">
    <link href="../estilos/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="../estilos/css/style.css" rel="stylesheet">
    <link href="../estilos/css/style-responsive.css" rel="stylesheet" />
    <!-- NotifIt -->
    <link href='../estilos/css/notifIt.css' rel='stylesheet'>
    
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

    <a href="../vista/trabajador.php" class="logo">
        <img src="../estilos/images/trabajador.png" alt="" height="50" width="200">
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
                <li><a href="../vista/editar_info_trabajador.php"><i class=" fa fa-suitcase"></i> Perfil</a></li>
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
                <a href="../vista/trabajador.php">
                    <i class="fa fa-dashboard"></i>
                    <span>Inicio</span>
                </a>
            </li>
			<li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-check-square-o"></i>
                    <span>Concertación de Objetivos</span>
                </a>
                <ul class="sub">
                    <li><a href="../vista/listado_obj_trab.php"><i class="fa fa-angle-double-right"></i> Pendientes</a></li>
					<li><a href="../vista/historial_obj_trab.php"><i class="fa fa-angle-double-right"></i> Historial</a></li>
                </ul>
            </li>				
			<li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-sitemap"></i>
                    <span>Evaluación Competencias</span>
                </a>
                <ul class="sub">
                    <li><a href="../vista/listado_eval_trab.php"><i class="fa fa-angle-double-right"></i> Pendientes</a></li>
					<li><a href="javascript:;">
                    <i class="fa fa-angle-double-right"></i>
                    <span>Historial</span>
					</a>
					<ul class="sub">
                    <li><a href="../vista/historial_eval_trab.php">&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-right"></i> Realizadas</a></li>
					<li><a href="../vista/historial_eval_trab_recib.php">&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-right"></i> Recibidas</a></li>
					</ul>
				</li>
				</ul>
			</li>
			<li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-bookmark"></i>
                    <span>Plan de Mejora Laboral</span>
                </a>
                <ul class="sub">
                    <li><a href="../vista/listado_mejora_trab.php"><i class="fa fa-angle-double-right"></i> Pendientes</a></li>			
					<li><a href="../vista/historial_mejora_trab.php"><i class="fa fa-angle-double-right"></i> Historial</a></li>
                </ul>
            </li>			
            <li>
                <a href="../vista/listado_recurso_trab.php">
                    <i class="fa fa-archive"></i>
                    <span>Recursos </span>
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

      <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        <strong>Editar Información de Perfil </strong>
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>
                    </header>
                    <div class="panel-body">
                      <div class="form">
                       <?php $id_usuario=$_SESSION["codigo"];	
						include_once("../controlador/contro_clase_usuario.php");
						$usu=new clase_usuario();
						$usu->valores_clase_usuario($id_usuario);	
						?>
                                <form class="cmxform form-horizontal" id="act_usuario" method="post" data-parsley-validate>
                                   <input id="codigo_act" name="codigo_act" type="hidden" value="<?php echo $usu->codigo; ?>" readonly/>
                                   <input id="correo_act_v" name="correo_act_v" type="hidden" value="<?php echo $usu->correo; ?>" readonly/>
                                    <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-3">Codigo/Identificación</label>
                                        <div class="col-lg-3">
                                            <input class=" form-control" id="codigo_act_v" name="codigo_act_v" type="text" value="<?php echo $usu->codigo; ?>" readonly/>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="firstname" class="control-label col-lg-3">Nombres</label>
                                        <div class="col-lg-4">
                                            <input class=" form-control" id="nombres_act" name="nombres_act" type="text" value="<?php echo $usu->nombre_usuario; ?>" data-required="true">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="lastname" class="control-label col-lg-3">Apellidos</label>
                                        <div class="col-lg-4">
                                            <input class=" form-control" id="apellidos_act" name="apellidos_act" type="text" value="<?php echo $usu->apellido_usuario; ?>" data-required="true">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="password" class="control-label col-lg-3">Contraseña</label>
                                        <div class="col-lg-3">
                                            <input class="form-control " id="pass_act" name="pass_act" type="password" data-required="true" />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="confirm_password" class="control-label col-lg-3">Confirmar Contraseña</label>
                                        <div class="col-lg-3">
                                            <input class="form-control " id="re_pass_act" name="re_pass_act" data-equalto="#pass_act"  type="password" data-required="true" />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="email" class="control-label col-lg-3">Correo</label>
                                        <div class="col-lg-5">
                                            <input class="form-control " id="correo_act" name="correo_act" type="email" value="<?php echo $usu->correo; ?>" data-required="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-3 col-lg-6">
                                            <button class="btn btn-primary" type="submit"><i class="fa fa-refresh"></i> Actualizar</button>
                                            <button class="btn btn-default" type="button">Cancelar</button>
                                        </div>
                                    </div>
                                </form>
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
                    <h4>E-Soluciones</h4>
                    <p>
                        Grupo de Investigación
                    </p>
                </div>
                <div class="side-mini-graph">
                    <div class="target-sell">
                    </div>
                     <div class="thumb">
                    <a href="http://ingenieriadesistemas.unicartagena.edu.co/index.php/inicio/investigacion/item/226-e-soluciones" target="_blank"><img src="../estilos/images/LogoSistemas.png" alt="" width="45" height="45"></a>
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
                    <h4>Martin Monroy Rios</h4>
                    <p>
                        Universidad de Cartagena
                    </p>
                </div>
                <div class="user-status text-danger">
                    <i class="fa fa-comments-o"></i>
                </div>
            </div>
            <div class="prog-row">
                <div class="user-thumb">
                    <img src="../estilos/images/chat-avatar2.jpg" alt="">
                </div>
                <div class="user-details">
                    <h4>Julio Deavila Pertuz</h4>
                    <p>
                        Investigador
                    </p>
                </div>
                <div class="user-status text-success">
                    <i class="fa fa-comments-o"></i>
                </div>
            </div>
            <div class="prog-row">
                <div class="user-thumb">
                    <img src="../estilos/images/avatar1.jpg" alt="">
                </div>
                <div class="user-details">
                    <h4>Marcelo Solis Poveda</h4>
                    <p>
                        Investigador
                    </p>
                </div>
                <div class="user-status text-warning">
                    <i class="fa fa-comments-o"></i>
                </div>
            </div>
            <p class="text-center">
                <a href="http://www.unicartagena.edu.co/" class="view-btn" target="_blank">Universidad de Cartagena 2013. Derechos Reservados.</a>
            Telefax: (+57-5) 6644080 ucsistemas@unicartagena.edu.co
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
<script src="../estilos/js/jquery.js"></script>
<script src="../estilos/bs3/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="../estilos/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="../estilos/js/jquery.scrollTo.min.js"></script>
<script src="../estilos/js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
<script src="../estilos/js/jquery.nicescroll.js"></script>
<!-- Parsley-->
<script src="../estilos/js/parsley.js"></script>
<!-- NotifIt -->
<script type="text/javascript" src="../estilos/js/notifIt.js"></script>
<!--common script init for all pages-->
<script src="../estilos/js/scripts.js"></script>
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
        $("#act_usuario").on('submit', function(e){
            e.preventDefault();
            var form = $(this);
            form.parsley().validate();
            if (form.parsley().isValid()){
			   $.ajax({		
		type : 'POST',
		url  : '../controlador/contro_act_usuario.php',
		data:  "cod_usu="+$("#codigo_act").val()+"&nombre_usu="+$("#nombres_act").val()+"&apellido_usu="+$("#apellidos_act").val()+"&clave_usu="+$("#pass_act").val()+"&re_clave_usu="+$("#re_pass_act").val()+"&correo_usu="+$("#correo_act").val(),
		success :  function(data)
				   {	
				window.location='../vista/editar_info_trabajador.php'							
				   },
			  error: function(){
				alert('error!');
			  }
		});
		return false;	   
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