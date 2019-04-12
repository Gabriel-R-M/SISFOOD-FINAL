<?php
ob_start();

set_time_limit(300);
ini_set('max_execution_time', 300);
ini_set('memory_limit', '-1');


/////////COPIA AS DLLS///////////
if (!@copy('../DLL/php_printer.dll', 'C:/xampp/php/ext/php_printer.dll')){
	@session_start();
	$_SESSION['erro_copiar_dll_php']=1;
}


///INSERE NO PHP.INI A PARTE DE IMPRESSÃO///
$fp_php = fopen("C:/xampp/php/php.ini", "a");
$conteudo_php = "

printer.default_printer=PHP_INI_ALL
extension=php_printer.dll
";
$escreve_php = fwrite($fp_php, $conteudo_php);
fclose($fp_php);




///RECEBE AS VARIAVEIS
$caminho = trim(strtolower($_POST['caminho']));
$nome_banco = trim(strtolower($_POST['nome_banco']));
$user_banco = trim(strtolower($_POST['user_banco']));
$senha_banco = trim(strtolower($_POST['senha_banco']));

$user1 = trim($_POST['user1']);
$senha1 = trim($_POST['senha1']);

$user2 = trim($_POST['user2']);
$senha2 = trim($_POST['senha2']);

$nome_local = $_POST['nome_local'];
$cnpj_local = $_POST['cnpj_local'];
$ie_local = $_POST['ie_local'];






/////////CONFIG///////////
$fp = fopen("../../admin/config.php", "w");

$conteudo = "<?php
ob_start();
@session_start();

define('ROOT_DIR', dirname(__FILE__).'/' );
define('SISTEMA_DIR', 'http://".$caminho."/');
define('ADMIN_DIR', 'http://".$caminho."/admin/');
	

//CLASSES DE USO
require(ROOT_DIR.'class/class.db.php');
require(ROOT_DIR.'class/class.seguranca.php');
require(ROOT_DIR.'class/class.session_ativa.php');
require(ROOT_DIR.'class/class.upload.php');

require(ROOT_DIR.'class/class.avisos.php');
require(ROOT_DIR.'class/class.mensagens_sistema.php');
require(ROOT_DIR.'class/class.totalizadores.vendas.php');

require(ROOT_DIR.'../includes/verifica_dados_sistema.php');
require(ROOT_DIR.'../includes/verifica_dados_loja.php');
require(ROOT_DIR.'../menu_caixa/actions/totalizadores_caixa.php');

require(ROOT_DIR.'class/class.mail.php');

?>
";

$escreve = fwrite($fp, $conteudo);
fclose($fp); 



//////////////////CLASS DB/////////////////
$fp = fopen("../../admin/class/class.db.php", "w");


$conteudo = '<?php
	set_time_limit(300);
	ini_set("max_execution_time", 300);
	ini_set("memory_limit", "-1");

	@ob_start();
	@session_start();
	@session_cache_expire(180000); 
	
	date_default_timezone_set("America/Sao_Paulo");

	define("HOST", "localhost");
	define("DBNAME", "'.$nome_banco.'");
	define("USER", "'.$user_banco.'");
	define("PASSWORD", "'.$senha_banco.'");

class DB{
    private $link;

	public function connect(){
		$this->link = new mysqli(HOST, USER, PASSWORD, DBNAME);
		mysqli_set_charset($this->link,"utf8");
        if( mysqli_connect_errno() ){
            echo "FALHA: ", mysqli_connect_error();
            exit();
        }
	}
	     
    public function __construct(){
	   $this->connect(); 
	}
	
	public function disconnect(){
		mysqli_close( $this->link );
	}
	
	
	public function __destruct(){
		$this->disconnect();
	}
	
	
	public function select($query,$erro=1){	
		error_reporting(0);
		if(!$result = $this->link->query($query)){
			if($erro==1){
				echo("<b>Erro MYSQL</b>:<br>" . mysqli_error($this->link))."<br><br>";
			}			
		} else {
			return $result;		
		}		
	}
	
	
	public function rows($query){	
		return mysqli_num_rows($query);
		
	}
	
	
	public function expand($query){	
		return mysqli_fetch_array($query,MYSQLI_BOTH);
	}
	
	
	public function last_id($query){	
		return mysqli_insert_id($this->link);
	}
	

	public function escape($var){
		$result = $this->link->real_escape_string($var);
		return $result;		
	}
	
}
?>
';

$escreve = fwrite($fp, $conteudo);
fclose($fp); 



//////////////////BANCO DE DADOS/////////////////
@$con = mysqli_connect("localhost",$user_banco,$senha_banco);

$sql1 = 'DROP DATABASE IF EXISTS $nome_banco';
$sql2 = "CREATE DATABASE $nome_banco";

if(mysqli_query($con, $sql1)) {	

	mysqli_query($con, $sql2);

		@$con = mysqli_connect("localhost",$user_banco,$senha_banco,$nome_banco);
		
		$nome_do_arquivo = "../base/base.sql"; 
			if(file_exists($nome_do_arquivo)){	
				
				$arquivo = Array();
				$arquivo = file($nome_do_arquivo);  
				$prepara = "";  
				foreach($arquivo as $v)$prepara.=$v; 
				$sql = explode(";",$prepara); 
				foreach($sql as $v) @mysqli_query($con,$v);	
		}

	 

}

$instalacao=1;	
require_once ("../../atualizacao.php");



/////////////
$insere = $db->select("INSERT INTO usuarios (nome, usuario, senha, ativo, nivel) VALUES ('$nome_pessoa', '$user1', '$senha1', '1', '3')");

$insere_admin = $db->select("INSERT INTO usuarios_admin (usuario, senha, ativo, nome) VALUES ('$user2', '$senha2', '1', '$nome_pessoa')");

$insere = $db->select("INSERT INTO dados_loja (razao, cnpj, inscricao_estadual) VALUES ('$nome_local', '$cnpj_local', '$ie_local')");

$insere = $db->select("INSERT INTO configuracoes (senha_cancelamento) VALUES ('123')");

$insere = $db->select("INSERT INTO sistema (url_servidor, versao) VALUES ('http://sisconnection.com.br/efood/webservice/', '1.1')");


////FORMAS PGTO//////
$delete = $db->select("DELETE FROM formas_pagamento");


//DINHEIRO
$grava = $db->select("INSERT INTO formas_pagamento (id, forma, icone, ativo, convenio) VALUES ('1', 'Dinheiro', 'icofont-dollar', '1', '0')");	

//CARTAO
$grava = $db->select("INSERT INTO formas_pagamento (id, forma, icone, ativo, convenio) VALUES ('2', 'Cartão', 'icofont-credit-card', '1', '0')");	

//CREDIARIO
$grava = $db->select("INSERT INTO formas_pagamento (id, forma, icone, ativo, convenio) VALUES ('3', 'Crediário', 'icofont-notebook', '0', '1')");	


header("Location: ../mensagem");

?>

