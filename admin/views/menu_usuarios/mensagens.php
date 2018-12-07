<?php require("../../includes/topo.php"); ?>


<div class="slim-pageheader">
  <ol class="breadcrumb slim-breadcrumb">
    <li class="breadcrumb-item"><a href="home">HOME</a></li>
    <li class="breadcrumb-item active" aria-current="page">MENSAGENS</li>
  </ol>
  <h6 class="slim-pagetitle upper">
    MENSAGENS DE AVISO
  </h6>
</div>

<div class="row">

<?php
	$sql = $db->select("SELECT * FROM admin_mensagens_sistema ORDER BY importante DESC, data DESC");  
  	while($ln = $db->expand($sql)){
?>

	<div class="col-md-12" style="margin-bottom: 20px">
		<div class="card">
			<?php
				if($ln['importante']==1){					
			?>
		    	<div class="card-header tx-medium bd-0 tx-white bg-danger">
		        	MENSAGEM IMPORTANTE
		        </div>
	        <?php
	        	}
	        ?>
	        <div class="card-body ">
	        	<p class="mg-b-0"><?php echo nl2br($ln['mensagem']); ?></p>
	        </div>
	        <div class="card-footer bd-t">
                  <small>ENVIADA EM <?php echo data_mysql_para_user(substr($ln['data'],0,10)); ?> ÀS <?php echo substr($ln['data'],10,6).'h'; ?></small>
                </div>
	    </div>
	</div>    

<?php
	}
?>

</div>

<?php require("../../includes/rodape.php"); ?>