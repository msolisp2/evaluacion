<?php
session_start();
	if($_SESSION["tipo"]=="2" || $_SESSION["tipo"]=="3") 
	{
$cod_eva=$_REQUEST["cod_eva"];
require_once("../controlador/contro_clase_evaluacion.php");
$eval=new clase_evaluacion();
$eval->valores_clase_evaluacion($cod_eva);
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
                                    <td><strong>CÓDIGO:</strong> FO-TH/AL-026</td>
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
                                    <td colspan="4" align="justify"><strong>Referencia:</strong> Formato <strong>B-2 - Evaluación de Competencias del nivel Asesor</strong></td>
                                </tr>
								<tr>
                                    <td colspan="4" align="justify"><strong>Objetivo:</strong> evaluar las competencias laborales de los empleados que se encuentren en el nivel Asesor.</td>
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
									<td align="left"><?php  echo $eval->Fecha  ?></td>
                                </tr>	
                </table>
				<table class="table table-bordered">
								<tr>
								  <td width="20%" align="center"><strong>Evaluado</strong></td>
								  <td width="40%"><?php  echo $eval->empleado ?></td>
								  <td width="10%" align="center"><strong>Cargo</strong></td>
								  <td width="30%"><?php   echo $eval->empleado_cargo ?></td>
								</tr>	
								<?php if($_SESSION["tipo"]=="2"){ ?>
								<tr>
								  <td width="20%" align="center"><strong>Evaluador</strong></td>
								  <td width="40%"><?php  echo $eval->jefe ?></td>
								  <td width="10%" align="center"><strong>Cargo</strong></td>
								  <td width="30%"><?php  echo $eval->jefe_cargo ?></td>
								</tr>
								<?php }?>
				</table>
				</div>	
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
									orienta los objetivos misionales al desarrollo del entorno, estando en constante vínculo con el medio y aportando para resolver necesidades con la prestación de servicios en el desarrollo de diferentes áreas del saber.

									</td>
                                    <td width="10%" align="center" class="td_center"><strong>1- 2</strong></td>
									<td width="10%" align="center" class="td_center"><strong>3</strong></td>
                                    <td width="10%" align="center" class="td_center"><strong>4 - 5</strong></td>
                                    <td width="20%"align="center" class="td_center"><strong><?php echo $eval->a; ?></strong></td>
                                </tr>
								<tr>
									<td width="45%" align="justify"><strong>INNOVACIÓN Y CREATIVIDAD:</strong>
									propicia espacios para el desarrollo de ideas y soluciones creativas a los problemas propios de su área de trabajo o a aquellos sobre los que se espere una respuesta institucional. Mentalidad abierta y flexible.

									</td>
                                    <td width="10%" align="center" class="td_center"><strong>1- 2</strong></td>
									<td width="10%" align="center" class="td_center"><strong>3</strong></td>
                                    <td width="10%" align="center" class="td_center"><strong>4 - 5</strong></td>
                                    <td width="20%"align="center" class="td_center"><strong><?php echo $eval->b; ?></strong></td>
                                </tr>	
								<tr>
									<td width="45%" align="justify"><strong>VISION DE CALIDAD ACADEMICA:</strong>
									desarrolla acciones a partir de la atención a aspectos pedagógicos, didácticos entendiendo la naturaleza de la institución y de los estudiantes.

									</td>
                                    <td width="10%" align="center" class="td_center"><strong>1- 2</strong></td>
									<td width="10%" align="center" class="td_center"><strong>3</strong></td>
                                    <td width="10%" align="center" class="td_center"><strong>4 - 5</strong></td>
                                    <td width="20%"align="center" class="td_center"><strong><?php echo $eval->c; ?></strong></td>
                                </tr>
								<tr>
									<td width="45%" align="justify"><strong>LIDERAZGO:</strong>
									promueve y gestiona acciones externas conducentes a vincular y posicionar la UNIVERSIDAD DE CARTAGENA en los sectores públicos y privados, dentro de un contexto de desarrollo social, humanístico, cultural y científico.

									</td>
                                    <td width="10%" align="center" class="td_center"><strong>1- 2</strong></td>
									<td width="10%" align="center" class="td_center"><strong>3</strong></td>
                                    <td width="10%" align="center" class="td_center"><strong>4 - 5</strong></td>
                                    <td width="20%"align="center" class="td_center"><strong><?php echo $eval->d; ?></strong></td>
                                </tr>
								<tr>
									<td width="45%" align="justify"><strong>COMPETITIVIDAD:</strong>
									apoya el desarrollo de iniciativas que incrementen y amplíen el potencial de competencias institucionales permitiéndole aumentar el reconocimiento de la institución.

									</td>
                                    <td width="10%" align="center" class="td_center"><strong>1- 2</strong></td>
									<td width="10%" align="center" class="td_center"><strong>3</strong></td>
                                    <td width="10%" align="center" class="td_center"><strong>4 - 5</strong></td>
                                    <td width="20%"align="center" class="td_center"><strong><?php echo $eval->e; ?></strong></td>
                                </tr>
								<tr>
									<td width="45%" align="justify"><strong>SENSIBILIDAD Y CONCIENCIA SOCIAL:</strong>
									contribuye y desarrolla métodos que sirvan para comprender las conductas de los demás, teniendo en cuenta la diversidad social y las posibilidades que brinda el medio.

									</td>
                                    <td width="10%" align="center" class="td_center"><strong>1- 2</strong></td>
									<td width="10%" align="center" class="td_center"><strong>3</strong></td>
                                    <td width="10%" align="center" class="td_center"><strong>4 - 5</strong></td>
                                    <td width="20%"align="center" class="td_center"><strong><?php echo $eval->f; ?></strong></td>
                                </tr>
								<tr>
									<td width="45%" align="justify"><strong>ORIENTACIÓN AL DESARROLLO:</strong>
									es eficaz en el desarrollo de cambios positivos, está en permanente compromiso tanto con la dirección como con el equipo de trabajo, consigue la participación individual, establece actividades que aseguren los estándares de calidad establecidos, así como también propone y desarrolla metas y objetivos a largo plazo en beneficio de la organización.

									</td>
                                    <td width="10%" align="center" class="td_center"><strong>1- 2</strong></td>
									<td width="10%" align="center" class="td_center"><strong>3</strong></td>
                                    <td width="10%" align="center" class="td_center"><strong>4 - 5</strong></td>
                                    <td width="20%"align="center" class="td_center"><strong><?php echo $eval->g; ?></strong></td>
                                </tr>
								<tr>
                                    <td rowspan="5" width="5%" align="center"><div class="vertical-text_dos"><div class="vertical-text__inner"><strong>COMPETENCIAS COMUNES</strong></div></div></td>
									<td width="45%" align="justify"><strong>COMPROMISO INSTITUCIONAL:</strong>
									promueve las metas de la organización y respeta sus normas, antepone las necesidades de la organización a sus propias necesidades, apoya a la organización en situaciones difíciles, demostrando sentido de pertenencia en todas sus acciones y un alto compromiso en el desarrollo de su trabajo, el cual se caracteriza por cumplir con elevados estándares de calidad, llegando a superar las expectativas de su grupo.

									</td>
                                    <td width="10%" align="center" class="td_center"><strong>1- 2</strong></td>
									<td width="10%" align="center" class="td_center"><strong>3</strong></td>
                                    <td width="10%" align="center" class="td_center"><strong>4 - 5</strong></td>
                                    <td width="20%"align="center" class="td_center"><strong><?php echo $eval->h; ?></strong></td>
                                </tr>
								<tr>
									<td width="45%" align="justify"><strong>ORIENTACION A RESULTADOS:</strong>
									cumple con oportunidad objetivos y metas establecidas por la entidad y las funciones que le son asignadas, asumiendo la responsabilidad por sus resultados, compromete recursos y tiempos para mejorar la productividad tomando las medidas necesarias para minimizar los riesgos y realiza todas las acciones necesarias para alcanzar los objetivos propuestos enfrentando los obstáculos que se presentan.

									</td>
                                    <td width="10%" align="center" class="td_center"><strong>1- 2</strong></td>
									<td width="10%" align="center" class="td_center"><strong>3</strong></td>
                                    <td width="10%" align="center" class="td_center"><strong>4 - 5</strong></td>
                                    <td width="20%"align="center" class="td_center"><strong><?php echo $eval->i; ?></strong></td>
                                </tr>	
								<tr>
									<td width="45%" align="justify"><strong>TRANSPARENCIA:</strong>
									proporciona información veraz, objetiva y basada en hechos, facilita el acceso a la información relacionada con sus responsabilidades y con el servicio a cargo de la Universidad. 
                                    Demuestra imparcialidad en sus decisiones, ejecuta sus funciones con base en las normas y criterios aplicables y utiliza adecuadamente los recursos de la entidad para el desarrollo de las labores y la prestación del servicio.

									</td>
                                    <td width="10%" align="center" class="td_center"><strong>1- 2</strong></td>
									<td width="10%" align="center" class="td_center"><strong>3</strong></td>
                                    <td width="10%" align="center" class="td_center"><strong>4 - 5</strong></td>
                                    <td width="20%"align="center" class="td_center"><strong><?php echo $eval->j; ?></strong></td>
                                </tr>
								<tr>
									<td width="45%" align="justify"><strong>ORIENTACIÓN AL USUARIO Y AL CIUDADANO:</strong>
									atiende y valora las necesidades y peticiones de los usuarios y de ciudadanos en general respondiendo oportunamente de conformidad con el servicio que ofrece la entidad y considera las mismas al diseñar proyectos o servicios.

									</td>
                                    <td width="10%" align="center" class="td_center"><strong>1- 2</strong></td>
									<td width="10%" align="center" class="td_center"><strong>3</strong></td>
                                    <td width="10%" align="center" class="td_center"><strong>4 - 5</strong></td>
                                    <td width="20%"align="center" class="td_center"><strong><?php echo $eval->a; ?></strong></td>
                                </tr>
								<tr>
									<td width="45%" align="justify"><strong>RESPONSABILIDAD:</strong>
									presenta una adecuada disposición a asumir los compromisos y cumplirlos en los plazos establecidos asumiendo las posibles consecuencias de sus actos y muestra habilidad para agregar valor en el desarrollo de todas las actividades y el cumplimiento de estas en el tiempo estipulado. Tiene clara conciencia del cuidado de los bienes que se le han asignado para la realización del trabajo y acepta que hay actividades que no puede realizar en plazos requeridos.

									</td>
                                    <td width="10%" align="center" class="td_center"><strong>1- 2</strong></td>
									<td width="10%" align="center" class="td_center"><strong>3</strong></td>
                                    <td width="10%" align="center" class="td_center"><strong>4 - 5</strong></td>
                                    <td width="20%"align="center" class="td_center"><strong><?php echo $eval->m; ?></strong></td>
                                </tr>
								<tr>
                                    <td rowspan="8" width="5%" align="center"><div class="vertical-text"><div class="vertical-text__inner"><strong>COMPETENCIAS DEL CARGO</strong></div></div></td>
									<td width="45%" align="justify"><strong>ORGANIZACIÓN, PLANEACION Y CONTROL:</strong>
									anticipa los puntos críticos de una situación o problemas con un gran número de variables, estableciendo puntos de control y mecanismos de coordinación, verificando datos y buscando información externa para asegurar la calidad de los procesos. Es capaz de administrar simultáneamente diversos proyectos complejos.

									</td>
                                    <td width="10%" align="center" class="td_center"><strong>1- 2</strong></td>
									<td width="10%" align="center" class="td_center"><strong>3</strong></td>
                                    <td width="10%" align="center" class="td_center"><strong>4 - 5</strong></td>
                                    <td width="20%"align="center" class="td_center"><strong><?php echo $eval->n; ?></strong></td>
                                </tr>
								<tr>
									<td width="45%" align="justify"><strong>COMUNICACIÓN ORAL:</strong>
									se comunica de forma asertiva y honesta, teniendo en cuenta a los demás miembros del equipo, se expresa de forma persuasiva, tratando de convencer a los demás de ideas u opiniones que favorezcan al grupo de trabajo.

									</td>
                                    <td width="10%" align="center" class="td_center"><strong>1- 2</strong></td>
									<td width="10%" align="center" class="td_center"><strong>3</strong></td>
                                    <td width="10%" align="center" class="td_center"><strong>4 - 5</strong></td>
                                    <td width="20%"align="center" class="td_center"><strong><?php echo $eval->l; ?></strong></td>
                                </tr>	
								<tr>
									<td width="45%" align="justify"><strong>AUTOCONTROL:</strong>
									es hábil para combatir el estrés, la angustia, las tensiones, sabe controlar los sentimientos y adaptarlos al momento adecuado. Regula las emociones y los impulsos conflictivos influenciando en un buen ambiente de trabajo.

									</td>
                                    <td width="10%" align="center" class="td_center"><strong>1- 2</strong></td>
									<td width="10%" align="center" class="td_center"><strong>3</strong></td>
                                    <td width="10%" align="center" class="td_center"><strong>4 - 5</strong></td>
                                    <td width="20%"align="center" class="td_center"><strong><?php echo $eval->o; ?></strong></td>
                                </tr>
								<tr>
									<td width="45%" align="justify"><strong>AUTOCONFIANZA:</strong>
									coordina las tareas asignadas, posee capacidad para buscar nuevas responsabilidades, habla cuando no está de acuerdo, expresándose adecuadamente y presentando una posición clara y concisa, creando un ambiente de aceptación, superación y seguridad a los demás.

									</td>
                                    <td width="10%" align="center" class="td_center"><strong>1- 2</strong></td>
									<td width="10%" align="center" class="td_center"><strong>3</strong></td>
                                    <td width="10%" align="center" class="td_center"><strong>4 - 5</strong></td>
                                    <td width="20%"align="center" class="td_center"><strong><?php echo $eval->p; ?></strong></td>
                                </tr>
								<tr>
									<td width="45%" align="justify"><strong>PENSAMIENTO ANALÍTICO:</strong>
									realiza análisis lógico, identifica problemas, reconoce información significativa, busca y coordina datos relevantes. Tiene mucha capacidad y habilidad para analizar, organizar datos estadísticos, financieros y para establecer conexión entre datos numéricos.

									</td>
                                    <td width="10%" align="center" class="td_center"><strong>1- 2</strong></td>
									<td width="10%" align="center" class="td_center"><strong>3</strong></td>
                                    <td width="10%" align="center" class="td_center"><strong>4 - 5</strong></td>
                                    <td width="20%"align="center" class="td_center"><strong><?php echo $eval->q; ?></strong></td>
                                </tr>
								<tr>
									<td width="45%" align="justify"><strong>EXPERTICIA PROFESIONAL:</strong>
									orienta el desarrollo de proyectos especiales para el logro de resultados de la alta dirección.

									</td>
                                    <td width="10%" align="center" class="td_center"><strong>1- 2</strong></td>
									<td width="10%" align="center" class="td_center"><strong>3</strong></td>
                                    <td width="10%" align="center" class="td_center"><strong>4 - 5</strong></td>
                                    <td width="20%"align="center" class="td_center"><strong><?php echo $eval->r; ?></strong></td>
                                </tr>
								<tr>
									<td width="45%" align="justify"><strong>INICIATIVA:</strong>
									capacidad para anticiparse a las situaciones con una visión a largo plazo, actúa para crear oportunidades o evitar problemas que no son evidentes para los demás, por medio de la elaboración de planes, habilidad para promover ideas innovadoras y no ser limitado por otros con el fin de beneficiar la organización.

									</td>
                                    <td width="10%" align="center" class="td_center"><strong>1- 2</strong></td>
									<td width="10%" align="center" class="td_center"><strong>3</strong></td>
                                    <td width="10%" align="center" class="td_center"><strong>4 - 5</strong></td>
                                    <td width="20%"align="center" class="td_center"><strong><?php echo $eval->s; ?></strong></td>
                                </tr>		
								<tr>
									<td width="45%" align="justify"><strong>TRABAJO EN EQUIPO:</strong>
									crea, coopera y actúa de forma activa para desarrollar el espíritu de equipo entre sus miembros; defiende la buena imagen y reputación del grupo ante terceros y afronta los problemas que plantee el grupo para resolver los conflictos que se presenten, en beneficio de este mismo.

									</td>
                                    <td width="10%" align="center" class="td_center"><strong>1- 2</strong></td>
									<td width="10%" align="center" class="td_center"><strong>3</strong></td>
                                    <td width="10%" align="center" class="td_center"><strong>4 - 5</strong></td>
                                    <td width="20%"align="center" class="td_center"><strong><?php echo $eval->t; ?></strong></td>
                                </tr>	
								<tr>
									<td colspan="5" align="right"><strong>Calificación Total</strong></td>
                                    <td width="20%"align="center"><?php echo $eval->Total; ?></td>
                                </tr>								
				</table>				
			
<script type="text/javascript">
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