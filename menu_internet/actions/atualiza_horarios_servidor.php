<?php
include_once ("../../admin/class/class.db.php"); 
include_once ("../../admin/class/class.seguranca.php");	
include_once ("../../includes/verifica_dados_sistema.php");		

ini_set('max_execution_time','-1');

	$table = 'horarios_funcionamento';

	$sql_drop_table_server = "DROP TABLE IF EXISTS $table";
	
	$colunas_geral = '';
	
	$sql = $db->select("SHOW COLUMNS FROM $table");
	$count = $db->rows($sql);
	$create_table = "CREATE TABLE $table ( ";
		
		$x=1;
		while($colunas = $db->expand($sql)){
			
			if($colunas['Key']=='PRI'){				
				$colunas['Key']='PRIMARY KEY';
			}
			
			$colunas_geral .= $colunas['Field'];

			$create_table .= $colunas['Field'].' '.strtoupper($colunas['Type']).' '.strtoupper($colunas['Extra']).' '.$colunas['Key'];
			
			if($x<$count){
				$create_table .=', '; 
				$colunas_geral.=', '; 
			}

			$x++;
		}


	$create_table .= ' ) ENGINE=InnoDB DEFAULT CHARSET=latin1';	
	
	
		

	//DADOS//
	$array_colunas = explode(',', $colunas_geral);

	$create_registros = "INSERT INTO $table ($colunas_geral) VALUES ";
	$pega = $db->select("SELECT $colunas_geral FROM $table");
	if($db->rows($pega)){	
		$contador_registros=1;	
		while($line = $db->expand($pega)){	
			$i=0;
			$contador=1;		
			$count_col = count($array_colunas); 
			$create_registros .= "(";
			foreach ($array_colunas as $colum) {
				
				$create_registros .= "'$line[$i]'";	

				if($contador<$count_col){
					$create_registros .=', '; 				
				}

				$i++;
				$contador++;
			}
			$create_registros .= ")";
			
			if($contador_registros<$db->rows($pega)){
				$create_registros .=', '; 				
			}

			$contador_registros++;	

		}
	} else {
		$count_col = count($array_colunas); 
		$contador=1;
		$create_registros .= "(";	
		foreach ($array_colunas as $colum) {
				
			$create_registros .= "''";	

			if($contador<$count_col){
				$create_registros .=', '; 				
			}

			$contador++;
		}
		$create_registros .= ")";

	}



	//ENVIA PARA O WEBSERVICE
	$post = [
    'chave_seguranca' => md5('user_sisconnection_adm'),
    'sql_drop' => $sql_drop_table_server,
    'sql_tabela' => $create_table,
    'sql_registros' => $create_registros,
	];

	$curl = curl_init();                                                                      
	curl_setopt_array($curl, array(
	    CURLOPT_RETURNTRANSFER => 1,
	     CURLOPT_URL => $dados_sistema['url_servidor_pedidos'].'/update-tabelas-sistema',
	    CURLOPT_USERAGENT => 'Request',
	    CURLOPT_POSTFIELDS =>  $post
	));

	$return = curl_exec($curl);

	if($return){


		$json_decoded = json_decode($return, false);    

		if($json_decoded){

			//ERRO
			if($json_decoded->msg!="OK"){
				echo 0;
				break;

			//TUDO OK CONTINUA	
			} else {

				echo 1;

			}

		} else {
			//echo $table.' <br> '.$return.'<br> <b>SCRIPT TABELA:</b><br>'.$create_table.'<br> <b>SCRIPT REGISTROS:</b><br>'.$create_registros;
			echo 0;
			break;

		}

		
		

	} 

	curl_close($curl); 


	


?>