<?php
//$username = strtolower($_REQUEST['codigo']);
include('../modelo/conexion.php');
class clase_verifica extends configuracion{
private $conexion;	
public function valores_clase_verifica_codigo($username){
	sleep(1);
  $this->conexion = parent::conectar();
  	if(empty($username)){
		echo '<div id="Error"><img src="../estilos/images/campo_vacio.png" alt="" />
		</div>';
		}
	else{ 
  $ConsultaSQL = $this->conexion->prepare("SELECT * FROM lider WHERE cc_lider = :id");
  $ConsultaSQL ->bindParam(':id', $username, PDO::PARAM_INT);
  $ConsultaSQL ->execute();
  $num_rows = $ConsultaSQL->fetchColumn();
    if($num_rows > 0){
        echo '<div id="Error"><img src="../estilos/images/usuario_existente.png" alt="" />
		</div>';}
    else{
        echo '<div id="Success"><img src="../estilos/images/usuario_disponible.png" alt="" />	
			 </div>';}		 
	}
}
public function valores_clase_verifica_votante($username){
	sleep(0.5);
  $this->conexion = parent::conectar();
  	if(empty($username)){
		echo '<div id="Error"><img src="../estilos/images/campo_vacio.png" alt="" />
		</div>';
		}
	else{ 
  $ConsultaSQL = $this->conexion->prepare("SELECT
 *
FROM
	votante
LEFT JOIN lider ON lider.cc_lider = votante.id_lider
WHERE
	votante.cc_votante = :id");
  $ConsultaSQL ->bindParam(':id', $username);
  $ConsultaSQL ->execute();
  $num_rows = $ConsultaSQL->fetchColumn(0);
   while ($row = $ConsultaSQL ->fetch(PDO::FETCH_ASSOC)) {
	echo $this->cedula_lider=$row["cc_lider"];}
  if($num_rows){
        echo '
		<div class="alert alert-warning alert-block fade in">
                                <a data-dismiss="alert" class="close close-sm" type="button">
                                    <i class="fa fa-times"></i>
                                </a>
                                <h4>
                                    <i class="icon-ok-sign"></i>
                                    Registrado!
                                </h4>
                                <p><b>Votante:</b> Aury Esther Pautt Quiñonez</p>
								<p><b>Lider:</b> Julio Deavila Pertuz</p>
								<p><b>Fecha Registro:</b> 2015-04-20</p>
        </div>
		 ';}
    else{
        echo '<div id="Success"><img src="../estilos/images/usuario_disponible.png" alt="" />	
			 </div>';}		 
	}
}
public function valores_clase_verifica_correo($username){
		sleep(1);
  $this->conexion = parent::conectar(); 
	  if(empty($username)){
			echo '<div id="Error"><img src="../estilos/images/campo_vacio.png" alt="" />
			</div>';
			}	
		else{ 
  $ConsultaSQL = $this->conexion->prepare("SELECT * FROM usuario WHERE correo_usuario = :email");
  $ConsultaSQL ->bindParam(':email', $username);
  $ConsultaSQL ->execute();
  $num_rows = $ConsultaSQL->fetchColumn();
    if($num_rows > 0){
        echo '<div id="Error"><img src="../estilos/images/usuario_existente.png" alt="" />
		</div>';}
    else{
        echo '<div id="Success"><img src="../estilos/images/usuario_disponible.png" alt="" />	
			 </div>';}
			}
     }
 }
?>