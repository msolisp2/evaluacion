<?php
include_once("../modelo/conexion.php");
	class clase_evaluacion extends configuracion{
	private $conexion;	
public function valores_clase_objetivos($id_obj){	//Clase Departamento
  $this->conexion = parent::conectar(); 
  $ConsultaSQL = $this->conexion->prepare("SELECT * FROM objetivos WHERE id_objetivos=:id");
  $ConsultaSQL ->bindParam(':id', $id_obj, PDO::PARAM_INT);
  $ConsultaSQL ->execute();
  while ($row = $ConsultaSQL ->fetch(PDO::FETCH_ASSOC)) {
	$this->codigo_eva=$row["cod_evaluacion"];
	$this->objetivo=$row["objetivos"];
	$this->evidencia=$row["evidencias"];
	$this->meta_pro=$row["meta_propuesta"];
	$this->meta_va=$row["meta_valor"];
	$this->peso=$row["peso_porcentaje"];
	$this->meta_alc=$row["meta_alcanzada"];
	$this->tipo_meta_valor=$row["tipo_meta_valor"];
	}
		}

public function valores_clase_evaluacion_trabajador($cod_eva){	//Clase Evaluacion
  $this->conexion = parent::conectar(); 
  $ConsultaSQL = $this->conexion->prepare("SELECT * FROM trabajador_evaluacion_cualitativa WHERE cod_evaluacion=:id");
  $ConsultaSQL ->bindParam(':id', $cod_eva, PDO::PARAM_INT);
  $ConsultaSQL ->execute();
  while ($row = $ConsultaSQL ->fetch(PDO::FETCH_ASSOC)) {
	$this->eva_cualitativa=$row["descripcion_cualitativa"];
	$this->estado_eva_cualitativa=$row["estado_eva_cualitativa"];
	}
		}				
		
public function valores_clase_mejoras($id_mej){	//Clase Departamento
  $this->conexion = parent::conectar(); 
  $ConsultaSQL = $this->conexion->prepare("SELECT * FROM plan_mejora LEFT JOIN trabajador_plan_mejora ON trabajador_plan_mejora.id_trabajador_plan_mejora = plan_mejora.cod_evaluacion WHERE id_plan_mejora=:id");
  $ConsultaSQL ->bindParam(':id', $id_mej, PDO::PARAM_INT);
  $ConsultaSQL ->execute();
  while ($row = $ConsultaSQL ->fetch(PDO::FETCH_ASSOC)) {
	$this->codigo=$row["cod_evaluacion"];
	$this->codigo_eva=$row["cod_evaluacion"];
	$this->difcultades=$row["difcultades"];
	$this->analisis=$row["analisis"];
	$this->actividad=$row["actividad"];
	$this->responsable=$row["responsable"];
	$this->fecha_1=$row["fecha_primer_periodo"];
	$this->justf_1=$row["jusft_primer_periodo"];
	$this->fecha_2=$row["fecha_segundo_periodo"];
	$this->justf_2=$row["jusft_segundo_periodo"];
	}
		}		

public function valores_clase_mejora($id_cod_obj){	//Clase Departamento
  $this->conexion = parent::conectar(); 
  $ConsultaSQL = $this->conexion->prepare("SELECT * FROM trabajador_plan_mejora WHERE cod_evaluacion=:id");
  $ConsultaSQL ->bindParam(':id', $id_cod_obj, PDO::PARAM_INT);
  $ConsultaSQL ->execute();
  while ($row = $ConsultaSQL ->fetch(PDO::FETCH_ASSOC)) {
	$this->cod_plan=$row["id_trabajador_plan_mejora"];
	$this->estado_plan=$row["estado_plan_mejora"];
	$this->fecha_plan=$row["fecha_plan_mejora"];
	}
		}		
		
  public function valores_clase_evaluacion_fecha($cod_eva,$seg){	//Clase Departamento
  $this->conexion = parent::conectar(); 
  $ConsultaSQL = $this->conexion->prepare("
SELECT* FROM objetivos_concertados_fechas WHERE cod_evaluacion=:id AND num_seguimiento=:seg");
  $ConsultaSQL ->bindParam(':id', $cod_eva, PDO::PARAM_INT);
  $ConsultaSQL ->bindParam(':seg', $seg);
  $ConsultaSQL ->execute();
  while ($row = $ConsultaSQL ->fetch(PDO::FETCH_ASSOC)) {
	$this->inicio=$row["fecha_ini_objetivo_concertados"];
	$this->fin=$row["fecha_fin_objetivo_concertados"];
	}
		}		

	 public function valores_clase_evaluacion_jefe($cod_eva){	//Clase Departamento
  $this->conexion = parent::conectar(); 
  $ConsultaSQL = $this->conexion->prepare("
SELECT
	jefe.correo_usuario
FROM
	evaluacion
LEFT JOIN usuario AS jefe ON cod_evaluador = jefe.codigo_usuario
WHERE
	cod_evaluacion = :id
AND num_evaluacion = 2");
  $ConsultaSQL ->bindParam(':id', $cod_eva, PDO::PARAM_INT);
  $ConsultaSQL ->execute();
  while ($row = $ConsultaSQL ->fetch(PDO::FETCH_ASSOC)) {
	$this->correo=$row["correo_usuario"];
	}
		}		
		
public function consulta_evaluacion_correos_jefe($id_evas){	//Clase Departamento
  $this->conexion = parent::conectar(); 
  $ConsultaSQL = $this->conexion->prepare("
  SELECT
	GROUP_CONCAT(correo_usuario) AS listado_correos
FROM
	evaluacion
LEFT JOIN usuario ON evaluacion.cod_evaluador = usuario.codigo_usuario
WHERE
	FIND_IN_SET(
		cod_evaluacion,
		:id
	)
AND estado_eva = 'Pendiente'
  ");
  $ConsultaSQL ->bindParam(':id', $id_evas, PDO::PARAM_INT);
  $ConsultaSQL ->execute();
  while ($row = $ConsultaSQL ->fetch(PDO::FETCH_ASSOC)) {
	$this->correos=$row["listado_correos"];
	}
		}	

public function consulta_evaluacion_correos_admin($id_evas){	//Clase Departamento
  $this->conexion = parent::conectar(); 
  $ConsultaSQL = $this->conexion->prepare("
  SELECT
	GROUP_CONCAT(correo_usuario) AS listado_correos
FROM
	dependencia
LEFT JOIN usuario ON dependencia.id_jefe = usuario.codigo_usuario
WHERE
	FIND_IN_SET(cod_dependencia, :id)
  ");
  $ConsultaSQL ->bindParam(':id', $id_evas, PDO::PARAM_INT);
  $ConsultaSQL ->execute();
  while ($row = $ConsultaSQL ->fetch(PDO::FETCH_ASSOC)) {
	$this->correos=$row["listado_correos"];
	}
		}		
		
public function valores_clase_select_dependencia(){	//Select Dependencia
  $this->conexion = parent::conectar(); 
  $ConsultaSQL = $this->conexion->prepare("SELECT * FROM dependencia");
  $ConsultaSQL ->execute();
    echo "<select name='id_depen_consulta[]' id='id_depen_consulta'  style='width:100%' class='populate'  multiple='multiple'>";
	while ($row = $ConsultaSQL ->fetch(PDO::FETCH_ASSOC)) {
	echo "<option value='".$row['cod_dependencia']."'>".$row['nombre_dependencia']."</option>";
	}
	echo "</select>";	
		}

		
public function valores_clase_verifica($cod_eva){
  $this->conexion = parent::conectar();
  	if(empty($cod_eva)){
		echo '<div id="Error"><img src="../estilos/images/campo_vacio.png" alt="" />
		</div>';
		}
	else{ 
  $ConsultaSQL = $this->conexion->prepare("SELECT * FROM recursos WHERE cod_evaluacion = :id");
  $ConsultaSQL ->bindParam(':id', $cod_eva, PDO::PARAM_INT);
  $ConsultaSQL ->execute();
  $num_rows = $ConsultaSQL->fetchColumn();
  $this->existe=$num_rows;	 
	}
	}
			
public function valores_clase_configuracion($id_config){	//Clase Departamento
  $this->conexion = parent::conectar(); 
  $ConsultaSQL = $this->conexion->prepare("SELECT * FROM configuracion WHERE id_configuracion=:id");
  $ConsultaSQL ->bindParam(':id', $id_config, PDO::PARAM_INT);
  $ConsultaSQL ->execute();
  while ($row = $ConsultaSQL ->fetch(PDO::FETCH_ASSOC)) {
	$this->estado=$row["estado_configuracion"];
	}
		}
		
public function valores_clase_evaluacion($cod_eva){	//Clase Departamento
  $this->conexion = parent::conectar(); 
  $ConsultaSQL = $this->conexion->prepare("
  SELECT
	trabajador_evaluacion.cod_evaluacion, evaluacion.id_evaluacion,trabajador_evaluacion.descripcion_cualitativa,
  gestion_desempeno.cod_trabajador,
  CONCAT(empleado.nombres_usuario,' ',empleado.apellidos_usuario) AS Empleado,
  empleado_cargo.nombre_cargo AS Empleado_Cargo,
  evaluacion.cod_evaluador,
	CONCAT(jefe.nombres_usuario,' ',jefe.apellidos_usuario) AS Jefe,
	jefe_cargo.nombre_cargo AS Jefe_Cargo,
  evaluacion.*,
  SUM(	compen_1 + compen_2 + compen_3 + compen_4 + compen_5 + compen_6 + compen_7 + compen_8 + compen_9 + compen_10 +
		compen_11 + compen_12 + compen_13 + compen_14 + compen_15 + compen_16 + compen_17 + compen_18 + compen_19 + compen_20
	  ) AS Total,
	  evaluacion.estado_eva AS Estado,
	  evaluacion.fecha_eva AS Fecha
FROM
	trabajador_evaluacion
LEFT JOIN evaluacion ON evaluacion.cod_evaluacion = trabajador_evaluacion.cod_evaluacion
LEFT JOIN gestion_desempeno ON gestion_desempeno.cod_evaluacion = trabajador_evaluacion.cod_evaluacion
LEFT JOIN usuario AS empleado ON gestion_desempeno.cod_trabajador = empleado.codigo_usuario
LEFT JOIN trabajador AS empleado_datos ON  empleado.codigo_usuario = empleado_datos.cc_trabajador
LEFT JOIN cargo AS empleado_cargo ON empleado_datos.id_cargo = empleado_cargo.id_cargo
LEFT JOIN usuario AS jefe ON evaluacion.cod_evaluador = jefe.codigo_usuario
LEFT JOIN trabajador AS jefe_datos ON  jefe.codigo_usuario = jefe_datos.cc_trabajador
LEFT JOIN cargo AS jefe_cargo ON jefe_datos.id_cargo = jefe_cargo.id_cargo
WHERE
	evaluacion.id_evaluacion = :id
  ");
  $ConsultaSQL ->bindParam(':id', $cod_eva, PDO::PARAM_INT);
  $ConsultaSQL ->execute();
  while ($row = $ConsultaSQL ->fetch(PDO::FETCH_ASSOC)) {
	$this->codigo_eva=$row["cod_evaluacion"];
	$this->cua_eva=$row["descripcion_cualitativa"];
	$this->id_eva=$row["id_evaluacion"];
	$this->cod_trab=$row["cod_trabajador"];
	$this->empleado=$row["Empleado"];
	$this->empleado_cargo=$row["Empleado_Cargo"];
	$this->cod_eva=$row["cod_evaluador"];
	$this->jefe=$row["Jefe"];
	$this->jefe_cargo=$row["Jefe_Cargo"];
	$this->a=$row["compen_1"];
	$this->b=$row["compen_2"];
	$this->c=$row["compen_3"];
	$this->d=$row["compen_4"];
	$this->e=$row["compen_5"];
	$this->f=$row["compen_6"];
	$this->g=$row["compen_7"];
	$this->h=$row["compen_8"];
	$this->i=$row["compen_9"];
	$this->j=$row["compen_10"];
	$this->k=$row["compen_11"];
	$this->m=$row["compen_12"];
	$this->n=$row["compen_13"];
	$this->l=$row["compen_14"];
	$this->o=$row["compen_15"];
	$this->p=$row["compen_16"];
	$this->q=$row["compen_17"];
	$this->r=$row["compen_18"];
	$this->s=$row["compen_19"];
	$this->t=$row["compen_20"];	
	$this->Total=$row["Total"];	
	$this->Estado=$row["Estado"];
	$this->Fecha=$row["Fecha"];
	$this->inicio=$row["fecha_inicio_eva"];
	$this->fin=$row["fecha_fin_eva"];
	}
		}		
	
	public function valores_clase_recurso($cod_eva){	
  $this->conexion = parent::conectar(); 
  $ConsultaSQL = $this->conexion->prepare("SELECT * FROM recursos WHERE cod_evaluacion=:id");
  $ConsultaSQL ->bindParam(':id', $cod_eva, PDO::PARAM_INT);
  $ConsultaSQL ->execute();
  while ($row = $ConsultaSQL ->fetch(PDO::FETCH_ASSOC)) {
	$this->id_recurso=$row["id_recurso"];
	$this->recurso=$row["recurso"];
	$this->estado_recurso=$row["estado_recurso"];	
	}
		}

	public function valores_clase_respuesta($id_recurso){	
  $this->conexion = parent::conectar(); 
  $ConsultaSQL = $this->conexion->prepare("SELECT * FROM respuesta LEFT JOIN usuario ON usuario.codigo_usuario = respuesta.codigo_usuario WHERE id_recurso=:id");
  $ConsultaSQL ->bindParam(':id', $id_recurso, PDO::PARAM_INT);
  $ConsultaSQL ->execute();
  while ($row = $ConsultaSQL ->fetch(PDO::FETCH_ASSOC)) {
	$this->id_respuesta=$row["id_respuesta"];
	$this->respuesta=$row["respuesta"];
	}
		}
		
	public function valores_clase_evaluacion_total($cod_eva){	
  $this->conexion = parent::conectar(); 
  $ConsultaSQL = $this->conexion->prepare("
  SELECT 
evaluacion.cod_evaluacion,
SUM((total)*(1-abs(sign(num_evaluacion-1)))) AS total_auto,
SUM((total)*(1-abs(sign(num_evaluacion-2)))) AS total_jefe,
SUM((total)*(1-abs(sign(num_evaluacion-3)))) AS total_par,
SUM((total)*(1-abs(sign(num_evaluacion-4)))) AS total_usuario
FROM evaluacion
WHERE evaluacion.cod_evaluacion = :id
GROUP BY evaluacion.cod_evaluacion");
  $ConsultaSQL ->bindParam(':id', $cod_eva, PDO::PARAM_INT);
  $ConsultaSQL ->execute();
  while ($row = $ConsultaSQL ->fetch(PDO::FETCH_ASSOC)) {
	$this->codigo_eva=$row["cod_evaluacion"];
	$this->total_auto=$row["total_auto"];
	$this->total_jefe=$row["total_jefe"];
	$this->total_par=$row["total_par"];
	$this->total_usuario=$row["total_usuario"];
	$this->subtotal=$row["total_usuario"]+$row["total_par"]+$row["total_auto"]+$row["total_jefe"];
	}
		}	
	
	public function valores_clase_objetivos_total($cod_eva){	
  $this->conexion = parent::conectar(); 
  $ConsultaSQL = $this->conexion->prepare("
  SELECT
  cod_evaluacion,
 SUM((((meta_alcanzada/meta_valor)*100)*peso_porcentaje)/100) AS Subtotal
FROM
	objetivos
WHERE
	cod_evaluacion = :id
	AND n_seguimiento_objetivo=3
GROUP BY cod_evaluacion");
  $ConsultaSQL ->bindParam(':id', $cod_eva, PDO::PARAM_INT);
  $ConsultaSQL ->execute();
  while ($row = $ConsultaSQL ->fetch(PDO::FETCH_ASSOC)) {
	$this->codigo_eva=$row["cod_evaluacion"];
	$this->subtotal=$row["Subtotal"];
	}
		}
	
	function valores_listado_inicio_per_evl($id_eval,$seg){	//Listado Departamentos
$this->conexion = parent::conectar(); 
	$ConsultaSQL_lista=$this->conexion->prepare("SELECT * FROM objetivos WHERE cod_evaluacion=:id AND n_seguimiento_objetivo=:seg");
	$ConsultaSQL_lista->bindParam(':id', $id_eval);
	$ConsultaSQL_lista->bindParam(':seg', $seg);
	$ConsultaSQL_lista->execute();
	$numero_filas = $ConsultaSQL_lista->rowCount();
	if(empty($numero_filas)){
		echo "No hay Objetivos Registrados.";
		}
	else{
    $a=0;
  echo '<table class="table table-bordered">
								  <tr>
								  <td colspan="6" align="center"><strong>Inicio del Período Evaluación</strong></td>
								  </tr>
								  <tr>
									  <td align="center">Nº</td>
									  <td align="center">Objetivos</td>
									  <td align="center">Evidencias</td> 
									  <td align="center">Meta Propuesta</td>
									  <td align="center">Peso %</td>  
									  <td width="15%"></td>									  
								  </tr>  
							  <tbody>';
while ($row = $ConsultaSQL_lista ->fetch(PDO::FETCH_ASSOC)) {
	$a++;
printf("<tr>
<td><center><strong>%s</strong></center></td>
<td align='justify'>%s</td>
<td align='justify'>%s</td>
<td align='center'>%s</td>
<td align='center'>%s</td>
<td>%s</td></tr>",
$a,
$row["objetivos"],
$row["evidencias"],
$row["meta_propuesta"]."<br>".$row["meta_valor"]."".$row["tipo_meta_valor"],
$row["peso_porcentaje"]."%",
"
<div class='btn-group'>
                            <button data-toggle='dropdown' class='btn btn-default dropdown-toggle' type='button'> <span class='caret'></span></button>
                            <ul role='menu' class='dropdown-menu'>
								<li><a data-toggle='modal' href='#editar_info'  class='editar' id='".$row["id_objetivos"]."' href='#'>Editar</a></li>
                                <li class='divider'></li>
                                <li><a onClick='eli_obj(id=".$row["id_objetivos"].")' href='#'> Eliminar</a></li>
								
                            </ul>
                        </div>"); 
	 }                                                                       
	echo '</tbody></table>';
	}	
	}
	
	function valores_listado_inicio_per_evl_seg($id_eval,$seg){	//Listado Departamentos
$this->conexion = parent::conectar(); 
	$ConsultaSQL_lista=$this->conexion->prepare("SELECT * FROM objetivos WHERE cod_evaluacion=:id AND n_seguimiento_objetivo=:seg");
	$ConsultaSQL_lista->bindParam(':id', $id_eval);
	$ConsultaSQL_lista->bindParam(':seg', $seg);
	$ConsultaSQL_lista->execute();
	$numero_filas = $ConsultaSQL_lista->rowCount();
	if(empty($numero_filas)){
		echo "
				<p align='center'>¿Desea generar los objetivos de este seguimiento?</p>
						<div class='btn-group btn-group-justified'>
							<a data-toggle='modal' href='#editar_seguimiento'  class='btn btn-success btn-lg btn-block seguimiento' id='".$seg."' rel='".$id_eval."' href='#'>Generar</a>
					    </div>				
			";
		}
	else{
    $a=0;
  echo '<table class="table table-bordered">
				"				  <tr>
								  <td colspan="6" align="center"><strong>Inicio del Período Evaluación</strong>
                                  <a data-toggle="modal" href="#agregar_info_seg"  class="btn btn-success agregar_seg" rel="'.$id_eval.'" rel="'.$seg.'" href="#"><i class="fa fa-plus"></i></a>
								  </td>
								  </tr>
								  <tr>
									  <td align="center">Nº</td>
									  <td align="center">Objetivos</td>
									  <td align="center">Evidencias</td> 
									  <td align="center">Meta Propuesta</td>
									  <td align="center">Peso %</td>  
									  <td width="15%"></td>									  
								  </tr>  
							  <tbody>';
while ($row = $ConsultaSQL_lista ->fetch(PDO::FETCH_ASSOC)) {
	$a++;
printf("<tr>
<td><center><strong>%s</strong></center></td>
<td align='justify'>%s</td>
<td align='justify'>%s</td>
<td align='center'>%s</td>
<td align='center'>%s</td>
<td>%s</td></tr>",
$a,
$row["objetivos"],
$row["evidencias"],
$row["meta_propuesta"]."<br>".$row["meta_valor"]."".$row["tipo_meta_valor"],
$row["peso_porcentaje"]."%",
"
<div class='btn-group'>
                            <button data-toggle='dropdown' class='btn btn-default dropdown-toggle' type='button'> <span class='caret'></span></button>
                            <ul role='menu' class='dropdown-menu'>
								<li><a data-toggle='modal' href='#editar_info_seg'  class='editar_seg' id='".$row["id_objetivos"]."' rel='".$seg."' href='#'>Editar</a></li>								
                            </ul>
                        </div>"); 
	 }                                                                       
	echo '</tbody></table>';
	}	
	}

function valores_listado_inicio_per_evl_jefe($id_eval,$seg){	//Listado Departamentos
$this->conexion = parent::conectar(); 
	$ConsultaSQL_lista=$this->conexion->prepare("SELECT * FROM objetivos WHERE cod_evaluacion=:id AND n_seguimiento_objetivo=:seg");
	$ConsultaSQL_lista->bindParam(':id', $id_eval);
	$ConsultaSQL_lista->bindParam(':seg', $seg);
	$ConsultaSQL_lista->execute();
	$numero_filas = $ConsultaSQL_lista->rowCount();
	if(empty($numero_filas)){
		echo "No hay Objetivos Registrados.";
		}
	else{
    $a=0;
  echo '<table class="table table-bordered">
								  <tr>
								  <td colspan="6" align="center"><strong>Inicio del Período Evaluación</strong></td>
								  </tr>
								  <tr>
									  <td align="center"><strong>Nº</strong></td>
									  <td align="center"><strong>Objetivos</strong></td>
									  <td align="center"><strong>Evidencias</strong></td> 
									  <td align="center"><strong>Meta Propuesta</strong></td>
									  <td align="center"><strong>Peso %</strong></td>  	
									  <td align="center"></td>
								  </tr>  
							  <tbody>';
while ($row = $ConsultaSQL_lista ->fetch(PDO::FETCH_ASSOC)) {
	$a++;
printf("<tr>
<td><center><strong>%s</strong></center></td>
<td align='justify'>%s</td>
<td align='justify'>%s</td>
<td align='center'>%s</td>
<td align='center'>%s</td>
<td align='center'>%s</td></tr>",
$a,
$row["objetivos"],
$row["evidencias"],
$row["meta_propuesta"]."<br>".$row["meta_valor"]."".$row["tipo_meta_valor"],
$row["peso_porcentaje"]."%",
"
<div class='btn-group'>
                            <button data-toggle='dropdown' class='btn btn-default dropdown-toggle' type='button'> <span class='caret'></span></button>
                            <ul role='menu' class='dropdown-menu'>
								<li><a data-toggle='modal' href='#meta_info'  class='meta' id='".$row["id_objetivos"]."' href='#'>Meta Alcanzada</a></li>	
                            </ul>
                        </div>"); 
	 }                                                                       
	echo '</tbody></table>';
	}	
	}	


function valores_listado_inicio_per_evl_jefe_final($id_eval,$seg){	//Listado Departamentos
$this->conexion = parent::conectar(); 
	$ConsultaSQL_lista=$this->conexion->prepare("SELECT * FROM objetivos WHERE cod_evaluacion=:id AND n_seguimiento_objetivo=:seg");
	$ConsultaSQL_lista->bindParam(':id', $id_eval);
	$ConsultaSQL_lista->bindParam(':seg', $seg);
	$ConsultaSQL_lista->execute();
	$numero_filas = $ConsultaSQL_lista->rowCount();
	if(empty($numero_filas)){
		echo "No hay Objetivos Registrados.";
		}
	else{
    $a=0;
  echo '<table class="table table-bordered">
								  <tr>
								  <td colspan="6" align="center"><strong>Inicio del Período Evaluación</strong></td>
								  </tr>
								  <tr>
									  <td align="center"><strong>Nº</strong></td>
									  <td align="center"><strong>Objetivos</strong></td>
									  <td align="center"><strong>Evidencias</strong></td> 
									  <td align="center"><strong>Meta Propuesta</strong></td>
									  <td align="center"><strong>Peso %</strong></td>  	
								  </tr>  
							  <tbody>';
while ($row = $ConsultaSQL_lista ->fetch(PDO::FETCH_ASSOC)) {
	$a++;
printf("<tr>
<td><center><strong>%s</strong></center></td>
<td align='justify'>%s</td>
<td align='justify'>%s</td>
<td align='center'>%s</td>
<td align='center'>%s</td>
</tr>",
$a,
$row["objetivos"],
$row["evidencias"],
$row["meta_propuesta"]."<br>".$row["meta_valor"]."".$row["tipo_meta_valor"],
$row["peso_porcentaje"]."%"); 
	 }                                                                       
	echo '</tbody></table>';
	}	
	}
	
function valores_listado_fin_per_evl($id_eval){	//Listado Departamentos
$this->conexion = parent::conectar(); 
	$ConsultaSQL_lista=$this->conexion->prepare("SELECT * FROM objetivos WHERE cod_evaluacion=? AND n_seguimiento_objetivo=3");
	$ConsultaSQL_lista->bindParam(1, $id_eval);
	$ConsultaSQL_lista->execute();
	$numero_filas = $ConsultaSQL_lista->rowCount();
	if(empty($numero_filas)){
		echo "No hay Objetivos Registrados.";
		}
	else{
    $a=0;
  echo '<table class="table table-bordered">
								  <tr>
								  <td colspan="6" align="center"><strong>Final del Período Evaluación</strong></td>
								  </tr>
								  <tr>
									  <td align="center"><strong>Meta Alcanzada</strong></td>
									  <td align="center"><strong>Logro % (MA÷MP) X 100</strong></td> 
									  <td align="center"><strong>(Peso x Logro) ÷ 100</strong></td>
									  <td align="center"><strong>Subtotal</strong></td>  								  
								  </tr>  
							  <tbody>';
while ($row = $ConsultaSQL_lista ->fetch(PDO::FETCH_ASSOC)) {
	$a++;
	$Logro=($row["meta_alcanzada"]/$row["meta_valor"])*100;
	$Peso_Logro=($row["peso_porcentaje"]*$Logro)/100;
printf("<tr>
<td align='center'>%s</td>
<td align='center'>%s</td>
<td align='center'>%s</td>
<td align='center'>%s</td></tr>",
$row["meta_alcanzada"]."".$row["tipo_meta_valor"],
$Logro."%",
$Peso_Logro."%",
$Peso_Logro."%"); 
	 }                                                                       
	echo '</tbody></table>';
	}	
	}	
	
function valores_listado_obj_concertados($id_eval){	//Listado Departamentos
$this->conexion = parent::conectar(); 
	$ConsultaSQL_lista=$this->conexion->prepare("SELECT
	id_objetivos_concertados,
	objetivos_concertados,
	fecha_reg_objetivo_concertados,
	DAY(fecha_reg_objetivo_concertados) AS Dia,
	MONTH(fecha_reg_objetivo_concertados) AS Mes,
	YEAR(fecha_reg_objetivo_concertados) AS Ano,
		CONCAT(
				empleado.nombres_usuario,
				' ',
				empleado.apellidos_usuario
			) AS nombre_trabajador,
		CONCAT(
				jefe.nombres_usuario,
				' ',
				jefe.apellidos_usuario
			) AS nombre_jefe
FROM
	 objetivos_concertados
LEFT JOIN gestion_desempeno ON objetivos_concertados.cod_evaluacion = gestion_desempeno.cod_evaluacion
LEFT JOIN trabajador_objetivos ON objetivos_concertados.cod_evaluacion = trabajador_objetivos.cod_evaluacion
LEFT JOIN usuario AS jefe ON gestion_desempeno.cod_jefe = jefe.codigo_usuario
LEFT JOIN usuario AS empleado ON gestion_desempeno.cod_trabajador = empleado.codigo_usuario
WHERE
	objetivos_concertados.cod_evaluacion = :id");
	$ConsultaSQL_lista->bindParam(':id', $id_eval);
	$ConsultaSQL_lista->execute();
	$numero_filas = $ConsultaSQL_lista->rowCount();
	if(empty($numero_filas)){
		echo "No hay Objetivos Registrados.";
		}
	else{
    $a=0;
  echo '<table class="table table-bordered">
								  <tr>
								      <td align="center"><strong>Nº</strong></td>
									  <td width="40%" align="center"><strong>III. IDENTIFICACIÓN DE DIFICULTADES Y/O MODIFICACIÓN DE LOS OBJETIVOS CONCERTADOS</strong></td>
									  <td align="center"><strong>DÍA</strong></td>
									  <td align="center"><strong>MES</strong></td> 
									  <td align="center"><strong>AÑO</strong></td>
									  <td align="center"><strong>Nombres y Apellidos</strong></td>  								  
								  </tr>  
							  <tbody>';
while ($row = $ConsultaSQL_lista ->fetch(PDO::FETCH_ASSOC)) {
	$a++;
printf("<tr>
<td><center><strong>%s</strong></center></td>
<td align='center'>%s</td>
<td align='center'>%s</td>
<td align='center'>%s</td>
<td align='center'>%s</td>
<td align='center'>%s</td></tr>",
$a,
$row["objetivos_concertados"],
$row["Dia"],
$row["Mes"],
$row["Ano"],
"<strong>Evaluado </strong>".$row["nombre_trabajador"]." <hr> <strong>Evaluador </strong>".$row["nombre_jefe"]); 
	 }                                                                       
	echo '</tbody></table>';
	}	
	}

function valores_clase_listado_evaluaciones_obj($id_eval){//Lista Objetivos 
	$a=0;	
    $this->conexion = parent::conectar(); 
	$ConsultaSQL=$this->conexion->prepare("
SELECT 
 evaluacion.id_evaluacion AS id_eva,correo_usuario,
CONCAT(nombres_usuario,' ',apellidos_usuario) AS empleado, ano_evaluacion,
evaluacion.cod_evaluacion, tipo_evaluacion,
(SELECT CONCAT(auto.nombres_usuario,' ',auto.apellidos_usuario) FROM usuario AS auto WHERE auto.codigo_usuario =  SUM(evaluacion.cod_evaluador*(1-abs(sign(num_evaluacion-1))))) AS autoevaluador,
SUM(evaluacion.id_evaluacion*(1-abs(sign(num_evaluacion-1)))) AS cod_auto,
SUM(IF(estado_eva='Pendiente',1,2)*(1-abs(sign(num_evaluacion-1)))) AS estado_auto,
(SELECT CONCAT(jefe.nombres_usuario,' ',jefe.apellidos_usuario) FROM usuario AS jefe WHERE jefe.codigo_usuario =  SUM(evaluacion.cod_evaluador*(1-abs(sign(num_evaluacion-2))))) AS jefe,
SUM(evaluacion.id_evaluacion*(1-abs(sign(num_evaluacion-2)))) AS cod_jefe,
SUM(IF(estado_eva='Pendiente',1,2)*(1-abs(sign(num_evaluacion-2)))) AS estado_jefe,
(SELECT CONCAT(par.nombres_usuario,' ',par.apellidos_usuario) FROM usuario AS par WHERE par.codigo_usuario =  SUM(evaluacion.cod_evaluador*(1-abs(sign(num_evaluacion-3))))) AS par,
SUM(evaluacion.id_evaluacion*(1-abs(sign(num_evaluacion-3)))) AS cod_par,
SUM(IF(estado_eva='Pendiente',1,2)*(1-abs(sign(num_evaluacion-3)))) AS estado_par,+
(SELECT CONCAT(usuario_eva.nombres_usuario,' ',usuario_eva.apellidos_usuario) FROM usuario AS usuario_eva WHERE usuario_eva.codigo_usuario =  SUM(evaluacion.cod_evaluador*(1-abs(sign(num_evaluacion-4))))) AS usuario_eva,
SUM(evaluacion.id_evaluacion*(1-abs(sign(num_evaluacion-4)))) AS cod_usuario,
SUM(IF(estado_eva='Pendiente',1,2)*(1-abs(sign(num_evaluacion-4)))) AS estado_usuario,
trabajador_objetivos.estado_eva_objetivos,
trabajador_evaluacion_cualitativa.estado_eva_cualitativa
FROM evaluacion
LEFT JOIN gestion_desempeno ON evaluacion.cod_evaluacion = gestion_desempeno.cod_evaluacion
LEFT JOIN usuario ON gestion_desempeno.cod_trabajador = usuario.codigo_usuario
LEFT JOIN trabajador ON gestion_desempeno.cod_trabajador = trabajador.cc_trabajador
LEFT JOIN dependencia ON trabajador.id_dependencia = dependencia.cod_dependencia
LEFT JOIN trabajador_objetivos ON evaluacion.cod_evaluacion = trabajador_objetivos.cod_evaluacion
LEFT JOIN trabajador_evaluacion ON evaluacion.cod_evaluacion = trabajador_evaluacion.cod_evaluacion
LEFT JOIN trabajador_evaluacion_cualitativa ON  evaluacion.cod_evaluacion = trabajador_evaluacion_cualitativa.cod_evaluacion
WHERE trabajador_evaluacion.estado_trab_evaluacion = :estado AND trabajador.id_jefe = :id
GROUP BY evaluacion.cod_evaluacion
	");
	$estado='Pendiente';
	$ConsultaSQL ->bindParam(':id', $id_eval, PDO::PARAM_INT);
	$ConsultaSQL ->bindParam(':estado', $estado);
	$ConsultaSQL->execute();
	$numero_filas = $ConsultaSQL->rowCount();
	if(empty($numero_filas)){
		echo "<br><br>No existen Datos.";
		}
	else{
  echo '<table  class="table table-striped table-hover table-bordered" id="dynamic-table">
							  <thead>
								  <tr>
									  <td width="5%" align="center">Nº</td>
									  <td width="22%" align="center">Trabajador</td>
									  <td width="10%" align="center">Año</td> 
									  <td width="10%" align="center">Auto</td>
									  <td width="10%" align="center">Jefe</td>  
									  <td width="10%" align="center">Par</td> 
									  <td width="10%" align="center">Usuario</td> 									  
									  <td width="10%" align="center">Objetivos</td>
									  <td width="10%" align="center">Cualitativa</td>									  
									  <td width="8%"></td>										  
								  </tr>
							  </thead>   
							  <tbody>';
while ($row = $ConsultaSQL->fetch(PDO::FETCH_ASSOC)) {
if($row["estado_auto"]==1){$color="warning";$estado="Pendiente";}else{$color="success";$estado="Finalizada";}
if($row["estado_jefe"]==1){$color_jefe="warning";$estado_jefe="Pendiente";}else{$color_jefe="success";$estado_jefe="Finalizada";}
if($row["estado_par"]==1){$color_par="warning";$estado_par="Pendiente";}else{$color_par="success";$estado_par="Finalizada";}
if($row["estado_usuario"]==1){$color_usuario="warning";$estado_usuario="Pendiente";}else{$color_usuario="success";$estado_usuario="Finalizada";}
if($row["estado_eva_objetivos"]=="Sin Aprobar"){$color_obj="primary";}else{$color_obj="success";}
if($row["estado_eva_cualitativa"]=="Pendiente"){$color_cua="warning";}else{$color_cua="success";}
$a++;
printf("<tr>
<td align='center'>%s</td><td>%s</td><td align='center'>%s</td>
<td align='center'>%s</td><td align='center'>%s</td>
<td align='center'>%s</td><td align='center'>%s</td>
<td align='center'>%s</td><td align='center'>%s</td>
<td align='center'>%s</td>
</tr>",
"<input type='checkbox' class='ads_Checkbox' name='id_correo[]' id='id_correo' value='".$row["cod_evaluacion"]."'>",
$row["empleado"],
$row["ano_evaluacion"],
"<span class='label label-".$color."'>".$row["autoevaluador"]."</span>",
"<span class='label label-".$color_jefe."'>".$row["jefe"]."</span>",
"<span class='label label-".$color_par."'>".$row["par"]."</span>",
"<span class='label label-".$color_usuario."'>".$row["usuario_eva"]."</span>",
"<span class='label label-".$color_obj."'>".$row["estado_eva_objetivos"]."</span>",
"<span class='label label-".$color_cua."'>".$row["estado_eva_cualitativa"]."</span>",
"<button class='btn btn-danger' data-rel='tooltip' title='Eliminar' onClick='eli_evaluaciones(id=".$row["cod_evaluacion"].")'><i class='fa fa-trash-o'></i></button>"); 
	 }                                                                       
	echo '
	<tfoot>
	<tr><td align="center" colspan="10">
	<span class="label label-warning">Pendiente</span>
	<span class="label label-success">Finalizada</span>
	</td></tr></tfoot>
	</tbody></table>';
	}		
}	
	
	
	
function valores_clase_listado_evaluaciones($id_eval){//Lista Objetivos 
	$a=0;	
    $this->conexion = parent::conectar(); 
	$ConsultaSQL=$this->conexion->prepare("
SELECT 
 evaluacion.id_evaluacion AS id_eva,
CONCAT(nombres_usuario,' ',apellidos_usuario) AS empleado, ano_evaluacion,
evaluacion.cod_evaluacion, tipo_evaluacion,
SUM(evaluacion.id_evaluacion*(1-abs(sign(num_evaluacion-1)))) AS cod_auto,
SUM(IF(estado_eva='Pendiente',1,2)*(1-abs(sign(num_evaluacion-1)))) AS estado_auto,
SUM(evaluacion.id_evaluacion*(1-abs(sign(num_evaluacion-2)))) AS cod_jefe,
SUM(IF(estado_eva='Pendiente',1,2)*(1-abs(sign(num_evaluacion-2)))) AS estado_jefe,
SUM(evaluacion.id_evaluacion*(1-abs(sign(num_evaluacion-3)))) AS cod_par,
SUM(IF(estado_eva='Pendiente',1,2)*(1-abs(sign(num_evaluacion-3)))) AS estado_par,
SUM(evaluacion.id_evaluacion*(1-abs(sign(num_evaluacion-4)))) AS cod_usuario,
SUM(IF(estado_eva='Pendiente',1,2)*(1-abs(sign(num_evaluacion-4)))) AS estado_usuario,
trabajador_evaluacion_cualitativa.estado_eva_cualitativa
FROM evaluacion
LEFT JOIN gestion_desempeno ON evaluacion.cod_evaluacion = gestion_desempeno.cod_evaluacion
LEFT JOIN trabajador_evaluacion ON evaluacion.cod_evaluacion = trabajador_evaluacion.cod_evaluacion
LEFT JOIN trabajador_evaluacion_cualitativa ON evaluacion.cod_evaluacion = trabajador_evaluacion_cualitativa.cod_evaluacion
LEFT JOIN usuario ON gestion_desempeno.cod_trabajador = usuario.codigo_usuario
LEFT JOIN trabajador ON gestion_desempeno.cod_trabajador = trabajador.cc_trabajador
LEFT JOIN dependencia ON gestion_desempeno.id_dependencia = dependencia.cod_dependencia
WHERE trabajador_evaluacion.estado_trab_evaluacion = :estado  AND trabajador.id_jefe = :id
GROUP BY evaluacion.cod_evaluacion	
	");
	$estado='Pendiente';
	$ConsultaSQL ->bindParam(':id', $id_eval, PDO::PARAM_INT);
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
									  <td width="5%" align="center">Nº</td>
									  <td width="25%" align="center">Trabajador</td>
									  <td width="8%" align="center">Año</td> 
									  <td width="10%" align="center">Auto</td>
									  <td width="10%" align="center">Jefe</td>  
									  <td width="10%" align="center">Par</td> 	
									  <td width="10%" align="center">Usuario</td> 	
									  <td width="10%" align="center">Cualitativa</td> 								  
									  <td width="18%"></td>									  
								  </tr>
							  </thead>   
							  <tbody>';
while ($row = $ConsultaSQL->fetch(PDO::FETCH_ASSOC)) {
if($row["estado_auto"]==1){$color="warning";$estado="Pendiente";}else{$color="success";$estado="Finalizada";}
if($row["estado_jefe"]==1){$color_jefe="warning";$estado_jefe="Pendiente";}else{$color_jefe="success";$estado_jefe="Finalizada";}
if($row["estado_par"]==1){$color_par="warning";$estado_par="Pendiente";}else{$color_par="success";$estado_par="Finalizada";}
if($row["estado_usuario"]==1){$color_usuario="warning";$estado_usuario="Pendiente";}else{$color_usuario="success";$estado_usuario="Finalizada";}
if($row["estado_eva_cualitativa"]=="Pendiente"){$color_cua="warning";}else{$color_cua="success";}
$a++;
printf("<tr>
<td align='center'>%s</td><td>%s</td>
<td align='center'>%s</td><td align='center'>%s</td>
<td align='center'>%s</td><td align='center'>%s</td>
<td align='center'>%s</td><td align='center'>%s</td><td>%s</td>
</tr>",
$a,
$row["empleado"],
$row["ano_evaluacion"],
"<span class='label label-".$color."'>".$estado."</span>",
"<span class='label label-".$color_jefe."'>".$estado_jefe."</span>",
"<span class='label label-".$color_par."'>".$estado_par."</span>",
"<span class='label label-".$color_usuario."'>".$estado_usuario."</span>",
"<span class='label label-".$color_cua."'>".$row["estado_eva_cualitativa"]."</span>",
"
<div class='btn-group'>
                            <button data-toggle='dropdown' class='btn btn-default dropdown-toggle' type='button'> <span class='caret'></span></button>
                            <ul role='menu' class='dropdown-menu'>
								<li><a href='#jefe' data-placement='left' data-rel='tooltip'  data-original-title='Realizar Evaluación'  rel='".$row["tipo_evaluacion"]."' class='re_eva' id='".$row["cod_jefe"]."' href='#'><i class='fa  fa-pencil'></i> Jefe</a></li>
								<li><a href='#jefe_cualitativa' data-placement='left' data-rel='tooltip'  data-original-title='Evaluación Cualitativa'  class='cue_eva' id='".$row["cod_jefe"]."' href='#'><i class='fa  fa-pencil'></i> Cualitativa</a></li>
								<li><a href='#auto' data-placement='left' data-rel='tooltip'  data-original-title='Ver AutoEvaluación' rel='".$row["tipo_evaluacion"]."'  class='eva' id='".$row["cod_auto"]."' href='#'><i class='fa  fa-search'></i> Autoevaluación</a></li>
								<li><a href='#par' data-placement='left' data-rel='tooltip'  data-original-title='Ver Evaluación Par' rel='".$row["tipo_evaluacion"]."' class='eva' id='".$row["cod_par"]."' href='#'><i class='fa  fa-search'></i> Par</a></li>	
								<li><a href='#usuario' data-placement='left' data-rel='tooltip'  data-original-title='Ver Evaluación Usuario' rel='".$row["tipo_evaluacion"]."' class='eva' id='".$row["cod_usuario"]."' href='#'><i class='fa  fa-search'></i> Usuario</a></li>								
                            </ul>
                        </div>"); 
	 }                                                                       
	echo '</tbody></table>';
	}		
}	

function valores_clase_historial_evaluaciones($id_eval){//Lista Objetivos 
	$a=0;	
    $this->conexion = parent::conectar(); 
	$ConsultaSQL=$this->conexion->prepare("
	SELECT 
 evaluacion.id_evaluacion AS id_eva,
CONCAT(nombres_usuario,' ',apellidos_usuario) AS empleado, ano_evaluacion,
evaluacion.cod_evaluacion, tipo_evaluacion,
SUM(evaluacion.id_evaluacion*(1-abs(sign(num_evaluacion-1)))) AS cod_auto,
SUM(IF(estado_eva='Pendiente',1,2)*(1-abs(sign(num_evaluacion-1)))) AS estado_auto,
SUM(evaluacion.id_evaluacion*(1-abs(sign(num_evaluacion-2)))) AS cod_jefe,
SUM(IF(estado_eva='Pendiente',1,2)*(1-abs(sign(num_evaluacion-2)))) AS estado_jefe,
SUM(evaluacion.id_evaluacion*(1-abs(sign(num_evaluacion-3)))) AS cod_par,
SUM(IF(estado_eva='Pendiente',1,2)*(1-abs(sign(num_evaluacion-3)))) AS estado_par,
SUM(evaluacion.id_evaluacion*(1-abs(sign(num_evaluacion-4)))) AS cod_usuario,
SUM(IF(estado_eva='Pendiente',1,2)*(1-abs(sign(num_evaluacion-4)))) AS estado_usuario
FROM evaluacion
LEFT JOIN gestion_desempeno ON evaluacion.cod_evaluacion = gestion_desempeno.cod_evaluacion
LEFT JOIN trabajador_evaluacion ON evaluacion.cod_evaluacion = trabajador_evaluacion.cod_evaluacion
LEFT JOIN usuario ON gestion_desempeno.cod_trabajador = usuario.codigo_usuario
LEFT JOIN trabajador ON gestion_desempeno.cod_trabajador = trabajador.cc_trabajador
LEFT JOIN dependencia ON gestion_desempeno.id_dependencia = dependencia.cod_dependencia
WHERE trabajador_evaluacion.estado_trab_evaluacion = :estado AND trabajador.id_jefe = :id
GROUP BY evaluacion.cod_evaluacion
	");
	$estado='Finalizada';
	$ConsultaSQL ->bindParam(':id', $id_eval, PDO::PARAM_INT);
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
									  <td width="7%" align="center">Nº</td>
									  <td width="25%" align="center">Trabajador</td>
									  <td width="10%" align="center">Año</td> 
									  <td width="10%" align="center">Auto</td>
									  <td width="10%" align="center">Jefe</td>  
									  <td width="10%" align="center">Par</td> 	
									  <td width="10%" align="center">Usuario</td> 										  
									  <td width="18%"></td>									  
								  </tr>
							  </thead>   
							  <tbody>';
while ($row = $ConsultaSQL->fetch(PDO::FETCH_ASSOC)) {
if($row["estado_auto"]==1){$color="warning";$estado="Pendiente";}else{$color="success";$estado="Finalizada";}
if($row["estado_jefe"]==1){$color_jefe="warning";$estado_jefe="Pendiente";}else{$color_jefe="success";$estado_jefe="Finalizada";}
if($row["estado_par"]==1){$color_par="warning";$estado_par="Pendiente";}else{$color_par="success";$estado_par="Finalizada";}
if($row["estado_usuario"]==1){$color_usuario="warning";$estado_usuario="Pendiente";}else{$color_usuario="success";$estado_usuario="Finalizada";}
$a++;
printf("<tr>
<td align='center'>%s</td><td>%s</td>
<td align='center'>%s</td><td align='center'>%s</td>
<td align='center'>%s</td><td align='center'>%s</td>
<td align='center'>%s</td>
<td>%s</td>
</tr>",
$a,
$row["empleado"],
$row["ano_evaluacion"],
"<span class='label label-".$color."'>".$estado."</span>",
"<span class='label label-".$color_jefe."'>".$estado_jefe."</span>",
"<span class='label label-".$color_par."'>".$estado_par."</span>",
"<span class='label label-".$color_usuario."'>".$estado_usuario."</span>",
"
<div class='btn-group'>
                            <button data-toggle='dropdown' class='btn btn-default dropdown-toggle' type='button'> <span class='caret'></span></button>
                            <ul role='menu' class='dropdown-menu'>
								<li><a href='#jefe' data-placement='left' data-rel='tooltip'  data-original-title='Ver Evaluación Jefe'  rel='".$row["tipo_evaluacion"]."' class='eva' id='".$row["cod_jefe"]."' href='#'><i class='fa  fa-search'></i> Jefe</a></li>
								<li><a href='#auto' data-placement='left' data-rel='tooltip'  data-original-title='Ver AutoEvaluación' rel='".$row["tipo_evaluacion"]."'  class='eva' id='".$row["cod_auto"]."' href='#'><i class='fa  fa-search'></i> Autoevaluación</a></li>
								<li><a href='#par' data-placement='left' data-rel='tooltip'  data-original-title='Ver Evaluación Par' rel='".$row["tipo_evaluacion"]."' class='eva' id='".$row["cod_par"]."' href='#'><i class='fa  fa-search'></i> Par</a></li>
								<li><a href='#usuario' data-placement='left' data-rel='tooltip'  data-original-title='Ver Evaluación Usuario' rel='".$row["tipo_evaluacion"]."' class='eva' id='".$row["cod_usuario"]."' href='#'><i class='fa  fa-search'></i> Usuario</a></li>								
								<li class='divider'></li>
								<li><a href='#usuario' data-placement='left' data-rel='tooltip'  data-original-title='Calificación Definitiva' class='total' id='".$row["cod_evaluacion"]."' href='#'><i class='fa fa-plus'></i> Calificación Definitiva</a></li>								 
							</ul>
                        </div>"); 
	 }                                                                       
	echo '</tbody></table>';
	}		
}



function valores_clase_listado_eva_trab($id_eval){//Lista Objetivos 
	$a=0;	
    $this->conexion = parent::conectar(); 
	$ConsultaSQL=$this->conexion->prepare("
	SELECT 
	evaluacion.id_evaluacion AS id_eva,
	CONCAT(nombres_usuario,' ',apellidos_usuario) AS empleado, ano_evaluacion,
	evaluacion.cod_evaluacion, 
	tipo_evaluacion,
	estado_eva,
	CASE num_evaluacion
	WHEN 1 THEN 'Autoevaluacion'
	WHEN 2 THEN 'Jefe'
	WHEN 3 THEN 'Par'
	WHEN 4 THEN 'Usuario'
	END AS tipo_usuario_evaluacion
	FROM evaluacion
	LEFT JOIN gestion_desempeno ON evaluacion.cod_evaluacion = gestion_desempeno.cod_evaluacion
	LEFT JOIN trabajador_evaluacion ON evaluacion.cod_evaluacion = trabajador_evaluacion.cod_evaluacion
	LEFT JOIN usuario ON gestion_desempeno.cod_trabajador = usuario.codigo_usuario
	WHERE evaluacion.estado_eva = :estado AND evaluacion.cod_evaluador = :id");
	$estado='Pendiente';
	$ConsultaSQL ->bindParam(':id', $id_eval, PDO::PARAM_INT);
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
									  <td width="7%" align="center">Nº</td>
									  <td width="53%" align="center">Trabajador</td>
									  <td width="10%" align="center">Año</td> 
									  <td width="10%" align="center">Tipo</td> 
									  <td width="10%" align="center">Estado</td>  									  
									  <td width="10%"></td>									  
								  </tr>
							  </thead>   
							  <tbody>';
while ($row = $ConsultaSQL->fetch(PDO::FETCH_ASSOC)) {
if($row["estado_eva"]=="Pendiente"){$color_jefe="warning";}else{$color_jefe="success";}
$a++;
printf("<tr>
<td align='center'>%s</td><td>%s</td><td align='center'>%s</td>
<td align='center'>%s</td><td align='center'>%s</td>
<td>%s</td>
</tr>",
$a,
$row["empleado"],
$row["ano_evaluacion"],
$row["tipo_usuario_evaluacion"],
"<span class='label label-".$color_jefe."'>".$row["estado_eva"]."</span>",
"
<a class='btn btn-success re_eva' data-toggle='modal' data-rel='tooltip' title='Editar'  href='#eva_info' rel='".$row["tipo_evaluacion"]."' id='".$row["id_eva"]."'><i class='fa fa-share-square-o'> </i></a>"); 
	 }                                                                       
	echo '</tbody></table>';
	}		
}

function valores_clase_historial_eva_trab($id_eval){//Lista Objetivos 
	$a=0;	
    $this->conexion = parent::conectar(); 
	$ConsultaSQL=$this->conexion->prepare("
	SELECT 
	evaluacion.id_evaluacion AS id_eva,
	CONCAT(nombres_usuario,' ',apellidos_usuario) AS empleado, ano_evaluacion,
	evaluacion.cod_evaluacion, 
	tipo_evaluacion,
	estado_eva,
	CASE num_evaluacion
	WHEN 1 THEN 'Autoevaluacion'
	WHEN 2 THEN 'Jefe'
	WHEN 3 THEN 'Par'
	WHEN 4 THEN 'Usuario'
	END AS tipo_usuario_evaluacion
	FROM evaluacion
	LEFT JOIN gestion_desempeno ON evaluacion.cod_evaluacion = gestion_desempeno.cod_evaluacion
	LEFT JOIN trabajador_evaluacion ON evaluacion.cod_evaluacion = trabajador_evaluacion.cod_evaluacion
	LEFT JOIN usuario ON gestion_desempeno.cod_trabajador = usuario.codigo_usuario
WHERE evaluacion.estado_eva = :estado AND evaluacion.cod_evaluador = :id
	");
	$estado='Finalizada';
	$ConsultaSQL ->bindParam(':id', $id_eval, PDO::PARAM_INT);
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
									  <td width="7%" align="center">Nº</td>
									  <td width="53%" align="center">Trabajador</td>
									  <td width="10%" align="center">Año</td> 
									  <td width="10%" align="center">Tipo</td> 
									  <td width="10%" align="center">Estado</td>  									  
									  <td width="10%"></td>									  
								  </tr>
							  </thead>   
							  <tbody>';
while ($row = $ConsultaSQL->fetch(PDO::FETCH_ASSOC)) {
if($row["estado_eva"]=="Pendiente"){$color_jefe="warning";}else{$color_jefe="danger";}
$a++;
printf("<tr>
<td align='center'>%s</td><td>%s</td><td align='center'>%s</td>
<td align='center'>%s</td><td align='center'>%s</td>
<td>%s</td>
</tr>",
$a,
$row["empleado"],
$row["ano_evaluacion"],
$row["tipo_usuario_evaluacion"],
"<span class='label label-".$color_jefe."'>".$row["estado_eva"]."</span>",
"
<a class='btn btn-success re_eva' data-toggle='modal' data-rel='tooltip' title='Editar'  href='#eva_info' rel='".$row["tipo_evaluacion"]."' id='".$row["id_eva"]."'><i class='fa fa-share-square-o'> </i></a>"); 
	 }                                                                       
	echo '</tbody></table>';
	}		
}

function valores_clase_historial_eva_trab_recib($id_eval){//Lista Objetivos 
	$a=0;	
    $this->conexion = parent::conectar(); 
	$ConsultaSQL=$this->conexion->prepare("
SELECT 
 evaluacion.id_evaluacion AS id_eva,
CONCAT(nombres_usuario,' ',apellidos_usuario) AS empleado, ano_evaluacion,
evaluacion.cod_evaluacion, tipo_evaluacion,
SUM(evaluacion.id_evaluacion*(1-abs(sign(num_evaluacion-1)))) AS cod_auto,
SUM(evaluacion.id_evaluacion*(1-abs(sign(num_evaluacion-2)))) AS cod_jefe,
SUM(evaluacion.id_evaluacion*(1-abs(sign(num_evaluacion-3)))) AS cod_par,
SUM(evaluacion.id_evaluacion*(1-abs(sign(num_evaluacion-4)))) AS cod_usuario,
nombre_dependencia
FROM evaluacion
LEFT JOIN gestion_desempeno ON evaluacion.cod_evaluacion = gestion_desempeno.cod_evaluacion
LEFT JOIN trabajador_evaluacion ON evaluacion.cod_evaluacion = trabajador_evaluacion.cod_evaluacion
LEFT JOIN usuario ON gestion_desempeno.cod_trabajador = usuario.codigo_usuario
LEFT JOIN trabajador ON gestion_desempeno.cod_trabajador = trabajador.cc_trabajador
LEFT JOIN dependencia ON gestion_desempeno.id_dependencia = dependencia.cod_dependencia
WHERE trabajador_evaluacion.estado_trab_evaluacion = :estado AND gestion_desempeno.cod_trabajador = :id
GROUP BY evaluacion.cod_evaluacion
	");
	$estado='Finalizada';
	$ConsultaSQL ->bindParam(':id', $id_eval, PDO::PARAM_INT);
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
									  <td width="7%" align="center">Nº</td>
									  <td width="10%" align="center">Año</td> 	
									  <td width="35%" align="center">Trabajador</td>	
									  <td width="28%" align="center">Dependencia</td>									  
									  <td width="20%"></td>									  
								  </tr>
							  </thead>   
							  <tbody>';
while ($row = $ConsultaSQL->fetch(PDO::FETCH_ASSOC)) {
$a++;
printf("<tr>
<td align='center'>%s</td><td align='center'>%s</td>
<td align='center'>%s</td><td align='center'>%s</td>
<td>%s</td>
</tr>",
$a,
$row["ano_evaluacion"],
$row["empleado"],
$row["nombre_dependencia"],
"
<div class='btn-group'>
                            <button data-toggle='dropdown' class='btn btn-default dropdown-toggle' type='button'> <span class='caret'></span></button>
                            <ul role='menu' class='dropdown-menu'>
								<li><a href='#jefe' data-placement='left' data-rel='tooltip'  data-original-title='Ver Evaluación Jefe'  rel='".$row["tipo_evaluacion"]."' class='eva' id='".$row["cod_jefe"]."' href='#'><i class='fa  fa-search'></i> Jefe</a></li>
								<li><a href='#auto' data-placement='left' data-rel='tooltip'  data-original-title='Ver AutoEvaluación' rel='".$row["tipo_evaluacion"]."'  class='eva' id='".$row["cod_auto"]."' href='#'><i class='fa  fa-search'></i> Autoevaluación</a></li>
								<li><a href='#par' data-placement='left' data-rel='tooltip'  data-original-title='Ver Evaluación Par' rel='".$row["tipo_evaluacion"]."' class='eva' id='".$row["cod_par"]."' href='#'><i class='fa  fa-search'></i> Par</a></li>
								<li><a href='#usuario' data-placement='left' data-rel='tooltip'  data-original-title='Ver Evaluación Usuario' rel='".$row["tipo_evaluacion"]."' class='eva' id='".$row["cod_usuario"]."' href='#'><i class='fa  fa-search'></i> Usuario</a></li>								
								<li class='divider'></li>
								<li><a href='#usuario' data-placement='left' data-rel='tooltip'  data-original-title='Calificación Definitiva' class='total' id='".$row["cod_evaluacion"]."' href='#'><i class='fa fa-plus'></i> Calificación Definitiva</a></li>								 
							</ul>
                        </div>"); 
	 }                                                                       
	echo '</tbody></table>';
	}		
}

function valores_clase_listado_recursos($id_eval){//Lista Objetivos 
	$a=0;	
    $this->conexion = parent::conectar(); 
	$ConsultaSQL=$this->conexion->prepare("
SELECT *,CONCAT(nombres_usuario,' ',apellidos_usuario) AS empleado,
	CASE estado_recurso  
	  WHEN 'Pendiente' THEN TO_DAYS( ADDDATE( fecha_recurso, INTERVAL 5 DAY ) ) - TO_DAYS( CURDATE( ) )  
	  WHEN 'Resuelto' THEN 0
	END AS dias_restantes
	FROM recursos
LEFT JOIN gestion_desempeno ON recursos.cod_evaluacion = gestion_desempeno.cod_evaluacion
	LEFT JOIN usuario ON gestion_desempeno.cod_trabajador = usuario.codigo_usuario
	WHERE gestion_desempeno.cod_trabajador = :id AND tipo_recurso = 2 
	");
	$ConsultaSQL ->bindParam(':id', $id_eval, PDO::PARAM_INT);
	$ConsultaSQL->execute();
	$numero_filas = $ConsultaSQL->rowCount();
	if(empty($numero_filas)){
		echo "No existen Datos.";
		}
	else{
  echo '<table  class="table table-striped table-hover table-bordered" id="dynamic-table">
							  <thead>
								  <tr>
									  <td width="7%" align="center">Nº</td>
									  <td width="43%" align="center">Trabajador</td>
									  <td width="10%" align="center">Año</td> 
									  <td width="20%" align="center">Dias Respuesta</td> 									  
									  <td width="10%" align="center">Estado</td>  									  
									  <td width="10%"></td>									  
								  </tr>
							  </thead>   
							  <tbody>';
while ($row = $ConsultaSQL->fetch(PDO::FETCH_ASSOC)) {
if($row["estado_recurso"]=="Pendiente"){$color_estado="warning";}else{$color_estado="danger";}
$a++;
printf("<tr>
<td align='center'>%s</td><td>%s</td><td align='center'>%s</td>
<td align='center'>%s</td><td align='center'>%s</td>
<td>%s</td>
</tr>",
$a,
$row["empleado"],
$row["ano_evaluacion"],
$row["dias_restantes"],
"<span class='label label-".$color_estado."'>".$row["estado_recurso"]."</span>",
"
<a class='btn btn-info ver_rec' data-toggle='modal' data-rel='tooltip' title='Ver'  href='#recurso_info' id='".$row["cod_evaluacion"]."'><i class='fa fa-search'> </i></a>"); 
	 }                                                                       
	echo '</tbody></table>';
	}		
}

function valores_listado_mejorar($cod_plan){//Lista Objetivos 
	$a=0;	
    $this->conexion = parent::conectar(); 
	$ConsultaSQL=$this->conexion->prepare("
	SELECT * FROM plan_mejora WHERE cod_evaluacion=:id
	");
	$ConsultaSQL ->bindParam(':id', $cod_plan, PDO::PARAM_INT);
	$ConsultaSQL->execute();
	$numero_filas = $ConsultaSQL->rowCount();
	if(empty($numero_filas)){
		echo "No existen Datos.";
		}
	else{
while ($row = $ConsultaSQL->fetch(PDO::FETCH_ASSOC)) {	
  echo '<table  class="table table-striped table-hover table-bordered" id="dynamic-table">
							  <thead>
							  	  <tr>
									  <td rowspan="3" align="center" style="text-align:center; line-height: 100px;"><b>Dificultades</b></td>
									  <td rowspan="3" align="center" style="text-align:center; line-height: 100px;"><b>Análisis de la Causa</b></td> 
									  <td colspan="2" align="center"><b>Plan de Acción para Causa Analizada</b></td> 									  
									  <td colspan="2" align="center"><b>Seguimiento Semestral</b></td> 
									  <td rowspan="3"></td>									  
								  </tr>
								  <tr>
									  <td rowspan="2" align="center" style="text-align:center; line-height: 50px;">Activdad</td> 									  
									  <td rowspan="2" align="center" style="text-align:center; line-height: 50px;">Responsable</td> 
									  <td align="center">Primer Periodo</td> 									  
									  <td align="center">Segundo Periodo</td> 									  
								  </tr>
								  <tr>
									  <td align="center">Fecha: '.$row["fecha_primer_periodo"].'</td> 									  
									  <td align="center">Fecha: '.$row["fecha_segundo_periodo"].'</td> 									  
								  </tr>								  
							  </thead>   
							  <tbody>';
$a++;
printf("
<tr>
<td>%s</td><td>%s</td>
<td>%s</td><td>%s</td>
<td>%s</td><td>%s</td>
<td>%s</td>
</tr>",
$row["difcultades"],
$row["analisis"],
$row["actividad"],
$row["responsable"],
$row["jusft_primer_periodo"],
$row["jusft_segundo_periodo"],
"
						<div class='btn-group pull-right dropup'>
                            <button data-toggle='dropdown' class='btn btn-default dropdown-toggle' type='button'> <span class='caret'></span></button>
                            <ul role='menu' class='dropdown-menu'>
								<li><a data-toggle='modal' href='#editar_info'  class='editar' id='".$row["id_plan_mejora"]."' href='#'>Editar</a></li>
                                <li class='divider'></li>
                                <li><a onClick='eli_mej(id=".$row["id_plan_mejora"].")' href='#'> Eliminar</a></li>
								
                            </ul>
                        </div>"); 
	 }                                                                       
	echo '</tbody></table>';
	}		
}

function valores_historial_mejorar($cod_plan){//Lista Objetivos 
	$a=0;	
    $this->conexion = parent::conectar(); 
	$ConsultaSQL=$this->conexion->prepare("
	SELECT * FROM plan_mejora WHERE cod_evaluacion=:id
	");
	$ConsultaSQL ->bindParam(':id', $cod_plan, PDO::PARAM_INT);
	$ConsultaSQL->execute();
	$numero_filas = $ConsultaSQL->rowCount();
	if(empty($numero_filas)){
		echo "No existen Datos.";
		}
	else{
while ($row = $ConsultaSQL->fetch(PDO::FETCH_ASSOC)) {	
  echo '<table  class="table table-striped table-hover table-bordered" id="dynamic-table">
							  <thead>
							  	  <tr>
									  <td rowspan="3" align="center" style="text-align:center; line-height: 100px;"><b>Dificultades</b></td>
									  <td rowspan="3" align="center" style="text-align:center; line-height: 100px;"><b>Análisis de la Causa</b></td> 
									  <td colspan="2" align="center"><b>Plan de Acción para Causa Analizada</b></td> 									  
									  <td colspan="2" align="center"><b>Seguimiento Semestral</b></td> 								  
								  </tr>
								  <tr>
									  <td rowspan="2" align="center" style="text-align:center; line-height: 50px;">Activdad</td> 									  
									  <td rowspan="2" align="center" style="text-align:center; line-height: 50px;">Responsable</td> 
									  <td align="center">Primer Periodo</td> 									  
									  <td align="center">Segundo Periodo</td> 									  
								  </tr>
								  <tr>
									  <td align="center">Fecha: '.$row["fecha_primer_periodo"].'</td> 									  
									  <td align="center">Fecha: '.$row["fecha_segundo_periodo"].'</td> 									  
								  </tr>								  
							  </thead>   
							  <tbody>';
$a++;
printf("
<tr>
<td>%s</td><td>%s</td>
<td>%s</td><td>%s</td>
<td>%s</td><td>%s</td>
</tr>",
$row["difcultades"],
$row["analisis"],
$row["actividad"],
$row["responsable"],
$row["jusft_primer_periodo"],
$row["jusft_segundo_periodo"]); 
	 }                                                                       
	echo '</tbody></table>';
	}		
}

function valores_listado_mejorar_jefe($cod_plan){//Lista Objetivos 
	$a=0;	
    $this->conexion = parent::conectar(); 
	$ConsultaSQL=$this->conexion->prepare("
	SELECT * FROM plan_mejora WHERE cod_evaluacion=:id
	");
	$ConsultaSQL ->bindParam(':id', $cod_plan, PDO::PARAM_INT);
	$ConsultaSQL->execute();
	$numero_filas = $ConsultaSQL->rowCount();
	if(empty($numero_filas)){
		echo "No existen Datos.";
		}
	else{
while ($row = $ConsultaSQL->fetch(PDO::FETCH_ASSOC)) {	
  echo '<table  class="table table-striped table-hover table-bordered" id="dynamic-table">
							  <thead>
							  	  <tr>
									  <td rowspan="3" align="center" style="text-align:center; line-height: 100px;"><b>Dificultades</b></td>
									  <td rowspan="3" align="center" style="text-align:center; line-height: 100px;"><b>Análisis de la Causa</b></td> 
									  <td colspan="2" align="center"><b>Plan de Acción para Causa Analizada</b></td> 									  
									  <td colspan="2" align="center"><b>Seguimiento Semestral</b></td> 
									  <td rowspan="3"></td>									  
								  </tr>
								  <tr>
									  <td rowspan="2" align="center" style="text-align:center; line-height: 50px;">Activdad</td> 									  
									  <td rowspan="2" align="center" style="text-align:center; line-height: 50px;">Responsable</td> 
									  <td align="center">Primer Periodo</td> 									  
									  <td align="center">Segundo Periodo</td> 									  
								  </tr>
								  <tr>
									  <td align="center">Fecha: '.$row["fecha_primer_periodo"].'</td> 									  
									  <td align="center">Fecha: '.$row["fecha_segundo_periodo"].'</td> 									  
								  </tr>								  
							  </thead>   
							  <tbody>';
$a++;
printf("
<tr>
<td>%s</td><td>%s</td>
<td>%s</td><td>%s</td>
<td>%s</td><td>%s</td>
<td>%s</td>
</tr>",
$row["difcultades"],
$row["analisis"],
$row["actividad"],
$row["responsable"],
$row["jusft_primer_periodo"],
$row["jusft_segundo_periodo"],
"
						<div class='btn-group pull-right dropup'>
                            <button data-toggle='dropdown' class='btn btn-default dropdown-toggle' type='button'> <span class='caret'></span></button>
                            <ul role='menu' class='dropdown-menu'>
								<li><a data-toggle='modal' href='#editar_info'  class='editar_pri' id='".$row["id_plan_mejora"]."' href='#'>Primera Periodo</a></li>	
								<li><a data-toggle='modal' href='#editar_info'  class='editar_seg' id='".$row["id_plan_mejora"]."' href='#'>Segundo Periodo</a></li>																
                            </ul>
                        </div>"); 
	 }                                                                       
	echo '</tbody></table>';
	}		
}

function valores_clase_listado_recursos_jefe($id_eval,$estado,$dia){//Lista Objetivos 
	$a=0;	
    $this->conexion = parent::conectar(); 
	$ConsultaSQL=$this->conexion->prepare("
	SELECT *,CONCAT(nombres_usuario,' ',apellidos_usuario) AS empleado,
	CASE estado_recurso  
	  WHEN 'Pendiente' THEN TO_DAYS( ADDDATE( fecha_recurso, INTERVAL :dia DAY ) ) - TO_DAYS( CURDATE( ) )  
	  WHEN 'Resuelto' THEN 0
	END AS dias_restantes
	FROM recursos
	LEFT JOIN gestion_desempeno ON recursos.cod_evaluacion = gestion_desempeno.cod_evaluacion
	LEFT JOIN usuario ON gestion_desempeno.cod_trabajador = usuario.codigo_usuario
	LEFT JOIN trabajador ON trabajador.cc_trabajador = usuario.codigo_usuario
	WHERE trabajador.id_jefe = :id AND tipo_recurso = 2 AND estado_recurso = :estado
	AND (TO_DAYS( ADDDATE( fecha_recurso, INTERVAL :dia DAY ) ) - TO_DAYS( CURDATE( )) BETWEEN 0 AND 5)
	");
	$ConsultaSQL ->bindParam(':id', $id_eval, PDO::PARAM_INT);
	$ConsultaSQL ->bindParam(':estado', $estado);
	$ConsultaSQL ->bindParam(':dia', $dia);	
	$ConsultaSQL->execute();
	$numero_filas = $ConsultaSQL->rowCount();
	if(empty($numero_filas)){
		echo "No existen Datos.";
		}
	else{
  echo '<table  class="table table-striped table-hover table-bordered" id="dynamic-table">
							  <thead>
								  <tr>
									  <td width="7%" align="center">Nº</td>
									  <td width="43%" align="center">Trabajador</td>
									  <td width="10%" align="center">Año</td> 
									  <td width="20%" align="center">Dias Restantes</td> 									  
									  <td width="10%" align="center">Estado</td>  									  
									  <td width="10%"></td>									  
								  </tr>
							  </thead>   
							  <tbody>';
while ($row = $ConsultaSQL->fetch(PDO::FETCH_ASSOC)) {
if($row["estado_recurso"]=="Pendiente"){$color_estado="warning";}else{$color_estado="danger";}
$a++;
printf("<tr>
<td align='center'>%s</td><td>%s</td><td align='center'>%s</td>
<td align='center'>%s</td><td align='center'>%s</td>
<td>%s</td>
</tr>",
$a,
$row["empleado"],
$row["ano_evaluacion"],
$row["dias_restantes"],
"<span class='label label-".$color_estado."'>".$row["estado_recurso"]."</span>",
"
<a class='btn btn-info ver_rec' data-toggle='modal' data-rel='tooltip' title='Ver'  href='#recurso_info' id='".$row["cod_evaluacion"]."'><i class='fa fa-search'> </i></a>"); 
	 }                                                                       
	echo '</tbody></table>';
	}		
}

function valores_clase_historial_recursos_jefe($id_eval,$estado){//Lista Objetivos 
	$a=0;	
    $this->conexion = parent::conectar(); 
	$ConsultaSQL=$this->conexion->prepare("
	SELECT *,CONCAT(nombres_usuario,' ',apellidos_usuario) AS empleado,
	CASE estado_recurso  
	  WHEN 'Pendiente' THEN TO_DAYS( ADDDATE( fecha_recurso, INTERVAL 11 DAY ) ) - TO_DAYS( CURDATE( ) )  
	  WHEN 'Resuelto' THEN 0
	END AS dias_restantes
	FROM recursos
	LEFT JOIN gestion_desempeno ON recursos.cod_evaluacion = gestion_desempeno.cod_evaluacion
	LEFT JOIN usuario ON gestion_desempeno.cod_trabajador = usuario.codigo_usuario
	LEFT JOIN trabajador ON trabajador.cc_trabajador = usuario.codigo_usuario
	WHERE trabajador.id_jefe = :id AND tipo_recurso = 2 AND estado_recurso = :estado
	");
	$ConsultaSQL ->bindParam(':id', $id_eval, PDO::PARAM_INT);
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
									  <td width="7%" align="center">Nº</td>
									  <td width="43%" align="center">Trabajador</td>
									  <td width="10%" align="center">Año</td> 
									  <td width="20%" align="center">Dias Restantes</td> 									  
									  <td width="10%" align="center">Estado</td>  									  
									  <td width="10%"></td>									  
								  </tr>
							  </thead>   
							  <tbody>';
while ($row = $ConsultaSQL->fetch(PDO::FETCH_ASSOC)) {
if($row["estado_recurso"]=="Pendiente"){$color_estado="warning";}else{$color_estado="danger";}
$a++;
printf("<tr>
<td align='center'>%s</td><td>%s</td><td align='center'>%s</td>
<td align='center'>%s</td><td align='center'>%s</td>
<td>%s</td>
</tr>",
$a,
$row["empleado"],
$row["ano_evaluacion"],
$row["dias_restantes"],
"<span class='label label-".$color_estado."'>".$row["estado_recurso"]."</span>",
"
<a class='btn btn-info ver_rec' data-toggle='modal' data-rel='tooltip' title='Ver'  href='#recurso_info' id='".$row["cod_evaluacion"]."'><i class='fa fa-search'> </i></a>"); 
	 }                                                                       
	echo '</tbody></table>';
	}		
}

function valores_clase_listado_recursos_admin($estado,$dia){//Lista Objetivos 
	$a=0;	
    $this->conexion = parent::conectar(); 
	$ConsultaSQL=$this->conexion->prepare("
	SELECT *,CONCAT(nombres_usuario,' ',apellidos_usuario) AS empleado,
	CASE estado_recurso  
	  WHEN 'Pendiente' THEN TO_DAYS( ADDDATE( fecha_recurso, INTERVAL :dia DAY ) ) - TO_DAYS( CURDATE( ) )  
	  WHEN 'Resuelto' THEN 0
	END AS dias_restantes
	FROM recursos
	LEFT JOIN gestion_desempeno ON recursos.cod_evaluacion = gestion_desempeno.cod_evaluacion
	LEFT JOIN usuario ON gestion_desempeno.cod_trabajador = usuario.codigo_usuario
	LEFT JOIN trabajador ON trabajador.cc_trabajador = usuario.codigo_usuario
	WHERE tipo_recurso = 2 AND estado_recurso = :estado
	AND (TO_DAYS( ADDDATE( fecha_recurso, INTERVAL :dia DAY ) ) - TO_DAYS( CURDATE( )) BETWEEN 0 AND 5)
	");
	$ConsultaSQL ->bindParam(':estado', $estado);
	$ConsultaSQL ->bindParam(':dia', $dia);	
	$ConsultaSQL->execute();
	$numero_filas = $ConsultaSQL->rowCount();
	if(empty($numero_filas)){
		echo "No existen Datos.";
		}
	else{
  echo '<table  class="table table-striped table-hover table-bordered" id="dynamic-table">
							  <thead>
								  <tr>
									  <td width="7%" align="center">Nº</td>
									  <td width="43%" align="center">Trabajador</td>
									  <td width="10%" align="center">Año</td> 
									  <td width="20%" align="center">Dias Restantes</td> 									  
									  <td width="10%" align="center">Estado</td>  									  
									  <td width="10%"></td>									  
								  </tr>
							  </thead>   
							  <tbody>';
while ($row = $ConsultaSQL->fetch(PDO::FETCH_ASSOC)) {
if($row["estado_recurso"]=="Pendiente"){$color_estado="warning";}else{$color_estado="danger";}
$a++;
printf("<tr>
<td align='center'>%s</td><td>%s</td><td align='center'>%s</td>
<td align='center'>%s</td><td align='center'>%s</td>
<td>%s</td>
</tr>",
$a,
$row["empleado"],
$row["ano_evaluacion"],
$row["dias_restantes"],
"<span class='label label-".$color_estado."'>".$row["estado_recurso"]."</span>",
"
<a class='btn btn-info ver_rec' data-toggle='modal' data-rel='tooltip' title='Ver'  href='#recurso_info' id='".$row["cod_evaluacion"]."'><i class='fa fa-search'> </i></a>"); 
	 }                                                                       
	echo '</tbody></table>';
	}		
}

function valores_clase_historial_recursos_admin($estado){//Lista Objetivos 
	$a=0;	
    $this->conexion = parent::conectar(); 
	$ConsultaSQL=$this->conexion->prepare("
	SELECT *,CONCAT(nombres_usuario,' ',apellidos_usuario) AS empleado,
	CASE estado_recurso  
	  WHEN 'Pendiente' THEN TO_DAYS( ADDDATE( fecha_recurso, INTERVAL 11 DAY ) ) - TO_DAYS( CURDATE( ) )  
	  WHEN 'Resuelto' THEN 0
	END AS dias_restantes
	FROM recursos
	LEFT JOIN gestion_desempeno ON recursos.cod_evaluacion = gestion_desempeno.cod_evaluacion
	LEFT JOIN usuario ON gestion_desempeno.cod_trabajador = usuario.codigo_usuario
	LEFT JOIN trabajador ON trabajador.cc_trabajador = usuario.codigo_usuario
	WHERE tipo_recurso = 2 AND estado_recurso = :estado
	");
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
									  <td width="7%" align="center">Nº</td>
									  <td width="43%" align="center">Trabajador</td>
									  <td width="10%" align="center">Año</td> 
									  <td width="20%" align="center">Dias Restantes</td> 									  
									  <td width="10%" align="center">Estado</td>  									  
									  <td width="10%"></td>									  
								  </tr>
							  </thead>   
							  <tbody>';
while ($row = $ConsultaSQL->fetch(PDO::FETCH_ASSOC)) {
if($row["estado_recurso"]=="Pendiente"){$color_estado="warning";}else{$color_estado="danger";}
$a++;
printf("<tr>
<td align='center'>%s</td><td>%s</td><td align='center'>%s</td>
<td align='center'>%s</td><td align='center'>%s</td>
<td>%s</td>
</tr>",
$a,
$row["empleado"],
$row["ano_evaluacion"],
$row["dias_restantes"],
"<span class='label label-".$color_estado."'>".$row["estado_recurso"]."</span>",
"
<a class='btn btn-info ver_rec' data-toggle='modal' data-rel='tooltip' title='Ver'  href='#recurso_info' id='".$row["cod_evaluacion"]."'><i class='fa fa-search'> </i></a>"); 
	 }                                                                       
	echo '</tbody></table>';
	}		
}
	
function consulta_evaluacion_departamento($ano,$id_depar){//Lista Objetivos 	
    $this->conexion = parent::conectar(); 
	$tam=count($id_depar);
	for ($i=0; $i<$tam; $i++)
		{	
		$a=0;
	$ConsultaSQL=$this->conexion->prepare("
SELECT 
 evaluacion.id_evaluacion AS id_eva,
CONCAT(nombres_usuario,' ',apellidos_usuario) AS empleado, ano_evaluacion,
evaluacion.cod_evaluacion, tipo_evaluacion,
SUM(evaluacion.id_evaluacion*(1-abs(sign(num_evaluacion-1)))) AS cod_auto,
SUM(IF(estado_eva='Pendiente',1,2)*(1-abs(sign(num_evaluacion-1)))) AS estado_auto,
SUM(evaluacion.id_evaluacion*(1-abs(sign(num_evaluacion-2)))) AS cod_jefe,
SUM(IF(estado_eva='Pendiente',1,2)*(1-abs(sign(num_evaluacion-2)))) AS estado_jefe,
SUM(evaluacion.id_evaluacion*(1-abs(sign(num_evaluacion-3)))) AS cod_par,
SUM(IF(estado_eva='Pendiente',1,2)*(1-abs(sign(num_evaluacion-3)))) AS estado_par,
SUM(evaluacion.id_evaluacion*(1-abs(sign(num_evaluacion-4)))) AS cod_usuario,
SUM(IF(estado_eva='Pendiente',1,2)*(1-abs(sign(num_evaluacion-4)))) AS estado_usuario,
trabajador_objetivos.estado_eva_objetivos,
(SELECT EXISTS(SELECT * FROM objetivos WHERE cod_evaluacion =  evaluacion.cod_evaluacion AND objetivos.n_seguimiento_objetivo=1)) AS primer_seg,
(SELECT EXISTS(SELECT * FROM objetivos WHERE cod_evaluacion =  evaluacion.cod_evaluacion AND objetivos.n_seguimiento_objetivo=2)) AS segundo_seg,
(SELECT EXISTS(SELECT * FROM objetivos WHERE cod_evaluacion =  evaluacion.cod_evaluacion AND objetivos.n_seguimiento_objetivo=3)) AS tercer_seg
FROM evaluacion
LEFT JOIN gestion_desempeno ON evaluacion.cod_evaluacion = gestion_desempeno.cod_evaluacion
LEFT JOIN usuario ON gestion_desempeno.cod_trabajador = usuario.codigo_usuario
LEFT JOIN trabajador ON gestion_desempeno.cod_trabajador = trabajador.cc_trabajador
LEFT JOIN dependencia ON gestion_desempeno.id_dependencia = dependencia.cod_dependencia
LEFT JOIN trabajador_objetivos ON evaluacion.cod_evaluacion = trabajador_objetivos.cod_evaluacion
LEFT JOIN trabajador_evaluacion ON gestion_desempeno.cod_evaluacion = trabajador_evaluacion.cod_evaluacion
WHERE gestion_desempeno.id_dependencia = :id
AND ano_evaluacion = :ano
GROUP BY evaluacion.cod_evaluacion");
	$ConsultaSQL->bindParam(':id', $id_depar[$i]);
	$ConsultaSQL->bindParam(':ano', $ano);
	$ConsultaSQL->execute();
	$numero_filas = $ConsultaSQL->rowCount();
	if(empty($numero_filas)){
		echo "<br><br>No existen Datos.</br></br></br><hr noshade></br>";
		}
	else{
  echo '<table  class="table table-striped table-hover table-bordered table-condensed" id="dynamic-table">
							  <thead>
							  	  <tr>
								  	<td colspan="7"  align="center">Evaluaciones</td>
									<td colspan="3"  align="center">Seguimientos</td>
								  </tr>
								  <tr>
									  <td width="7%" align="center">Nº</td>
									  <td width="37%" align="center">Trabajador</td>
									  <td width="7%" align="center">Auto</td>
									  <td width="7%" align="center">Jefe</td>  
									  <td width="7%" align="center">Par</td> 
									  <td width="7%" align="center">Usuario</td> 									  
									  <td width="7%" align="center">Objetivos</td>	
									  <td width="7%" align="center">Primer</td> 
									  <td width="7%" align="center">Segundo</td> 									  
									  <td width="7%" align="center">Tercer</td>										  
								  </tr>
							  </thead>   
							  <tbody>';
while ($row = $ConsultaSQL->fetch(PDO::FETCH_ASSOC)) {
if($row["estado_auto"]==1){$color="warning";$estado="Pendiente";}else{$color="success";$estado="Finalizada";}
if($row["estado_jefe"]==1){$color_jefe="warning";$estado_jefe="Pendiente";}else{$color_jefe="success";$estado_jefe="Finalizada";}
if($row["estado_par"]==1){$color_par="warning";$estado_par="Pendiente";}else{$color_par="success";$estado_par="Finalizada";}
if($row["estado_usuario"]==1){$color_usuario="warning";$estado_usuario="Pendiente";}else{$color_usuario="success";$estado_usuario="Finalizada";}
if($row["estado_eva_objetivos"]=="Sin Aprobar"){$color_obj="primary";}else{$color_obj="success";}
if($row["primer_seg"]==1){$color_sega="info";$estado_sega="Realizado";}else{$color_sega="warning";$estado_sega="Pendiente";}
if($row["segundo_seg"]==1){$color_segb="info";$estado_segb="Realizado";}else{$color_segb="warning";$estado_segb="Pendiente";}
if($row["tercer_seg"]==1){$color_segc="info";$estado_segc="Realizado";}else{$color_segc="warning";$estado_segc="Pendiente";}
$a++;
printf("<tr>
<td align='center'>%s</td><td>%s</td><td align='center'>%s</td>
<td align='center'>%s</td><td align='center'>%s</td>
<td align='center'>%s</td><td align='center'>%s</td>
<td align='center'>%s</td><td align='center'>%s</td><td align='center'>%s</td>
</tr>",
$a,
$row["empleado"],
"<span class='label label-".$color."'>".$estado."</span>",
"<span class='label label-".$color_jefe."'>".$estado_jefe."</span>",
"<span class='label label-".$color_par."'>".$estado_par."</span>",
"<span class='label label-".$color_usuario."'>".$estado_usuario."</span>",
"<span class='label label-".$color_obj."'>".$row["estado_eva_objetivos"]."</span>",
"<span class='label label-".$color_sega."'>".$estado_sega."</span>",
"<span class='label label-".$color_segb."'>".$estado_segb."</span>",
"<span class='label label-".$color_segc."'>".$estado_segc."</span>"); 
	 }                                                                       
	echo '
	<tr><td colspan="10"></td></tr>
	</tbody>
	</table></br></br></br><hr noshade></br>';
	}
	}	
}	


function consulta_evaluacion_general($ano,$id_depar){//Lista Objetivos 	
    $this->conexion = parent::conectar(); 
		$a=0;
	$ConsultaSQL=$this->conexion->prepare("
SELECT
	dependencia.cod_dependencia,
 dependencia.nombre_dependencia, 
 ano_evaluacion,
SUM(IF(estado_eva='Pendiente',1,0)) AS pendiente_eva,
SUM(IF(estado_eva='Finalizada',1,0)) AS finalizada_eva,
SUM(IF(estado_eva='Pendiente',1,0)*(1-abs(sign(num_evaluacion-1)))) AS pendiente_auto,
SUM(IF(estado_eva='Finalizada',1,0)*(1-abs(sign(num_evaluacion-1)))) AS finalizada_auto,
SUM(IF(estado_eva='Pendiente',1,0)*(1-abs(sign(num_evaluacion-2)))) AS pendiente_jefe,
SUM(IF(estado_eva='Finalizada',1,0)*(1-abs(sign(num_evaluacion-2)))) AS finalizada_jefe,
SUM(IF(estado_eva='Pendiente',1,0)*(1-abs(sign(num_evaluacion-3)))) AS pendiente_par,
SUM(IF(estado_eva='Finalizada',1,0)*(1-abs(sign(num_evaluacion-3)))) AS finalizada_par,
SUM(IF(estado_eva='Pendiente',1,0)*(1-abs(sign(num_evaluacion-4)))) AS pendiente_usuario,
SUM(IF(estado_eva='Finalizada',1,0)*(1-abs(sign(num_evaluacion-4)))) AS finalizada_usuario,
SUM(IF(trabajador_objetivos.estado_eva_objetivos='Sin Aprobar',1,0)*(1-abs(sign(num_evaluacion-1)))) AS sin_aprobar_obj,
SUM(IF(trabajador_objetivos.estado_eva_objetivos='Aprobado',1,0)*(1-abs(sign(num_evaluacion-1)))) AS aprobar_obj,
SUM(IF(trabajador_objetivos.estado_eva_objetivos='Finalizada',1,0)*(1-abs(sign(num_evaluacion-1)))) AS finalizada_obj
FROM evaluacion
LEFT JOIN gestion_desempeno ON evaluacion.cod_evaluacion = gestion_desempeno.cod_evaluacion
LEFT JOIN trabajador ON gestion_desempeno.cod_trabajador = trabajador.cc_trabajador
LEFT JOIN dependencia ON gestion_desempeno.id_dependencia = dependencia.cod_dependencia
LEFT JOIN trabajador_objetivos ON evaluacion.cod_evaluacion = trabajador_objetivos.cod_evaluacion
LEFT JOIN trabajador_evaluacion ON evaluacion.cod_evaluacion = trabajador_evaluacion.cod_evaluacion
WHERE FIND_IN_SET(gestion_desempeno.id_dependencia, :id)
AND ano_evaluacion = :ano
GROUP BY dependencia.cod_dependencia");
	$ConsultaSQL->bindParam(':id', $id_depar);
	$ConsultaSQL->bindParam(':ano', $ano);
	$ConsultaSQL->execute();
	$numero_filas = $ConsultaSQL->rowCount();
	if(empty($numero_filas)){
		echo "<br><br>No existen Datos.</br></br></br><hr noshade></br>";
		}
	else{
  echo '<table  class="table table-striped table-hover table-bordered table-condensed" id="dynamic-table">
							  <thead>
								  <tr>
									  <td class="b" width="7%" rowspan="3" align="center"></td>
									  <td class="b" width="33%" rowspan="3" align="center">Departamento</td>								  
									  <td  colspan="10" align="center">Evaluaciones</td> 									  										  									  
									  <td class="b" colspan="3" rowspan="2" align="center">Objetivos</td>										  								  
								  </tr>							  
								  <tr>							  
									  <td  colspan="2" align="center">Jefe</td> 									  
									  <td  colspan="2" align="center">Auto</td> 
									  <td  colspan="2" align="center">Par</td> 									  
									  <td  colspan="2" align="center">Usuario</td>			
									  <td  colspan="2" align="center">Total</td>										  									  										  								  
								  </tr>							  
								  <tr> 									  
									  <td  align="center"><span class="label label-warning label-mini">P</span></td> 
									  <td  align="center"><span class="label label-success label-mini">F</span></td> 									  
									  <td  align="center"><span class="label label-warning label-mini">P</span></td> 
									  <td  align="center"><span class="label label-success label-mini">F</span></td>  
									  <td  align="center"><span class="label label-warning label-mini">P</span></td> 
									  <td  align="center"><span class="label label-success label-mini">F</span></td> 
									  <td  align="center"><span class="label label-warning label-mini">P</span></td> 
									  <td  align="center"><span class="label label-success label-mini">F</span></td> 
									  <td  align="center"><span class="label label-warning label-mini">P</span></td> 
									  <td  align="center"><span class="label label-success label-mini">F</span></td>									  
									  <td  align="center"><span class="label label-primary  label-mini">S</span></td> 
									  <td  align="center"><span class="label label-success label-mini">A</span></td>	
									  <td  align="center"><span class="label label-danger label-mini">F</span></td>									  
								  </tr>
							  </thead>   
							  <tbody>';
while ($row = $ConsultaSQL->fetch(PDO::FETCH_ASSOC)) {
$a++;
printf("<tr>
<td align='center'>%s</td><td align='center'>%s</td>
<td align='center'>%s</td><td align='center'>%s</td>
<td align='center'>%s</td><td align='center'>%s</td>
<td align='center'>%s</td><td align='center'>%s</td>
<td align='center'>%s</td><td align='center'>%s</td>
<td align='center'>%s</td><td align='center'>%s</td>
<td align='center'>%s</td><td align='center'>%s</td>
<td align='center'>%s</td>
</tr>",
"<input type='checkbox' class='ads_Checkbox' name='id_dep[]' id='id_dep' value='".$row["cod_dependencia"]."'>",
$row["nombre_dependencia"],
$row["pendiente_jefe"],
$row["finalizada_jefe"],
$row["pendiente_auto"],
$row["finalizada_auto"],
$row["pendiente_par"],
$row["finalizada_par"],
$row["pendiente_usuario"],
$row["finalizada_usuario"],
$row["pendiente_eva"],
$row["finalizada_eva"],
$row["sin_aprobar_obj"],
$row["aprobar_obj"],
$row["finalizada_obj"]
); 
	 }                                                                       
	echo '
	<thead>
	<tr><td colspan="15" align="center">
	<span class="label label-warning label-mini">P</span> Pendiente,
	<span class="label label-success label-mini">F</span> Finalizada,
	<span class="label label-primary label-mini">S</span> Sin Aprobar,
	<span class="label label-success label-mini">A</span> Aprobado	
	<span class="label label-danger label-mini">F</span> Finalizada	
	</td></tr>
	</thead>
	</tbody>
	</table></br>';
	}	
}

function consulta_evaluacion_resultado($ano,$id_depar,$estado){//Lista Objetivos 	
    $this->conexion = parent::conectar(); 
	$tam=count($id_depar);
	for ($i=0; $i<$tam; $i++)
		{	
		$a=0;
	$ConsultaSQL=$this->conexion->prepare("
SELECT 
 CONCAT(usuario.nombres_usuario,' ',usuario.apellidos_usuario) AS Empleado,
 dependencia.nombre_dependencia,
 cargo.nombre_cargo,
 nivel.nombre_nivel,
  total_gestion_desempeno,
estado_gestion_desempeno
FROM gestion_desempeno
LEFT JOIN usuario ON gestion_desempeno.cod_trabajador = usuario.codigo_usuario
LEFT JOIN trabajador ON gestion_desempeno.cod_trabajador = trabajador.cc_trabajador
LEFT JOIN dependencia ON gestion_desempeno.id_dependencia = dependencia.cod_dependencia
LEFT JOIN cargo ON  gestion_desempeno.id_cargo_trabajador =  cargo.id_cargo
LEFT JOIN nivel ON gestion_desempeno.id_nivel_trabajador =  nivel.id_nivel
WHERE gestion_desempeno.id_dependencia = :id
AND ano_evaluacion = :ano
AND FIND_IN_SET(estado_gestion_desempeno,:estado)");
	$ConsultaSQL->bindParam(':id', $id_depar[$i]);
	$ConsultaSQL->bindParam(':ano', $ano);
	$ConsultaSQL->bindParam(':estado', $estado);	
	$ConsultaSQL->execute();
	$numero_filas = $ConsultaSQL->rowCount();
	if(empty($numero_filas)){
		echo "<br><br>No existen Datos.</br></br></br><hr noshade></br>";
		}
	else{
  echo '<table  class="table table-striped table-hover table-bordered table-condensed" id="dynamic-table">
							  <thead>
								  <tr>
									  <td width="7%" align="center">Nº</td>
									  <td width="33%" align="center">Trabajador</td>
									  <td width="30%" align="center">Cargo</td>
									  <td width="10%" align="center">Nivel</td>  
									  <td width="10%" align="center">Estado</td> 
									  <td width="10%" align="center">Calificacion</td> 									  									  
								  </tr>
							  </thead>   
							  <tbody>';
while ($row = $ConsultaSQL->fetch(PDO::FETCH_ASSOC)) {
if($row["estado_gestion_desempeno"]=="Sobresaliente"){$color="success";$estado="Sobresaliente";}elseif($row["estado_gestion_desempeno"]=="Sastifactorio"){$color="warning";$estado="Sastifactorio";}else{$color="danger";$estado="Insactifactorio";}
$a++;
printf("<tr>
<td align='center'>%s</td><td>%s</td><td align='center'>%s</td>
<td align='center'>%s</td><td align='center'>%s</td><td align='center'>%s</td>
</tr>",
$a,
$row["Empleado"],
$row["nombre_cargo"],
$row["nombre_nivel"],
"<span class='label label-".$color."'>".$estado."</span>",
$row["total_gestion_desempeno"]
); 
	 }                                                                       
	echo '
	<tr><td colspan="10"></td></tr>
	</tbody>
	</table></br></br></br><hr noshade></br>';
	}
	}	
}			
	
	
}
?>