<?php
include("../modelo/conexion.php");
class ValidarEntrada extends configuracion{
	private $conexion;	
public function validar($cod,$cla,$tipo_usu){
  $this->conexion = parent::conectar();
  $ConsultaSQL = $this->conexion->prepare("
	  SELECT
		id_usuario,
		codigo_usuario,
		nombres_usuario,
		apellidos_usuario,
		num_tipo,
		estado_usuario,
		correo_usuario,
		fecha_registro_usuario
	FROM
		usuario,
		usuario_tipo
	WHERE
		usuario.codigo_usuario = usuario_tipo.cedula_usuario
	AND clave_usuario = md5(:pass)
	AND codigo_usuario = :id
	AND estado_usuario = 'Habilitado'
	AND usuario_tipo.num_tipo = :tipo");
  $ConsultaSQL ->bindParam(':id', $cod);
  $ConsultaSQL ->bindParam(':pass', $cla);
  $ConsultaSQL ->bindParam(':tipo', $tipo_usu);
  $ConsultaSQL ->execute();
   while ($row = $ConsultaSQL ->fetch(PDO::FETCH_ASSOC)) {
                  $id=$row['id_usuario'];
				  $cedula=$row['codigo_usuario'];
                  $nombres=$row['nombres_usuario'];
                  $apellidos=$row['apellidos_usuario'];
		 		  $tipo=$row['num_tipo'];
				  $estado=$row['estado_usuario'];
				  $fecha=$row['fecha_registro_usuario'];
                }

		$_SESSION['num']=$id;
		$_SESSION['codigo']=$cedula;
		$_SESSION['nombre']=$nombres;
		$_SESSION['apellido']=$apellidos;
		$_SESSION['tipo']=$tipo;
		$_SESSION['fecha_registro']=$fecha;
		$_SESSION['estado']=$estado;
		date_default_timezone_set('America/Bogota');
		$_SESSION['ultimoAcceso']=date("Y-n-j H:i:s"); 
	
		if($tipo=="1"){
			//header("Location: ../vista/admin.php");
						echo '<script language="javascript">window.location=" ../vista/admin.php"</script>';
		}
		elseif($tipo=="2"){
			//header("Location: ../vista/jefe.php");
						echo'<script language="javascript">window.location=" ../vista/jefe.php"</script>';		
		}
		elseif($tipo=="3"){
			//header("Location: ../vista/trabajador.php");
			echo '<script language="javascript">window.location=" ../vista/trabajador.php"</script>';				
		}		
		else{
			$errmsg_arr[] = "<img src='../estilos/img/error.png'>".' Usuario y Contraseña no encontrados';
			$errflag = true;
		}
		if($errflag) {
			$_SESSION['suceso_r'] = $errmsg_arr;
			$_SESSION["evento_r"] = "error"; 
			//header("location: ../vista/index_reg.php");
			echo '<script language="javascript">window.location=" ../vista/index_reg.php"</script>';
			exit();
			}
    }
}
?>