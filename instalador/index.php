<?php 
ob_start();
@session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <title>INSTALAÇÃO SIS E-FOOD</title>

    <!-- Vendor css -->
    <link href="../admin/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../admin/lib/Ionicons/css/ionicons.css" rel="stylesheet">

    <!-- Slim CSS -->
    <link href="../admin/lib/jquery.steps/css/jquery.steps.css" rel="stylesheet">
    <link rel="stylesheet" href="../admin/css/slim.css">
    <link rel="stylesheet" href="../admin/css/custom.css">
    <link rel="shortcut icon" href="../admin/favicon.ico">  

  </head>
  <body >

    <div class="slim-mainpanel">
    <div class="container">

        <?php         
        if(file_exists('../admin/class/class.db.php')){
           echo '<div class="alert alert-danger top20 text-center">
                  O BANCO OU ARQUIVO "CLASS.DB" JÁ EXISTE. AO CONTINUAR AS INFORMAÇÕES SERÃO SUBSTITUÍDAS.
                </div>';  
        }
        ?>

        <form method="post" action="controlers/instalacao.php">

        <div class="section-wrapper mg-t-20">
          
          <label class="section-title">INSTALAÇÃO SIS E-FOOD </label>
          <p class="mg-b-20 mg-sm-b-40 upper">Gerenciamento e controle para Lanchonetes, Bares e Restaurantes.</p>
          
          <div id="wizard4">

            <h3>INFORMAÇÕES</h3>
            <section>
              <div class="row">

                  <div class="col-md-12">
                    <div class="form-group">
                        <label>*NOME DO ESTABELECIMENTO</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-home" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="" name="nome_local" id="nome_local" required>
                          </div>                        
                    </div>
                  </div>


                  <div class="col-md-6">
                    <div class="form-group">
                        <label>*CNPJ</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-file-text-o" aria-hidden="true"></i></span>
                            </div>
                            <input type="number" class="form-control" placeholder="" name="cnpj_local" id="cnpj_local" required>
                          </div>
                          <small>APENAS NÚMEROS</small>                       
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                        <label>INSCRIÇÃO ESTADUAL</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-file-text-o" aria-hidden="true"></i></span>
                            </div>
                            <input type="number" class="form-control" placeholder="" name="ie_local" id="ie_local">
                          </div>   
                          <small>APENAS NÚMEROS</small>                       
                    </div>
                  </div>

              </div>    
            </section>  

            <h3>CAMINHO E BASE DE DADOS</h3>
            <section>
              <div class="form-group">
                    <label>Caminho do Sistema</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">http://</span>
                        </div>
                        <?php
                        $path = $_SERVER['SCRIPT_FILENAME'];
                        $path_parts = pathinfo($path);
                        $path = $path_parts['dirname'];
                        $path = explode('htdocs', $path);
                        $path = str_replace('instalador', '', $path[1]);
                        $utlima = substr($path, -1);
                        if($utlima=='/'){
                            $size = strlen($path);
                            $path = substr($path,0, $size-1);
                        }
                        ?>
                        <input type="text" value="<?php echo $_SERVER['HTTP_HOST']; ?><?php echo $path; ?>" class="form-control" placeholder="" name="caminho" id="caminho" required>
                      </div>
                    <small>Ex: http://localhost/sistema</small>
              </div>
              

              <div class="row">

                  <div class="col-md-4">
                    <div class="form-group">
                        <label>*NOME BASE DE DADOS</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-database" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="" name="nome_banco" id="nome_banco" required>
                          </div>
                        <small>Ex: sistema</small>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                        <label>*USUÁRIO BASE DE DADOS</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" value="root" class="form-control" placeholder="" name="user_banco" id="user_banco" required>
                          </div>
                        <small>Ex: root</small>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                        <label>*SENHA BANCO DE DADOS</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="" name="senha_banco" id="senha_banco">
                          </div>
                        <small>Em branco para instalação local</small>
                    </div>
                  </div>

               </div>    

            </section>
            <h3>USUÁRIOS PARA ACESSO</h3>
            <section>
              <p>ACESSO PARA ÁREA DE VENDAS</p>
              <div class="row">

                  <div class="col-md-4">
                    <div class="form-group">
                        <label>*NOME</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="" name="nome_pessoa" id="nome_pessoa" required >
                          </div>                        
                    </div>
                  </div>  

                  <div class="col-md-4">
                    <div class="form-group">
                        <label>*USUÁRIO</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="" name="user1" id="user1" required >
                          </div>                        
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                        <label>*SENHA</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="" name="senha1" id="senha1" required>
                          </div>                       
                    </div>
                  </div>

                  <hr>
              </div>
                   
                  <p><BR><BR>ACESSO PARA RETAGUARDA ADMINISTRATIVA</p>
              
              <div class="row">

                  <div class="col-md-6">
                    <div class="form-group">
                        <label>*USUÁRIO</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="" name="user2" id="user2" required>
                          </div>                        
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                        <label>*SENHA</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="" name="senha2" id="senha2" required>
                          </div>                       
                    </div>
                  </div>

               </div> 

            </section>
            

            <h3>FINALIZAÇÃO</h3>
            <section class="text-center">
                
                <div class="instalador_body hide">
                    <i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw loader-instalacao"></i><br>
                    <span class="span_install">INSTALANDO, AGUARDE...<br><small>(NÃO FECHE ESTA JANELA)</small></span>
                </div>
                
                <div class="avisos_instalacao">
                    <h4>PRONTO PARA INSTALAÇÃO</h4>  
                    <p>AO CLICAR EM <b>"INSTALAR AGORA"</b>, o sistema irá criar a base de dados<BR> e demais opções para funcionamento.</p>
                    <p><b>ATENÇÃO: </b> APÓS CONFIRMAR, NÃO SERÁ POSSÍVEL RETORNAR.</p>

                    <button type="submit" onclick="javascript:instala_sistema_efood();" class="btn btn-primary">INSTALAR AGORA</button>
                </div>    


            </section>
          </div>
        </div><!-- section-wrapper -->

        </form>
     </div>
     </div>   


    <script src="../admin/lib/jquery/js/jquery.js"></script>
    <script src="../admin/lib/popper.js/js/popper.js"></script>
    <script src="../admin/lib/bootstrap/js/bootstrap.js"></script>
    <script src="../admin/lib/jquery.steps/js/jquery.steps.js"></script>
   <script src="../admin/lib/parsleyjs/js/parsley.js"></script>
    <script src="../admin/js/slim.js"></script>
    <script src="javascript/instalador.js"></script>
    


  </body>
</html>
