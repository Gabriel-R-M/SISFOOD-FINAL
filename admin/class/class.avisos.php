<?php
@session_start();

class AvisosLoja{
	
	
	public function Avisos(){	
		
		if(isset($_SESSION['avisos-admin-sis-classe'])){
			
			echo '<div class="alert alert-'.$_SESSION['avisos-admin-sis-classe'].' avisos-loja">';
				echo '<div class="container upper">';
  					echo $_SESSION['avisos-admin-sis-frase'];
				echo '</div>';
			echo '</div>';
			
			unset($_SESSION['avisos-admin-sis-classe']);	
			unset($_SESSION['avisos-admin-sis-frase']);	
			
		} 
		
	}
	
	
	
}

?>