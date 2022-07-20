<?php  

session_start();
require_once 'db_connect.php';


$formatosPermitidos = array("png","jpeg","jpg","PNG","JPG","JPEG");


$altPrincipal = $_POST['txtFotoPrincipal'];
$altSec1 = $_POST['txtFotoSec1'];
$altSec2 = $_POST['txtFotoSec2'];
$altSec3 = $_POST['txtFotoSec3'];


$extensaoPrincipal  = "";
$extensao1 = "";
$extensao2 = "";
$extensao3 = "";

$cp = "";
$c1 = "";
$c2 = "";
$c3 = "";


$cod_evento = clear($_POST['txtCodEvento']);

// Principal

$sql = "select i.nm_img, i.cod_img from tbl_evento as e inner join tbl_img as i on i.cod_evento = e.cod_evento where i.principal = 's' and e.cod_evento = $cod_evento";

$resultado = mysqli_query($connect,$sql);
echo mysqli_error($connect);
if (mysqli_num_rows($resultado)>0) {

	$dados = mysqli_fetch_array($resultado);

	$novoNome1 = $dados['nm_img'];
	$cp = $dados['cod_img'];

}
else{
	$novoNome1 = "EvSemImg.png";
}

// Img 1


$sql = "select i.nm_img, i.cod_img from tbl_evento as e inner join tbl_img as i on i.cod_evento = e.cod_evento where i.principal = 'n' and i.secundaria = '1' and e.cod_evento = $cod_evento";

$resultado = mysqli_query($connect,$sql);
echo mysqli_error($connect);
if (mysqli_num_rows($resultado)>0) {

	$dados = mysqli_fetch_array($resultado);

	$novoNome2 = $dados['nm_img'];
	$c1 = $dados['cod_img'];

}
else{
	$novoNome2 = "addImg.jpg";
}

// Img 2

$sql = "select i.nm_img, i.cod_img from tbl_evento as e inner join tbl_img as i on i.cod_evento = e.cod_evento where i.principal = 'n' and i.secundaria = '2' and e.cod_evento = $cod_evento";

$resultado = mysqli_query($connect,$sql);
echo mysqli_error($connect);
if (mysqli_num_rows($resultado)>0) {

	$dados = mysqli_fetch_array($resultado);

	$novoNome3 = $dados['nm_img'];
	$c2 = $dados['cod_img'];

}
else{
	$novoNome3 = "addImg.jpg";
}


// Img 3


$sql = "select i.nm_img, i.cod_img from tbl_evento as e inner join tbl_img as i on i.cod_evento = e.cod_evento where i.principal = 'n' and i.secundaria = '3' and e.cod_evento = $cod_evento";

$resultado = mysqli_query($connect,$sql);
echo mysqli_error($connect);
if (mysqli_num_rows($resultado)>0) {

	$dados = mysqli_fetch_array($resultado);

	$novoNome4 = $dados['nm_img'];
	$c3 = $dados['cod_img'];

}
else{
	$novoNome4 = "addImg.jpg";
}

// --------------------------- Movendo ---------------------------



// Pegando a extensão do arquivo

if ($altPrincipal == 's') {
	$extensaoPrincipal = pathinfo($_FILES['fileUploadPrincipal']['name'],PATHINFO_EXTENSION);

	if ($extensaoPrincipal != "") {
		if(!in_array($extensaoPrincipal, $formatosPermitidos)){
			$_SESSION['msg'] = "Erro ao Cadastrar! Uma das imagens possui formato inválido";
				// Destino

			header('Location: ../cadastroEvento.php');
		}
		else{
			  // Destino
			$pasta = "../img/imgUsuario/";
    		  // Pega o nome do arquiivo
			$temporario = $_FILES['fileUploadPrincipal']['tmp_name'];
   			   // Gera um nome novo pra ele
			$novoNome1 = uniqid().".$extensaoPrincipal";

			if(!move_uploaded_file($temporario, $pasta.$novoNome1)){
				$_SESSION['msg'] = "Erro ao Cadastrar! Verifique as imagens enviadas";
				header('Location: ../cadastroEvento.php');
			}
		}
	}
	else{
		$novoNome1 = "EvSemImg.png";
	}
}


if ($altSec1 == 's') {
	$extensao1 = pathinfo($_FILES['fileUpload1']['name'],PATHINFO_EXTENSION);

	if ($extensao1 != "") {
		if(!in_array($extensao1, $formatosPermitidos)){ 
			$_SESSION['msg'] = "Erro ao Cadastrar! Uma das imagens possui formato inválido";

			header('Location: ../cadastroEvento.php');
		}
		else{
			  // Destino
			$pasta = "../img/imgUsuario/";
    		  // Pega o nome do arquiivo
			$temporario = $_FILES['fileUpload1']['tmp_name'];
      		// Gera um nome novo pra ele
			$novoNome2 = uniqid().".$extensao1";

			if(!move_uploaded_file($temporario, $pasta.$novoNome2)){
				$_SESSION['msg'] = "Erro ao Cadastrar! Verifique as imagens enviadas";
				header('Location: ../cadastroEvento.php');
			}
		}
	}
	else{
		$novoNome2 = "addImg.jpg";
	}
}

if ($altSec2 == 's') {
	$extensao2 = pathinfo($_FILES['fileUpload2']['name'],PATHINFO_EXTENSION);

	if ($extensao2 != "") {
		if(!in_array($extensao2, $formatosPermitidos)){
			$_SESSION['msg'] = "Erro ao Cadastrar! Uma das imagens possui formato inválido";
			$erro = true;
			header('Location: ../cadastroEvento.php');
		}
		else{
			  // Destino
			$pasta = "../img/imgUsuario/";
   			   // Pega o nome do arquiivo
			$temporario = $_FILES['fileUpload2']['tmp_name'];
     		 // Gera um nome novo pra ele
			$novoNome3 = uniqid().".$extensao2";

			if(!move_uploaded_file($temporario, $pasta.$novoNome3)){
				$_SESSION['msg'] = "Erro ao Cadastrar! Verifique as imagens enviadas";
				header('Location: ../cadastroEvento.php');
			}
		}
	}
	else{
		$novoNome3 = "addImg.jpg";
	}
}

if ($altSec3 == 's') {
	$extensao3 = pathinfo($_FILES['fileUpload3']['name'],PATHINFO_EXTENSION);

	if ($extensao3 != "") {
		if(!in_array($extensao3, $formatosPermitidos)){
			$_SESSION['msg'] = "Erro ao Cadastrar! Uma das imagens possui formato inválido";
			header('Location: ../cadastroEvento.php');
		}
		else{
			  // Destino
			$pasta = "../img/imgUsuario/";
     		 // Pega o nome do arquiivo
			$temporario = $_FILES['fileUpload3']['tmp_name'];
     		 // Gera um nome novo pra ele
			$novoNome4 = uniqid().".$extensao3";

			if(!move_uploaded_file($temporario, $pasta.$novoNome4)){
				$_SESSION['msg'] = "Erro ao Cadastrar! Verifique as imagens enviadas";
				header('Location: ../cadastroEvento.php');
			}
		}
	}
	else{
		$novoNome4 = "addImg.jpg";
	}
}

// --------------------------------------- Já enviou a imagem -----------------------------------------------

	// Clear

function clear($input){
	global $connect;
	// Sql
	$var = mysqli_escape_string($connect,$input);

	// XSS

	$var = htmlspecialchars($var);

	return $var;
}



if (isset($_POST['btAlterar'])) {

	$nome = clear($_POST['txtNome']);
	$telefone = clear($_POST['txtTelefone']);
	$dt_inicio = clear($_POST['txtDtInicio']);
	$dt_fim = clear($_POST['txtDtFim']);
	$hr_inicio = clear($_POST['txtHrInicio']);
	$hr_fim = clear($_POST['txtHrFim']);
	$categoria = clear($_POST['cbCategoria']);
	$valor = clear($_POST['txtValor']);
	$bairro = clear($_POST['txtBairro']);
	$cidade = clear($_POST['txtCidade']);
	$numero = clear($_POST['txtNumero']);
	$rua = clear($_POST['txtRua']);
	$descricao = clear($_POST['txtDescricao']);
	$adicionais = clear($_POST['txtAdicional']);
	$cod_evento = clear($_POST['txtCodEvento']);
	$cod_usuario = $_SESSION['id'];
	$dt_cadastro = date('Y-m-d H:i:s');

	$sql = "update tbl_evento set `cod_categoria` = '$categoria', `nm_evento` = '$nome', `telefone`= '$telefone', `dt_inicio` = '$dt_inicio', `dt_fim` = '$dt_fim', `hr_inicio` = '$hr_inicio', `hr_fim` = '$hr_fim', `valor` = '$valor', `bairro` = '$bairro', `cidade` = '$cidade', `numero` = '$numero', `rua` = '$rua', `descricao` = '$descricao',adicionais = '$adicionais',`reprovado` = 'n',`vizualizado` = 'n', situacao = 'a' where cod_evento = '$cod_evento'";

	if (mysqli_query($connect,$sql)) {
		$_SESSION['msg'] = "Alterado com sucesso!";
	}
	else{
		$_SESSION['msg'] = "Deu erro : ".mysqli_error($connect);
		header('Location: ../cadastroEvento.php?id=$cod_evento');
	}


// --------------------------------------------ALterou o evento -----------------------------------------


	if ($novoNome1 != "") {

		$sql = "update `tbl_img` set nm_img = '$novoNome1' where cod_img = '$cp'";


		if (mysqli_query($connect,$sql)) {
			$_SESSION['msg'] = "Cadastrado com sucesso!";
		}
		else{
			$_SESSION['msg'] = "Deu erro : ".mysqli_error($connect);
			header('Location: ../cadastroEvento.php?id=$cod_evento');
		}
	}


	if ($novoNome2 != "") {

		$sql = "update `tbl_img` set nm_img = '$novoNome2' where cod_img = '$c1'";


		if (mysqli_query($connect,$sql)) {
			$_SESSION['msg'] = "Alterado com sucesso!";
		}
		else{
			$_SESSION['msg'] = "Deu erro : ".mysqli_error($connect);
			header('Location: ../cadastroEvento.php');
		}
	}

	if ($novoNome3 != "") {

		$sql = "update `tbl_img` set nm_img = '$novoNome3' where cod_img = '$c2'";


		if (mysqli_query($connect,$sql)) {
			$_SESSION['msg'] = "Alterado com sucesso!";
			header('Location: ../'.$_SESSION['pagina']);
		}
		else{
			$_SESSION['msg'] = "Deu erro : ".mysqli_error($connect);
			header('Location: ../cadastroEvento.php');
		}
	}

	if ($novoNome4 != "") {

		$sql = "update `tbl_img` set nm_img = '$novoNome4' where cod_img = '$c3'";

		if (mysqli_query($connect,$sql)) {
			$_SESSION['msg'] = "Alterado com sucesso!";
			header('Location: ../'.$_SESSION['pagina']);
		}
		else{
			$_SESSION['msg'] = "Deu erro : ".mysqli_error($connect);
			header('Location: ../cadastroEvento.php');
		}
	}



	
}




?>