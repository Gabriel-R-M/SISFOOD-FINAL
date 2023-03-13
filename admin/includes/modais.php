<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">AVISO</h4>
      </div>
      <div class="modal-body">
        	<p>Mensagem enviada com sucesso. Obrigado.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
      </div>
    </div>

  </div>
</div>



<div id="ModalNovoIngrediente" class="modal fade">
 
      <div class="modal-dialog modal-md modal-dialog-vertical-center" role="document">
        <div class="modal-content bd-0 tx-14">
          <form method="post" action="ajax/salva_ingrediente.php" id="FormCadastroIngredientes"> 
          <div class="modal-header" >
            <h6 class="tx-12 mg-b-0 tx-uppercase ">CADASTRO DE INGREDIENTES</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body pd-15">
            <h5 class="lh-3 mg-b-20 mg-t-10"><a href="" class="tx-inverse hover-primary">INFORME O INGREDIENTE, PARA CADASTRO:</a></h5>
            <div class="form-group">
              <input type="hidden" name="id" value="">
              <input type="text" name="ingrediente" id="ingrediente" class="form-control pd-y-12" required>
            </div><!-- form-group -->

            <div class="alert alert-success hide" id="msg_ok_ingrediente">
              <i class="icofont-ui-check"></i>&nbsp;INGREDIENTE CADASTRADO.
            </div>
            

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="btn_salva_ingrediente">CADASTRAR</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
          </div>
          </form>  
        </div>
      </div><!-- modal-dialog -->
    
</div><!-- modal -->


