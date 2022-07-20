<?php  

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

session_start();

if (isset($_POST['btAlterar'])) {

	$nome = clear($_POST['txtNome']);
	$email = clear($_POST['txtEmail']);
	$cpf = clear($_POST['cpf']);
	$senha = clear($_POST['txtSenha']);
	$cod = clear($_POST['txtCodigo']);

	$sql = "SELECT * FROM `tbl_usuario` WHERE cpf = '$cpf'";

	$senha = md5($senha);
	
	$sql = "update tbl_usuario set nm_usuario = '$nome', email = '$email',cpf ='$cpf',senha = '$senha' where cod_usuario = '$cod'";

	if (mysqli_query($connect,$sql)) {
		mysqli_close($connect);
		header("Location: ../perfil.php?id=$cod");
		$_SESSION['msg'] = "Alterado com sucesso!";
	}
	else{
		$_SESSION['msg'] = "Erro ao Alterar";
		header("Location: ../cadastroUsuario.php?id=$cod");
	}

}

?>