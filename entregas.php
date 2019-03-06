<?php
include("admin/class/class.db.php");
include("admin/class/class.seguranca.php");
include("includes/verifica_configuracoes_loja.php");
include("includes/verifica_dados_sistema.php");
include("includes/verifica_caixa_aberto.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<title>SIS E-FOOD v<?php echo $dados_sistema['versao']; ?></title>

<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    
<link rel="shortcut icon" href="favicon.ico">     
    
<!-- Bootstrap 3.3.4 -->
<link href="admin/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
<link href="admin/lib/Ionicons/css/ionicons.css" rel="stylesheet">
<link href="css/icones/icones01/icofont.min.css" rel="stylesheet">
<link href="css/icones/icones02/css/pe-icon-set-food.min.css" rel="stylesheet">

<link href="admin/lib/perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet">
    
<!-- Slim CSS -->
<link rel="stylesheet" href="css/sistema/slim.css">
<link rel="stylesheet" href="css/sistema/custom.css">
<link rel="stylesheet" href="css/sistema/custom-mobile.css">


<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body style="overflow-y: auto;">


	<div class="slim-header with-sidebar" >
      <div class="container-fluid">
        <div class="slim-header-right">
          <h2 class="slim-logo"><a href="javascript:void(0)">ENTREGAS</a></h2>          
        </div>
        <a href="entregas">
          <button class="btn btn-primary pull-right" style="font-size: 18px"><i class="icofont-refresh"></i></button>
        </a>
      </div>
  </div>


    <div class="slim-body " >

     
      
      <div class="slim-mainpanel " >

      
      <div class="container" id="tudo_conteudo">
      <div class="row row-xs" id="conteudo_geral"  >





        <?php  
        $p=1;    
        $sel = $db->select("SELECT aguarda_venda.*, clientes.*, aguarda_venda.id AS id_venda FROM aguarda_venda          
        LEFT JOIN clientes ON aguarda_venda.id_cliente=clientes.id
        WHERE aguarda_venda.finalizada='0' AND aguarda_venda.aguarde='1' 
        AND aguarda_venda.id_caixa='$id_caixa_aberto' AND aguarda_venda.entrega!='0'
        ORDER BY aguarda_venda.pedido_entregue ASC, aguarda_venda.pedido_inicio DESC
        ");
        
        if($db->rows($sel)){
      
          while($dados = $db->expand($sel)){
      
            $entrega = '<i class="fa fa-motorcycle" aria-hidden="true"></i> SAIU P/ ENTREGA';
            $entrega2 = 'tx-danger';
            $entrega3 = '#B92A25';
            $id = $dados['id_venda'];
       
    ?>
        
          <div class="col-12 col-md-3 bottom10">
              <div class="card card-popular-product" style="border-left-color: <?php echo $entrega3; ?>">
                
            
                  <label class="prod-id thin">PEDIDO: <?php echo ($id); ?></label>
                  <h5 class="prod-name upper corta_texto"><a href="javascript:void(0);"><?php echo ($dados['nome']); ?></a></h5>
                  <p class="prod-by"><?php echo data_mysql_para_user($dados['data_pedido']); ?> ás <?php echo substr($dados['pedido_inicio'],0,5).'hs'; ?></p>
                    <div class="row" style="padding-bottom: 0; margin-bottom: 0">
                      <div class="col-12" style="margin-top: -12px; padding-bottom: 0; margin-bottom: 0">
                          <h3 class="tx-lato" style="padding-bottom: 0; margin-bottom: 0; color: <?php echo $entrega3; ?>">
                            <small>R$</small>
                            &nbsp;<?php echo number_format($dados['valor_final_venda'],2,",","."); ?>
                          </h3>                         
                      </div>                      
                    </div>

                    <div class="row" style="padding-bottom: 0; margin-bottom: 0">
                      <div class="col-12" style="margin-top: 10px; padding-bottom: 0; margin-bottom: 0">
                        <hr class="top0">
                        <h6 class="prod-name upper corta_texto" style="font-size: 13px">
                          <?php echo $dados['endereco']; ?>, <?php echo $dados['numero']; ?><br>                          
                          <?php echo $dados['bairro']; ?> <?php echo $dados['complemento']; ?>
                        </h6>
                      </div>
                    </div>    

                    <?php
                    $display_entregadores = ''; 
                    $display_marca_ok = '';
                    $col= 6; 
                   
                    if($dados['pedido_saiu_entrega']=='00:00:00'){  
                      
                      $display_entregadores = ''; 
                      $display_marca_ok = 'style="display:none"'; 
                      $display_marca_ok2 = 'style="display:none"'; 

                    } else {                      

                      $display_entregadores = 'style="display:none"'; 
                      $display_marca_ok = ''; 
                      $display_marca_ok2 = ''; 

                        if($dados['pedido_entregue']!='00:00:00'){  
                            $display_marca_ok2 = 'style="display:none;"'; 
                            $col= 12;
                        }

                    }
                    ?>  

                        <div class="row row-xs top15" >
                            
                            <div class="col-md-12" id="seleciona_entregador<?php echo $id; ?>" <?php echo $display_entregadores; ?>>
                              <select class="form-control upper" onChange="javascript:marca_pedido_entregue(this.value,<?php echo $id; ?>,1);" id="nome_entregador<?php echo $id; ?>">
                                <?php
                                  if($dados['entregador']!=0){
                                    $id_entregador=$dados['entregador'];
                                    $sql = $db->select("SELECT * FROM entregadores WHERE id='$id_entregador' LIMIT 1");
                                    $row = $db->expand($sql);
                                    echo '<option value="'.$row['id'].'" selected>'.$row['nome'].'</option>';
                                          
                                  } else {
                                    echo '<option value="">--- ESCOLHA ---</option>';
                                    $id_entregador=0; 
                                  }
                                      
                                  $sql = $db->select("SELECT * FROM entregadores WHERE ativo='1' AND id!='$id_entregador' ORDER BY nome");
                                  while($row = $db->expand($sql)){
                                    echo '<option value="'.$row['id'].'">'.$row['nome'].'</option>';
                                  }
                                ?>  
                              </select>
                            </div>


                            <div class="col-md-<?php echo $col; ?>" id="marca_ok_entrega<?php echo $id; ?>" <?php echo $display_marca_ok; ?>> 
                               <button class="btn btn-block btn-primary" onclick="javascript:marca_pedido_entregue(0,<?php echo $id; ?>,0);" type="button">NÃO ENTREGUE</button> 
                            </div>

                            <div class="col-md-6" id="marca_ok_entrega2<?php echo $id; ?>" <?php echo $display_marca_ok2; ?>> 
                               <button class="btn btn-block btn-success" onclick="javascript:marca_pedido_entregue(0,<?php echo $id; ?>,1,1);" type="button">ENTREGUE</button> 
                            </div>

                        </div> 


                     
                        


              </div>
          </div>


      <?php
            
          
        }
      } else {

          $entrega2 = 'tx-primary';
          $entrega3 = '#B92A25';

      ?>  
          

          <div class="col-md-12 col-lg-12 bottom10 cursor">
              <div class="card card-popular-product" style="border-left-color: <?php echo $entrega3; ?>"> 
                
                  <label class="prod-id" style="font-weight: 300"><small>ENTREGA</small></label>
                  <h5 class="prod-name upper corta_texto"><a href="javascript:void(0);">NENHUMA ENTREGA ENCONTRADA</a></h5>
                  
              </div>
              </div>


      <?php      
      }
      ?>




<?php include("includes/rodape.php"); ?>     

<script>
  window.clearTimeout(atualiza_pedidos);  
  var atualiza_pedidos = setInterval(function(){ location.reload() }, 60000);
</script>   