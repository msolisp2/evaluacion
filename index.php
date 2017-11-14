<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="estilos/images/favicon.ico">

    <title>Gestión del Desempeño Basado en Competencias Laborales para Empleados Públicos no Docentes y Trabajadores Oficiales de la Universidad de Cartagena | Iniciar Sesión</title>
    <!--Core CSS -->
    <link href="estilos/bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="estilos/css/bootstrap-reset.css" rel="stylesheet">
    <link href="estilos/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Multi Select -->
    <link rel="stylesheet" type="text/css" href="estilos/js/select2/select2.css" />
    <!-- Custom styles for this template -->
    <link href="estilos/css/style.css" rel="stylesheet">
    <link href="estilos/css/style-responsive.css" rel="stylesheet" />
        <!-- NotifIt -->
    <link href='estilos/css/notifIt.css' rel='stylesheet'>
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

  <body class="login-body">

    <div class="container">

      <form class="form-signin" name="a" id="a" action="controlador/valida.php" method="post" data-validate="parsley">
        <h2 class="form-signin-heading-a text-justify">Gestión del Desempeño Basado en Competencias Laborales para Empleados Públicos no Docentes y Trabajadores Oficiales de la Universidad de Cartagena</h2>
		 <h2 class="form-signin-heading">Iniciar Sesión</h2>
        <div class="login-wrap">
            <div class="user-login-info">
                <select class="form-control" style="width: 324px" id="tipo_usuario" name="tipo_usuario" data-required="true">
                                            <option value="">Seleccione un Tipo</option>
											<option value="1">Administrador</option>
                                            <option value="3">Empleado</option>
                                            <option value="2">Jefe</option>											
                </select>
				<br>					
				<input type="text" name="codigo" class="form-control" placeholder="ID Usuario" data-required="true">
                <br>
                <input type="password" name="clave" class="form-control" placeholder="Contraseña" data-required="true"/>
            </div>
            <label class="checkbox">
                <!--<input type="checkbox" value="remember-me" required> Recordarme-->
                <span class="pull-right">
				    <a data-toggle="modal" href="#myModal"> ¿Olvidaste tu contraseña?</a>
                </span>
            </label>
            <button class="btn btn-lg btn-login btn-block" type="submit">Ingresar</button>  
            <br>                               
                        </div>                       
     </div></form>
 <!--           <div class="registration">
                Don't have an account yet?
                <a class="" href="registration.html">
                    Create an account
                </a>
            </div>-->

        </div>

          <!-- Modal Contraseña -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Olvido su Contraseña?</h4>
                      </div>
                     <form name="correo" id="correo" action="controlador/contro_recordar_contraseña.php" method="post" data-validate="parsley">
                      <div class="modal-body">
                          <p>Ingrese su correo electrónico para reiniciar su contraseña.</p>
                          <input type="email" name="email" placeholder="Correo registrado" autocomplete="off" class="form-control placeholder-no-fix" data-required="true">
                      </div>
                      <div class="modal-footer">
                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
                          <button class="btn btn-success" type="submit">Enviar</button>
                      </div>
                      </form>
                  </div>
              </div>
          </div>
          <!-- modal -->
          
    </div>



    <!-- Placed js at the end of the document so the pages load faster -->

    <!--Core js-->
    <script src="estilos/js/jquery.js"></script>
    <script src="estilos/bs3/js/bootstrap.min.js"></script>
    <!--Parsley-->
	<script src="estilos/js/parsley.js"></script>  
    <!--Backstretch-->
    <script src="estilos/js/jquery.backstretch.min.js"></script>
    <!-- NotifIt -->
	<script type="text/javascript" src="estilos/js/notifIt.js"></script>
    <!-- Multi Select --> 
	<script src="estilos/js/select2/select2.js"></script>
    <script src="estilos/js/select-init.js"></script>
    <!--common script init for all pages-->
<script src="estilos/js/scripts.js"></script>
<script>
    $.backstretch([
      "estilos/images/blur-background01.jpg",
      "estilos/images/blur-background02.jpg",
      "estilos/images/blur-background03.jpg"
      ], {
        fade: 750,
        duration: 4000
    });
</script>  
</body>
</html>