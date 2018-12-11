<?php

class TotalizadoresVendas{
	
	
	public function VendasTotais(){	
		
		$db= new DB();
		$sql = $db->select("SELECT SUM(valor_final_venda) AS valor_final FROM aguarda_venda");
		$result = $db->expand($sql);
		return number_format($result['valor_final'],2,",",".");	
		
	}

	public function ClientesTotais(){	
		
		$db= new DB();
		$sql = $db->select("SELECT COUNT(*) AS clientes_final FROM clientes");
		$result = $db->expand($sql);
		return $result['clientes_final'];
		
		
	}

	public function ProdutosTotais(){	
		
		$db= new DB();
		$sql = $db->select("SELECT COUNT(*) AS produtos_final FROM lanches");
		$result = $db->expand($sql);
		return $result['produtos_final'];
		
		
	}

	public function Movimentacao($tipo){	
		
		$db= new DB();

		if($tipo=='ultima'){
			$sql = $db->select("SELECT data_abertura FROM caixa ORDER BY id DESC LIMIT 1");
			$result = $db->expand($sql);
			return data_mysql_para_user($result['data_abertura']);	
		}

		if($tipo=='ultima_valores'){
			$sql = $db->select("SELECT id FROM caixa ORDER BY id DESC LIMIT 1");
			$result = $db->expand($sql);
			$id_caixa = $result['id'];

			$sql = $db->select("SELECT SUM(valor_final_venda) AS valor_final FROM aguarda_venda WHERE id_caixa='$id_caixa'");
			$result = $db->expand($sql);
			return number_format($result['valor_final'],2,",",".");	
		}

		
	}


	public function Periodo30Dias($tipo){

		$db= new DB();

		$hoje = date("Y-m-d");
		$diasatras =date('Y-m-d',strtotime("-30 day")); 


		if($tipo=='periodo'){		
			return data_mysql_para_user($diasatras).' À '.data_mysql_para_user($hoje);
		}

		if($tipo=='valores'){
			$sql = $db->select("SELECT SUM(valor_final_venda) AS valor_final 
				FROM aguarda_venda 
				WHERE data_pedido>='$diasatras' AND data_pedido<='$hoje'");
			$result = $db->expand($sql);
			return number_format($result['valor_final'],2,",",".");

		}

		if($tipo=='entregas'){
			$sql = $db->select("SELECT COUNT(*) AS total 
				FROM aguarda_venda 
				WHERE data_pedido>='$diasatras' AND data_pedido<='$hoje' AND entrega='1'");
			$result = $db->expand($sql);
			if($result['total']<10){
				$result['total'] = '0'.$result['total'];
			}
			return $result['total'];

		}

		if($tipo=='balcao'){
			$sql = $db->select("SELECT COUNT(*) AS total 
				FROM aguarda_venda 
				WHERE data_pedido>='$diasatras' AND data_pedido<='$hoje' AND entrega='0'");
			$result = $db->expand($sql);
			if($result['total']<10){
				$result['total'] = '0'.$result['total'];
			}
			return $result['total'];

		}


	}
	
	
	
}

?>