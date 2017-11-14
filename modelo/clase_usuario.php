<?php
include_once("../modelo/conexion.php");
	class clase_usuario extends configuracion{
	private $conexion;	
	
function valores_configuracion(){ //Configuracion desempeño
    $this->conexion = parent::conectar(); 
	$ConsultaSQL=$this->conexion->prepare("SELECT * FROM configuracion ORDER BY id_configuracion ASC");
	$estado='Finalizada';
	$ConsultaSQL ->bindParam(':id', $id_trabajador, PDO::PARAM_INT);
	$ConsultaSQL ->bindParam(':estado', $estado);
	$ConsultaSQL->execute();
	$numero_filas = $ConsultaSQL->rowCount();
	if(empty($numero_filas)){
		echo "No existen Datos.";
		}
	else{
  echo '<table class="table table-striped table-hover table-bordered result" id="dynamic-table">
							  <thead>
								  <tr>
									  <th width="7%"></th>
									  <th width="40%">Actividad</th> 
									  <th width="36%">Fechas</th> 										  
									  <th width="17%"></th>                                     
								  </tr>
							  </thead>   
							  <tbody>';
while ($row = $ConsultaSQL->fetch(PDO::FETCH_ASSOC)) {
printf("<tr>
<td>%s</td><td>%s</td>
<td>%s</td><td>%s</td>
</tr>",
$row["id_configuracion"],
$row["nombre_configuracion"],
    "<div class='input-group input-large'>
            <input type='text' class='form-control dpd1' name='from_".$row["id_configuracion"]."' id='from_".$row["id_configuracion"]."' value=".$row["fecha_inicio_configuracion"].">
            <span class='input-group-addon'>a</span>
            <input type='text' class='form-control dpd2' name='to_".$row["id_configuracion"]."' id='to_".$row["id_configuracion"]."' value=".$row["fecha_fin_configuracion"].">
    </div></div></div>",
"<a class='btn btn-success estado_config' id='".$row["id_configuracion"]."'><i class='fa fa-pencil'> </i></a>"
	); 
	 }							                                                                       
	echo '</tbody></table>';
	}		
}

function valores_configuracion_consulta(){ //Configuracion
    $this->conexion = parent::conectar(); 
	$ConsultaSQL=$this->conexion->prepare("SELECT * FROM configuracion ORDER BY id_configuracion ASC");
	$estado='Finalizada';
	$ConsultaSQL ->bindParam(':id', $id_trabajador, PDO::PARAM_INT);
	$ConsultaSQL ->bindParam(':estado', $estado);
	$ConsultaSQL->execute();
	$numero_filas = $ConsultaSQL->rowCount();
	if(empty($numero_filas)){
		echo "No existen Datos.";
		}
	else{
  echo '<table class="table table-striped table-hover table-bordered result">
							  <thead>
								  <tr>
									  <th width="7%"></th>
									  <th width="40%">Actividad</th> 
									  <th width="53%">Fechas</th> 										  
								  </tr>
							  </thead>   
							  <tbody>';
while ($row = $ConsultaSQL->fetch(PDO::FETCH_ASSOC)) {
printf("<tr>
<td>%s</td><td>%s</td>
<td>%s</td>
</tr>",
$row["id_configuracion"],
$row["nombre_configuracion"],
    "<div class='input-group input-large'>
            <input type='text' class='form-control dpd1' name='from_".$row["id_configuracion"]."' id='from_".$row["id_configuracion"]."' value=".$row["fecha_inicio_configuracion"]." readonly>
            <span class='input-group-addon'>a</span>
            <input type='text' class='form-control dpd2' name='to_".$row["id_configuracion"]."' id='to_".$row["id_configuracion"]."' value=".$row["fecha_fin_configuracion"]." readonly>
    </div></div></div>"
	); 
	 }							                                                                       
	echo '</tbody></table>';
	}		
}

public function act_configuracion($id_configuracion,$from,$to){	//Actualizar un Objetivo
	$this->conexion = parent::conectar();
	$errflag = false;
	if(empty($id_configuracion)) {
	$errmsg_arr[] = "<img src='../estilos/images/error.png'>".' Error al seleccionar el ID    ';
	$errflag = true;
	}
	if($errflag) {
	$_SESSION['suceso'] = $errmsg_arr;
	$_SESSION["evento"] = "error";
	session_write_close();
	//header("location: ../vista/configuracion.php");
	exit();
	}
	else{	
	$ConsultaSQL = $this->conexion->prepare("
	UPDATE configuracion SET 
	fecha_inicio_configuracion = COALESCE(NULLIF(:a,''),fecha_inicio_configuracion),
	fecha_fin_configuracion = COALESCE(NULLIF(:b,''),fecha_fin_configuracion)
	WHERE id_configuracion=:id");
  	$ConsultaSQL ->bindParam(':id', $id_configuracion);
	$ConsultaSQL ->bindParam(':a', $from);
	$ConsultaSQL ->bindParam(':b', $to);
	$ConsultaSQL ->execute();
	$okmsg_arr[] = "<img src='../estilos/images/success.png'>".' Estado Actualizado con Éxito';
	$_SESSION["suceso"] = $okmsg_arr;
	$_SESSION["evento"] = 'success';
	//header("Location: ../vista/configuracion.php");				
		}
		  }	
	public function valores_clase_usuario($id_trabajador){	//Clase Departamento
  $this->conexion = parent::conectar(); 
  $ConsultaSQL = $this->conexion->prepare("
  SELECT
  *
  FROM usuario
WHERE
	codigo_usuario = :id");
  $ConsultaSQL ->bindParam(':id', $id_trabajador, PDO::PARAM_INT);
  $ConsultaSQL ->execute();
  while ($row = $ConsultaSQL ->fetch(PDO::FETCH_ASSOC)) {
	$this->codigo=$row["codigo_usuario"];
	$this->nombre_usuario=$row["nombres_usuario"];
	$this->apellido_usuario=$row["apellidos_usuario"];
	$this->correo=$row["correo_usuario"];
	}
		}
public function act_usuario($cod_usu,$nombre_usu,$apellido_usu,$clave_usu,$re_clave_usu,$correo_usu){	//Actualizar un trabajador
	$this->conexion = parent::conectar();
	if(empty($cod_usu) || is_null($cod_usu)) {
	$errmsg_arr[] = "<img src='../estilos/images/error.png'>".' Error al seleccionar el ID';
	$errflag = true;
	}
	if($clave_usu != $re_clave_usu) {
	$errmsg_arr[] = "<img src='../estilos/images/error.png'>".' Claves no Coinciden';
	$errflag = true;
	}	
	if($errflag) {
	$_SESSION['suceso'] = $errmsg_arr;
	$_SESSION["evento"] = "error";
	session_write_close();
	}
	else{
	$ConsultaSQL = $this->conexion->prepare("
	UPDATE usuario SET  
	nombres_usuario = COALESCE(NULLIF(:a,''),nombres_usuario),
	apellidos_usuario = COALESCE(NULLIF(:b,''),apellidos_usuario),
	clave_usuario = COALESCE(NULLIF(:c,''),clave_usuario),
	correo_usuario = COALESCE(NULLIF(:d,''),correo_usuario)
	WHERE codigo_usuario=:id
	");
	$clave=md5($clave);
  	$ConsultaSQL ->bindParam(':a', $nombre_usu);
  	$ConsultaSQL ->bindParam(':b', $apellido_usu);
  	$ConsultaSQL ->bindParam(':c', md5($clave_usu));
  	$ConsultaSQL ->bindParam(':d', $correo_usu);		
	$ConsultaSQL ->bindParam(':id', $cod_usu, PDO::PARAM_INT);
	$ConsultaSQL ->execute();
	$okmsg_arr[] = "<img src='../estilos/images/success.png'>".' Usuario Actualizado con Éxito';
	$_SESSION["suceso"] = $okmsg_arr;
	$_SESSION["evento"] = 'success';				
		}
		  }		

public function eli_trabajador($id_trab){	//Actualizar un Objetivo
	$this->conexion = parent::conectar();
	$errflag = false;
	if(empty($id_trab)) {
	$errmsg_arr[] = "<img src='../estilos/images/error.png'>".' Error al seleccionar el ID    ';
	$errflag = true;
	}
	if($errflag) {
	$_SESSION['suceso'] = $errmsg_arr;
	$_SESSION["evento"] = "error";
	session_write_close();
	//header("location: ../vista/configuracion_jefe.php");
	echo '<script language="javascript">window.location=" ../vista/configuracion_jefe.php"</script>';
	exit();
	}
	else{	
	$ConsultaSQL = $this->conexion->prepare("
	UPDATE trabajador SET 
	id_jefe=NULL
	WHERE cc_trabajador=:id");
  	$ConsultaSQL ->bindParam(':id', $id_trab);
	$ConsultaSQL ->execute();
	$okmsg_arr[] = "<img src='../estilos/images/success.png'>".' Trabajador Actualizado con Éxito';
	$_SESSION["suceso"] = $okmsg_arr;
	$_SESSION["evento"] = 'success';
	//header("Location: ../vista/configuracion_jefe.php");	
		echo '<script language="javascript">window.location=" ../vista/configuracion_jefe.php"</script>';	
		}
		  }

public function act_configuracion_jefe($id_jefe,$id_trab){	//Actualizar un trabajador
	$this->conexion = parent::conectar();
	$errflag = false;
	if(empty($id_jefe)) {
	$errmsg_arr[] = "<img src='../estilos/images/error.png'>".' Error al seleccionar el ID';
	$errflag = true;
	}
	if($errflag) {
	$_SESSION['suceso'] = $errmsg_arr;
	$_SESSION["evento"] = "error";
	session_write_close();
	}
	else{
	$ConsultaSQL = $this->conexion->prepare("
	UPDATE trabajador SET  
	id_jefe=:id
	WHERE FIND_IN_SET(cc_trabajador, :id_trab)
	");
	$ConsultaSQL ->bindParam(':id', $id_jefe, PDO::PARAM_INT);
	$ConsultaSQL ->bindParam(':id_trab', $id_trab);
	$ConsultaSQL ->execute();
	$okmsg_arr[] = "<img src='../estilos/images/success.png'>".' Trabajadores Actualizados con Éxito';
	$_SESSION["suceso"] = $okmsg_arr;
	$_SESSION["evento"] = 'success';				
		}
		  }			  
		  
}
?>