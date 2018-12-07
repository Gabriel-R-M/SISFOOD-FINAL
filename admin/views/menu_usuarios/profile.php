<?php require("../../includes/topo.php"); ?>

<?php
  $sql2 = $db->select("SELECT * FROM usuarios_admin");  
  $ln2 = $db->expand($sql2);
?>

<div class="slim-pageheader">
  <ol class="breadcrumb slim-breadcrumb">
    <li class="breadcrumb-item"><a href="home">HOME</a></li>
    <li class="breadcrumb-item active" aria-current="page">USUÁRIO RETAGUARDA</li>
  </ol>
  <h6 class="slim-pagetitle upper">
    DADOS DE USUÁRIO RETAGUARDA
  </h6>
</div>


<form method="post" action="usuario-retaguarda/save">
<div class="section-wrapper">
          

      <div class="form-layout">
            <div class="row mg-b-25">
              
        
        <div class="col-md-12">
           <div class="form-group">
                <label for="exampleInputEmail1">Nome</label>
                <input type="text" class="form-control" name="nome" required="required" value="<?php echo $ln2['nome']; ?>"/>
           </div>
        </div>


        <div class="col-md-6">
           <div class="form-group">
                <label for="exampleInputEmail1">Usuário</label>
                <input type="text" class="form-control" name="usuario"  value="<?php echo $ln2['usuario']; ?>"/>
           </div>
        </div> 

        <div class="col-md-6">
           <div class="form-group">
                <label for="exampleInputEmail1">Senha</label>
                <input type="password" class="form-control" name="senha"  value="<?php echo $ln2['senha']; ?>"/>
           </div>
        </div> 


        


            </div><!-- row -->

            <div class="form-layout-footer">
              <button type="submit" class="btn btn-primary bd-0">SALVAR</button>              
            </div><!-- form-layout-footer -->
          </div><!-- form-layout -->
             
  
</div>
</form>

<?php require("../../includes/rodape.php"); ?>