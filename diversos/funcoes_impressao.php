<?php

		$n_colunas = 34; // 40 colunas por linha
        $numero_colunas = $dados_configuracoes['colunas_impressora'];

        function ajusta_caracteres_impressao($string='',$tipo='M',$limite=0){

            global $numero_colunas;
            
            if($string==''){

                    $x=1;
                    $espaco = '';
                    while($x<=$numero_colunas){
                        $espaco .= '-';
                        $x++;
                    }

                    return $espaco;

            } else {

                    $count = strlen($string);

                    if($count>=$numero_colunas && $limite>=0){

                         return substr($string, 0, $numero_colunas);

                    } else {

                        if($limite==0){

                            $diferenca = ($numero_colunas-$count);    
                            $meio_meio = floor(($numero_colunas-$count)/2);
                        
                        } else {

                            if($count>$limite && $limite>0){

                                $string = substr($string, 0, $limite);
                                $diferenca = 0;
                                $meio_meio = 0;
                                    

                            } else {

                                if($limite<0){
                                    
                                    $diferenca = ($numero_colunas-abs($limite));
                                    $meio_meio = ($numero_colunas-abs($limite));

                                    if($count>$diferenca){
                                        $string = substr($string, 0, $diferenca);
                                    }

                                } else {
                                    $diferenca = ($limite-$count);
                                    $meio_meio = ($limite-$count);    
                                }

                                
                            }
                            
                        }
                        
                        
                        
                        //MEIO
                        if($tipo=='M'){

                            $x=1;
                            $espaco = '';
                            while($x<=$meio_meio){
                                $espaco .= ' ';
                                $x++;
                            }

                            return $espaco.$string.$espaco;

                        //INICIO    
                        } else if($tipo=='I'){

                            $x=1;
                            $espaco = '';
                            while($x<=$diferenca){
                                $espaco .= ' ';
                                $x++;
                            }

                            return $espaco.$string;

                        
                        //FIM    
                        } else if($tipo=='F'){

                            $x=1;
                            $espaco = '';
                            while($x<=$diferenca){
                                $espaco .= ' ';
                                $x++;
                            }

                            return $string.$espaco;
                            
                        }


                    }

                }


        }






        
        /**
         * Adiciona a quantidade necessaria de espaços no inicio 
         * da string informada para deixa-la centralizada na tela
         * 
         * @global int $n_colunas Numero maximo de caracteres aceitos
         * @param string $info String a ser centralizada
         * @return string
         */
        function centraliza($info)
        {
            global $n_colunas;
            
            $aux = strlen($info);
            
            if ($aux < $n_colunas) {
                // calcula quantos espaços devem ser adicionados
                // antes da string para deixa-la centralizada
                $espacos = floor(($n_colunas - $aux) / 2);
                
                $espaco = '';
                for ($i = 0; $i < $espacos; $i++){
                    $espaco .= ' ';
                }
                
                // retorna a string com os espaços necessários para centraliza-la
                return $espaco.$info;
                
            } else {
                // se for maior ou igual ao número de colunas
                // retorna a string cortada com o número máximo de colunas.
                return substr($info, 0, $n_colunas);
            }
            
        }
        
        /**
         * Adiciona a quantidade de espaços informados na String
         * passada na possição informada.
         * 
         * Se a string informada for maior que a quantidade de posições
         * informada, então corta a string para ela ter a quantidade
         * de caracteres exata das posições.
         * 
         * @param string $string String a ter os espaços adicionados.
         * @param int $posicoes Qtde de posições da coluna
         * @param string $onde Onde será adicionar os espaços. I (inicio) ou F (final).
         * @return string
         */
        function addEspacos($string, $posicoes, $onde)
        {
            
            $aux = strlen($string);
            
            if ($aux >= $posicoes)
                return substr ($string, 0, $posicoes);
            
            $dif = $posicoes - $aux;
            
            $espacos = '';
            
            for($i = 0; $i < $dif; $i++) {
                $espacos .= ' ';
            }
            
            if ($onde === 'I')
                return $espacos.$string;
            else
                return $string.$espacos;
            
        }



        function abrevia_palavra($palavra){

            $count = strlen($palavra);
            if($count>=15){
               $explode = explode(' ', $palavra);
               $can = count($explode);
               foreach($explode as $prod) {                    

                    $gh = strlen($prod);
                    if($gh>3){
                        $prod = substr($prod, 0,3);
                    } 

                    $palavrax = $palavrax.$prod.' '; 
               }                
            } else {
                $palavrax = $palavra;
            }

            return $palavrax;

        }



    
    function limpa_pasta($pasta){
       if(is_dir($pasta)){
            $diretorio = dir($pasta);
            while($arquivo = $diretorio->read()){
                if(($arquivo != '.') && ($arquivo != '..')){
                    unlink($pasta.$arquivo);
                }
            }
            $diretorio->close();
        }
    }    



    function retira_acentos($str){
        
        $str = preg_replace('/[áàãâä]/ui', 'a', $str);
        $str = preg_replace('/[éèêë]/ui', 'e', $str);
        $str = preg_replace('/[íìîï]/ui', 'i', $str);
        $str = preg_replace('/[óòõôö]/ui', 'o', $str);
        $str = preg_replace('/[úùûü]/ui', 'u', $str);
        $str = preg_replace('/[ç]/ui', 'c', $str);   
        $str = str_replace("\n", ' ', $str);
        $str = str_replace("<br>", ' ', $str);                     
        $str = strtoupper($str);    
        $str = trim($str);    
        return $str; 
    }



?>        