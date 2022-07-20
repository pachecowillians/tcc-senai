<?php  

session_start();

unset($_SESSION['msg']); 
$erro = false;
if(isset($_POST['btFinalizar'])){
	

	$formatosPermitidos = array("png","jpeg","jpg","PNG","JPG","JPEG");

      // Pegando a extensão do arquivo
	$extensaoPrincipal = pathinfo($_FILES['fileUploadPrincipal']['name'],PATHINFO_EXTENSION);
	$extensao1 = pathinfo($_FILES['fileUpload1']['name'],PATHINFO_EXTENSION);
	$extensao2 = pathinfo($_FILES['fileUpload2']['name'],PATHINFO_EXTENSION);
	$extensao3 = pathinfo($_FILES['fileUpload3']['name'],PATHINFO_EXTENSION);

	if ($extensaoPrincipal != "") {
		if(!in_array($extensaoPrincipal, $formatosPermitidos)){
			$_SESSION['msg'] = "Erro ao Cadastrar! Uma das imagens possui formato inválido";
			$erro = true;
			header('Location: ../cadastroEvento.php');
		}
	}

	if ($extensao1 != "") {
		if(!in_array($extensao1, $formatosPermitidos)){ 
			$_SESSION['msg'] = "Erro ao Cadastrar! Uma das imagens possui formato inválido";
			$erro = true;
			header('Location: ../cadastroEvento.php');
		}
	}

	if ($extensao2 != "") {
		if(!in_array($extensao2, $formatosPermitidos)){
			$_SESSION['msg'] = "Erro ao Cadastrar! Uma das imagens possui formato inválido";
			$erro = true;
			header('Location: ../cadastroEvento.php');
		}
	}

	if ($extensao3 != "") {
		if(!in_array($extensao3, $formatosPermitidos)){
			$_SESSION['msg'] = "Erro ao Cadastrar! Uma das imagens possui formato inválido";
			$erro = true;
			header('Location: ../cadastroEvento.php');
		}
	}

	if ($extensaoPrincipal != "" && $erro != true) {
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
	else if ($extensaoPrincipal == "" && $erro != true) {
		// Destino
		$pasta = "../img/imgUsuario/";

		$novoNome1 = "EvSemImg.png";
	}

	if ($extensao1 != "" && $erro != true) {
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
	else if ($extensao1 == "" && $erro != true) {
		// Destino
		$pasta = "../img/imgUsuario/";

		$novoNome2 = "addImg.jpg";
	}

	if ($extensao2 != "" && $erro != true) {
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
	else if ($extensao2 == "" && $erro != true) {
		// Destino
		$pasta = "../img/imgUsuario/";

		$novoNome3 = "addImg.jpg";
	}

	if ($extensao3 != "" && $erro != true) {
      // Destino
		$pasta = "../img/imgUsuario/";
      // Pega o nome do arquiivo
		$temporario = $_FILES['fileUpload3']['tmp_name'];
      // Gera um nome novo pra ele
		$novoNome4 = uniqid().".$extensao4";

		if(!move_uploaded_file($temporario, $pasta.$novoNome4)){
			$_SESSION['msg'] = "Erro ao Cadastrar! Verifique as imagens enviadas";
			header('Location: ../cadastroEvento.php');
		}
	}
	else if ($extensao3 == "" && $erro != true) {
		// Destino
		$pasta = "../img/imgUsuario/";

		$novoNome4 = "addImg.jpg";
	}





	require_once 'db_connect.php';


	// Clear

	function clear($input){
		global $connect;
	// Sql
		$var = mysqli_escape_string($connect,$input);

	// XSS

		$var = htmlspecialchars($var);

		return $var;
	}

	if ($erro != true) {

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
		$cod_usuario = $_SESSION['id'];
		$dt_cadastro = date('Y-m-d H:i:s');


		$sql = "INSERT INTO `tbl_evento` (`cod_categoria`, `cod_usuario`, `nm_evento`, `telefone`, `dt_inicio`, `dt_fim`, `hr_inicio`, `hr_fim`, `dt_cadastro`, `valor`, `bairro`, `cidade`, `numero`, `rua`, `descricao`,adicionais, `situacao`, `prioridade`,`reprovado`,`vizualizado`) VALUES ('$categoria', '$cod_usuario', '$nome', '$telefone', '$dt_inicio', '$dt_fim', '$hr_inicio', '$hr_fim', '$dt_cadastro', '$valor', '$bairro', '$cidade', '$numero', '$rua', '$descricao','$adicionais', 'a', '0','n','n');";

		if (mysqli_query($connect,$sql)) {
			$cod_evento = mysqli_insert_id($connect);
			$_SESSION['msg'] = "Cadastrado com sucesso!";
		}
		else{
			$_SESSION['msg'] = "Deu erro : ".mysqli_error($connect);
			header('Location: ../cadastroEvento.php');
		}



		if ($novoNome1 != "") {
			$sql = "INSERT INTO `tbl_img` (`cod_evento`, `nm_img`, `principal`,secundaria) VALUES ('$cod_evento', '$novoNome1', 's','n');";

			if (mysqli_query($connect,$sql)) {
				$_SESSION['msg'] = "Cadastrado com sucesso!";
			}
			else{
				$_SESSION['msg'] = "Deu erro : ".mysqli_error($connect);
				header('Location: ../cadastroEvento.php');
			}
		}

		if ($novoNome2 != "") {
			$sql = "INSERT INTO `tbl_img` (`cod_evento`, `nm_img`, `principal`,secundaria) VALUES ('$cod_evento', '$novoNome2', 'n','1');";

			if (mysqli_query($connect,$sql)) {
				$_SESSION['msg'] = "Cadastrado com sucesso!";
			}
			else{
				$_SESSION['msg'] = "Deu erro : ".mysqli_error($connect);
				header('Location: ../cadastroEvento.php');
			}
		}

		if ($novoNome3 != "") {
			$sql = "INSERT INTO `tbl_img` (`cod_evento`, `nm_img`, `principal`,secundaria) VALUES ('$cod_evento', '$novoNome3', 'n','2');";

			if (mysqli_query($connect,$sql)) {
				$_SESSION['msg'] = "Cadastrado com sucesso!";
			}
			else{
				$_SESSION['msg'] = "Deu erro : ".mysqli_error($connect);
				header('Location: ../cadastroEvento.php');
			}
		}

		if ($novoNome4 != "") {
			$sql = "INSERT INTO `tbl_img` (`cod_evento`, `nm_img`, `principal`,secundaria) VALUES ('$cod_evento', '$novoNome4', 'n','3');";

			if (mysqli_query($connect,$sql)) {
				$_SESSION['msg'] = "Cadastrado com sucesso!";
			}
			else{
				$_SESSION['msg'] = "Deu erro : ".mysqli_error($connect);
				header('Location: ../cadastroEvento.php');
			}
		}

		header('Location: ../meusEventos.php');
	}

}
else{
	header('Location: ../cadastroEvento.php');
}
?>