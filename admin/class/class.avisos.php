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



	public function AvisoUpdateBaseInternet(){	

		$db = new DB();	
		$sql = $db->select("SELECT modulo_internet FROM configuracoes LIMIT 1");  
  		$ln = $db->expand($sql);

  		
  		if($ln['modulo_internet']==1){

  			$sql = $db->select("SELECT aviso_update_internet, data_update_internet FROM sistema LIMIT 1");  
	  		$ln = $db->expand($sql);  		
			
	  		$data_inicio = new DateTime($ln['data_update_internet']);
	    	$data_fim = new DateTime(date("Y-m-d"));

	    	// Resgata diferença entre as datas
	    	$dateInterval = $data_inicio->diff($data_fim);
	    	$dias_ultima_atualizacao = $dateInterval->days;

			if($ln['aviso_update_internet']==1 || $dias_ultima_atualizacao>=7){
				
				$aviso = 'A BASE DE DADOS FOI MODIFICADA E DEVE SER ATUALIZADA NO SERVIDOR WEB.';

				if($dias_ultima_atualizacao>=7){
					if($ln['data_update_internet']=='0000-00-00'){$dias_ultima_atualizacao=30;}
					$aviso = 'O SERVIDOR WEB FOI ATUALIZADO A MAIS DE '.$dias_ultima_atualizacao.' DIAS.';	
				}

				if($ln['aviso_update_internet']==1){
					$aviso = 'A BASE DE DADOS FOI MODIFICADA E DEVE SER ATUALIZADA NO SERVIDOR WEB.';	
				}

				echo '<div class="alert alert-danger avisos-loja-warning" id="barra_aviso_servidor">';
					echo '<div class="container upper">';
	  					echo '<i class="icofont-warning"></i>&nbsp;'.$aviso;
	  					echo '<a href="atualiza-servidor-web"><button class="btn btn-danger pull-right btn-sm">ATUALIZAR AGORA</button></a>';
					echo '</div>';
				echo '</div>';
				
			} 	
  				
  		}
	
		
	}
	
	
	
}

?>