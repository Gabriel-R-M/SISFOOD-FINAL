<div id="ModalConsultaPreco" class="modal fade" tabindex="-1" >
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-header">        
        <h4 class="modal-title">Consulta de Preços</h4>
       
      </div>
      
        <div class="modal-body pd-20 text-center" style="text-transform: uppercase;">

            <div class="form-group top10">               
                <input type="text" autocomplete="off" style="width: 430px; " name="consulta_preco_input" id="consulta_preco_input" class="form-control" onkeyup="javascript:consulta_precos_modal(this.value);">               
            </div> 

            <div class="" style="max-height: 340px; min-height: 340px; overflow-x: hidden; overflow-y: auto;" id="exibe_consulta_precos">
                <center>PREECHA O CAMPO ACIMA PARA PESQUISAR</center>
            </div>  

                     
        </div>
      
    </div>

  </div>
</div>







<div id="ModalCupomFiscal" class="modal fade" tabindex="-1" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-header">        
        <h4 class="modal-title">Cupom Fiscal</h4>
       
      </div>
      
        <div class="modal-body pd-20 text-center" style="text-transform: uppercase;">

            <h19 class="text-center" id="cupom_fiscal_avisos"></h19>

            <div class="form-group top10" id="hide_input_fiscal">               
                <input type="number" autocomplete="off" style="width: 330px; " name="cpf_cliente" id="cpf_cliente" class="form-control">
                <button type="button" onclick="javascript:venda_fiscal();" class="btn btn-block  btn-danger top10">CONTINUAR</button>
            </div> 

            <div class="form-group top10 hide" id="botao_erro_sat">                               
                <button type="button" onclick="javascript:libera_venda_fiscal();" class="btn btn-block  btn-danger top10">ENTENDI</button>
            </div> 

                     
        </div>
      
    </div>

  </div>
</div>



<div id="ModalRejeicaoPedidoInternet" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-header">        
        <h4 class="modal-title">Motivo da Rejeição</h4>
        <button type="button" class="close" data-dismiss="modal" tabindex="-1">&times;</button>
      </div>
        
        <form method="post" id="FormRejeitaPedidoInternet" action="menu_internet/actions/aceita-rejeita-pedido.php">      
        <div class="modal-body" id="motivo_rejeicao_pedido_internet_conteudo">
          
            <div class="form-group">
                <input type="hidden" name="status" value="3">
                <input type="hidden" name="id" id="id_pedido_rejeicao">
                <textarea name="motivo_erro_internet" id="motivo_erro_internet" class="form-control" style="height: 120px" placeholder="Informe o motivo da rejeição do pedido"></textarea>
            </div>  
          
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn  btn-danger" id="botao_rejeita_pedido_modal">REJEITAR</button>
      </div>  
      </form>
      
    </div>

  </div>
</div>


<div id="ModalPedidoInternet" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-header">        
        <h4 class="modal-title">Detalhes do Pedido</h4>
        <button type="button" class="close" data-dismiss="modal" tabindex="-1">&times;</button>
      </div>
      
        <div class="modal-body" id="detalhes_pedido_internet_conteudo">
            
        </div>
      
    </div>

  </div>
</div>


<div id="ModalIniciaNovoPedido" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-header">        
        <h4 class="modal-title"><center>Novo Pedido?</center></h4>
        <button type="button" class="close" data-dismiss="modal" tabindex="-1">&times;</button>
      </div>
      
        <div class="modal-body">
          <div class="row">

            <div class="col-md-12 d-none d-md-block">              
                  <button onclick="javascript:inicia_pedido();" class="btn btn-info btn-block grandao" id="sim_novo_pedido">
                    SIM
                  </button>               
            </div>

            <div class="col-md-12 d-block d-md-none">              
                  <button onclick="javascript:inicia_pedido(0,1);" class="btn btn-info btn-block grandao" id="sim_novo_pedido">
                    SIM
                  </button>               
            </div> 

            <div class="col-md-12 top15">                
                    <button data-dismiss="modal" tabindex="-1" class="btn btn-danger btn-block  grandao">NÃO</button>                
            </div> 

          </div>           
        </div>
      
    </div>

  </div>
</div>





<!-- Modal -->
<div id="ModalPgtosRecebidos" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-header">
        <h4 class="modal-title">Pagamentos Recebidos</h4>
        <button type="button" class="close" data-dismiss="modal" tabindex="-1">&times;</button>
        
      </div>
      
      <div class="modal-body" id="exibe_pagamentos_recebidos">
      
  	  </div>
      
      
    </div>

  </div>
</div>



<!-- Modal -->
<div id="ModalCompartilhamentoMesaRecebimento" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-header">        
        <h4 class="modal-title">Divisão de Mesa</h4>
        <button type="button" class="close" data-dismiss="modal" tabindex="-1">&times;</button>
      </div>
      
      <div class="modal-body" id="exibe_compartilhamento_mesa_recebimento">
      
      </div>
      
      
    </div>

  </div>
</div>



<!-- Modal -->
<div id="ModalDivisaoMesaPessoas" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-header">        
        <h4 class="modal-title">Divisão de Ítens</h4>
        <button type="button" class="close" data-dismiss="modal" tabindex="-1">&times;</button>
      </div>
      
      <div class="modal-body" id="exibe_pessoas_mesa_divisao">
      
      </div>
      
      
    </div>

  </div>
</div>



<!-- Modal -->
<div id="ModalEditaDadosClienteVenda" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-header">        
        <h4 class="modal-title">Dados do Cliente</h4>
        <button type="button"  class="close" data-dismiss="modal" tabindex="-1">&times;</button>
      </div>
      
      <div class="modal-body" id="exibe_dados_cliente_pedido">
      
      </div>
      
      
    </div>

  </div>
</div>


<div id="CancelaVendaSenha" class="modal fade scale" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-dialog-vertical-top modal-sm" role="document">

    <!-- Modal content-->
    <div class="modal-content bd-0 tx-14">
      
      <div class="modal-header">
        <h6 class="modal-title">Cancelamento</h4>
        <button type="button" class="close" data-dismiss="modal" tabindex="-1" aria-label="Close">
              <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        
        <form method="post" action="menu_pedidos/actions/cancela_venda.php" id="FormCancelaVenda">

            <div class="input-group top5">
                  <div class="input-group-append">
                  <span class="input-group-text" style="border-right:0">PEDIDO:</span>
                </div>
                  
                   <input type="text" name="id_venda_cancela" id="exibe_cancelamento_venda" readonly="readonly" class="form-control text-center" required="required">
                   <input type="hidden" name="verifica_senha" value="1">
                  
            </div>  

              <div class="input-group input-group-lg top15">
                
                  
                    <input type="password" class="form-control" style="border-radius: 4px 4px 0 0; text-align: center;" placeholder="Senha de cancelamento" id="senha_cancelamento" name="senha_cancelamento" required="required">
                    <button type="submit" id="botao_cancela_pedido" class="btn btn-danger btn-block " style="border-radius:0 0  4px 4px">CANCELAR VENDA</button>
                  
              </div>  

            
              <div class="alert alert-danger text-center" style="margin-bottom: 0; display: none; margin-top: 10px" id="erro_senha_cancela">
                <i class="icofont-exclamation-tringle"></i> SENHA INCORRETA!
              </div>

        </form>      


      </div>
      
      
    </div>

  </div>
</div>





<div id="CancelaItemPedidoSenha" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-header">        
        <h4 class="modal-title">Cancela Ítem</h4>
        <button type="button" class="close" data-dismiss="modal" tabindex="-1">&times;</button>
      </div>
      
      <div class="modal-body text-center">
        
        <form method="post" action="menu_pedidos/actions/exclui_produto_venda.php" id="FormCancelaItemPedido">

              <input type="hidden" name="id_prod_venda_cancelamento" value="" id="id_prod_venda_cancelamento">

              <span class="corpo-modal top5">Senha para cancelar o ítem:</span>

              <div class="input-group input-group-lg top15">
              
                    <input type="password" class="form-control" style="border-radius: 4px 4px 0 0; text-align: center; " placeholder="Senha de cancelamento" id="senha_cancelamento_item_pedido" name="senha_cancelamento_item_pedido" required="required" autocomplete="off" >
                    <button type="submit" id="botao_cancela_item_pedido" class="btn btn-danger btn-block " style="border-radius:0 0  4px 4px">CANCELAR ÍTEM</button>
                  
              </div>  

              <div class="alert alert-danger text-center" style="margin-bottom: 0; display: none; margin-top: 10px" id="erro_senha_cancela_item_pedido">
                Senha de cancelamento incorreta!
              </div>

        </form>      


      </div>
      
      
    </div>

  </div>
</div>



<div id="CancelaAdicionalPedidoSenha" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-header">        
        <h4 class="modal-title">Cancela Adicional</h4>
        <button type="button" class="close" data-dismiss="modal" tabindex="-1">&times;</button>
      </div>
      
      <div class="modal-body text-center">
        
        <form method="post" action="menu_pedidos/actions/exclui_adicional_venda.php" id="FormCancelaAdicionalPedido">

              <input type="hidden" name="id" value="" id="id_adicional_cancelamento">
              <input type="hidden" name="verifica_senha" value="1">

              <span class="corpo-modal top5">Senha para cancelar:</span>

              <div class="input-group input-group-lg top15">
              
                    <input type="password" class="form-control" style="border-radius: 4px 4px 0 0; text-align: center; " placeholder="Senha de cancelamento" id="senha_cancelamento_adicional_pedido" name="senha_cancelamento_adicional_pedido" required="required">
                    <button type="submit" id="botao_cancela_adicional_pedido" class="btn btn-danger btn-block " style="border-radius:0 0  4px 4px">CANCELAR</button>
                  
              </div>  

              <div class="alert alert-danger text-center" style="margin-bottom: 0; display: none; margin-top: 10px" id="erro_senha_cancela_adicional">
                Senha de cancelamento incorreta!
              </div>

        </form>      


      </div>
      
      
    </div>

  </div>
</div>



<div id="CancelaOpcoesPedidoSenha" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-header">        
        <h4 class="modal-title">Cancela Opção</h4>
        <button type="button" class="close" data-dismiss="modal" tabindex="-1">&times;</button>
      </div>
      
      <div class="modal-body text-center">
        
        <form method="post" action="menu_pedidos/actions/exclui_opcao_venda.php" id="FormCancelaOpcoesPedido">

              <input type="hidden" name="id" value="" id="id_opcoes_cancelamento">
              <input type="hidden" name="verifica_senha" value="1">

              <span class="corpo-modal top5">Senha para cancelar:</span>

              <div class="input-group input-group-lg top15">
              
                    <input type="password" class="form-control" style="border-radius: 4px 4px 0 0; text-align: center; " placeholder="Senha de cancelamento" id="senha_cancelamento_opcoes_pedido" name="senha_cancelamento_opcoes_pedido" required="required">
                    <button type="submit" id="botao_cancela_opcoes_pedido" class="btn btn-danger btn-block " style="border-radius:0 0  4px 4px">CANCELAR</button>
                  
              </div>  

              <div class="alert alert-danger text-center" style="margin-bottom: 0; display: none; margin-top: 10px" id="erro_senha_cancela_opcoes">
                Senha de cancelamento incorreta!
              </div>

        </form>      


      </div>
      
      
    </div>

  </div>
</div>



<div id="NovaSaidaCaixa" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-header">        
        <h4 class="modal-title">Retirada de Caixa</h4>
        <button type="button" class="close" data-dismiss="modal" tabindex="-1">&times;</button>
      </div>
      
      <div class="modal-body">
        
        <form method="post" action="menu_caixa/actions/salva_saida_caixa.php" id="FormSaidaCaixa">

            <ul class="list-group">        
              <li class="list-group-item text-center">
                <span><h19><strong>VALOR DA RETIRADA</strong></h19></span>                
              </li> 
              <li class="list-group-item" style="border-top: 0">
                <input type="text" name="valor_saida_caixa" placeholder="0.00" class="form-control input-lg valores text-center" required="required" id="valor_saida_caixa">
              </li>
              <li class="list-group-item" style="border-top: 0">
                <input type="text" name="motivo_saida_caixa" placeholder="Informe o motivo" class="form-control input-lg text-center " required="required">
              </li>  
            </ul> 


           <button type="submit" id="botao_saida_caixa" class="btn btn-danger btn-block top10" >EFETUAR SAÍDA</button>

        </form>      


      </div>
      
      
    </div>

  </div>
</div>




<!-- Modal -->
<div id="ModalExibeSaidasCaixa" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-header">        
        <h4 class="modal-title">Retiradas do Caixa</h4>
        <button type="button" class="close" data-dismiss="modal" tabindex="-1">&times;</button>
      </div>
      
      <div class="modal-body" id="exibe_retiradas_caixa">
          
      </div>
      
      
    </div>

  </div>
</div>



<!-- Modal -->
<div id="ModalExibeEntregasCaixa" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-header">        
        <h4 class="modal-title">Entregas Realizadas</h4>
        <button type="button" class="close" data-dismiss="modal" tabindex="-1">&times;</button>
      </div>
      
      <div class="modal-body" id="exibe_saidas_caixa">
          
      </div>
      
      
    </div>

  </div>
</div>






<!-- Modal -->
<div id="ModalExibeVendasCaixa" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-header">        
        <h4 class="modal-title">Listagem de Vendas</h4>
        <button type="button" class="close" data-dismiss="modal" tabindex="-1">&times;</button>
      </div>
      
      <div class="modal-body" id="exibe_vendas_caixa">
          
      </div>
      
      
    </div>

  </div>
</div>


<div id="ModalFinalizaCaixa" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-header">        
        <h4 class="modal-title">Finalizar Caixa</h4>
        <button type="button" class="close" data-dismiss="modal" tabindex="-1">&times;</button>
      </div>
      
      <div class="modal-body text-center">

          <br>
          <h16>Confirma a finalização do caixa?</h16><br>
          <h19 id="horario_caixa"></h19><br>
          <h12 class="thin">*Todos os pedidos em aberto serão finalizados.</h12>
                    
      </div>

      <div class="modal-footer">
          <button type="submit" id="btn_fecha_caixa" class="btn  btn-danger btn-block " onclick="finaliza_caixa();">CONFIRMAR</button>

      </div>  
      
      
    </div>

  </div>
</div>




<div id="ModalAbreCaixa" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-header">
        <h4 class="modal-title">Iniciar Caixa</h4>
        <button type="button" class="close" data-dismiss="modal" tabindex="-1">&times;</button>
      </div>
      
      <div class="modal-body text-center">

          <br>
          <h16>Confirma abertura do caixa?</h16>
          <h19 id="abre_caixa"></h19><br>
          <h16 id="confirma_troco"></h16>
                    
      </div>

      <div class="modal-footer">
          <button type="submit" id="btn_abre_caixa" class="btn  btn-primary btn-block " onclick="abre_caixa();">CONFIRMAR</button>

      </div>  
      
      
    </div>

  </div>
</div>



<div id="ModalFichaCliente" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-header">        
        <h4 class="modal-title">Ficha do Cliente</h4>
        <button type="button" class="close" data-dismiss="modal" tabindex="-1">&times;</button>
      </div>
      
      <div class="modal-body" id="carrega_dados_cliente_modal">

          
                    
      </div>

      <div class="modal-footer">
          <div class="col-md-6">
            <button type="submit" id="edita_ficha_cliente" class="btn btn-block btn-primary pull-left" onclick="edita_ficha_cliente();">EDITAR DADOS</button>
          </div>

          <div class="col-md-6">
            <button type="submit" id="edita_ficha_cliente" class="btn btn-block btn-warning " onclick="consulta_compras_cliente();">VER COMPRAS</button>
          </div>
      </div>  
      
      
    </div>

  </div>
</div>





<div id="ModalDetalhesCompra" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-header">        
        <h4 class="modal-title">Detalhes da Venda</h4>
        <button type="button" class="close" data-dismiss="modal" tabindex="-1">&times;</button>
      </div>
      
        <div class="modal-body" id="exibe_detalhes_venda_modal" style="text-transform: uppercase;">

                     
        </div>
      
    </div>

  </div>
</div>


<div id="ModalErrosGerais" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-header">        
        <h4 class="modal-title">Ops!</h4>
        <button type="button" class="close" data-dismiss="modal" tabindex="-1">&times;</button>
      </div>
      
        <div class="modal-body pd-20 text-center" style="text-transform: uppercase;">

            <h19 id="erros_escritos_gerais"></h19>
                     
        </div>
      
    </div>

  </div>
</div>




<div id="ModalPerguntaImprime01" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-header">        
        <h4 class="modal-title"><center>Imprimir Comanda?</center></h4>
        <button type="button" class="close" data-dismiss="modal" tabindex="-1">&times;</button>
      </div>
      
        <div class="modal-body">
          <div class="row">

            <div class="col-md-12">               
                    <button onclick="javascript:imprime_comanda01();" class="btn btn-success btn-block  grandao">SIM</button>               
            </div> 

            <div class="col-md-12 top15">                
                    <button data-dismiss="modal" tabindex="-1" class="btn btn-danger btn-block  grandao">NÃO</button>                
            </div> 

          </div>           
        </div>
      
    </div>

  </div>
</div>





<div id="ModalPerguntaImprime02" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-header">        
        <h4 class="modal-title"><center>Imprimir Ítem(s) ?</center></h4>
        <button type="button" class="close" data-dismiss="modal" tabindex="-1">&times;</button>
      </div>
      
        <div class="modal-body">
          <div class="row">

            <div class="col-md-12">               
                    <button onclick="javascript:imprime_comanda02(0);" class="btn btn-success btn-block  grandao">SIM</button>               
            </div> 

            <div class="col-md-12 top15">                
                    <button onclick="javascript:marca_itens_impressos();" data-dismiss="modal" tabindex="-1" class="btn btn-danger btn-block  grandao">NÃO</button>                
            </div> 

          </div>           
        </div>
      
    </div>

  </div>
</div>


<div id="ModalPerguntaImprime05" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-header">        
        <h4 class="modal-title"><center>Imprimir Ítem ?</center></h4>
        <button type="button" class="close" data-dismiss="modal" tabindex="-1">&times;</button>
      </div>
      
        <div class="modal-body">
          <div class="row">

            <div class="col-md-12"> 
                    <input type="hidden" id="id_item_imprimir">              
                    <button onclick="javascript:reimprime_item_avulso();" class="btn btn-success btn-block  grandao">SIM</button>               
            </div> 

            <div class="col-md-12 top15">                
                    <button data-dismiss="modal" tabindex="-1" class="btn btn-danger btn-block  grandao">NÃO</button>                
            </div> 

          </div>           
        </div>
      
    </div>

  </div>
</div>




<div id="ModalPerguntaImprime03" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-header">        
        <h4 class="modal-title"><center>Imprimir Recibo?</center></h4>
        <button type="button" class="close" data-dismiss="modal" tabindex="-1">&times;</button>
      </div>
      
        <div class="modal-body">
          <div class="row">

            <div class="col-md-12">               
                    <button onclick="javascript:imprime_comprovante_crediario();" class="btn btn-success btn-block  grandao">SIM</button>               
            </div> 

            <div class="col-md-12 top15">                
                    <button data-dismiss="modal" tabindex="-1" class="btn btn-danger btn-block  grandao">NÃO</button>                
            </div> 

          </div>           
        </div>
      
    </div>

  </div>
</div>




<div id="ModalPerguntaImprime04" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-header">        
        <h4 class="modal-title"><center>Imprimir Comprovante?</center></h4>
        <button type="button" class="close" data-dismiss="modal" tabindex="-1">&times;</button>
      </div>
      
        <div class="modal-body">
          <div class="row">

            <div class="col-md-12">               
                    <button onclick="javascript:imprime_ciencia_crediario();" class="btn btn-success btn-block  grandao">SIM</button>               
            </div> 

            <div class="col-md-12 top15">                
                    <button data-dismiss="modal" tabindex="-1" class="btn btn-danger btn-block  grandao">NÃO</button>                
            </div> 

          </div>           
        </div>
      
    </div>

  </div>
</div>



<div id="ModalBaixaPedidosRapido" class="modal fade" role="dialog" tabindex="-1">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-header">
        <h4 class="modal-title">Atenção</h4>
        <button type="button" class="close" data-dismiss="modal" tabindex="-1">&times;</button>
        
      </div>
      
      <div class="modal-body upper thin text-center">
          <div class="col-md-12" id="exibe_mensagem_baixa_pedidos"></div> 
          <div class="col-md-12 hide" id="tipo_pgto_baixa_varios_pedidos">
            <select class="form-control top10 upper" id="forma_pagamento_baixa_varios_pedidos">
              <option value="0">-- FORMA DE PAGAMENTO --</option>
              <?php             
                $sql = $db->select("SELECT * FROM formas_pagamento WHERE ativo='1' AND id!='3' ORDER BY id");
                while($row = $db->expand($sql)){
                  echo '<option value="'.$row['id'].'">'.$row['forma'].'</option>';
                }
              ?>  
            </select>
          </div> 

          <div class="alert alert-danger text-center" style="margin-bottom: 0; display: none; margin-top: 10px" id="erro_baixa_varios_pedidos">
                <i class="icofont-exclamation-tringle"></i> ESCOLHA A FORMA DE RECEBIMENTO!
          </div>

      </div>

      <div class="modal-footer">
          <button type="submit" class="btn  btn-danger btn-block " onclick="marca_recebe_cancela_pedidos();">CONFIRMAR</button>

      </div>  
      
      
    </div>

  </div>
</div>

