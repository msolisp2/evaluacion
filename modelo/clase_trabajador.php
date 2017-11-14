<?php
include_once("../modelo/conexion.php");
	class clase_trabajador extends configuracion{
	private $conexion;	
public function valores_clase_trabajador($id_trabajador){	//Clase Departamento
  $this->conexion = parent::conectar(); 
  $ConsultaSQL = $this->conexion->prepare("
  SELECT
  nombre_tipo_contrato AS vinculo,
  empleado.codigo_usuario,
	CONCAT(
		empleado.nombres_usuario,
		' ',
		empleado.apellidos_usuario
	) AS nombre_trabajador,
	dependencia.nombre_dependencia,
	jefe.codigo_usuario AS codigo_jefe,
  CONCAT(
		jefe.nombres_usuario,
		' ',
		jefe.apellidos_usuario
	) AS nombre_jefe,
	nombre_cargo,genero_trabajador,
	trabajador.id_municipio,
	nombre_municipio,
	id_dependencia,
	trabajador.id_cargo
FROM
	trabajador
LEFT JOIN usuario AS empleado ON trabajador.cc_trabajador = empleado.codigo_usuario
LEFT JOIN dependencia ON dependencia.cod_dependencia = trabajador.id_dependencia
LEFT JOIN usuario AS jefe ON trabajador.id_jefe = jefe.codigo_usuario
LEFT JOIN cargo ON trabajador.id_cargo = cargo.id_cargo
LEFT JOIN municipio ON trabajador.id_municipio = municipio.id_municipio
LEFT JOIN tipo_contrato ON trabajador.id_tipo_vin_trabajador = tipo_contrato.id_tipo_contrato
WHERE
	trabajador.cc_trabajador = :id");
  $ConsultaSQL ->bindParam(':id', $id_trabajador, PDO::PARAM_INT);
  $ConsultaSQL ->execute();
  while ($row = $ConsultaSQL ->fetch(PDO::FETCH_ASSOC)) {
	$this->cedula=$row["codigo_usuario"];
	$this->nombre_trab=$row["nombre_trabajador"];
	$this->cedula_jefe=$row["codigo_jefe"];
	$this->id_cargo=$row["id_cargo"];
	$this->cargo=$row["nombre_cargo"];
	$this->id_area=$row["id_dependencia"];
	$this->area=$row["nombre_dependencia"];
	$this->genero=$row["genero_trabajador"];
	$this->vinculo=$row["vinculo"];
	$this->ciudad=$row["nombre_municipio"];
	}
		}

public function valores_clase_datos($id_trabajador){
  $this->conexion = parent::conectar(); 
  $ConsultaSQL = $this->conexion->prepare("
 SELECT
	trabajador.id_cargo,
	nombre_cargo,
 trabajador.id_nivel,
  nombre_nivel,
  empleado.correo_usuario
FROM
	trabajador
LEFT JOIN usuario AS empleado ON trabajador.cc_trabajador = empleado.codigo_usuario
LEFT JOIN cargo ON trabajador.id_cargo = cargo.id_cargo
LEFT JOIN nivel ON trabajador.id_nivel = nivel.id_nivel
WHERE
	trabajador.cc_trabajador = :id");
  $ConsultaSQL ->bindParam(':id', $id_trabajador, PDO::PARAM_INT);
  $ConsultaSQL ->execute();
  while ($row = $ConsultaSQL ->fetch(PDO::FETCH_ASSOC)) {
	$rows = $row;
	}
	 print json_encode($rows);
		} 
	
	public function valores_clase_cargo($id_trabajador){
  $this->conexion = parent::conectar(); 
  $ConsultaSQL = $this->conexion->prepare("
  SELECT
	Par.codigo_usuario,
	CONCAT(
		Par.nombres_usuario,
		' ',
		Par.apellidos_usuario
	) AS nombre_par
FROM
	trabajador
LEFT JOIN usuario AS Par ON Par.codigo_usuario = trabajador.cc_trabajador
WHERE
	id_cargo = (
		SELECT
			trabajador.id_cargo
		FROM
			trabajador
		WHERE
			cc_trabajador = :id
	) AND codigo_usuario != :id");
  $ConsultaSQL ->bindParam(':id', $id_trabajador);
  $ConsultaSQL ->execute();
  $opciones = '';
while ($row = $ConsultaSQL ->fetch(PDO::FETCH_ASSOC)) {
	$opciones.='<option value="'.$row["codigo_usuario"].'">'.$row["nombre_par"].'</option>';
	}
		echo $opciones;		
		}
		
	function valores_select_trabajador($id_jefe){
	$this->conexion = parent::conectar();
	$ConsultaSQL_l=$this->conexion->prepare("
	SELECT cc_trabajador, CONCAT(nombres_usuario,' ',apellidos_usuario) AS Empleado FROM trabajador LEFT JOIN usuario ON usuario.codigo_usuario=trabajador.cc_trabajador WHERE id_jefe=? AND id_tipo_vin_trabajador IN (2,3)");
	$ConsultaSQL_l ->bindParam(1, $id_jefe);
	$ConsultaSQL_l->execute();
echo "<select name='id_trab_select' id='id_trab_select' data-required='true'  style='width:100%'class='populate' data-required='true' multiple='multiple'>";	
while ($row = $ConsultaSQL_l ->fetch(PDO::FETCH_ASSOC)) {
    echo "<option value='".$row['cc_trabajador']."'>".$row['Empleado']."</option>";
}
echo "</select>";	
		}	

	function valores_select_trabajador_total($id_jefe){
	$this->conexion = parent::conectar();
	$ConsultaSQL_l=$this->conexion->prepare("
	SELECT cc_trabajador, CONCAT(nombres_usuario,' ',apellidos_usuario) AS Empleado FROM trabajador LEFT JOIN usuario ON usuario.codigo_usuario=trabajador.cc_trabajador WHERE cc_trabajador!=? AND id_tipo_vin_trabajador IN (2,3)");
	$ConsultaSQL_l ->bindParam(1, $id_jefe);
	$ConsultaSQL_l->execute();
echo "<select name='id_trab_total_select' id='id_trab_total_select' data-required='true'  style='width:100%'class='populate' data-required='true' multiple='multiple'>";	
while ($row = $ConsultaSQL_l ->fetch(PDO::FETCH_ASSOC)) {
    echo "<option value='".$row['cc_trabajador']."'>".$row['Empleado']."</option>";
}
echo "</select>";	
		}

		
	function valores_select_trabajador_general($id_jefe,$id_trabajador,$id_par){
	$this->conexion = parent::conectar();
	$ConsultaSQL_l=$this->conexion->prepare("
	SELECT
	cc_trabajador,
	CONCAT(
		nombres_usuario,
		' ',
		apellidos_usuario
	) AS Empleado
FROM
	trabajador
LEFT JOIN usuario ON usuario.codigo_usuario = trabajador.cc_trabajador
WHERE cc_trabajador NOT IN(:jefe,:trab,:par)");
	$ConsultaSQL_l ->bindParam(':jefe', $id_jefe);
	$ConsultaSQL_l ->bindParam(':trab', $id_trabajador);
	$ConsultaSQL_l ->bindParam(':par', $id_par);
	$ConsultaSQL_l->execute();
echo "<select name='id_trab_select' id='id_trab_select' data-required='true'  style='width:100%'class='populate' data-required='true' multiple='multiple'>";	
while ($row = $ConsultaSQL_l ->fetch(PDO::FETCH_ASSOC)) {
    echo "<option value='".$row['cc_trabajador']."'>".$row['Empleado']."</option>";
}
echo "</select>";	
		}
		

public function valores_clase_evaluacion($id_cod_obj){	//Clase Departamento
  $this->conexion = parent::conectar(); 
  $ConsultaSQL = $this->conexion->prepare("
  SELECT
	nombre_tipo_contrato AS vinculo,
  	gestion_desempeno.cod_evaluacion,
	CONCAT(
		usuario.nombres_usuario,
		' ',
		usuario.apellidos_usuario
	) AS nombre_jefe,
	cargo_jefe.nombre_cargo AS Cargo_Jefe,
	 trabajador.codigo_usuario,
CONCAT(
		trabajador.nombres_usuario,
		' ',
		trabajador.apellidos_usuario
	) AS nombre_trabajador,
cargo_trabajador.nombre_cargo AS Cargo_Trab,
nombre_dependencia,
  fecha_eva_objetivos,
trabajador_objetivos.fecha_ini_eva_objetivos,
trabajador_objetivos.fecha_fin_eva_objetivos,
trabajador_objetivos.fecha_eva_objetivos_conc,
trabajador_objetivos.estado_eva_objetivos,
fecha_inicio_evaluacion_objetivos,
fecha_fin_evaluacion_objetivos
FROM
	trabajador_objetivos
LEFT JOIN gestion_desempeno ON trabajador_objetivos.cod_evaluacion = gestion_desempeno.cod_evaluacion
LEFT JOIN usuario AS trabajador ON gestion_desempeno.cod_trabajador = trabajador.codigo_usuario
LEFT JOIN trabajador AS empleado ON gestion_desempeno.cod_trabajador = empleado.cc_trabajador
LEFT JOIN cargo AS cargo_trabajador ON gestion_desempeno.id_cargo_trabajador = cargo_trabajador.id_cargo
LEFT JOIN dependencia AS depe_trabajador ON gestion_desempeno.id_dependencia = depe_trabajador.cod_dependencia
LEFT JOIN trabajador AS jefe ON gestion_desempeno.cod_jefe = jefe.cc_trabajador
LEFT JOIN cargo AS cargo_jefe ON jefe.id_cargo = cargo_jefe.id_cargo
LEFT JOIN usuario ON jefe.cc_trabajador = usuario.codigo_usuario
LEFT JOIN tipo_contrato ON empleado.id_tipo_vin_trabajador = tipo_contrato.id_tipo_contrato
WHERE
	trabajador_objetivos.cod_evaluacion =  :id");
  $ConsultaSQL ->bindParam(':id', $id_cod_obj);
  $ConsultaSQL ->execute();
  while ($row = $ConsultaSQL ->fetch(PDO::FETCH_ASSOC)) {
	$this->cod_eva=$row["cod_evaluacion"];
	$this->nombre_jefe=$row["nombre_jefe"];
	$this->cod_trabajador=$row["codigo_usuario"];
	$this->cargo_jefe=$row["Cargo_Jefe"];
	$this->cargo_trab=$row["Cargo_Trab"];
	$this->area=$row["nombre_dependencia"];
	$this->fecha=$row["fecha_eva_objetivos"];
	$this->vinculo=$row["vinculo"];
	$this->fecha_in=$row["fecha_ini_eva_objetivos"];
	$this->fecha_fin=$row["fecha_fin_eva_objetivos"];
	$this->fecha_con=$row["fecha_eva_objetivos_conc"];
	$this->estado=$row["estado_eva_objetivos"];
	$this->inicio=$row["fecha_inicio_evaluacion_objetivos"];
	$this->fin=$row["fecha_fin_evaluacion_objetivos"];
	}
		}		
	
		function valores_clase_objetivos_select($id_trabajador){	//Lista id Area
	$this->conexion = parent::conectar();
	$ConsultaSQL_l=$this->conexion->prepare("
		SELECT
		*
	FROM
		trabajador_objetivos
	LEFT JOIN gestion_desempeno ON trabajador_objetivos.cod_evaluacion = gestion_desempeno.cod_evaluacion
	WHERE
		cod_trabajador =? ");
	$ConsultaSQL_l ->bindParam(1, $id_trabajador, PDO::PARAM_INT);
	$ConsultaSQL_l->execute();
echo "<select name='cod_eva_obj_select' id='cod_eva_obj_select' class='form-control' data-required='true'>";	
echo "<option value=''>Seleccionar un Año</option>";
while ($row = $ConsultaSQL_l ->fetch(PDO::FETCH_ASSOC)) {
    echo "<option value='".$row['cod_evaluacion']."'>".$row['ano_evaluacion']."</option>";
}
echo "</select>";	
		}		
		
function valores_clase_listado_objetivos($id_trabajador){ //POR AQUI
	$a=0;	
    $this->conexion = parent::conectar(); 
	$ConsultaSQL=$this->conexion->prepare("
SELECT
	gestion_desempeno.cod_evaluacion,
	estado_eva_objetivos,
	IFNULL(observacion_evaluacion_objetivos,'') AS observaciones,
	ano_evaluacion,
	CONCAT(
		empleado.nombres_usuario,
		' ',
		empleado.apellidos_usuario
	) AS nombre_trabajador,
	cargo_empleado.nombre_cargo,
	CONCAT(
		jefe.nombres_usuario,
		' ',
		jefe.apellidos_usuario
	) AS nombre_jefe,
	nombre_dependencia
FROM
	trabajador_objetivos
LEFT JOIN gestion_desempeno ON trabajador_objetivos.cod_evaluacion = gestion_desempeno.cod_evaluacion
LEFT JOIN usuario AS empleado ON gestion_desempeno.cod_trabajador = empleado.codigo_usuario
LEFT JOIN cargo AS cargo_empleado ON gestion_desempeno.id_cargo_trabajador = cargo_empleado.id_cargo
LEFT JOIN dependencia AS dependencia_empleado ON gestion_desempeno.id_dependencia = dependencia_empleado.cod_dependencia
LEFT JOIN usuario AS jefe ON gestion_desempeno.cod_jefe = jefe.codigo_usuario
WHERE
	cod_trabajador = :id AND (estado_eva_objetivos = :estado OR estado_eva_objetivos = :estado_a)");
//AND 
//(SELECT IF(estado_configuracion = 'Activa',1,0) FROM configuracion WHERE configuracion.id_configuracion = 1) = 1	
//	");
	$estado='Sin Aprobar';
	$estado_a='Aprobado';	
	$ConsultaSQL ->bindParam(':id', $id_trabajador, PDO::PARAM_INT);
	$ConsultaSQL ->bindParam(':estado', $estado);
	$ConsultaSQL ->bindParam(':estado_a', $estado_a);
	$ConsultaSQL->execute();
	$numero_filas = $ConsultaSQL->rowCount();
	if(empty($numero_filas)){
		echo "No existen Datos.";
		}
	else{
  echo '<table  class="table table-striped table-hover table-bordered">
							  <thead>
								  <tr>
									  <th></th>
									  <th>Año</th> 
									  <th>Trabajador</th> 
									  <th>Cargo</th> 
									  <th>Jefe</th>	
									  <th>Estado</th>	
									  <th>Observaciones</th> 									  
									  <th></th>                                     
								  </tr>
							  </thead>   
							  <tbody>';
while ($row = $ConsultaSQL->fetch(PDO::FETCH_ASSOC)) {
if($row["estado_eva_objetivos"]=='Sin Aprobar'){$color="primary";}elseif($row["estado_eva_objetivos"]=='Aprobado'){$color="success";}else{$color="danger";}
$a++;
printf("<tr>
<td>%s</td><td>%s</td>
<td>%s</td><td>%s</td>
<td>%s</td><td>%s</td>
<td>%s</td><td>%s</td>
</tr>",
$a,
$row["ano_evaluacion"],
$row["nombre_trabajador"],
$row["nombre_cargo"],
$row["nombre_jefe"],
"<span class='label label-".$color."'>".$row["estado_eva_objetivos"]."</span>",
$row["observaciones"],
"<a class='btn btn-success re_obj' data-toggle='modal' data-rel='tooltip' title='Editar'  href='#obs_info'  id='".$row["cod_evaluacion"]."'><i class='fa fa-share-square-o'> </i></a>"); 
	 }                                                                       
	echo '</tbody></table>';
	}		
}

function valores_clase_listado_mejora($id_trabajador){//Lista Objetivos 
	$a=0;	
    $this->conexion = parent::conectar(); 
	$ConsultaSQL=$this->conexion->prepare("
	SELECT
	gestion_desempeno.cod_evaluacion,
	ano_evaluacion,
	CONCAT(
		empleado.nombres_usuario,
		' ',
		empleado.apellidos_usuario
	) AS nombre_trabajador,
	cargo_empleado.nombre_cargo,
	CONCAT(
		jefe.nombres_usuario,
		' ',
		jefe.apellidos_usuario
	) AS nombre_jefe,
	nombre_dependencia, estado_plan_mejora
FROM
	trabajador_plan_mejora
LEFT JOIN gestion_desempeno ON trabajador_plan_mejora.cod_evaluacion = gestion_desempeno.cod_evaluacion
LEFT JOIN usuario AS empleado ON gestion_desempeno.cod_trabajador = empleado.codigo_usuario
LEFT JOIN cargo AS cargo_empleado ON gestion_desempeno.id_cargo_trabajador = cargo_empleado.id_cargo
LEFT JOIN dependencia AS dependencia_empleado ON gestion_desempeno.id_dependencia = dependencia_empleado.cod_dependencia
LEFT JOIN usuario AS jefe ON gestion_desempeno.cod_jefe = jefe.codigo_usuario
WHERE
	gestion_desempeno.cod_trabajador = :id AND estado_plan_mejora IN ('Pendiente','Aprobado','Sin Aprobar')");
	$ConsultaSQL ->bindParam(':id', $id_trabajador, PDO::PARAM_INT);
	$ConsultaSQL->execute();
	$numero_filas = $ConsultaSQL->rowCount();
	if(empty($numero_filas)){
		echo "No existen Datos.";
		}
	else{
  echo '<table  class="table table-striped table-hover table-bordered">
							  <thead>
								  <tr>
									  <th></th>
									  <th>Año</th> 
									  <th>Trabajador</th> 
									  <th>Dependencia</th> 
									  <th>Cargo</th> 
									  <th>Jefe</th>	
									  <th>Estado</th>										  
									  <th></th>                                     
								  </tr>
							  </thead>   
							  <tbody>';
while ($row = $ConsultaSQL->fetch(PDO::FETCH_ASSOC)) {
if($row["estado_plan_mejora"]=='Pendiente'){$color="warning";}elseif($row["estado_plan_mejora"]=='Aprobado'){$color="success";}elseif($row["estado_plan_mejora"]=='Sin Aprobar'){$color="inverse";}else{$color="danger";}
$a++;
printf("<tr>
<td>%s</td><td>%s</td>
<td>%s</td><td>%s</td>
<td>%s</td><td>%s</td>
<td>%s</td><td>%s</td>
</tr>",
$a,
$row["ano_evaluacion"],
$row["nombre_trabajador"],
$row["nombre_dependencia"],
$row["nombre_cargo"],
$row["nombre_jefe"],
"<span class='label label-".$color."'>".$row["estado_plan_mejora"]."</span>",
"<a class='btn btn-success re_mej' data-toggle='modal' data-rel='tooltip' title='Editar'  href='#obs_info'  id='".$row["cod_evaluacion"]."'><i class='fa fa-share-square-o'> </i></a>"); 
	 }                                                                       
	echo '</tbody></table>';
	}		
}	

function valores_clase_historial_mejora($id_trabajador){//Lista Objetivos 
	$a=0;	
    $this->conexion = parent::conectar(); 
	$ConsultaSQL=$this->conexion->prepare("
	SELECT
	gestion_desempeno.cod_evaluacion,
	ano_evaluacion,
	CONCAT(
		empleado.nombres_usuario,
		' ',
		empleado.apellidos_usuario
	) AS nombre_trabajador,
	cargo_empleado.nombre_cargo,
	CONCAT(
		jefe.nombres_usuario,
		' ',
		jefe.apellidos_usuario
	) AS nombre_jefe,
	nombre_dependencia, estado_plan_mejora
FROM
	trabajador_plan_mejora
LEFT JOIN gestion_desempeno ON gestion_desempeno.cod_evaluacion = trabajador_plan_mejora.cod_evaluacion
LEFT JOIN usuario AS empleado ON gestion_desempeno.cod_trabajador = empleado.codigo_usuario
LEFT JOIN cargo AS cargo_empleado ON gestion_desempeno.id_cargo_trabajador = cargo_empleado.id_cargo
LEFT JOIN dependencia AS dependencia_empleado ON gestion_desempeno.id_dependencia = dependencia_empleado.cod_dependencia
LEFT JOIN usuario AS jefe ON gestion_desempeno.cod_jefe = jefe.codigo_usuario
WHERE
	gestion_desempeno.cod_trabajador =:id AND estado_plan_mejora IN ('Finalizada')");
	$ConsultaSQL ->bindParam(':id', $id_trabajador, PDO::PARAM_INT);
	$ConsultaSQL->execute();
	$numero_filas = $ConsultaSQL->rowCount();
	if(empty($numero_filas)){
		echo "No existen Datos.";
		}
	else{
  echo '<table  class="table table-striped table-hover table-bordered">
							  <thead>
								  <tr>
									  <th></th>
									  <th>Año</th> 
									  <th>Trabajador</th> 
									  <th>Dependencia</th> 
									  <th>Cargo</th> 
									  <th>Jefe</th>	
									  <th>Estado</th>										  
									  <th></th>                                     
								  </tr>
							  </thead>   
							  <tbody>';
while ($row = $ConsultaSQL->fetch(PDO::FETCH_ASSOC)) {
if($row["estado_plan_mejora"]=='Pendiente'){$color="warning";}elseif($row["estado_plan_mejora"]=='Aprobado'){$color="success";}elseif($row["estado_plan_mejora"]=='Sin Aprobar'){$color="inverse";}else{$color="danger";}
$a++;
printf("<tr>
<td>%s</td><td>%s</td>
<td>%s</td><td>%s</td>
<td>%s</td><td>%s</td>
<td>%s</td><td>%s</td>
</tr>",
$a,
$row["ano_evaluacion"],
$row["nombre_trabajador"],
$row["nombre_dependencia"],
$row["nombre_cargo"],
$row["nombre_jefe"],
"<span class='label label-".$color."'>".$row["estado_plan_mejora"]."</span>",
"<a class='btn btn-primary ver_mej' data-toggle='modal' data-rel='tooltip' title='Editar'  href='#obs_info'  id='".$row["cod_evaluacion"]."'><i class='fa fa-search'> </i></a>"); 
	 }                                                                       
	echo '</tbody></table>';
	}		
}

function valores_clase_listado_mejora_jefe($id_jefe){//Lista Objetivos 
	$a=0;	
    $this->conexion = parent::conectar(); 
	$ConsultaSQL=$this->conexion->prepare("
	SELECT
	gestion_desempeno.cod_evaluacion,
	ano_evaluacion,
	CONCAT(
		empleado.nombres_usuario,
		' ',
		empleado.apellidos_usuario
	) AS nombre_trabajador,
	cargo_empleado.nombre_cargo,
	CONCAT(
		jefe.nombres_usuario,
		' ',
		jefe.apellidos_usuario
	) AS nombre_jefe,
	nombre_dependencia, estado_plan_mejora
FROM
	trabajador_plan_mejora
LEFT JOIN gestion_desempeno ON gestion_desempeno.cod_evaluacion = trabajador_plan_mejora.cod_evaluacion
LEFT JOIN usuario AS empleado ON gestion_desempeno.cod_trabajador = empleado.codigo_usuario
LEFT JOIN cargo AS cargo_empleado ON gestion_desempeno.id_cargo_trabajador = cargo_empleado.id_cargo
LEFT JOIN dependencia AS dependencia_empleado ON gestion_desempeno.id_dependencia = dependencia_empleado.cod_dependencia
LEFT JOIN usuario AS jefe ON gestion_desempeno.cod_jefe = jefe.codigo_usuario
WHERE
	gestion_desempeno.cod_jefe = :id AND estado_plan_mejora IN ('Pendiente','Aprobado','Sin Aprobar')");
	$ConsultaSQL ->bindParam(':id', $id_jefe, PDO::PARAM_INT);
	$ConsultaSQL->execute();
	$numero_filas = $ConsultaSQL->rowCount();
	if(empty($numero_filas)){
		echo "No existen Datos.";
		}
	else{
  echo '<table  class="table table-striped table-hover table-bordered" id="dynamic-table">
							  <thead>
								  <tr>
									  <th></th>
									  <th>Año</th> 
									  <th>Trabajador</th> 
									  <th>Dependencia</th> 
									  <th>Cargo</th> 
									  <th>Jefe</th>	
									  <th>Estado</th>										  
									  <th></th>                                     
								  </tr>
							  </thead>   
							  <tbody>';
while ($row = $ConsultaSQL->fetch(PDO::FETCH_ASSOC)) {
if($row["estado_plan_mejora"]=='Pendiente'){$color="warning";}elseif($row["estado_plan_mejora"]=='Aprobado'){$color="success";}elseif($row["estado_plan_mejora"]=='Sin Aprobar'){$color="inverse";}else{$color="danger";}
$a++;
printf("<tr>
<td>%s</td><td>%s</td>
<td>%s</td><td>%s</td>
<td>%s</td><td>%s</td>
<td>%s</td><td>%s</td>
</tr>",
$a,
$row["ano_evaluacion"],
$row["nombre_trabajador"],
$row["nombre_dependencia"],
$row["nombre_cargo"],
$row["nombre_jefe"],
"<span class='label label-".$color."'>".$row["estado_plan_mejora"]."</span>",
"
<a class='btn btn-success aprobar' data-toggle='modal' data-rel='tooltip' title='Estado' href='#aprobar_info'   id='".$row["cod_evaluacion"]."'><i class='fa fa-share-square-o'> </i></a>
<a class='btn btn-primary re_mej' data-toggle='modal' data-rel='tooltip' title='Editar'  href='#obs_info'  id='".$row["cod_evaluacion"]."'><i class='fa fa-search'> </i></a>"); 
	 }                                                                       
	echo '</tbody></table>';
	}		
}

function valores_clase_historial_mejora_jefe($id_jefe){//Lista Objetivos 
	$a=0;	
    $this->conexion = parent::conectar(); 
	$ConsultaSQL=$this->conexion->prepare("
	SELECT
	gestion_desempeno.cod_evaluacion,
	ano_evaluacion,
	CONCAT(
		empleado.nombres_usuario,
		' ',
		empleado.apellidos_usuario
	) AS nombre_trabajador,
	cargo_empleado.nombre_cargo,
	CONCAT(
		jefe.nombres_usuario,
		' ',
		jefe.apellidos_usuario
	) AS nombre_jefe,
	nombre_dependencia, estado_plan_mejora
FROM
	trabajador_plan_mejora
LEFT JOIN gestion_desempeno ON gestion_desempeno.cod_evaluacion = trabajador_plan_mejora.cod_evaluacion
LEFT JOIN usuario AS empleado ON gestion_desempeno.cod_trabajador = empleado.codigo_usuario
LEFT JOIN cargo AS cargo_empleado ON gestion_desempeno.id_cargo_trabajador = cargo_empleado.id_cargo
LEFT JOIN dependencia AS dependencia_empleado ON gestion_desempeno.id_dependencia = dependencia_empleado.cod_dependencia
LEFT JOIN usuario AS jefe ON gestion_desempeno.cod_jefe = jefe.codigo_usuario
WHERE
	gestion_desempeno.cod_jefe = :id AND estado_plan_mejora IN ('Finalizada')");
	$ConsultaSQL ->bindParam(':id', $id_jefe, PDO::PARAM_INT);
	$ConsultaSQL->execute();
	$numero_filas = $ConsultaSQL->rowCount();
	if(empty($numero_filas)){
		echo "No existen Datos.";
		}
	else{
  echo '<table  class="table table-striped table-hover table-bordered" id="dynamic-table">
							  <thead>
								  <tr>
									  <th></th>
									  <th>Año</th> 
									  <th>Trabajador</th> 
									  <th>Dependencia</th> 
									  <th>Cargo</th> 
									  <th>Jefe</th>	
									  <th>Estado</th>										  
									  <th></th>                                     
								  </tr>
							  </thead>   
							  <tbody>';
while ($row = $ConsultaSQL->fetch(PDO::FETCH_ASSOC)) {
if($row["estado_plan_mejora"]=='Pendiente'){$color="warning";}elseif($row["estado_plan_mejora"]=='Aprobado'){$color="success";}elseif($row["estado_plan_mejora"]=='Sin Aprobar'){$color="inverse";}else{$color="danger";}
$a++;
printf("<tr>
<td>%s</td><td>%s</td>
<td>%s</td><td>%s</td>
<td>%s</td><td>%s</td>
<td>%s</td><td>%s</td>
</tr>",
$a,
$row["ano_evaluacion"],
$row["nombre_trabajador"],
$row["nombre_dependencia"],
$row["nombre_cargo"],
$row["nombre_jefe"],
"<span class='label label-".$color."'>".$row["estado_plan_mejora"]."</span>",
"
<a class='btn btn-primary ver_mej' data-toggle='modal' data-rel='tooltip' title='Ver'  href='#obs_info'  id='".$row["cod_evaluacion"]."'><i class='fa fa-search'> </i></a>"); 
	 }                                                                       
	echo '</tbody></table><br><br>';
	}		
}

function valores_clase_historial_objetivos($id_trabajador){//Lista Objetivos 
	$a=0;	
    $this->conexion = parent::conectar(); 
	$ConsultaSQL=$this->conexion->prepare("
	SELECT
	gestion_desempeno.cod_evaluacion,
	estado_eva_objetivos,
	ano_evaluacion,
	CONCAT(
		empleado.nombres_usuario,
		' ',
		empleado.apellidos_usuario
	) AS nombre_trabajador,
	cargo_empleado.nombre_cargo,
	CONCAT(
		jefe.nombres_usuario,
		' ',
		jefe.apellidos_usuario
	) AS nombre_jefe,
	nombre_dependencia
FROM
	trabajador_objetivos
LEFT JOIN gestion_desempeno ON trabajador_objetivos.cod_evaluacion = gestion_desempeno.cod_evaluacion
LEFT JOIN usuario AS empleado ON gestion_desempeno.cod_trabajador = empleado.codigo_usuario
LEFT JOIN cargo AS cargo_empleado ON gestion_desempeno.id_cargo_trabajador = cargo_empleado.id_cargo
LEFT JOIN dependencia AS dependencia_empleado ON gestion_desempeno.id_dependencia = dependencia_empleado.cod_dependencia
LEFT JOIN usuario AS jefe ON gestion_desempeno.cod_jefe = jefe.codigo_usuario
WHERE
	cod_trabajador = :id AND estado_eva_objetivos = :estado
	");
	$estado='Finalizada';
	$ConsultaSQL ->bindParam(':id', $id_trabajador, PDO::PARAM_INT);
	$ConsultaSQL ->bindParam(':estado', $estado);
	$ConsultaSQL->execute();
	$numero_filas = $ConsultaSQL->rowCount();
	if(empty($numero_filas)){
		echo "No existen Datos.";
		}
	else{
  echo '<table  class="table table-striped table-hover table-bordered" id="dynamic-table">
							  <thead>
								  <tr>
									  <th></th>
									  <th>Año</th> 
									  <th>Trabajador</th> 
									  <th>Dependencia</th> 
									  <th>Cargo</th> 
									  <th>Jefe</th>	
									  <th>Estado</th>										  
									  <th></th>                                     
								  </tr>
							  </thead>   
							  <tbody>';
while ($row = $ConsultaSQL->fetch(PDO::FETCH_ASSOC)) {
if($row["estado_eva_objetivos"]=='Sin Aprobar'){$color="primary";}elseif($row["estado_eva_objetivos"]=='Aprobado'){$color="success";}else{$color="danger";}
$a++;
printf("<tr>
<td>%s</td><td>%s</td>
<td>%s</td><td>%s</td>
<td>%s</td><td>%s</td>
<td>%s</td><td>%s</td>
</tr>",
$a,
$row["ano_evaluacion"],
$row["nombre_trabajador"],
$row["nombre_dependencia"],
$row["nombre_cargo"],
$row["nombre_jefe"],
"<span class='label label-".$color."'>".$row["estado_eva_objetivos"]."</span>",
"<a class='btn btn-success ver' data-toggle='modal' data-rel='tooltip' title='Editar'  href='#obs_info'  id='".$row["cod_evaluacion"]."'><i class='fa fa-share-square-o'> </i></a>"); 
	 }                                                                       
	echo '</tbody></table>';
	}		
}	

	
function valores_clase_listado_objetivos_jefe($id_jefe){//Lista Objetivos 
	$a=0;	
    $this->conexion = parent::conectar(); 
	$ConsultaSQL=$this->conexion->prepare("
SELECT
	trabajador_objetivos.cod_evaluacion,
	estado_eva_objetivos,
	ano_evaluacion,
	IFNULL(observacion_evaluacion_objetivos,'') AS observaciones,
	CONCAT(
		empleado.nombres_usuario,
		' ',
		empleado.apellidos_usuario
	) AS nombre_trabajador,
	cargo_empleado.nombre_cargo,
	CONCAT(
		jefe.nombres_usuario,
		' ',
		jefe.apellidos_usuario
	) AS nombre_jefe,
	nombre_dependencia,
	estado_eva_primer_objetivos,
	estado_eva_segundo_objetivos,
	estado_eva_tercer_objetivos
FROM
	trabajador_objetivos
LEFT JOIN gestion_desempeno ON trabajador_objetivos.cod_evaluacion = gestion_desempeno.cod_evaluacion
LEFT JOIN usuario AS empleado ON gestion_desempeno.cod_trabajador = empleado.codigo_usuario
LEFT JOIN cargo AS cargo_empleado ON gestion_desempeno.id_cargo_trabajador = cargo_empleado.id_cargo
LEFT JOIN dependencia AS dependencia_empleado ON gestion_desempeno.id_dependencia = dependencia_empleado.cod_dependencia
LEFT JOIN usuario AS jefe ON gestion_desempeno.cod_jefe = jefe.codigo_usuario
WHERE
	cod_jefe = :id AND (estado_eva_objetivos = :estado OR estado_eva_objetivos = :estado_a)
	");
	$estado='Sin Aprobar';
	$estado_a='Aprobado';
	$ConsultaSQL ->bindParam(':id', $id_jefe, PDO::PARAM_INT);
	$ConsultaSQL ->bindParam(':estado', $estado);
	$ConsultaSQL ->bindParam(':estado_a', $estado_a);
	$ConsultaSQL->execute();
	$numero_filas = $ConsultaSQL->rowCount();
	if(empty($numero_filas)){
		echo "No existen Datos.";
		}
	else{
  echo '<table  class="table table-striped table-hover table-bordered" id="dynamic-table">
							  <thead>
								  <tr>      
									  <td width="5%" align="center">Nº</td>
									  <td width="5%" align="center">Año</td>
									  <td width="20%" align="center">Trabajador</td> 
									  <td width="10%" align="center">Inicial</td> 
									  <td width="10%" align="center">Primer</td> 
									  <td width="10%" align="center">Segundo</td> 
									  <td width="10%" align="center">Tercer</td> 
									  <td width="20%" align="center">Observaciones</td>  
									  <td width="10%" align="center"></td>                           
								  </tr>
							  </thead>   
							  <tbody>';
while ($row = $ConsultaSQL->fetch(PDO::FETCH_ASSOC)) {
if($row["estado_eva_objetivos"]=='Sin Aprobar'){$colora="primary";}elseif($row["estado_eva_objetivos"]=='Aprobado'){$colora="success";}else{$colora="danger";}
if($row["estado_eva_primer_objetivos"]=='Sin Aprobar'){$colorb="primary";}elseif($row["estado_eva_primer_objetivos"]=='Aprobado'){$colorb="success";}else{$color="danger";}
if($row["estado_eva_segundo_objetivos"]=='Sin Aprobar'){$colorc="primary";}elseif($row["estado_eva_segundo_objetivos"]=='Aprobado'){$colorc="success";}else{$color="danger";}
if($row["estado_eva_tercer_objetivos"]=='Sin Aprobar'){$colord="primary";}elseif($row["estado_eva_tercer_objetivos"]=='Aprobado'){$colord="success";}else{$color="danger";}
$a++;
printf("<tr>
<td align='center'>%s</td><td align='center'>%s</td>
<td>%s</td><td align='center'>%s</td>
<td align='center'>%s</td><td align='center'>%s</td>
<td align='center'>%s</td><td align='center'>%s</td>
<td>%s</td>
</tr>",
$a,
$row["ano_evaluacion"],
$row["nombre_trabajador"],
"<span class='label label-".$colora."'>".$row["estado_eva_objetivos"]."</span>",
"<span class='label label-".$colorb."'>".$row["estado_eva_primer_objetivos"]."</span>",
"<span class='label label-".$colorc."'>".$row["estado_eva_segundo_objetivos"]."</span>",
"<span class='label label-".$colord."'>".$row["estado_eva_tercer_objetivos"]."</span>",
$row["observaciones"],
"
<div class='btn-group'>
  <button data-toggle='dropdown' class='btn btn-default dropdown-toggle' type='button'> <span class='caret'></span></button>
  <ul role='menu' class='dropdown-menu'>
    <li><a href='#ver' data-placement='left' data-rel='tooltip'  data-original-title='Ver Evaluación'  class='ver' id='".$row["cod_evaluacion"]."' ><i class='fa  fa-search'></i> Ver</a></li>
    <li><a href='#aprobar_info' data-placement='left' data-toggle='modal'  data-rel='tooltip'  data-original-title='Validar Objetivos'  id='".$row["cod_evaluacion"]."' rel='0' class='aprobar'><i class='fa fa-check'></i> Iniciales</a></li>    
    <li><a href='#aprobar_info_seg' data-placement='left' data-toggle='modal'  data-rel='tooltip'  data-original-title='Validar Objetivos'  id='".$row["cod_evaluacion"]."' rel='1' class='aprobar_seg'>1° Seguimiento</a></li>
    <li><a href='#aprobar_info_seg' data-placement='left' data-toggle='modal'  data-rel='tooltip'  data-original-title='Validar Objetivos'  id='".$row["cod_evaluacion"]."' rel='2' class='aprobar_seg'>2° Seguimiento</a></li>
    <li><a href='#aprobar_info_seg' data-placement='left' data-toggle='modal'  data-rel='tooltip'  data-original-title='Validar Objetivos'  id='".$row["cod_evaluacion"]."' rel='3' class='aprobar_seg'>3° Seguimiento</a></li>
  </ul>
</div>
"); 
	 }                                                                       
	echo '</tbody></table>';
	}		
}	
	
function valores_clase_historial_objetivos_jefe($id_jefe){//Lista Objetivos 
	$a=0;	
    $this->conexion = parent::conectar(); 
	$ConsultaSQL=$this->conexion->prepare("
	SELECT
	gestion_desempeno.cod_evaluacion,
	estado_eva_objetivos,
	ano_evaluacion,
	CONCAT(
		empleado.nombres_usuario,
		' ',
		empleado.apellidos_usuario
	) AS nombre_trabajador,
	cargo_empleado.nombre_cargo,
	CONCAT(
		jefe.nombres_usuario,
		' ',
		jefe.apellidos_usuario
	) AS nombre_jefe,
	nombre_dependencia
FROM
	trabajador_objetivos
LEFT JOIN gestion_desempeno ON trabajador_objetivos.cod_evaluacion = gestion_desempeno.cod_evaluacion
LEFT JOIN usuario AS empleado ON gestion_desempeno.cod_trabajador = empleado.codigo_usuario
LEFT JOIN cargo AS cargo_empleado ON gestion_desempeno.id_cargo_trabajador = cargo_empleado.id_cargo
LEFT JOIN dependencia AS dependencia_empleado ON gestion_desempeno.id_dependencia = dependencia_empleado.cod_dependencia
LEFT JOIN usuario AS jefe ON gestion_desempeno.cod_jefe = jefe.codigo_usuario
WHERE
	cod_jefe = :id AND estado_eva_objetivos = :estado
	");
	$estado='Finalizada';
	$ConsultaSQL ->bindParam(':id', $id_jefe, PDO::PARAM_INT);
	$ConsultaSQL ->bindParam(':estado', $estado);
	$ConsultaSQL->execute();
	$numero_filas = $ConsultaSQL->rowCount();
	if(empty($numero_filas)){
		echo "No existen Datos.";
		}
	else{
  echo '<table  class="table table-striped table-hover table-bordered" id="dynamic-table">
							  <thead>
								  <tr>
									  <th></th>
									  <th>Año</th> 
									  <th>Trabajador</th> 
									  <th>Dependencia</th> 
									  <th>Cargo</th> 	
									  <th>Estado</th>										  
									  <th></th>                                     
								  </tr>
							  </thead>   
							  <tbody>';
while ($row = $ConsultaSQL->fetch(PDO::FETCH_ASSOC)) {
if($row["estado_eva_objetivos"]=='Sin Aprobar'){$color="primary";}elseif($row["estado_eva_objetivos"]=='Aprobado'){$color="success";}else{$color="danger";}
$a++;
printf("<tr>
<td>%s</td><td>%s</td>
<td>%s</td><td>%s</td>
<td>%s</td>
<td>%s</td><td>%s</td>
</tr>",
$a,
$row["ano_evaluacion"],
$row["nombre_trabajador"],
$row["nombre_dependencia"],
$row["nombre_cargo"],
"<span class='label label-".$color."'>".$row["estado_eva_objetivos"]."</span>",
"
<a class='btn btn-info ver' data-toggle='modal' data-rel='tooltip' title='Ver'  href='#objetivos_info' id='".$row["cod_evaluacion"]."'><i class='fa fa-search'> </i></a>"); 
	 }                                                                       
	echo '</tbody></table>';
	}		
}		

public function valores_clase_anio($id_trabajador,$ano){
	sleep(1);
  $this->conexion = parent::conectar();
  	if(empty($id_trabajador)){
		echo '<div id="Error"><img src="../estilos/images/campo_vacio.png" alt="" />
		</div>';
		}
	else{ 
  $ConsultaSQL = $this->conexion->prepare("
  SELECT
	*
FROM
	trabajador_evaluacion
LEFT JOIN gestion_desempeno ON trabajador_evaluacion.cod_evaluacion = trabajador_evaluacion.cod_evaluacion
WHERE ano_evaluacion=:ano AND cod_trabajador=:id
  ");
  $ConsultaSQL ->bindParam(':id', $id_trabajador, PDO::PARAM_INT);
  $ConsultaSQL ->bindParam(':ano', $ano);
  $ConsultaSQL ->execute();
  $num_rows = $ConsultaSQL->fetchColumn();
    if($num_rows > 0){
        echo '<script>var bla = $("#id_valida_anio").val(1);</script>';
    //	echo '<script>$("#generar").hide(); document.getElementById("generar").disabled = true;</script>';
        echo '<div class="alert alert-block alert-danger fade in">
                    <button data-dismiss="alert" class="close close-sm" type="button">
                        <i class="fa fa-times"></i>
                         </button>
							<strong>Atencion!</strong> Este trabajador tiene una evaluación pendiente para el año seleccionado.
                </div>				
		';}
    else{
        echo '<script>var bla = $("#id_valida_anio").val(0);</script>';
    	//echo '<script> $("#generar").show(); document.getElementById("generar").disabled = false;</script>';
			 }		 
	}
}

public function valores_clase_eva_par($id_trabajador,$ano){
	sleep(1);
  $this->conexion = parent::conectar();
  	if(empty($id_trabajador)){
		echo '<div id="Error"><img src="../estilos/images/campo_vacio.png" alt="" />
		</div>';
		}
	else{ 
  $ConsultaSQL = $this->conexion->prepare("
  SELECT
	COUNT(id_evaluacion) AS total_eva
FROM
	evaluacion
LEFT JOIN gestion_desempeno ON gestion_desempeno.cod_evaluacion = evaluacion.cod_evaluacion
WHERE
	evaluacion.cod_evaluador = :id AND gestion_desempeno.ano_evaluacion = :ano
  ");
  $ConsultaSQL ->bindParam(':id', $id_trabajador, PDO::PARAM_INT);
  $ConsultaSQL ->bindParam(':ano', $ano);
  $ConsultaSQL ->execute();
  while($row = $ConsultaSQL->fetch(PDO::FETCH_ASSOC)) {
      $total_eva = $row["total_eva"];
  }
    if($total_eva >= 3){
        echo '<script>var bla = $("#id_valida_par").val(1);</script>';
    	//echo '<script>$("#generar").hide(); document.getElementById("generar").disabled = true;</script>';
        echo '<div class="alert alert-block alert-danger fade in">
                    <button data-dismiss="alert" class="close close-sm" type="button">
                        <i class="fa fa-times"></i>
                         </button>
							<strong>Atencion!</strong> Este empleado tiene mas de 3 evaluaciones para este año.
                </div>				
		';}
    else{
        echo '<script>var bla = $("#id_valida_par").val(0);</script>';
        // echo $total_eva;
    	// echo '<script> $("#generar").show(); document.getElementById("generar").disabled = false;</script>';
			 }		 
	}
}

public function valores_clase_eva_usu($id_trabajador,$ano){
	sleep(1);
  $this->conexion = parent::conectar();
  	if(empty($id_trabajador)){
		echo '<div id="Error"><img src="../estilos/images/campo_vacio.png" alt="" />
		</div>';
		}
	else{ 
  $ConsultaSQL = $this->conexion->prepare("
  SELECT
	COUNT(id_evaluacion) AS total_eva
FROM
	evaluacion
LEFT JOIN gestion_desempeno ON gestion_desempeno.cod_evaluacion = evaluacion.cod_evaluacion
WHERE
	evaluacion.cod_evaluador = :id AND gestion_desempeno.ano_evaluacion = :ano
  ");
  $ConsultaSQL ->bindParam(':id', $id_trabajador, PDO::PARAM_INT);
  $ConsultaSQL ->bindParam(':ano', $ano);
  $ConsultaSQL ->execute();
  while($row = $ConsultaSQL->fetch(PDO::FETCH_ASSOC)) {
      $total_eva = $row["total_eva"];
  }
    if($total_eva >= 3){
        echo '<script>var bla = $("#id_valida_usuario").val(1);</script>';
    	//echo '<script>$("#generar").hide(); document.getElementById("generar").disabled = true;</script>';
        echo '<div class="alert alert-block alert-danger fade in">
                    <button data-dismiss="alert" class="close close-sm" type="button">
                        <i class="fa fa-times"></i>
                         </button>
							<strong>Atencion!</strong> Este empleado tiene mas de 3 evaluaciones para este año.
                </div>				
		';}
    else{
        echo '<script>var bla = $("#id_valida_usuario").val(0);</script>';
        // echo $total_eva;
    	// echo '<script> $("#generar").show(); document.getElementById("generar").disabled = false;</script>';
			 }		 
	}
}

public function valores_clase_peso($id_eva,$estado,$num_seg){
	sleep(1);
  $this->conexion = parent::conectar();
  	if(empty($id_eva)){
		echo '<div id="Error"><img src="../estilos/images/campo_vacio.png" alt="" />
		</div>';
		}
	else{ 
  $ConsultaSQL = $this->conexion->prepare("
  SELECT
IFNULL(SUM(peso_porcentaje),0) AS suma
FROM
	objetivos
WHERE cod_evaluacion=:id AND n_seguimiento_objetivo = :seg
  "); 
  $ConsultaSQL ->bindParam(':id', $id_eva, PDO::PARAM_INT);
   $ConsultaSQL ->bindParam(':seg', $num_seg, PDO::PARAM_INT);
  $ConsultaSQL ->execute();
  while($row = $ConsultaSQL->fetch(PDO::FETCH_ASSOC)) {
      $suma = $row["suma"];
  }
   if($suma != 100 && $estado != "Sin Aprobar"){
   	    echo '<script> $("#cod_pro").val("0"); document.getElementById("enviar").disabled = true;</script>';
        echo '<div class="alert alert-block alert-danger fade in">
                    <button data-dismiss="alert" class="close close-sm" type="button">
                        <i class="fa fa-times"></i>
                         </button>
							<strong>Atencion!</strong> La suma de los pesos no es igual a 100, verifique.
                </div>				
		';}
    elseif($suma != 100 && $estado == "Sin Aprobar") {
    	   echo '<script> $("#cod_pro").val("100"); document.getElementById("enviar").disabled = false;</script>';
           echo '<div class="alert alert-block alert-success fade in">
                    <button data-dismiss="alert" class="close close-sm" type="button">
                        <i class="fa fa-times"></i>
                         </button>
							<strong>Atencion!</strong> La suma de los pesos no es igual a 100, verifique.
                </div>				
		';
			 }	
			 else{

			 }
	}
}

function valores_listado_trabajador($id_jefe){//Lista Objetivos 
	$a=0;	
    $this->conexion = parent::conectar(); 
	$ConsultaSQL=$this->conexion->prepare("
	SELECT
	trabajador.cc_trabajador,
	CONCAT(
		empleado.nombres_usuario,
		' ',
		empleado.apellidos_usuario
	) AS nombre_trabajador,
	cargo_empleado.nombre_cargo,
	CONCAT(
		jefe.nombres_usuario,
		' ',
		jefe.apellidos_usuario
	) AS nombre_jefe,
	nombre_dependencia
FROM
	trabajador
LEFT JOIN usuario AS empleado ON trabajador.cc_trabajador = empleado.codigo_usuario
LEFT JOIN cargo AS cargo_empleado ON trabajador.id_cargo = cargo_empleado.id_cargo
LEFT JOIN dependencia AS dependencia_empleado ON trabajador.id_dependencia = dependencia_empleado.cod_dependencia
LEFT JOIN usuario AS jefe ON trabajador.id_jefe = jefe.codigo_usuario
WHERE
	trabajador.id_jefe=:id");	
	$ConsultaSQL ->bindParam(':id', $id_jefe, PDO::PARAM_INT);
	$ConsultaSQL->execute();
	$numero_filas = $ConsultaSQL->rowCount();
	if(empty($numero_filas)){
		echo "No existen Datos.";
		}
	else{
  echo '<table  class="table table-striped table-hover table-bordered">
							  <thead>
								  <tr>
									  <th></th>
									  <th>Trabajador</th> 
									  <th>Dependencia</th> 
									  <th>Cargo</th> 								  
									  <th></th>                                     
								  </tr>
							  </thead>   
							  <tbody>';
while ($row = $ConsultaSQL->fetch(PDO::FETCH_ASSOC)) {
$a++;
printf("<tr>
<td>%s</td><td>%s</td>
<td>%s</td><td>%s</td>
<td>%s</td>
</tr>",
$a,
$row["nombre_trabajador"],
$row["nombre_dependencia"],
$row["nombre_cargo"],
"<button class='btn btn-danger' data-rel='tooltip' title='Eliminar' onClick='eli_trabajador(id=".$row["cc_trabajador"].")'><i class='fa fa-minus'></i></button>"); 
	 }                                                                       
	echo '</tbody></table>';
	}		
}


	
}
?>