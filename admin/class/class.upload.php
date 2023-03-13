<?php

require ('class.imagens.php');

class UploadArquivoSis{
    
    //DEIXAR VAZIO PARA ACEITAR TODOS OS ARQUIVOS
	private $extensoes = array('jpg','jpeg','png');

	//TAMANHO EM MEGAS - MINIMO DE 1 - DEIXAR ZERO PARA ACEITAR TODOS OS TAMANHOS
	private $tamanho_maximo = 0;


    public function Upload($caminho='',$nome_campo='',$largura=0){
		
    	$arquivo_upload = $_FILES["$nome_campo"]["name"];
    	$tamanho_arquivo_upload = $_FILES["$nome_campo"]["size"];
    	$temp_arquivo_upload = $_FILES["$nome_campo"]["tmp_name"];
    	$type_arquivo_upload = $_FILES["$nome_campo"]["type"];


		//RECEBE ARQUIVO//
    	if(!empty($arquivo_upload)){

    		//ACERTA O NOME DO ARQUIVO REMOVENDO ESPAÇOS E ACENTOS E COLOCA UM UNIQID ANTES DO NOME
    		$novo_nome_arquivo = $this->RenomeiaArquivo($arquivo_upload);	
    		

    		//CASO HAJA RESTRICAO DE TIPOS DE ARQUIVOS PARA UPLOAD
    		if(!empty($this->extensoes)){
    			
    			$permissao = $this->RestricaoArquivo($novo_nome_arquivo);	

    			if($permissao==0){
    				echo '<div class="alert alert-danger"><strong>Erro:</strong> Tipo de arquivo não permitido.</div>';    				
    				return '';
    			} 
    		
    		}
    		////////////////////////////////////////////////////////


    		//CASO HAJA RESTRICAO DE TAMANHO
    		if($this->tamanho_maximo!=0){
    			
    			$tamanho = $this->TamanhoArquivo($tamanho_arquivo_upload);	

    			if($tamanho==0){
    				echo '<div class="alert alert-danger"><strong>Erro:</strong> O tamanho do arquivo excede o máximo de '.$this->tamanho_maximo.'Mb.</div>';    				
    				return '';
    			} 
    		
    		}
    		/////////////////////////////////////////////////////////////////////////////



            //CASO RECEBA LARGURA E ALTURA REDIMENSIONA NA PROPORÇÃO
            if($largura!=0){
                

                $extensao_arquivo = strtolower(end(explode(".", $novo_nome_arquivo)));        

                //VERIFICA SE É UMA IMAGEM
                if($extensao_arquivo=='jpg' || $extensao_arquivo=='jpeg' || $extensao_arquivo=='png'){

                    //CASO NAO EXISTA CRIA UM DIRETORIO PARA COLOCAR AS IMAGENS ANTES DE REDIMENSIONAR     
                    if(!is_dir($caminho.'/aguarda_arquivos')){
                        mkdir($caminho.'/aguarda_arquivos/');
                    }

                    //MOVE O ARQUIVO PARA A PASTA TEMPORÁRIA
                    move_uploaded_file($temp_arquivo_upload, ($caminho.'/aguarda_arquivos/'.$novo_nome_arquivo));

                    //INSTANCIA A CLASSE QUE REDIMENSIONA COM AS IMAGENS
                    $oImg = new m2brimagem();

                    //CARREGA A IMAGEM NA CLASSE
                    $oImg->carrega($caminho.'/aguarda_arquivos/'.$novo_nome_arquivo);

                    //PEGA A LARGURA E ALTURA DA IMAGEM ATUAL
                    $imnfo = getimagesize($caminho.'/aguarda_arquivos/'.$novo_nome_arquivo);
                    $img_w = $imnfo[0];//LARGURA
                    $img_h = $imnfo[1];//ALTURA


                    //FOTO DEITADA
                    if($img_w>$img_h){
                                                    
                        $altura= (($img_h/$img_w)*$largura);
                            
                        if($img_w>$largura || $img_w==$largura){                  
                            $oImg->redimensiona($largura,$altura);                              
                        } 
                            
                    //FOTO EM PÉ    
                    } else if($img_h>$img_w){
                        
                        if($img_h>$largura){
                            $altura = $largura;
                        }

                        $largura = (($img_w/$img_h)*$altura);
                            
                        if($img_h>$altura || $img_h==$altura){    
                            $oImg->redimensiona($largura,$altura);                              
                        } 
                            
                    //FOTO QUADRADA 
                    } else if($img_h==$img_w){
                                                        
                        if($img_w>$largura || $img_h==$largura){                  
                            $oImg->redimensiona($largura,$largura);  
                        } 
                            
                    }

                    //SALVA NO DIRETORIO FINAL
                    $oImg->grava($caminho.'/'.$novo_nome_arquivo,100);
                    
                    //SALVA NO DIRETORIO FINAL
                    unlink($caminho.'/aguarda_arquivos/'.$novo_nome_arquivo);

                    //RETORNA O NOME DO ARQUIVO              
                    return $novo_nome_arquivo;

                }

                 
            
            }
            ///////////////////////////////////////////////////////////////////////////// 
    		



    		//CASO NÃO APRESENTE NENHUM ERRO - FAZ O UPLOAD E RETORNA O NOME DO ARQUIVO
    		move_uploaded_file($temp_arquivo_upload, ($caminho.'/'.$novo_nome_arquivo));
    		return $novo_nome_arquivo;


    	}

		
	}
	

	public function RenomeiaArquivo($var){		
		$str = preg_replace('/[^a-z0-9.]/i', '', $var);
		$str = strtolower($str);
		$str = uniqid().'_'.$str;
		return $str;
	}

	public function TamanhoArquivo($var){				
		
		$limite = ($this->tamanho_maximo*1000000);
		if($var>$limite){
			return 0;
		} else {
			return 1;
		}
		
	}


	public function RestricaoArquivo($var){		
		
		//PEGA A EXTENSÃO DO ARQUIVO
		$extensao_arquivo = strtolower(end(explode(".", $var)));		

		if(in_array($extensao_arquivo, $this->extensoes)){ 
			return 1;
		} else {
			return 0;
		}

	}	

}


?>