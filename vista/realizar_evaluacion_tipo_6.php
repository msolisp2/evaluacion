﻿<?php
session_start();
	if($_SESSION["tipo"]=="2" || $_SESSION["tipo"]=="3") 
	{
$cod_eva=$_REQUEST["cod_eva"];
$id_config=2;
require_once("../controlador/contro_clase_evaluacion.php");
$eval=new clase_evaluacion();
$eval->valores_clase_evaluacion($cod_eva);
$config=new clase_evaluacion();
$config->valores_clase_configuracion($id_config);
date_default_timezone_set('America/Bogota');
$hoy=date("Y-m-d")
?>
<style type="text/css">
table , td, th {
    border-collapse: collapse !important;
}
table + table, table + table tr:first-child th, table + table tr:first-child td {
    border-top: 0 !important;
}
.td_center {
text-align:center !important;
vertical-align:middle !important;
}
/*
   Vertical text
   by @kizmarh
*/
.vertical-text {
	display: inline-block;
	overflow: hidden;
	width: 1.5em;
	position:relative;
    top:250px;
}
.vertical-text_dos {
	display: inline-block;
	overflow: hidden;
	width: 1.5em;
	position:relative;
    top:150px;
}
.vertical-text__inner {
	display: inline-block;
	white-space: nowrap;
	line-height: 1.5;
	transform: translate(0,100%) rotate(-90deg);
	transform-origin: 0 0;
}
/* This element stretches the parent to be square
   by using the mechanics of vertical margins  */
.vertical-text__inner:after {
	content: "";
	display: block;
	margin: -1.5em 0 100%;
}
}
</style>
<form id="form_eval" class="form-horizontal" method="post" data-validate="parsley">
<input type="hidden" id="cod_eva" name="cod_eva" value="<?php echo $cod_eva ?>">
<input type="hidden" id="cod_eva_trab" name="cod_eva_trab" value="<?php echo $eval->codigo_eva ?>">
<br>
<center>
<div id="info_c"></div>
Mostrar Cabecera
<input type="checkbox" name="check_objetivo" id="check_objetivo" value="1" onchange="javascript:showContent()" />
</center>
<br>
<div id="content_objetivo" style="display: none;">
				<table class="table table-bordered">
                                <tr>
                                    <td rowspan="3" align="center"><img src="../estilos/images/udc2.png" alt="Smiley face" height="100" width="100"></td>
                                    <td colspan="2" align="center"><strong>UNIVERSIDAD DE CARTAGENA</strong></td>
                                    <td><strong>CÓDIGO:</strong> FO-TH/AL-030</td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center"><strong>OFICINA ASESORA DE GESTIÓN HUMANA Y DESARROLLO DE PERSONAL</strong></td>
									<td><strong>VERSIÓN:</strong> 03</td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center"><strong>GESTIÓN DEL DESEMPEÑO PARA EMPLEADOS PÚBLICOS NO DOCENTES Y TRABAJADORES OFICIALES</strong></td>
									<td><strong>FECHA:</strong> 13/12/2010</td>
                                </tr>
								<tr>
                                    <td colspan="4" align="justify"><strong>Referencia:</strong> Formato <strong>B-6 - Evaluación de competencias del nivel Administrativo</strong></td>
                                </tr>
								<tr>
                                    <td colspan="4" align="justify"><strong>Objetivo:</strong>evaluar las competencias laborales de los empleados que se encuentren en el nivel Administrativo.</td>
                                </tr>
								<tr>
                                    <td colspan="4" align="center">
									<ul>
										 <li align="justify"><strong>Inferior:</strong>  durante el periodo la competencia no se cumple o su cumplimiento dista mucho de los niveles y patrones establecidos.</li>
										 <li align="justify"><strong>Medio:</strong>  durante el período la competencia se cumple, pero requiere aplicar esfuerzos para mejorar los niveles y patrones establecidos.</li>
									     <li align="justify"><strong>Superior:</strong>  durante el período la competencia se cumple de manera tal que supera ampliamente los patrones y niveles establecidos.</li>											
									</ul>											
									</td>
                                </tr>								
				</table>
				<table class="table table-bordered">
								<tr>
                                    <td width="30%" align="left"><strong>Fecha de diligenciamiento:</strong></td>
									<td align="left"><?php   echo date("Y-m-d");  ?></td>
                                </tr>	
                </table>
				<table class="table table-bordered">
								<tr>
								  <td width="20%" align="center"><strong>Evaluado</strong></td>
								  <td width="40%"><?php  echo $eval->empleado ?></td>
								  <td width="10%" align="center"><strong>Cargo</strong></td>
								  <td width="30%"><?php   echo $eval->empleado_cargo ?></td>
								</tr>	
								<tr>
								  <td width="20%" align="center"><strong>Evaluador</strong></td>
								  <td width="40%"><?php  echo $eval->jefe ?></td>
								  <td width="10%" align="center"><strong>Cargo</strong></td>
								  <td width="30%"><?php  echo $eval->jefe_cargo ?></td>
								</tr>
				</table>
				</div>	
				<?php if(($hoy >= $eval->inicio) && ($hoy <= $eval->fin)){ ?>
				<table class="table table-bordered">
								<tr>
                                    <td rowspan="3" width="50%" align="center"><strong><br><br>COMPETENCIAS</strong></td>
                                    <td colspan="5" width="30%"align="center"><strong>VALORACIÓN</strong></td>
                                    <td rowspan="3" width="20%"align="center"><strong><br><br>CALIFICACIÓN</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="5" align="center"><strong>NIVEL DE EJECUCIÓN</strong></td>
                                </tr>			
                                <tr>
									<td width="10%" align="center"><strong>INFERIOR</strong></td>
									<td width="10%" align="center"><strong>MEDIO</strong></td>
                                    <td width="10%" align="center"><strong>SUPERIOR</strong></td>
                                </tr>
				</table>
						<table class="table table-bordered">			
								<tr>
                                    <td rowspan="7" width="5%" align="center"><div class="vertical-text"><div class="vertical-text__inner"><strong>COMPETENCIAS INSTITUCIONALES</strong></div></div></td>
									<td width="45%" align="justify"><strong>PERTINENCIA Y ARTICULACIÓN CON EL ENTORNO:</strong>
									tiene en cuenta las necesidades que pueden surgir en el entorno, identificándolas y proponiendo ideas para satisfacerlas.

                                    </td>
                                    <td width="10%" align="center" class="td_center"><strong>1- 2</strong></td>
									<td width="10%" align="center" class="td_center"><strong>3</strong></td>
                                    <td width="10%" align="center" class="td_center"><strong>4 - 5</strong></td>
                                    <td width="20%"align="center" class="td_center">
									<div class="form-group">
									  <div class="col-lg-12">
									  <input class="form-control input-lg m-bot5" type="number" id="nota1" name="nota[]" min="0" max="5" value="<?php echo $eval->a; ?>" data-required="true">
									  </div>
								    </div>
									</td>
                                </tr>
								<tr>
									<td width="45%" align="justify"><strong>INNOVACIÓN Y CREATIVIDAD:</strong>
									genera ideas que aporten al mejoramiento del cargo y a la ejecución de sus funciones, es recursivo y efectivo en el aprovechamiento de los recursos.

									</td>
                                    <td width="10%" align="center" class="td_center"><strong>1- 2</strong></td>
									<td width="10%" align="center" class="td_center"><strong>3</strong></td>
                                    <td width="10%" align="center" class="td_center"><strong>4 - 5</strong></td>
                                    <td width="20%"align="center" class="td_center">
									<div class="form-group">
									  <div class="col-lg-12">
									  <input class="form-control input-lg m-bot5" type="number" id="nota2" name="nota[]" min="0" max="5" value="<?php echo $eval->b; ?>" data-required="true">
									  </div>
								    </div>
								</td>
                                </tr>	
								<tr>
									<td width="45%" align="justify"><strong>VISION DE CALIDAD ACADEMICA:</strong>
									identifica la importancia de la gestión docente y actúa oportunamente ante los requerimientos del área docente.

									</td>
                                    <td width="10%" align="center" class="td_center"><strong>1- 2</strong></td>
									<td width="10%" align="center" class="td_center"><strong>3</strong></td>
                                    <td width="10%" align="center" class="td_center"><strong>4 - 5</strong></td>
                                    <td width="20%"align="center" class="td_center">
									<div class="form-group">
									  <div class="col-lg-12">
									  <input class="form-control input-lg m-bot5" type="number" id="nota3" name="nota[]" min="0" max="5" value="<?php echo $eval->c; ?>" data-required="true">
									  </div>
								    </div>
									</td>
                                </tr>
								<tr>
									<td width="45%" align="justify"><strong>LIDERAZGO:</strong>
									contribuye con su liderazgo personal al logro de los objetivos y de los planes del área o dependencia en la que se desempeña.

									</td>
                                    <td width="10%" align="center" class="td_center"><strong>1- 2</strong></td>
									<td width="10%" align="center" class="td_center"><strong>3</strong></td>
                                    <td width="10%" align="center" class="td_center"><strong>4 - 5</strong></td>
                                    <td width="20%"align="center" class="td_center">
									<div class="form-group">
									  <div class="col-lg-12">
									  <input class="form-control input-lg m-bot5" type="number" id="nota4" name="nota[]" min="0" max="5" value="<?php echo $eval->d; ?>" data-required="true">
									  </div>
								    </div>
									</td>
                                </tr>
								<tr>
									<td width="45%" align="justify"><strong>COMPETITIVIDAD:</strong>
									interés en causar un impacto positivo en clientes internos y externos de la institución de tal manera que con su gestión aumente la probabilidad de que la institución sea escogida como preferente en la comunidad académica.

									</td>
                                    <td width="10%" align="center" class="td_center"><strong>1- 2</strong></td>
									<td width="10%" align="center" class="td_center"><strong>3</strong></td>
                                    <td width="10%" align="center" class="td_center"><strong>4 - 5</strong></td>
                                    <td width="20%"align="center" class="td_center">
									<div class="form-group">
									  <div class="col-lg-12">
									  <input class="form-control input-lg m-bot5" type="number" id="nota5" name="nota[]" min="0" max="5" value="<?php echo $eval->e; ?>" data-required="true">
									  </div>
								    </div>
									</td>
                                </tr>
								<tr>
									<td width="45%" align="justify"><strong>SENSIBILIDAD Y CONCIENCIA SOCIAL:</strong>
									es capaz de regular conductas ajenas, identificando necesidades del entorno y contribuir a su satisfacción.

									</td>
                                    <td width="10%" align="center" class="td_center"><strong>1- 2</strong></td>
									<td width="10%" align="center" class="td_center"><strong>3</strong></td>
                                    <td width="10%" align="center" class="td_center"><strong>4 - 5</strong></td>
                                    <td width="20%"align="center" class="td_center">
									<div class="form-group">
									  <div class="col-lg-12">
									  <input class="form-control input-lg m-bot5" type="number" id="nota6" name="nota[]" min="0" max="5" value="<?php echo $eval->f; ?>" data-required="true">
									  </div>
								    </div>
									</td>
                                </tr>
								<tr>
									<td width="45%" align="justify"><strong>ORIENTACIÓN AL DESARROLLO:</strong>
									contribuye a la adaptación de los procesos a los avances tecnológicos, de mercado o estándares de calidad, aportando en el desarrollo de la formación del personal que se desempeña en la organización.

									</td>
                                    <td width="10%" align="center" class="td_center"><strong>1- 2</strong></td>
									<td width="10%" align="center" class="td_center"><strong>3</strong></td>
                                    <td width="10%" align="center" class="td_center"><strong>4 - 5</strong></td>
                                    <td width="20%"align="center" class="td_center">
									<div class="form-group">
									  <div class="col-lg-12">
									  <input class="form-control input-lg m-bot5" type="number" id="nota7" name="nota[]" min="0" max="5" value="<?php echo $eval->g; ?>" data-required="true">
									  </div>
								    </div>
									</td>
                                </tr>
								<tr>
                                    <td rowspan="5" width="5%" align="center"><div class="vertical-text_dos"><div class="vertical-text__inner"><strong>COMPETENCIAS COMUNES</strong></div></div></td>
									<td width="45%" align="justify"><strong>COMPROMISO INSTITUCIONAL:</strong>
									promueve las metas de la organización y respeta sus normas, antepone las necesidades de la organización a sus propias necesidades, apoya a la organización en situaciones difíciles, demostrando sentido de pertenencia en todas sus acciones y un alto compromiso en el desarrollo de su trabajo, el cual se caracteriza por cumplir con elevados estándares de calidad, llegando a superar las expectativas de su grupo.

									</td>
                                    <td width="10%" align="center" class="td_center"><strong>1- 2</strong></td>
									<td width="10%" align="center" class="td_center"><strong>3</strong></td>
                                    <td width="10%" align="center" class="td_center"><strong>4 - 5</strong></td>
                                    <td width="20%"align="center" class="td_center">
									<div class="form-group">
									  <div class="col-lg-12">
									  <input class="form-control input-lg m-bot5" type="number" id="nota8" name="nota[]" min="0" max="5" value="<?php echo $eval->h; ?>" data-required="true">
									  </div>
								    </div>
									</td>
                                </tr>
								<tr>
									<td width="45%" align="justify"><strong>ORIENTACION A RESULTADOS:</strong>
									cumple con oportunidad objetivos y metas establecidas por la entidad y las funciones que le son asignadas, asumiendo la responsabilidad por sus resultados, compromete recursos y tiempos para mejorar la productividad tomando las medidas necesarias para minimizar los riesgos y realiza todas las acciones necesarias para alcanzar los objetivos propuestos enfrentando los obstáculos que se presentan.

									</td>
                                    <td width="10%" align="center" class="td_center"><strong>1- 2</strong></td>
									<td width="10%" align="center" class="td_center"><strong>3</strong></td>
                                    <td width="10%" align="center" class="td_center"><strong>4 - 5</strong></td>
                                    <td width="20%"align="center" class="td_center">
									<div class="form-group">
									  <div class="col-lg-12">
									  <input class="form-control input-lg m-bot5" type="number" id="nota9" name="nota[]" min="0" max="5" value="<?php echo $eval->i; ?>" data-required="true">
									  </div>
								    </div>
									</td>
                                </tr>	
								<tr>
									<td width="45%" align="justify"><strong>TRANSPARENCIA:</strong>
									proporciona información veraz, objetiva y basada en hechos, facilita el acceso a la información relacionada con sus responsabilidades y con el servicio a cargo de la Universidad. Demuestra imparcialidad en sus decisiones, ejecuta sus funciones con base en las normas y criterios aplicables y utiliza adecuadamente los recursos de la entidad para el desarrollo de las labores y la prestación del servicio.

									</td>
                                    <td width="10%" align="center" class="td_center"><strong>1- 2</strong></td>
									<td width="10%" align="center" class="td_center"><strong>3</strong></td>
                                    <td width="10%" align="center" class="td_center"><strong>4 - 5</strong></td>
                                    <td width="20%"align="center" class="td_center">
									<div class="form-group">
									  <div class="col-lg-12">
									  <input class="form-control input-lg m-bot5" type="number" id="nota10" name="nota[]" min="0" max="5" value="<?php echo $eval->j; ?>" data-required="true">
									  </div>
								    </div>
									</td>
                                </tr>
								<tr>
									<td width="45%" align="justify"><strong>ORIENTACIÓN AL USUARIO Y AL CIUDADANO:</strong>
									atiende y valora las necesidades y peticiones de los usuarios y de ciudadanos en general respondiendo oportunamente de conformidad con el servicio que ofrece la entidad y considera las mismas al diseñar proyectos o servicios.

									</td>
                                    <td width="10%" align="center" class="td_center"><strong>1- 2</strong></td>
									<td width="10%" align="center" class="td_center"><strong>3</strong></td>
                                    <td width="10%" align="center" class="td_center"><strong>4 - 5</strong></td>
                                    <td width="20%"align="center" class="td_center">
									<div class="form-group">
									  <div class="col-lg-12">
									  <input class="form-control input-lg m-bot5" type="number" id="nota11" name="nota[]" min="0" max="5" value="<?php echo $eval->k; ?>" data-required="true">
									  </div>
								    </div>
									</td>
                                </tr>
								<tr>
									<td width="45%" align="justify"><strong>RESPONSABILIDAD:</strong>
									presenta una adecuada disposición para asumir los compromisos y cumplirlos en los plazos establecidos asumiendo las posibles consecuencias de sus actos y muestra habilidad para agregar valor en el desarrollo de todas las actividades y el cumplimiento de estas en el tiempo estipulado. Tiene clara conciencia del cuidado de los bienes que se le han asignado para la realización del trabajo y acepta que hay actividades que no puede realizar en plazos requeridos.

									</td>
                                    <td width="10%" align="center" class="td_center"><strong>1- 2</strong></td>
									<td width="10%" align="center" class="td_center"><strong>3</strong></td>
                                    <td width="10%" align="center" class="td_center"><strong>4 - 5</strong></td>
                                    <td width="20%"align="center" class="td_center">
									<div class="form-group">
									  <div class="col-lg-12">
									  <input class="form-control input-lg m-bot5" type="number" id="nota12" name="nota[]" min="0" max="5" value="<?php echo $eval->m; ?>" data-required="true">
									  </div>
								    </div>
									</td>
                                </tr>
								<tr>
                                    <td rowspan="8" width="5%" align="center"><div class="vertical-text"><div class="vertical-text__inner"><strong>COMPETENCIAS DEL CARGO</strong></div></div></td>
									<td width="45%" align="justify"><strong>RELACIONES INTERPERSONALES:</strong>
									se esfuerza constantemente por ser una persona íntegra, que genera desarrollo personal y organizacional y que inspira confianza. Establece y mantiene relaciones armónicas, afectivas, honestas y efectivas para el logro de sus proyectos.

									</td>
                                    <td width="10%" align="center" class="td_center"><strong>1- 2</strong></td>
									<td width="10%" align="center" class="td_center"><strong>3</strong></td>
                                    <td width="10%" align="center" class="td_center"><strong>4 - 5</strong></td>
                                    <td width="20%"align="center" class="td_center">
									<div class="form-group">
									  <div class="col-lg-12">
									  <input class="form-control input-lg m-bot5" type="number" id="nota13" name="nota[]" min="0" max="5" value="<?php echo $eval->n; ?>" data-required="true">
									  </div>
								    </div>
									</td>
                                </tr>
								<tr>
									<td width="45%" align="justify"><strong>PREOCUPACIÓN POR EL ORDEN Y LA CALIDAD:</strong>
									realiza el seguimiento del trabajo de los demás vigilando su calidad para asegurarse de que se siguen los procedimientos establecidos. Se preocupa por dejar claras las normas y procedimientos, explicándolos a sus colaboradores y apoyándolos para su mejor funcionamiento.

									</td>
                                    <td width="10%" align="center" class="td_center"><strong>1- 2</strong></td>
									<td width="10%" align="center" class="td_center"><strong>3</strong></td>
                                    <td width="10%" align="center" class="td_center"><strong>4 - 5</strong></td>
                                    <td width="20%"align="center" class="td_center">
									<div class="form-group">
									  <div class="col-lg-12">
									  <input class="form-control input-lg m-bot5" type="number" id="nota14" name="nota[]" min="0" max="5" value="<?php echo $eval->l; ?>" data-required="true">
									  </div>
								    </div>
									</td>
                                </tr>	
								<tr>
									<td width="45%" align="justify"><strong>COMUNICACIÓN ORAL:</strong>
									se comunica de forma asertiva y honesta, teniendo en cuenta a los demás miembros del equipo; se expresa de forma persuasiva, tratando de convencer a los demás de ideas u opiniones que favorezcan al grupo de trabajo.

									</td>
                                    <td width="10%" align="center" class="td_center"><strong>1- 2</strong></td>
									<td width="10%" align="center" class="td_center"><strong>3</strong></td>
                                    <td width="10%" align="center" class="td_center"><strong>4 - 5</strong></td>
                                    <td width="20%"align="center" class="td_center">
									<div class="form-group">
									  <div class="col-lg-12">
									  <input class="form-control input-lg m-bot5" type="number" id="nota15" name="nota[]" min="0" max="5" value="<?php echo $eval->o; ?>" data-required="true">
									  </div>
								    </div>
									</td>
                                </tr>
								<tr>
									<td width="45%" align="justify"><strong>COMUNICACIÓN ESCRITA:</strong>
									capacidad para redactar ideas que tengan concordancia, que sean claras, precisas y entendibles, que estén bien estructuradas tanto lógica como gramaticalmente, y que transmitan un mensaje.

									</td>
                                    <td width="10%" align="center" class="td_center"><strong>1- 2</strong></td>
									<td width="10%" align="center" class="td_center"><strong>3</strong></td>
                                    <td width="10%" align="center" class="td_center"><strong>4 - 5</strong></td>
                                    <td width="20%"align="center" class="td_center">
									<div class="form-group">
									  <div class="col-lg-12">
									  <input class="form-control input-lg m-bot5" type="number" id="nota16" name="nota[]" min="0" max="5" value="<?php echo $eval->p; ?>" data-required="true">
									  </div>
								    </div>
									</td>
                                </tr>
								<tr>
									<td width="45%" align="justify"><strong>ADAPTABILIDAD:</strong>
									posee una alta capacidad para enfrentar situaciones cambiantes e innovadoras, conjugando con un gran dominio la estabilidad y la versatilidad.

									</td>
                                    <td width="10%" align="center" class="td_center"><strong>1- 2</strong></td>
									<td width="10%" align="center" class="td_center"><strong>3</strong></td>
                                    <td width="10%" align="center" class="td_center"><strong>4 - 5</strong></td>
                                    <td width="20%"align="center" class="td_center">
									<div class="form-group">
									  <div class="col-lg-12">
									  <input class="form-control input-lg m-bot5" type="number" id="nota17" name="nota[]" min="0" max="5" value="<?php echo $eval->q; ?>" data-required="true">
									  </div>
								    </div>
									</td>
                                </tr>
								<tr>
									<td width="45%" align="justify"><strong>ORIENTACIÓN Y ATENCIÓN AL CLIENTE:</strong>
									sus acciones están dirigidas a comprender y satisfacer a los clientes, busca explorar las necesidades e inquietudes de cada cliente, brindando un trato personalizado que demuestra interés en cada uno de los mismos y considera la plena satisfacción del cliente como un criterio esencial para la planificación de futuras actividades.

									</td>
                                    <td width="10%" align="center" class="td_center"><strong>1- 2</strong></td>
									<td width="10%" align="center" class="td_center"><strong>3</strong></td>
                                    <td width="10%" align="center" class="td_center"><strong>4 - 5</strong></td>
                                    <td width="20%"align="center" class="td_center">
									<div class="form-group">
									  <div class="col-lg-12">
									  <input class="form-control input-lg m-bot5" type="number" id="nota18" name="nota[]" min="0" max="5" value="<?php echo $eval->r; ?>" data-required="true">
									  </div>
								    </div>
									</td>
                                </tr>
								<tr>
									<td width="45%" align="justify"><strong>MANEJO DE LA INFORMACIÓN:</strong>
									es capaz de discernir qué se puede hacer público y qué no. Transmite información oportuna y objetiva.

									</td>
                                    <td width="10%" align="center" class="td_center"><strong>1- 2</strong></td>
									<td width="10%" align="center" class="td_center"><strong>3</strong></td>
                                    <td width="10%" align="center" class="td_center"><strong>4 - 5</strong></td>
                                    <td width="20%"align="center" class="td_center">
									<div class="form-group">
									  <div class="col-lg-12">
									  <input class="form-control input-lg m-bot5" type="number" id="nota19" name="nota[]" min="0" max="5" value="<?php echo $eval->s; ?>" data-required="true">
									  </div>
								    </div>
									</td>
                                </tr>		
								<tr>
									<td width="45%" align="justify"><strong>TRABAJO EN EQUIPO:</strong>
									anima y motiva a los demás, sabiendo reconocer en el seno del grupo el mérito de otros miembros, resaltando sus valores positivos, la colaboración prestada, haciéndoles sentirse importantes dentro del grupo.

									</td>
                                    <td width="10%" align="center" class="td_center"><strong>1- 2</strong></td>
									<td width="10%" align="center" class="td_center"><strong>3</strong></td>
                                    <td width="10%" align="center" class="td_center"><strong>4 - 5</strong></td>
                                    <td width="20%"align="center" class="td_center">
									<div class="form-group">
									  <div class="col-lg-12">
									  <input class="form-control input-lg m-bot5" type="number" id="nota20" name="nota[]" min="0" max="5" value="<?php echo $eval->t; ?>" data-required="true">
									  </div>
								    </div>
									</td>
                                </tr>	
								<tr>
									<td colspan="5" align="right"><strong>Calificación Total</strong></td>
                                    <td width="20%"align="center" class="td_center">
									<div class="form-group">
									  <div class="col-lg-12">
									  <input class="form-control input-lg m-bot6" name="total" id="total" type="text" value="<?php echo $eval->Total; ?>" readonly>
									  </div>
								    </div>
									</td>
                                </tr>								
							</table>
									<div class="row">
										<div class="col-lg-5"></div>
										<div class="col-lg-3">
									     <div class="form-group" align="center">  
										 <strong>Estado</strong><br>
												  <select class="form-control m-bot15" id="estado_eval" name="estado_eval" data-required="true">
													<option value="">Seleccione Estado</option>
													<option value="Pendiente">Sin Finalizar</option>
													<option value="Finalizada">Finalizada</option>
												  </select>  <span class="label label-warning"><?php echo $eval->Estado; ?></span> 
										  </div> 
									  </div> 
									  </div>
									  <br>
									<div class="row">
										<div class="col-lg-5"></div>
										<div class="col-lg-3">
											<div class="box-footer" align="center">
												<button type="submit" class="btn btn-primary">Actualizar</button>
												<button type="reset" class="btn btn-danger">Cancelar</button>
											</div>
									  </div> 
									  </div>											  								  
								 <?php  }
								 else { ?>				
								  <div class="alert alert-warning fade in">
										<button data-dismiss="alert" class="close close-sm" type="button">
											<i class="fa fa-times"></i>
										</button>
										<strong>Atencion!</strong> Debe esperar las fechas establecidas por el administrador del sistema. <?php echo"(".$eval->inicio." <b>a</b> ".$eval->fin.")"?> 
								 </div>							 
						<?php  } ?>				  
</form>									  
<script type="text/javascript">
$("#form_eval").parsley();
$('#info_c').html('<img src="../estilos/images/input-spinner.gif" alt="" />').fadeOut(1000);
    function showContent() {
        element = document.getElementById("content_objetivo");
        check = document.getElementById("check_objetivo");
        if (check.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }
	//Suma
$('.m-bot5').blur(function () {
    var sum = 0;
    $('.m-bot5').each(function() {
        if($(this).val()!="")
         {
            sum += parseFloat($(this).val());
         }

    });
		$('#total').val(sum);
        //alert(sum);
});	
</script>
<script type="text/javascript">
$(document).ready(function()
{		
	$(document).on('submit', '#form_eval', function()
	{
		var data = $(this).serialize();
		$.ajax({		
		type : 'POST',
		url  : '../controlador/contro_act_evaluacion.php',
		data : data,
		success :  function(data)
				   {					
					$("#form_eval").fadeOut(500).hide(function()
						{	
						var mydata= jQuery.parseJSON(data);						
						notif({
								msg: mydata.suceso,
								type: mydata.evento
								});
						});				
				   }
		});
		return false;
	});
});
</script>
<?php
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