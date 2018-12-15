<div class="row row-xs">

  <div class="col-md-6">
  <div class="card" style="height: 207px">
              
              <div class="col-md-12 top20">
                <div class="row row-xs"> 
                  <div class="col-md">
                    <label class="section-label-sm tx-gray-500">CLIENTE</label>
                    <div class="billed-to">
                      <h6 class="tx-gray-800 upper">
                      <?php 
                        if(!empty($dados_venda['nome_cliente'])){
                            echo $dados_venda['nome_cliente'];
                        } else {
                             echo $dados_cliente['nome'];
                        }
                      ?>
                      </h6>
                      <p class="upper thin">
                        <?php if(!empty($dados_cliente['endereco'])){echo $dados_cliente['endereco'].', '.$dados_cliente['numero'].' - ';} ?>
                        <?php if(!empty($dados_cliente['bairro'])){echo $dados_cliente['bairro'].'<br>';} ?>
                        <?php if(!empty($dados_cliente['telefone'])){echo '('.$dados_cliente['ddd'].') '.$dados_cliente['telefone'];} ?>
                      </p>
                      <h6>
                        <?php 
                        if($dados_venda['ocupou_mesa']!=0){
                            echo 'SENTOU NA MESA: '.$dados_venda['ocupou_mesa'];
                        } 
                        ?>
                      </h6>
                    </div>
                  </div>  
                </div>                
              </div>
  </div>
  </div>

  <div class="col-md-6">
  <div class="card">            

              <div class="col-md-12">
                <div class="table-responsive mg-t-10">
                  <table class="table table-invoice" style="border:0">
                    
                    <tbody>
                                      
                      <tr style="border:0">
                        <td class="tx-right" style="border:0">SUBTOTAL:</td>
                        <td class="tx-right" width="150" style="border:0">R$ <?php echo number_format($dados_venda['valor_total'],2,",","."); ?></td>
                      </tr>
                      <tr>
                        <td class="tx-right">DESCONTO (-):</td>
                        <td class="tx-right">R$ <?php echo number_format($dados_venda['valor_desconto'],2,",","."); ?></td>
                      </tr>
                      <tr>
                        <td class="tx-right">ENTREGA (+):</td>
                        <td class="tx-right">R$ <?php echo number_format($dados_venda['valor_entrega'],2,",","."); ?></td>
                      </tr>
                      <tr>
                        <td class="tx-right tx-uppercase tx-bold tx-inverse">TOTAL GERAL:</td>
                        <td class="tx-right"><h4 class="tx-primary tx-bold tx-lato">R$ <?php echo number_format($dados_venda['valor_final_venda'],2,",","."); ?></h4></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
                
              
  </div>
  </div>


</div>

<div class="card top10 listagem-pagamentos-recebidos">
            
            <div class="col-md-12 top20">             
              <div class="row row-xs">
                <div class="col-md">                
                  <div class="billed-to">
                    <h6 class="tx-gray-800">VALORES RECEBIDOS</h6>                  
                  </div>
                </div>     
              </div>         
            </div>

            <div class="col-md-12">
              <div class="table-responsive mg-t-10">
                <table class="table table-invoice" style="border:0">
                    <thead>
                    <tr>
                      <th width="200">Data/Hora</th>
                      <th>Atendente</th>                      
                      <th>Forma Pagamento</th>
                      <th>Valor Recebido</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $sel = $db->select("SELECT pagamentos_vendas.*, formas_pagamento.forma, usuarios.nome FROM pagamentos_vendas 
                        LEFT JOIN formas_pagamento ON pagamentos_vendas.forma_pagamento=formas_pagamento.id
                        LEFT JOIN usuarios ON pagamentos_vendas.id_usuario=usuarios.id
                        WHERE pagamentos_vendas.id_venda='$id_venda'
                        ORDER BY pagamentos_vendas.id
                        ");
                      if($db->rows($sel)){
                    while($dados = $db->expand($sel)){
                  ?>
                    <tr>
                      <td class="upper thin"><?php echo data_mysql_para_user($dados['data']); ?> ás <?php echo substr($dados['hora'],0,5); ?></td>
                      <td class="upper thin"><?php echo ($dados['nome']); ?></td>
                      <td class="upper thin"><?php echo ($dados['forma']); ?></td>
                      <td class="upper thin">R$ <?php echo number_format($dados['valor_caixa_real'],2,",","."); ?></td>
                    </tr>
                    <?php
                      }}
                    ?>                                    
                  </tbody>
                </table>
              </div>
            </div>
              
            
</div>