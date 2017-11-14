<?php
//session_start();
	if ($_SESSION["tipo"]=="2" || $_SESSION["tipo"]=="3") 
	{	
include_once("../modelo/clase_trabajador.php");
	class controla_clase_trabajador{ 
	
		
		function val_clase_trabajador_listado(){ 
			$facu=new clase_trabajador();
			$facu->listado_valores_trabajador();
											
		}
		
		function val_listado_trabajador(){ 
			$facu=new clase_trabajador();
			$facu->valores_listado_trabajador($id_jefe);
											
		}
		
		function val_clase_trabajador_select_general(){ 
			$facu=new clase_trabajador();
			$facu->valores_select_trabajador_total($id_jefe);
											
		}
		
		function val_clase_trabajador_select(){ 
			$facu=new clase_trabajador();
			$facu->valores_select_trabajador($id_jefe);
											
		}
				
		function val_clase_trabajador(){ 
			$facu=new clase_trabajador();
			$facu->valores_clase_trabajador($id_trabajador);								
		}
		
		function val_clase_trabajador_eva(){ 
			$facu=new clase_trabajador();
			$facu->valores_clase_evaluacion($id_cod_obj);								
		}

		function val_clase_objetivos_select(){ 
			$area=new clase_trabajador();
			$area->valores_clase_objetivos_select($id_trabajador);
											
		}

		
	    function val_clase_listado_objetivos(){ 
			$facu=new clase_trabajador();
			$facu->valores_clase_listado_objetivos($id_trabajador);										
		}
		
	    function val_clase_listado_mejora(){ 
			$facu=new clase_trabajador();
			$facu->valores_clase_listado_mejora($id_jefe);
											
		}		
		
	    function val_clase_historial_mejora(){ 
			$facu=new clase_trabajador();
			$facu->valores_clase_historial_mejora($id_jefe);
											
		}			
		
	    function val_clase_listado_mejora_jefe(){ 
			$facu=new clase_trabajador();
			$facu->valores_clase_listado_mejora_jefe($id_trabajador);
											
		}	

	    function val_clase_historial_mejora_jefe(){ 
			$facu=new clase_trabajador();
			$facu->valores_clase_historial_mejora_jefe($id_trabajador);
											
		}		

	    function val_clase_historial_objetivos(){ 
			$facu=new clase_trabajador();
			$facu->valores_clase_historial_objetivos($id_trabajador);
											
		}		
		
		function val_clase_listado_objetivos_jefe(){ 
			$facu=new clase_trabajador();
			$facu->valores_clase_listado_objetivos_jefe($id_jefe);
											
		}		

		function val_clase_historial_objetivos_jefe(){ 
			$facu=new clase_trabajador();
			$facu->valores_clase_historial_objetivos_jefe($id_jefe);
											
		}
		
			}
$depa=new controla_clase_trabajador();
	}
	else{
		header("Location: ../index.php");
	}		
?>