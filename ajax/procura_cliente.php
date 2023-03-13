<?php 
require("../admin/class/class.db.php");
require("../admin/class/class.seguranca.php");

//TELEFONE
if($tipo==1){
	$pega = $db->select("SELECT * FROM clientes WHERE telefone='$telefone' OR celular='$telefone' LIMIT 1");			
//CARTAO
} else if($tipo==2){
	$pega = $db->select("SELECT * FROM clientes WHERE cartao='$cartao' LIMIT 1");			
}

if($db->rows($pega)){
	
	$pontuacao_real =0;
	//$pontuacao_usada =0;
	$ln = $db->expand($pega);
	$id_cliente_achado = $ln['id'];
	
	///PONTOS///
	//$pontos = mysql_query("SELECT SUM(pontos) AS pontos FROM pontuacao_acumulada WHERE id_cliente='$id_cliente_achado'");
	//if(mysql_num_rows($pontos)){
//		$pt = mysql_fetch_array($pontos);
//		$pontos = $pt['pontos'];//
//		$pontuacao_real = $pontos;
//	}
	
	//$pontos2 = mysql_query("SELECT SUM(pontos) AS pontos FROM pontuacao_usada WHERE id_cliente='$id_cliente_achado'");
	//if(mysql_num_rows($pontos2)){
//		$pt2 = mysql_fetch_array($pontos2);
//		$pontos2 = $pt2['pontos'];
//		$pontuacao_usada = $pontos2;
		
//		$pontuacao_real = ($pontuacao_real-$pontuacao_usada);
//	}
	
	
	///PONTOS///
	

	$var = '';
	$pega = $db->select("SELECT padrao, id, endereco, numero FROM  enderecos_clientes WHERE cliente='$id_cliente_achado' ORDER BY id DESC"); 
    if($db->rows($pega)){   
    	$var .= '<option value="0">-- OUTROS ENDEREÇOS --</option>';                     
    	$opt = '';
        while($line = $db->expand($pega)){              
        	if($line['padrao']==1){$opt=" (PADRÃO)";}
            $var .= '<option value="'.$line['id'].'">'.$line['endereco'].', '.$line['numero'].' '.$opt.'</option>';      
        } 
    }
	
	
	echo $ln['id'].'&*&'.$ln['cartao'].'&*&'.$ln['nome'].'&*&'.$ln['ddd'].'&*&'.$ln['telefone'].'&*&'.$ln['celular'].'&*&'.$ln['endereco'].'&*&'.$ln['numero'].'&*&'.$ln['cep'].'&*&'.$ln['complemento'].'&*&'.$ln['bairro'].'&*&'.$ln['cidade'].'&*&'.$pontuacao_real.'&*&'.$var;


	


		
} else {
	echo 0;		
}




?>