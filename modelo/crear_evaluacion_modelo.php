<?php
include_once("../modelo/conexion.php");
class crear_evaluacion_modelo extends configuracion{
	private $conexion;		
	public function crear_evaluacion($id_trab,$id_cargo_trab,$id_nivel_trab,$id_par,$id_cargo_par,$id_usuario,$id_cargo_usuario,$ano_eval,$fecha_inicio,$fecha_fin,$id_jefe,$id_cargo_jefe,$id_depe,$cod_eval,$correo_par,$correo_usuario,$correo_trab,$total){	//Crea un evaluacion
	$this->conexion = parent::conectar();
	// Verificar Existencia de Codigo
  $ConsultaSQL_v = $this->conexion->prepare("
  SELECT
	*
FROM
	trabajador_evaluacion
LEFT JOIN gestion_desempeno ON trabajador_evaluacion.cod_evaluacion = gestion_desempeno.cod_evaluacion
WHERE
	ano_evaluacion =: ano
AND cod_trabajador =: id");
  $ConsultaSQL_v ->bindParam(':id', $id_trab, PDO::PARAM_INT);
  $ConsultaSQL_v ->bindParam(':ano', $ano_eval);
  $ConsultaSQL_v ->execute();
  $num_rows = $ConsultaSQL_v->fetchColumn();
    if($num_rows > 0){ 
	$errmsg_arr[] = "<img src='../estilos/images/error.png'>".' Evaluación Pendiente';
	$errflag = true;
	}
	if(empty($ano_eval)) {
	$errmsg_arr[] = "<img src='../estilos/images/error.png'>".' Debes seleccionar un año ';
	$errflag = true;
	}
	if($total>=1) {
	$errmsg_arr[] = "<img src='../estilos/images/error.png'>".' Existen errores de validaciones en el formulario inicial.';
	$errflag = true;
	}
	if($errflag) {
	$_SESSION['suceso'] = $errmsg_arr;
	$_SESSION["evento"] = "error";
	session_write_close();
	//header("location: ../vista/generar_evaluaciones.php");
	echo '<script language="javascript">window.location=" ../vista/generar_evaluaciones.php"</script>';
	exit();
	}
	else{	
  	$estado="Sin Aprobar";
	date_default_timezone_set('America/Bogota');
	$fecha=date("Y-m-d");
	  $estado_eva_g="Pendiente";
	  $ConsultaSQL_G = $this->conexion->prepare("INSERT INTO gestion_desempeno VALUES('',:cod,:ano,:trabajador,:a,:b,:c,:d,:e,'',:f,:g)");
	  $ConsultaSQL_G ->bindParam(':cod', $cod_eval);
	  $ConsultaSQL_G ->bindParam(':ano', $ano_eval); 
	  $ConsultaSQL_G ->bindParam(':trabajador', $id_trab);  
	  $ConsultaSQL_G ->bindParam(':a', $id_cargo_trab);
	  $ConsultaSQL_G ->bindParam(':b', $id_depe);
	  $ConsultaSQL_G ->bindParam(':c', $id_jefe);
	  $ConsultaSQL_G ->bindParam(':d', $id_cargo_jefe);  
	  $ConsultaSQL_G ->bindParam(':e', $id_nivel_trab);
	  $ConsultaSQL_G ->bindParam(':f', $estado_eva_g);
	  $ConsultaSQL_G ->bindParam(':g', $fecha);
	  $ConsultaSQL_G ->execute();	
	$fecha_ap=NULL;	
  $ConsultaSQL = $this->conexion->prepare("
	  INSERT INTO trabajador_objetivos (
		cod_evaluacion,
		fecha_ini_eva_objetivos,
		fecha_fin_eva_objetivos,
		estado_eva_objetivos,
		fecha_eva_objetivos,
		fecha_eva_objetivos_conc,
		fecha_inicio_evaluacion_objetivos,
		fecha_fin_evaluacion_objetivos,
		observacion_evaluacion_objetivos,
		estado_eva_primer_objetivos,
		estado_eva_segundo_objetivos,
		estado_eva_tercer_objetivos
	) SELECT
		:cod,
		:f,
		:g,
		:h,
		:i,
		:j,
	    fecha_inicio_configuracion,
		fecha_fin_configuracion,
		'',
		:h,
		:h,
		:h
	FROM
		configuracion
	WHERE
		id_configuracion = 1");
  $ConsultaSQL ->bindParam(':cod', $cod_eval);
  $ConsultaSQL ->bindParam(':f', $fecha_inicio);
  $ConsultaSQL ->bindParam(':g', $fecha_fin);
  $ConsultaSQL ->bindParam(':h', $estado);
  $ConsultaSQL ->bindParam(':i', $fecha);
  $ConsultaSQL ->bindParam(':j', $fecha_ap, PDO::PARAM_NULL);
  $ConsultaSQL ->execute();
  $a=0; $b=1;
  for ($x = 0; $x <= 2; $x++) {
  $ConsultaSQL_F = $this->conexion->prepare("INSERT INTO objetivos_concertados_fechas (
	cod_evaluacion,
	num_seguimiento,
	fecha_ini_objetivo_concertados,
	fecha_fin_objetivo_concertados
	) SELECT
		:cod,
		:a,
		fecha_inicio_configuracion,
		fecha_fin_configuracion
	FROM
	configuracion WHERE id_configuracion=:b");
	$a++;
	$b++;
  $ConsultaSQL_F ->bindParam(':cod', $cod_eval);
  $ConsultaSQL_F ->bindParam(':a', $a);
  $ConsultaSQL_F ->bindParam(':b', $b);
  $ConsultaSQL_F ->execute();
  }
  $estado_eva="Pendiente";
  $ConsultaSQL_E = $this->conexion->prepare("INSERT INTO trabajador_evaluacion VALUES('',:cod,:b,:c,:d,'')");
  $ConsultaSQL_E ->bindParam(':cod', $cod_eval);
  $ConsultaSQL_E ->bindParam(':b', $id_nivel_trab);
  $ConsultaSQL_E ->bindParam(':c', $estado_eva);
  $ConsultaSQL_E ->bindParam(':d', $fecha);
  $ConsultaSQL_E ->execute();
  $ConsultaSQL_C = $this->conexion->prepare("INSERT INTO trabajador_evaluacion_cualitativa VALUES('',:cod,'',:c,:d)");
  $ConsultaSQL_C ->bindParam(':cod', $cod_eval);
  $ConsultaSQL_C ->bindParam(':c', $estado_eva);
  $ConsultaSQL_C ->bindParam(':d', $fecha);
  $ConsultaSQL_C ->execute();
  $ConsultaSQL_Fechas = $this->conexion->prepare("SELECT * FROM configuracion WHERE id_configuracion=5");
  $ConsultaSQL_Fechas ->execute();
  while ($row = $ConsultaSQL_Fechas ->fetch(PDO::FETCH_ASSOC)) {
	$inicio=$row["fecha_inicio_configuracion"];
	$fin=$row["fecha_fin_configuracion"];
	}
  //Jefe
  $ConsultaSQL_A = $this->conexion->prepare("INSERT INTO evaluacion VALUES('',1,:cod,:a,:b,'','','','','','','','','','','','','','','','','','','','','',:c,:d,:e,:f)");
  $ConsultaSQL_A ->bindParam(':cod', $cod_eval);
  $ConsultaSQL_A ->bindParam(':a', $id_trab);
  $ConsultaSQL_A ->bindParam(':b', $id_cargo_trab);
  $ConsultaSQL_A ->bindParam(':c', $estado_eva);
  $ConsultaSQL_A ->bindParam(':d', $fecha);
  $ConsultaSQL_A ->bindParam(':e', $inicio);
  $ConsultaSQL_A ->bindParam(':f', $fin);
  $ConsultaSQL_A ->execute();
  //Jefe
  $ConsultaSQL_J = $this->conexion->prepare("INSERT INTO evaluacion VALUES('',2,:cod,:a,:b,'','','','','','','','','','','','','','','','','','','','','',:c,:d,:e,:f)");
  $ConsultaSQL_J ->bindParam(':cod', $cod_eval);
  $ConsultaSQL_J ->bindParam(':a', $id_jefe);
  $ConsultaSQL_J ->bindParam(':b', $id_cargo_jefe);
  $ConsultaSQL_J ->bindParam(':c', $estado_eva);
  $ConsultaSQL_J ->bindParam(':d', $fecha);
  $ConsultaSQL_J ->bindParam(':e', $inicio);
  $ConsultaSQL_J ->bindParam(':f', $fin);  
  $ConsultaSQL_J ->execute();
  //Par
  $ConsultaSQL_P = $this->conexion->prepare("INSERT INTO evaluacion VALUES('',3,:cod,:a,:b,'','','','','','','','','','','','','','','','','','','','','',:c,:d,:e,:f)");
  $ConsultaSQL_P ->bindParam(':cod', $cod_eval);
  $ConsultaSQL_P ->bindParam(':a', $id_par);
  $ConsultaSQL_P ->bindParam(':b', $id_cargo_par);
  $ConsultaSQL_P ->bindParam(':c', $estado_eva);
  $ConsultaSQL_P ->bindParam(':d', $fecha);
  $ConsultaSQL_P ->bindParam(':e', $inicio);
  $ConsultaSQL_P ->bindParam(':f', $fin);  
  $ConsultaSQL_P ->execute();
   //Usuario
  $ConsultaSQL_U = $this->conexion->prepare("INSERT INTO evaluacion VALUES('',4,:cod,:a,:b,'','','','','','','','','','','','','','','','','','','','','',:c,:d,:e,:f)");
  $ConsultaSQL_U ->bindParam(':cod', $cod_eval);
  $ConsultaSQL_U ->bindParam(':a', $id_usuario);
  $ConsultaSQL_U ->bindParam(':b', $id_cargo_usuario);
  $ConsultaSQL_U ->bindParam(':c', $estado_eva);
  $ConsultaSQL_U ->bindParam(':d', $fecha);
  $ConsultaSQL_U ->bindParam(':e', $inicio);
  $ConsultaSQL_U ->bindParam(':f', $fin);  
  $ConsultaSQL_U ->execute();

        $server_name = "localhost";
		$header = "MIME-Version: 1.0\n";
		$header .= "Content-Type: text/html; charset=iso-8859-1\n";
		$header .="From: webmaster@$server_name\nReply-To:
		webmaster@$server_name\nX-Mailer: PHP/";
		$mensaje = "<h2>Cordial Saludo</h2>
					<h1 style='color: #5e9ca0;'>Actualmente usted tiene pendiente evaluaciones en nuestro sistema.</h1>
					<ul>
					<li>Ingrese al sistema y realizar las actividades pendientes, gracias.</li>
					</ul>
					<h1 style='color: #5e9ca0;'>&nbsp;</h1>
					<h4>Universidad de Cartagena</h4>";
		mail("$correo_trab,$correo_usuario,$correo_par","$titulo","$mensaje","$header");
	$okmsg_arr[] = "<img src='../estilos/images/success.png'>".' Evaluación Creada con Éxito';
	$_SESSION["suceso"] = $okmsg_arr;
	$_SESSION["evento"] = "success";  
	//header("Location: ../vista/generar_evaluaciones.php");	
	echo '<script language="javascript">window.location=" ../vista/generar_evaluaciones.php"</script>';	
	}
}
	
	public function crear_objetivos($cod_eva,$objetivo,$evidencia,$meta,$meta_valor,$peso){	//Crea un evaluacion
		$this->conexion = parent::conectar();
		if(empty($cod_eva)) {
		$errmsg_arr[] = "<img src='../estilos/images/error.png'>".' Debes seleccionar un año ';
		$errflag = true;
		}
		if($errflag) {
		$_SESSION['suceso'] = $errmsg_arr;
		$_SESSION["evento"] = "error";
		session_write_close();
		//header("location: ../vista/listado_obj_trab.php");
		echo '<script language="javascript">window.location=" ../vista/listado_obj_trab.php"</script>';
		exit();
		}
		else{	
		date_default_timezone_set('America/Bogota');
		$fecha=date("Y-m-d");	
		 for($i=0; $i<count($objetivo); $i++){
		 $tipo_meta_valor[$i]=preg_replace('/[0-9]/','', $meta_valor[$i]);
		 $meta_valor[$i]=ereg_replace("[^0-9]", "", $meta_valor[$i]);	 
	  $ConsultaSQL_O = $this->conexion->prepare("INSERT INTO objetivos VALUES('',:cod,:a,:b,:c,:d,:e,:f,'','0',:fecha)");
	  $ConsultaSQL_O ->bindParam(':cod', $cod_eva);
	  $ConsultaSQL_O ->bindParam(':a', $objetivo[$i]);
	  $ConsultaSQL_O ->bindParam(':b', $evidencia[$i]);
	  $ConsultaSQL_O ->bindParam(':c', $meta[$i]);
	  $ConsultaSQL_O ->bindParam(':d', $meta_valor[$i]);
	  $ConsultaSQL_O ->bindParam(':e', $tipo_meta_valor[$i]);
	  $ConsultaSQL_O ->bindParam(':f', $peso[$i]);
	  $ConsultaSQL_O ->bindParam(':fecha', $fecha);
	  $ConsultaSQL_O ->execute();
							   }
		$okmsg_arr[] = "<img src='../estilos/images/success.png'>".' Objetivos Registrados con Éxito';
		$_SESSION["suceso"] = $okmsg_arr;
		$_SESSION["evento"] = "success";  
		//header("Location: ../vista/listado_obj_trab.php");	
		echo '<script language="javascript">window.location=" ../vista/listado_obj_trab.php"</script>';		
		}
	}	

	public function crear_mejoras($cod_eva,$dificultad,$analisis,$actividad,$responsable){	//Crea un evaluacion
		$this->conexion = parent::conectar();
		if(empty($cod_eva)) {
		$errmsg_arr[] = "<img src='../estilos/images/error.png'>".' Error ID ';
		$errflag = true;
		}
		if($errflag) {
		$_SESSION['suceso'] = $errmsg_arr;
		$_SESSION["evento"] = "error";
		session_write_close();
		//header("location: ../vista/listado_mejora_trab.php");
		echo '<script language="javascript">window.location=" ../vista/listado_mejora_trab.php"</script>';
		exit();
		}
		else{	
		date_default_timezone_set('America/Bogota');
		$fecha=date("Y-m-d");	
		 for($i=0; $i<count($dificultad); $i++){	 
	  $ConsultaSQL_O = $this->conexion->prepare("INSERT INTO plan_mejora VALUES('',:cod,:a,:b,:c,:d,'','','','',:fecha)");
	  $ConsultaSQL_O ->bindParam(':cod', $cod_eva);
	  $ConsultaSQL_O ->bindParam(':a', $dificultad[$i]);
	  $ConsultaSQL_O ->bindParam(':b', $analisis[$i]);
	  $ConsultaSQL_O ->bindParam(':c', $actividad[$i]);
	  $ConsultaSQL_O ->bindParam(':d', $responsable[$i]);
	  $ConsultaSQL_O ->bindParam(':fecha', $fecha);
	  $ConsultaSQL_O ->execute();
							   }
		$okmsg_arr[] = "<img src='../estilos/images/success.png'>".' Mejoras Registrados con Éxito';
		$_SESSION["suceso"] = $okmsg_arr;
		$_SESSION["evento"] = "success";  
		//header("Location: ../vista/listado_mejora_trab.php");
		echo '<script language="javascript">window.location=" ../vista/listado_mejora_trab.php"</script>';		
		}
	}	

	
	public function act_objetivos($id_objetivo,$objetivo,$evidencia,$meta,$meta_valor,$peso){	//Actualizar un Objetivo
	$this->conexion = parent::conectar();
	/*$estado_e="Activa";
	$ConsultaSQL_v = $this->conexion->prepare("SELECT estado_autoeva FROM evaluacion,auto_evaluacion WHERE evaluacion.cod_evaluacion = auto_evaluacion.cod_evaluacion
AND evaluacion.cod_evaluacion = :id AND estado_autoeva = :es_ac");
    $ConsultaSQL_v ->bindParam(':id', $id_eval, PDO::PARAM_INT);
	$ConsultaSQL_v ->bindParam(':es_ac', $estado_e);
    $ConsultaSQL_v ->execute();
    $num_rows = $ConsultaSQL_v->fetchColumn();
    if($num_rows > 0){ 
	$errmsg_arr[] = "<img src='../estilos/img/error.png'>".' La auto-evaluacion del trabajador esta sin finalizar ';
	$errflag = true;
	}*/
	if(empty($id_objetivo)) {
	$errmsg_arr[] = "<img src='../estilos/images/error.png'>".' Error al seleccionar el ID    ';
	$errflag = true;
	}
	if($errflag) {
	$_SESSION['suceso'] = $errmsg_arr;
	$_SESSION["evento"] = "error";
	session_write_close();
	//header("location: ../vista/listado_obj_trab.php");
	echo '<script language="javascript">window.location=" ../vista/listado_obj_trab.php"</script>';
	exit();
	}
	else{	
	$ConsultaSQL = $this->conexion->prepare("
	UPDATE objetivos SET 
	objetivos = :a,
	evidencias = :b,
	meta_propuesta = :c,
	meta_valor = :d,
	peso_porcentaje = :e
	WHERE id_objetivos=:id");
  	$ConsultaSQL ->bindParam(':id', $id_objetivo);
	$ConsultaSQL ->bindParam(':a', $objetivo);
	$ConsultaSQL ->bindParam(':b', $evidencia);
	$ConsultaSQL ->bindParam(':c', $meta);
	$ConsultaSQL ->bindParam(':d', $meta_valor);
	$ConsultaSQL ->bindParam(':e', $peso);
	$ConsultaSQL ->execute();
	$okmsg_arr[] = "<img src='../estilos/images/success.png'>".' Objetivo Actualizado con Éxito';
	$_SESSION["suceso"] = $okmsg_arr;
	$_SESSION["evento"] = 'success';
	//header("Location: ../vista/listado_obj_trab.php");	
	echo '<script language="javascript">window.location=" ../vista/listado_obj_trab.php"</script>';	
		}
		  }

public function act_objetivos_add($id_objetivo,$objetivo,$evidencia,$meta,$meta_valor,$peso,$cod_eva,$num_seg,$obj_con,$respuesta){	//Actualizar un Objetivo
	$this->conexion = parent::conectar();
	/*$estado_e="Activa";
	$ConsultaSQL_v = $this->conexion->prepare("SELECT estado_autoeva FROM evaluacion,auto_evaluacion WHERE evaluacion.cod_evaluacion = auto_evaluacion.cod_evaluacion
AND evaluacion.cod_evaluacion = :id AND estado_autoeva = :es_ac");
    $ConsultaSQL_v ->bindParam(':id', $id_eval, PDO::PARAM_INT);
	$ConsultaSQL_v ->bindParam(':es_ac', $estado_e);
    $ConsultaSQL_v ->execute();
    $num_rows = $ConsultaSQL_v->fetchColumn();
    if($num_rows > 0){ 
	$errmsg_arr[] = "<img src='../estilos/img/error.png'>".' La auto-evaluacion del trabajador esta sin finalizar ';
	$errflag = true;
	}*/
	if(empty($id_objetivo)) {
	$errmsg_arr[] = "<img src='../estilos/images/error.png'>".' Error al seleccionar el ID    ';
	$errflag = true;
	}
	if($errflag) {
	$_SESSION['suceso'] = $errmsg_arr;
	$_SESSION["evento"] = "error";
	session_write_close();
	//header("location: ../vista/listado_obj_trab.php");
	echo '<script language="javascript">window.location=" ../vista/listado_obj_trab.php"</script>';
	exit();
	}
	else{	
	$ConsultaSQL = $this->conexion->prepare("
	UPDATE objetivos SET 
	objetivos = :a,
	evidencias = :b,
	meta_propuesta = :c,
	meta_valor = :d,
	peso_porcentaje = :e
	WHERE id_objetivos=:id");
  	$ConsultaSQL ->bindParam(':id', $id_objetivo);
	$ConsultaSQL ->bindParam(':a', $objetivo);
	$ConsultaSQL ->bindParam(':b', $evidencia);
	$ConsultaSQL ->bindParam(':c', $meta);
	$ConsultaSQL ->bindParam(':d', $meta_valor);
	$ConsultaSQL ->bindParam(':e', $peso);
	$ConsultaSQL ->execute();
	if($respuesta=="Si"){
	$ConsultaSQL_c = $this->conexion->prepare("INSERT INTO objetivos_concertados VALUES('',:id,:a,:b,:fecha)");
	$fecha=date("Y-m-d");
  	$ConsultaSQL_c ->bindParam(':id', $cod_eva);
	$ConsultaSQL_c ->bindParam(':a', $obj_con);
	$ConsultaSQL_c ->bindParam(':b', $num_seg);	
	$ConsultaSQL_c ->bindParam(':fecha', $fecha);
	$ConsultaSQL_c ->execute();
}
	$okmsg_arr[] = "<img src='../estilos/images/success.png'>".' Objetivo Actualizado con Éxito';
	$_SESSION["suceso"] = $okmsg_arr;
	$_SESSION["evento"] = 'success';
	//header("Location: ../vista/listado_obj_trab.php");	
	echo '<script language="javascript">window.location=" ../vista/listado_obj_trab.php"</script>';	
		}
		  }

public function act_mejoras($dificultad,$analisis,$actividad,$responsable,$id_mejora){	
	$this->conexion = parent::conectar();
	if(empty($id_mejora)) {
	$errmsg_arr[] = "<img src='../estilos/images/error.png'>".' Error al seleccionar el ID    ';
	$errflag = true;
	}
	if($errflag) {
	$_SESSION['suceso'] = $errmsg_arr;
	$_SESSION["evento"] = "error";
	session_write_close();
	//header("location: ../vista/listado_mejora_trab.php");
	echo '<script language="javascript">window.location=" ../vista/listado_mejora_trab.php"</script>';	
	exit();
	}
	else{	
	$ConsultaSQL = $this->conexion->prepare("
	UPDATE plan_mejora SET 
	difcultades = :a,
	analisis = :b,
	actividad = :c,
	responsable = :d
	WHERE id_plan_mejora=:id");
  	$ConsultaSQL ->bindParam(':id', $id_mejora);
	$ConsultaSQL ->bindParam(':a', $dificultad);
	$ConsultaSQL ->bindParam(':b', $analisis);
	$ConsultaSQL ->bindParam(':c', $actividad);
	$ConsultaSQL ->bindParam(':d', $responsable);
	$ConsultaSQL ->execute();
	$okmsg_arr[] = "<img src='../estilos/images/success.png'>".' Mejora Actualizada con Éxito';
	$_SESSION["suceso"] = $okmsg_arr;
	$_SESSION["evento"] = 'success';
	//header("Location: ../vista/listado_mejora_trab.php");	
	echo '<script language="javascript">window.location=" ../vista/listado_mejora_trab.php"</script>';	
		}
		  }		  

public function act_mejoras_jefe($id_mejora,$tipo,$primer_periodo,$segundo_periodo){	
	$this->conexion = parent::conectar();
	if(empty($id_mejora)) {
	$errmsg_arr[] = "<img src='../estilos/images/error.png'>".' Error al seleccionar el ID    ';
	$errflag = true;
	}
	if($errflag) {
	$_SESSION['suceso'] = $errmsg_arr;
	$_SESSION["evento"] = "error";
	session_write_close();
	//header("location: ../vista/listado_mejora_trab_jefe.php");
	echo '<script language="javascript">window.location=" ../vista/listado_mejora_trab_jefe.php"</script>';
	exit();
	}
	else{
	date_default_timezone_set('America/Bogota');
	$fecha=date("Y-m-d");
	 if($tipo==1){
	$ConsultaSQL = $this->conexion->prepare("
	UPDATE plan_mejora SET 
	jusft_primer_periodo = :a,
	fecha_primer_periodo = :b
	WHERE id_plan_mejora=:id");
  	$ConsultaSQL ->bindParam(':id', $id_mejora);
	$ConsultaSQL ->bindParam(':a', $primer_periodo);
	$ConsultaSQL ->bindParam(':b', $fecha);
	$ConsultaSQL ->execute();}
	else{
	$ConsultaSQL = $this->conexion->prepare("
	UPDATE plan_mejora SET 
	jusft_segundo_periodo = :a,
	fecha_segundo_periodo = :b
	WHERE id_plan_mejora=:id");
  	$ConsultaSQL ->bindParam(':id', $id_mejora);
	$ConsultaSQL ->bindParam(':a', $segundo_periodo);
	$ConsultaSQL ->bindParam(':b', $fecha);
	$ConsultaSQL ->execute();	
	}
	$okmsg_arr[] = "<img src='../estilos/images/success.png'>".' Mejora Actualizada con Éxito';
	$_SESSION["suceso"] = $okmsg_arr;
	$_SESSION["evento"] = 'success';
	//header("Location: ../vista/listado_mejora_trab_jefe.php");	
	echo '<script language="javascript">window.location=" ../vista/listado_mejora_trab_jefe.php"</script>';
		}
		  }		  
	
	public function act_objetivos_meta($id_objetivo,$meta_alc){	//Actualizar un Objetivo
	$this->conexion = parent::conectar();
	if(empty($id_objetivo)) {
	$errmsg_arr[] = "<img src='../estilos/images/error.png'>".' Error al seleccionar el ID    ';
	$errflag = true;
	}
	if($errflag) {
	$_SESSION['suceso'] = $errmsg_arr;
	$_SESSION["evento"] = "error";
	session_write_close();
	//header("location: ../vista/listado_objetivos.php");
	echo '<script language="javascript">window.location=" ../vista/listado_objetivos.php"</script>';	
	exit();
	}
	else{	
	$ConsultaSQL = $this->conexion->prepare("
	UPDATE objetivos SET 
	meta_alcanzada = :a
	WHERE id_objetivos=:id");
  	$ConsultaSQL ->bindParam(':id', $id_objetivo);
	$ConsultaSQL ->bindParam(':a', $meta_alc);
	$ConsultaSQL ->execute();
	$okmsg_arr[] = "<img src='../estilos/images/success.png'>".' Objetivo Actualizado con Éxito';
	$_SESSION["suceso"] = $okmsg_arr;
	$_SESSION["evento"] = 'success';
	//header("Location: ../vista/listado_objetivos.php");	
	echo '<script language="javascript">window.location=" ../vista/listado_objetivos.php"</script>';	
		}
		  }
	
	
	public function act_objetivos_concretado($cod_eva,$num_seg,$obj_con){	//Actualizar un Objetivo Concretado
	$this->conexion = parent::conectar();
	if(empty($cod_eva)) {
	$errmsg_arr[] = "<img src='../estilos/images/error.png'>".' Error al seleccionar el ID    ';
	$errflag = true;
	}
	if($errflag) {
	$_SESSION['suceso'] = $errmsg_arr;
	$_SESSION["evento"] = "error";
	session_write_close();
	//header("location: ../vista/listado_obj_trab.php");
	echo '<script language="javascript">window.location=" ../vista/listado_obj_trab.php"</script>';
	exit();
	}
	else{	
	$ConsultaSQL_O = $this->conexion->prepare("
	INSERT INTO objetivos (
	cod_evaluacion,
	objetivos,
	evidencias,
	meta_propuesta,
	meta_valor,
	tipo_meta_valor,
	peso_porcentaje,
	meta_alcanzada,
	n_seguimiento_objetivo,
	fecha_reg_objetivo
	) SELECT
		cod_evaluacion,
		objetivos,
		evidencias,
		meta_propuesta,
		meta_valor,
		tipo_meta_valor,
		peso_porcentaje,
		meta_alcanzada,
		:b,
		:fecha_obj
	FROM
	objetivos WHERE cod_evaluacion=:id AND n_seguimiento_objetivo=:a");
	date_default_timezone_set('America/Bogota');
	$fecha_obj=date("Y-m-d");
	$num_seg_menos=$num_seg-1;
  	$ConsultaSQL_O ->bindParam(':id', $cod_eva);
	$ConsultaSQL_O ->bindParam(':a', $num_seg_menos);	
	$ConsultaSQL_O ->bindParam(':b', $num_seg);	
	$ConsultaSQL_O ->bindParam(':fecha_obj', $fecha_obj);
	$ConsultaSQL_O ->execute();	
	/*$ConsultaSQL = $this->conexion->prepare("INSERT INTO objetivos_concertados VALUES('',:id,:a,:b,:fecha)");
	$fecha=date("Y-m-d");
  	$ConsultaSQL ->bindParam(':id', $cod_eva);
	$ConsultaSQL ->bindParam(':a', $obj_con);
	$ConsultaSQL ->bindParam(':b', $num_seg);	
	$ConsultaSQL ->bindParam(':fecha', $fecha);
	$ConsultaSQL ->execute();*/
	$okmsg_arr[] = "<img src='../estilos/images/success.png'>".' Objetivo Concretado Actualizado con Éxito';
	$_SESSION["suceso"] = $okmsg_arr;
	$_SESSION["evento"] = 'success';
	//header("Location: ../vista/listado_obj_trab.php");	
	echo '<script language="javascript">window.location=" ../vista/listado_obj_trab.php"</script>';	
		}
		  }
	
	public function act_objetivos_estado_jefe($cod_eva,$estado_eva,$obs,$num_seg){	//Actualizar un Objetivo Concretado
	$this->conexion = parent::conectar();
	if(empty($cod_eva)) {
	$errmsg_arr[] = "<img src='../estilos/images/error.png'>".' Error al seleccionar el ID    ';
	$errflag = true;
	}
	if($errflag) {
	$_SESSION['suceso'] = $errmsg_arr;
	$_SESSION["evento"] = "error";
	session_write_close();
	//header("location: ../vista/listado_objetivos.php");
	echo '<script language="javascript">window.location=" ../vista/listado_objetivos.php"</script>';
	exit();
	}
	else{	
	 if($num_seg == 0){
	 	$columa = "estado_eva_objetivos";
	 }elseif ($num_seg == 1) {
	 	$columa = "estado_eva_primer_objetivos";
	 }elseif ($num_seg == 2) {
	 	$columa = "estado_eva_segundo_objetivos";
	 }else{
		$columa = "estado_eva_tercer_objetivos";
	 }
	$ConsultaSQL = $this->conexion->prepare("
	UPDATE trabajador_objetivos SET $columa=:a, fecha_eva_objetivos_conc=:fecha, observacion_evaluacion_objetivos=:obs  WHERE cod_evaluacion=:id");
	date_default_timezone_set('America/Bogota');
	$fecha=date("Y-m-d");
  	$ConsultaSQL ->bindParam(':id', $cod_eva);
	$ConsultaSQL ->bindParam(':a', $estado_eva);
	$ConsultaSQL ->bindParam(':fecha', $fecha);
	$ConsultaSQL ->bindParam(':obs', $obs);
	$ConsultaSQL ->execute();
	$okmsg_arr[] = "<img src='../estilos/images/success.png'>".' Evaluación  Actualizada con Éxito';
	$_SESSION["suceso"] = $okmsg_arr;
	$_SESSION["evento"] = 'success';
	//header("Location: ../vista/listado_objetivos.php");	
	echo '<script language="javascript">window.location=" ../vista/listado_objetivos.php"</script>';	
		}
		  }
	
	
	public function act_mejoras_estado_jefe($cod_eva,$estado_eva){	//Actualizar un Objetivo Concretado
	$this->conexion = parent::conectar();
	if(empty($cod_eva)) {
	$errmsg_arr[] = "<img src='../estilos/images/error.png'>".' Error al seleccionar el ID    ';
	$errflag = true;
	}
	if($errflag) {
	$_SESSION['suceso'] = $errmsg_arr;
	$_SESSION["evento"] = "error";
	session_write_close();
	//header("location: ../vista/listado_mejora_trab_jefe.php");
	echo '<script language="javascript">window.location=" ../vista/listado_mejora_trab_jefe.php"</script>';
	exit();
	}
	else{	
	$ConsultaSQL = $this->conexion->prepare("
	UPDATE trabajador_plan_mejora SET estado_plan_mejora=:a, fecha_plan_mejora=:fecha WHERE cod_evaluacion=:id");
	date_default_timezone_set('America/Bogota');
	$fecha=date("Y-m-d");
  	$ConsultaSQL ->bindParam(':id', $cod_eva);
	$ConsultaSQL ->bindParam(':a', $estado_eva);
	$ConsultaSQL ->bindParam(':fecha', $fecha);
	$ConsultaSQL ->execute();
	$okmsg_arr[] = "<img src='../estilos/images/success.png'>".' Evaluación Mejora Actualizada con Éxito';
	$_SESSION["suceso"] = $okmsg_arr;
	$_SESSION["evento"] = 'success';
	//header("Location: ../vista/listado_mejora_trab_jefe.php");	
	echo '<script language="javascript">window.location=" ../vista/listado_mejora_trab_jefe.php"</script>';	
		}
		  }	
		  
	public function eli_objetivo($id_obj){	//Actualizar un evaluacion
	$this->conexion = parent::conectar();
	if(empty($id_obj) || is_null($id_obj)  || $id_obj==='undefined') {
	$errmsg_arr[] = "<img src='../estilos/images/error.png'>".' Error al seleccionar el ID';
	$errflag = true;
	}
	if($errflag) {
	$_SESSION['suceso'] = $errmsg_arr;
	$_SESSION["evento"] = "error";
	session_write_close();
	//header("location: ../vista/listado_obj_trab.php");
	echo '<script language="javascript">window.location=" ../vista/listado_obj_trab.php"</script>';	
	exit();
	}
	else{
	$ConsultaSQL = $this->conexion->prepare("DELETE FROM objetivos WHERE id_objetivos=:id");
	$ConsultaSQL ->bindParam(':id', $id_obj, PDO::PARAM_INT);
	$ConsultaSQL ->execute();
	$okmsg_arr[] = "<img src='../estilos/images/success.png'>".' Objetivo Eliminado con Éxito';
	$_SESSION["suceso"] = $okmsg_arr;
	$_SESSION["evento"] = 'success';
	//header("Location: ../vista/listado_obj_trab.php");
	echo '<script language="javascript">window.location=" ../vista/listado_obj_trab.php"</script>';	
		  }
		 } 
		 
	public function eli_mejora($id_mej){	
	$this->conexion = parent::conectar();
	if(empty($id_mej) || is_null($id_mej)  || $id_mej==='undefined') {
	$errmsg_arr[] = "<img src='../estilos/images/error.png'>".' Error al seleccionar el ID';
	$errflag = true;
	}
	if($errflag) {
	$_SESSION['suceso'] = $errmsg_arr;
	$_SESSION["evento"] = "error";
	session_write_close();
	//header("location: ../vista/listado_mejora_trab.php");
	echo '<script language="javascript">window.location=" ../vista/listado_mejora_trab.php"</script>';
	exit();
	}
	else{
	$ConsultaSQL = $this->conexion->prepare("DELETE FROM plan_mejora WHERE id_plan_mejora=:id");
	$ConsultaSQL ->bindParam(':id', $id_mej, PDO::PARAM_INT);
	$ConsultaSQL ->execute();
	$okmsg_arr[] = "<img src='../estilos/images/success.png'>".' Mejora Eliminado con Éxito';
	$_SESSION["suceso"] = $okmsg_arr;
	$_SESSION["evento"] = 'success';
	//header("Location: ../vista/listado_mejora_trab.php");
	echo '<script language="javascript">window.location=" ../vista/listado_mejora_trab.php"</script>';	
		  }
		 } 		 
		 
	public function eli_evaluacion($id_eva){	//Actualizar un evaluacion
	$this->conexion = parent::conectar();
	if(empty($id_eva) || is_null($id_eva)  || $id_eva==='undefined') {
	$errmsg_arr[] = "<img src='../estilos/images/error.png'>".' Error al seleccionar el ID';
	$errflag = true;
	}
	if($errflag) {
	$_SESSION['suceso'] = $errmsg_arr;
	$_SESSION["evento"] = "error";
	session_write_close();
	//header("location: ../vista/generar_evaluaciones.php");
	echo '<script language="javascript">window.location=" ../vista/generar_evaluaciones.php"</script>';
	exit();
	}
	else{
	$ConsultaSQL = $this->conexion->prepare("DELETE FROM gestion_desempeno WHERE cod_evaluacion=:id");
	$ConsultaSQL->bindParam(':id', $id_eva, PDO::PARAM_INT);
	$ConsultaSQL->execute();
	$okmsg_arr[] = "<img src='../estilos/images/success.png'>".' Evaluación Eliminada con Éxito';
	$_SESSION["suceso"] = $okmsg_arr;
	$_SESSION["evento"] = 'success';
	//header("Location: ../vista/generar_evaluaciones.php");	
	echo '<script language="javascript">window.location=" ../vista/generar_evaluaciones.php"</script>';
		  }
		 }  
		 
	public function act_evaluacion($cod_eva_trab,$cod_eva,$nota,$estado,$total){	//Actualizar un evaluacion
	$this->conexion = parent::conectar();
	$errflag = false;
	if(empty($cod_eva)) {
	$errmsg_arr[] = "<img src='../estilos/images/error.png'>".' Error al seleccionar el ID    ';
	$errflag = true;
	}
	if(empty($estado)) {
	$errmsg_arr[] = "<img src='../estilos/images/error.png'>".' Debe seleccionar un estado   ';
	$errflag = true;
	}
	if($errflag) {
	$_SESSION['suceso'] = $errmsg_arr;
	$_SESSION["evento"] = "error";
	$change = array('suceso' => $errmsg_arr, 'evento' => 'error');
	echo json_encode($change);
	//session_write_close();
	//header("location: ../vista/listado_eval_trab_jefe.php");
	exit();
	}
	else{
		$i = 1; 
			foreach($nota as $key => $value) {
			   if ($value != NULL) {
				   $query[] = "compen_{$i}=".$value;
				  $i++;
			   }
			}
			if (! empty($query)) {
			  $finalQuery = implode(",", $query);
			  $ConsultaSQL = $this->conexion->prepare('UPDATE evaluacion SET ' . $finalQuery.', estado_eva=:estado, total=:total WHERE id_evaluacion=:id');
			}	
	$ConsultaSQL ->bindParam(':id', $cod_eva);
	$ConsultaSQL ->bindParam(':estado', $estado);
	$ConsultaSQL ->bindParam(':total', $total);
	$ConsultaSQL ->execute();
	//Evaluacion Estado
	/*$ConsultaSQL_v = $this->conexion->prepare("
		UPDATE trabajador_evaluacion
		SET estado_trab_evaluacion =
		IF (
			(
				SELECT
					SUM(

						IF (estado_eva = 'Pendiente', 1, 0)
					) AS Total_Pendiente
				FROM
					evaluacion
				WHERE
					cod_evaluacion = :id
			) = 0,
			'Finalizada',
			'Pendiente'
		)
		WHERE
			cod_evaluacion = :id");*/
	$ConsultaSQL_v = $this->conexion->prepare("
		UPDATE trabajador_evaluacion
		SET estado_trab_evaluacion =
		IF (
			(
				SELECT
					(SUM(IF (estado_eva = 'Pendiente', 1, 0))) + (IF (trabajador_evaluacion_cualitativa.estado_eva_cualitativa = 'Pendiente', 1, 0) ) AS Total_Pendiente
				FROM
					evaluacion
LEFT JOIN trabajador_evaluacion_cualitativa ON evaluacion.cod_evaluacion = trabajador_evaluacion_cualitativa.cod_evaluacion
				WHERE
					evaluacion.cod_evaluacion =  :id
			) = 0,
			'Finalizada',
			'Pendiente'
		)
		WHERE
			cod_evaluacion = :id");			
    $ConsultaSQL_v ->bindParam(':id', $cod_eva_trab);
   $ConsultaSQL_v ->execute();
//Evaluacion General
	$ConsultaSQL_g = $this->conexion->prepare("
		UPDATE gestion_desempeno
		SET total_gestion_desempeno = IF ((SELECT	SUM(IF (estado_eva = 'Pendiente', 1, 0)) AS Total_Pendiente	FROM evaluacion	WHERE	cod_evaluacion = :id) = 0,
		(SELECT (((SUM((total)*(1-abs(sign(num_evaluacion-1))))+SUM((total)*(1-abs(sign(num_evaluacion-2))))+
		SUM((total)*(1-abs(sign(num_evaluacion-3))))+SUM((total)*(1-abs(sign(num_evaluacion-4)))))/4)*0.3)+
		((SELECT SUM((((meta_alcanzada/meta_valor)*100)*peso_porcentaje)/100) AS Subtotal FROM objetivos
		WHERE	cod_evaluacion = :id	AND n_seguimiento_objetivo=3 GROUP BY cod_evaluacion)*0.7) AS Final
		FROM evaluacion WHERE evaluacion.cod_evaluacion = :id GROUP BY evaluacion.cod_evaluacion),
		0)
WHERE
	cod_evaluacion = :id");
    $ConsultaSQL_g ->bindParam(':id', $cod_eva_trab);
    $ConsultaSQL_g ->execute();
//Evaluacion Estado
	$ConsultaSQL_gf = $this->conexion->prepare("
		UPDATE gestion_desempeno SET estado_gestion_desempeno = CASE
    WHEN total_gestion_desempeno = 0 THEN 'Pendiente'
    WHEN total_gestion_desempeno <= 70 THEN 'Insatisfactoria'
    WHEN total_gestion_desempeno BETWEEN 70 AND 89 THEN 'Satisfactoria'
    WHEN total_gestion_desempeno >= 90 THEN 'Sobresaliente'
    END
WHERE cod_evaluacion = :id");
    $ConsultaSQL_gf ->bindParam(':id', $cod_eva_trab);
    $ConsultaSQL_gf ->execute();		
	// Crear Plan de Mejora
	$ConsultaSQL_vf = $this->conexion->prepare("
SELECT
	evaluacion.id_evaluacion AS id_eva,
	CONCAT(
		nombres_usuario,
		' ',
		apellidos_usuario
	) AS empleado,
	ano_evaluacion,
	evaluacion.cod_evaluacion,
(ROUND(((SUM(
		(
			total
		) * (
			1 - abs(sign(num_evaluacion - 1))
		)
	) +
	SUM(
		(
			total
		) * (
			1 - abs(sign(num_evaluacion - 2))
		)
	) +
	SUM(
		(
			total
		) * (
			1 - abs(sign(num_evaluacion - 3))
		)
	) +
	SUM(
		(
			total
		) * (
			1 - abs(sign(num_evaluacion - 4))
		)
	) )/4 * 0.3),2) +
((SELECT SUM((((meta_alcanzada/meta_valor)*100)*peso_porcentaje)/100) AS Subtotal FROM	objetivos WHERE cod_evaluacion =  evaluacion.cod_evaluacion GROUP BY cod_evaluacion ) * 0.7)) AS Total
FROM
	evaluacion
LEFT JOIN gestion_desempeno ON evaluacion.cod_evaluacion = gestion_desempeno.cod_evaluacion
LEFT JOIN trabajador_evaluacion ON evaluacion.cod_evaluacion = trabajador_evaluacion.cod_evaluacion
LEFT JOIN usuario ON gestion_desempeno.cod_trabajador = usuario.codigo_usuario
LEFT JOIN trabajador ON gestion_desempeno.cod_trabajador = trabajador.cc_trabajador
WHERE
 evaluacion.cod_evaluacion = :id AND trabajador_evaluacion.estado_trab_evaluacion='Finalizada'
GROUP BY
	evaluacion.cod_evaluacion");
	  $ConsultaSQL_vf ->bindParam(':id', $cod_eva_trab, PDO::PARAM_INT);
	       $ConsultaSQL_vf ->execute();
	  while ($row = $ConsultaSQL_vf->fetch(PDO::FETCH_ASSOC)) {
		if($row["Total"] <= 70){
			$ConsultaSQL = $this->conexion->prepare("INSERT INTO trabajador_plan_mejora VALUES('',:cod,:a,:fecha)");
			date_default_timezone_set('America/Bogota');
			$fecha=date("Y-m-d");
			$estado="Pendiente";
			$ConsultaSQL ->bindParam(':cod', $cod_eva_trab);
			$ConsultaSQL ->bindParam(':a', $estado);
			$ConsultaSQL ->bindParam(':fecha', $fecha);
			$ConsultaSQL ->execute();
						}
		}
	$change = array('suceso' => '<img src="../estilos/images/success.png"> Evaluación Actualizada con Éxito', 'evento' => 'success');
	echo json_encode($change);	
		}
		  }	
		  
	public function act_evaluacion_cualitativa($cod_eva,$evaluacion_cualitativa,$estado_eval){	
	$this->conexion = parent::conectar();
	if(empty($cod_eva)) {
	$errmsg_arr[] = "<img src='../estilos/images/error.png'>".' Error al seleccionar el ID    ';
	$errflag = true;
	}
	if($errflag) {
	$_SESSION['suceso'] = $errmsg_arr;
	$_SESSION["evento"] = "error";
	session_write_close();
	//header("location: ../vista/listado_recurso_jefe.php");
	echo '<script language="javascript">window.location=" ../vista/listado_recurso_jefe.php"</script>';	
	exit();
	}
	else{	
	date_default_timezone_set('America/Bogota');
	$fecha=date("Y-m-d");
	$ConsultaSQL_Exa = $this->conexion->prepare("
	UPDATE trabajador_evaluacion_cualitativa SET descripcion_cualitativa = :a, estado_eva_cualitativa = :estado WHERE cod_evaluacion=:id");
  	$ConsultaSQL_Exa ->bindParam(':id', $cod_eva);
	$ConsultaSQL_Exa ->bindParam(':a', $evaluacion_cualitativa);
	$ConsultaSQL_Exa ->bindParam(':estado', $estado_eval);
	$ConsultaSQL_Exa ->execute();
	$ConsultaSQL_v = $this->conexion->prepare("
		UPDATE trabajador_evaluacion
		SET estado_trab_evaluacion =
		IF (
			(
				SELECT
					(SUM(IF (estado_eva = 'Pendiente', 1, 0))) + (IF (trabajador_evaluacion_cualitativa.estado_eva_cualitativa = 'Pendiente', 1, 0) ) AS Total_Pendiente
				FROM
					evaluacion
LEFT JOIN trabajador_evaluacion_cualitativa ON evaluacion.cod_evaluacion = trabajador_evaluacion_cualitativa.cod_evaluacion
				WHERE
					evaluacion.cod_evaluacion =  :id
			) = 0,
			'Finalizada',
			'Pendiente'
		)
		WHERE
			cod_evaluacion = :id");			
    $ConsultaSQL_v ->bindParam(':id', $cod_eva);
   $ConsultaSQL_v ->execute();
	$okmsg_arr[] = "<img src='../estilos/images/success.png'>".'Descropcion actualizada con Éxito';
	$_SESSION["suceso"] = $okmsg_arr;
	$_SESSION["evento"] = 'success';
	//header("Location: ../vista/listado_recurso_jefe.php");
	echo '<script language="javascript">window.location=" ../vista/listado_eval_trab_jefe.php"</script>';	
		}
		  }	  

	public function crear_recursos($cod_eva,$notificacion,$si_obs,$no_obs,$correo){	
	$this->conexion = parent::conectar();
	if(empty($cod_eva)) {
	$errmsg_arr[] = "<img src='../estilos/images/error.png'>".' Error al seleccionar el ID    ';
	$errflag = true;
	}
	if($errflag) {
	$_SESSION['suceso'] = $errmsg_arr;
	$_SESSION["evento"] = "error";
	session_write_close();
	//header("location: ../vista/listado_recurso_trab.php");
	echo '<script language="javascript">window.location=" ../vista/listado_recurso_trab.php"</script>';
	exit();
	}
	else{	
	$ConsultaSQL = $this->conexion->prepare("INSERT INTO recursos VALUES('',:cod,:a,:b,:c,:fecha)");
	date_default_timezone_set('America/Bogota');
	$fecha=date("Y-m-d");
	$estado="Pendiente";
	if($notificacion==1){$recurso=$si_obs;}else{$recurso=$no_obs;}
  	$ConsultaSQL ->bindParam(':cod', $cod_eva);
	$ConsultaSQL ->bindParam(':a', $notificacion);
  	$ConsultaSQL ->bindParam(':b', $recurso);	
	$ConsultaSQL ->bindParam(':c', $estado);
	$ConsultaSQL ->bindParam(':fecha', $fecha);
	$ConsultaSQL ->execute();
	     $server_name = "localhost";
		$header = "MIME-Version: 1.0\n";
		$header .= "Content-Type: text/html; charset=iso-8859-1\n";
		$header .="From: webmaster@$server_name\nReply-To:
		webmaster@$server_name\nX-Mailer: PHP/";
		$mensaje = "<h2>Cordial Saludo</h2>
					<h1 style='color: #5e9ca0;'>Actualmente usted tiene un nuevo recurso por revisar.</h1>
					<ul>
					<li>Ingrese al sistema y realizar esta actividad pendiente, gracias.</li>
					</ul>
					<h1 style='color: #5e9ca0;'>&nbsp;</h1>
					<h4>Universidad de Cartagena</h4>";
		mail("$correo","$titulo","$mensaje","$header");
	$okmsg_arr[] = "<img src='../estilos/images/success.png'>".'Recurso Enviado con Éxito';
	$_SESSION["suceso"] = $okmsg_arr;
	$_SESSION["evento"] = 'success';
	//header("Location: ../vista/listado_recurso_trab.php");	
	echo '<script language="javascript">window.location=" ../vista/listado_recurso_trab.php"</script>';	
		}
		  }
		  
	public function crear_respuesta($id_recurso,$cod_usuario,$respuesta){	
	$this->conexion = parent::conectar();
	if(empty($id_recurso)) {
	$errmsg_arr[] = "<img src='../estilos/images/error.png'>".' Error al seleccionar el ID    ';
	$errflag = true;
	}
	if($errflag) {
	$_SESSION['suceso'] = $errmsg_arr;
	$_SESSION["evento"] = "error";
	session_write_close();
	//header("location: ../vista/listado_recurso_jefe.php");
	echo '<script language="javascript">window.location=" ../vista/listado_recurso_jefe.php"</script>';	
	exit();
	}
	else{	
	$ConsultaSQL = $this->conexion->prepare("INSERT INTO respuesta VALUES('',:id,:a,:b,:fecha)");
	date_default_timezone_set('America/Bogota');
	$fecha=date("Y-m-d");
  	$ConsultaSQL ->bindParam(':id', $id_recurso);
	$ConsultaSQL ->bindParam(':a', $cod_usuario);
  	$ConsultaSQL ->bindParam(':b', $respuesta);	
	$ConsultaSQL ->bindParam(':fecha', $fecha);
	$ConsultaSQL ->execute();
	$estado="Resuelto";
	$ConsultaSQL_E = $this->conexion->prepare("
	UPDATE recursos SET estado_recurso = :a WHERE id_recurso=:id");
  	$ConsultaSQL_E ->bindParam(':id', $id_recurso);
	$ConsultaSQL_E ->bindParam(':a', $estado);
	$ConsultaSQL_E ->execute();
	$okmsg_arr[] = "<img src='../estilos/images/success.png'>".'Respuesta Enviada con Éxito';
	$_SESSION["suceso"] = $okmsg_arr;
	$_SESSION["evento"] = 'success';
	//header("Location: ../vista/listado_recurso_jefe.php");
	echo '<script language="javascript">window.location=" ../vista/listado_recurso_jefe.php"</script>';	
		}
		  }

	public function crear_respuesta_admin($id_recurso,$cod_usuario,$respuesta){	
	$this->conexion = parent::conectar();
	if(empty($id_recurso)) {
	$errmsg_arr[] = "<img src='../estilos/images/error.png'>".' Error al seleccionar el ID    ';
	$errflag = true;
	}
	if($errflag) {
	$_SESSION['suceso'] = $errmsg_arr;
	$_SESSION["evento"] = "error";
	session_write_close();
	//header("location: ../vista/listado_recurso_admin.php");
	echo '<script language="javascript">window.location=" ../vista/listado_recurso_admin.php"</script>';
	exit();
	}
	else{	
	$ConsultaSQL = $this->conexion->prepare("INSERT INTO respuesta VALUES('',:id,:a,:b,:fecha)");
	date_default_timezone_set('America/Bogota');
	$fecha=date("Y-m-d");
  	$ConsultaSQL ->bindParam(':id', $id_recurso);
	$ConsultaSQL ->bindParam(':a', $cod_usuario);
  	$ConsultaSQL ->bindParam(':b', $respuesta);	
	$ConsultaSQL ->bindParam(':fecha', $fecha);
	$ConsultaSQL ->execute();
	$estado="Resuelto";
	$ConsultaSQL_E = $this->conexion->prepare("
	UPDATE recursos SET estado_recurso = :a WHERE id_recurso=:id");
  	$ConsultaSQL_E ->bindParam(':id', $id_recurso);
	$ConsultaSQL_E ->bindParam(':a', $estado);
	$ConsultaSQL_E ->execute();
	$okmsg_arr[] = "<img src='../estilos/images/success.png'>".'Respuesta Enviada con Éxito';
	$_SESSION["suceso"] = $okmsg_arr;
	$_SESSION["evento"] = 'success';
	//header("Location: ../vista/listado_recurso_admin.php");
	echo '<script language="javascript">window.location=" ../vista/listado_recurso_admin.php"</script>';	
		}
		  }

public function crear_envio_correo_jefe($correos,$titulo,$contenido){	//Actualizar estado estudiante
	$this->conexion = parent::conectar();
	if(empty($correos)) {
	$errmsg_arr[] = "<img src='../estilos/images/error.png'>".' No hay correos de destino';
	$errflag = true;
	}
	if($errflag) {
	$_SESSION['suceso'] = $errmsg_arr;
	$_SESSION["evento"] = "error";
	session_write_close();
	//header("location: ../vista/generar_evaluaciones.php");
	echo '<script language="javascript">window.location=" ../vista/generar_evaluaciones.php"</script>';
	exit();
	}
	else{
		$server_name = "localhost";
		$header = "MIME-Version: 1.0\n";
		$header .= "Content-Type: text/html; charset=iso-8859-1\n";
		$header .="From: webmaster@$server_name\nReply-To:
		webmaster@$server_name\nX-Mailer: PHP/";
		$mensaje = $contenido;
		mail("$correos","$titulo","$mensaje","$header");
	$okmsg_arr[] = "<img src='../estilos/images/success.png'>".' Correo Enviado Con Éxito';
	$_SESSION["suceso"] = $okmsg_arr;
	$_SESSION["evento"] = 'success';	
	echo '<script language="javascript">window.location=" ../vista/generar_evaluaciones.php"</script>';	
		}
		  }	

public function crear_envio_correo_admin($correos,$titulo,$contenido){	//Actualizar estado estudiante
	$this->conexion = parent::conectar();
	if(empty($correos)) {
	$errmsg_arr[] = "<img src='../estilos/images/error.png'>".' No hay correos de destino';
	$errflag = true;
	}
	if($errflag) {
	$_SESSION['suceso'] = $errmsg_arr;
	$_SESSION["evento"] = "error";
	session_write_close();
	//header("location: ../vista/consulta_admin_general.php");
	echo '<script language="javascript">window.location=" ../vista/consulta_admin_general.php"</script>';
	exit();
	}
	else{
		$server_name = "localhost";
		$header = "MIME-Version: 1.0\n";
		$header .= "Content-Type: text/html; charset=iso-8859-1\n";
		$header .="From: webmaster@$server_name\nReply-To:
		webmaster@$server_name\nX-Mailer: PHP/";
		$mensaje = $contenido;
		mail("$correos","$titulo","$mensaje","$header");
	$okmsg_arr[] = "<img src='../estilos/images/success.png'>".' Correo Enviado Con Éxito';
	$_SESSION["suceso"] = $okmsg_arr;
	$_SESSION["evento"] = 'success';
	echo '<script language="javascript">window.location=" ../vista/consulta_admin_general.php"</script>';		
		}
		  }		  
		  
}
?>