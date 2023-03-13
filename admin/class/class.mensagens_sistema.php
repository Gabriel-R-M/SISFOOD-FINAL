<?php

class MensagensDesenvolvedorSistema{
	
	
	public function MensagensDesenvolvedor(){	
		
		$db= new DB();
		$sql = $db->select("SELECT id FROM admin_mensagens_sistema LIMIT 1");
		if($db->rows($sql)){
			return 1;
		} else {
			return 0;
		}
		
	}


	public function MensagensImportantesDesenvolvedor(){	
		
		$db= new DB();
		$sql = $db->select("SELECT id FROM admin_mensagens_sistema WHERE importante='1' LIMIT 1");
		if($db->rows($sql)){
			return 1;
		} else {
			return 0;
		}
		
	}


}

?>