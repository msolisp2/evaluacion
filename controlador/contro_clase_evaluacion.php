<?php
//session_start();
	if ($_SESSION["tipo"]=="1" || $_SESSION["tipo"]=="2" || $_SESSION["tipo"]=="3") 
	{	
include_once("../modelo/clase_evaluacion.php");
	class controla_clase_evaluacion{ 
			
		function val_clase_evaluacion(){ 
			$obj=new clase_evaluacion();
			$obj->valores_clase_objetivos($id_obj);								
		}
		
		function val_clase_evaluacion_mejora(){ 
			$obj=new clase_evaluacion();
			$obj->valores_clase_mejoras($id_mej);								
		}
		
		function val_clase_mejora(){ 
			$obj=new clase_evaluacion();
			$obj->valores_clase_mejora($id_cod_obj);								
		}		

		function val_clase_evaluacion_dependencia(){ 
			$obj=new clase_evaluacion();
			$obj->valores_clase_select_dependencia();								
		}
		
		function val_clase_configuracion(){ 
			$obj=new clase_evaluacion();
			$obj->valores_clase_configuracion($id_config);								
		}
		
		
		function val_clase_evaluacion_fecha(){ 
			$obj=new clase_evaluacion();
			$obj->valores_clase_evaluacion_fecha($cod_eva,$seg);								
		}
		
		function val_clase_evaluacion_final(){ 
			$obj=new clase_evaluacion();
			$obj->valores_clase_evaluacion($cod_eva);								
		}
		
		function val_clase_evaluacion_final_total(){ 
			$obj=new clase_evaluacion();
			$obj->valores_clase_evaluacion_total($cod_eva);								
		}
		
		function val_clase_objetivos_total(){ 
			$obj=new clase_evaluacion();
			$obj->valores_clase_objetivos_total($cod_eva);								
		}

		function val_clase_recursos(){ 
			$obj=new clase_evaluacion();
			$obj->valores_clase_recurso($cod_eva);								
		}

		function val_clase_verifica(){ 
			$obj=new clase_evaluacion();
			$obj->valores_clase_verifica($cod_eva);								
		}
		
		function val_clase_evaluacion_trabajador(){ 
			$obj=new clase_evaluacion();
			$obj->valores_clase_evaluacion_trabajador($cod_eva);								
		}

		function val_clase_evaluacion_jefe(){ 
			$obj=new clase_evaluacion();
			$obj->valores_clase_evaluacion_jefe($cod_eva);								
		}
		
		function val_clase_respueta(){ 
			$obj=new clase_evaluacion();
			$obj->valores_clase_respuesta($id_recurso);								
		}

		function val_clase_listado_mejorar(){ 
			$facu=new clase_evaluacion();
			$facu->valores_listado_mejorar($cod_plan);											
		}		

		function val_clase_historial_mejorar(){ 
			$facu=new clase_evaluacion();
			$facu->valores_historial_mejorar($cod_plan);											
		}		
		
		function val_clase_listado_mejorar_jefe(){ 
			$facu=new clase_evaluacion();
			$facu->valores_listado_mejorar_jefe($cod_plan);											
		}	
		
		function val_clase_listado_inicio_per_evl(){ 
			$facu=new clase_evaluacion();
			$facu->valores_listado_inicio_per_evl($id_eval,$seg);
											
		}
		
		function val_clase_listado_inicio_per_evl_seg(){ 
			$facu=new clase_evaluacion();
			$facu->valores_listado_inicio_per_evl_seg($id_eval,$seg);
											
		}
		
		function val_clase_listado_inicio_per_evl_jefe(){ 
			$facu=new clase_evaluacion();
			$facu->valores_listado_inicio_per_evl_jefe($id_eval,$seg);
											
		}		

		function val_clase_listado_inicio_per_evl_jefe_final(){ 
			$facu=new clase_evaluacion();
			$facu->valores_listado_inicio_per_evl_jefe_final($id_eval,$seg);
											
		}
		
		function val_clase_listado_fin_per_evl(){ 
			$facu=new clase_evaluacion();
			$facu->valores_listado_fin_per_evl($id_eval);
											
		}

		function val_clase_listado_obj_concertados(){ 
			$facu=new clase_evaluacion();
			$facu->valores_listado_obj_concertados($id_eval);
											
		}		

		function val_clase_listado_evaluaciones_obj(){ 
			$facu=new clase_evaluacion();
			$facu->valores_clase_listado_evaluaciones_obj($id_eval);
											
		}
		
		function val_clase_listado_evaluaciones(){ 
			$facu=new clase_evaluacion();
			$facu->valores_clase_listado_evaluaciones($id_eval);
											
		}
		
		function val_clase_historial_evaluaciones(){ 
			$facu=new clase_evaluacion();
			$facu->valores_clase_historial_evaluaciones($id_eval);
											
		}		
		
		function val_clase_listado_evaluaciones_trab(){ 
			$facu=new clase_evaluacion();
			$facu->valores_clase_listado_eva_trab($id_eval);
											
		}

		function val_clase_historial_evaluaciones_trab(){ 
			$facu=new clase_evaluacion();
			$facu->valores_clase_historial_eva_trab($id_eval);
											
		}	

		function val_clase_historial_evaluaciones_trab_recib(){ 
			$facu=new clase_evaluacion();
			$facu->valores_clase_historial_eva_trab_recib($id_eval);
											
		}			
	
		function val_clase_listado_recursos(){ 
			$facu=new clase_evaluacion();
			$facu->valores_clase_listado_recursos($id_eval);
											
		}

		function val_clase_listado_recursos_jefe(){ 
			$facu=new clase_evaluacion();
			$facu->valores_clase_listado_recursos_jefe($id_eval,$estado,$dia);
											
		}

		function val_clase_historial_recursos_jefe(){ 
			$facu=new clase_evaluacion();
			$facu->valores_clase_historial_recursos_jefe($id_eval,$estado);
											
		}
		
		function val_clase_listado_recursos_admin(){ 
			$facu=new clase_evaluacion();
			$facu->valores_clase_listado_recursos_admin($estado,$dia);
											
		}

		function val_clase_historial_recursos_admin(){ 
			$facu=new clase_evaluacion();
			$facu->valores_clase_historial_recursos_admin($estado);
											
		}		

		function val_clase_consulta_evaluacion_departamento(){ 
			$facu=new clase_evaluacion();
			$facu->consulta_evaluacion_departamento($ano,$id_depar);
											
		}		
		
		function val_clase_consulta_evaluacion_resultado(){ 
			$facu=new clase_evaluacion();
			$facu->consulta_evaluacion_resultado($ano,$id_depar,$estado);
											
		}			

		function val_clase_consulta_evaluacion_general(){ 
			$facu=new clase_evaluacion();
			$facu->consulta_evaluacion_general($ano,$id_depar);
											
		}	

		function val_clase_consulta_correos_jefe(){ 
			$facu=new clase_evaluacion();
			$facu->consulta_evaluacion_correos_jefe($id_evas);
											
		}	
		
		function val_clase_consulta_correos_admin(){ 
			$facu=new clase_evaluacion();
			$facu->consulta_evaluacion_correos_admin($dependencias);
											
		}		
		
			}
$depa=new controla_clase_evaluacion();
	}
	else{
		header("Location: ../index.php");
	}		
?>