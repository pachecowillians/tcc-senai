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

if (isset($_POST['btCadastrar'])) {

	$nome = clear($_POST['txtNome']);
	$email = clear($_POST['txtEmail']);
	$cpf = clear($_POST['cpf']);
	$senha = clear($_POST['txtSenha']);

	$sql = "SELECT * FROM `tbl_usuario` WHERE cpf = '$cpf'";

	$resultado = mysqli_query($connect,$sql);
	echo mysqli_error($connect);
	if (mysqli_num_rows($resultado)>0) {
		$_SESSION['msg'] = "O cpf inserido já está em uso";
		header('Location: ../cadastroUsuario.php');
	}
	else{

		$sql = "SELECT * FROM `tbl_usuario` WHERE email = '$email'";

		$resultado = mysqli_query($connect,$sql);
		echo mysqli_error($connect);
		if (mysqli_num_rows($resultado)>0) {
			$_SESSION['msg'] = "O email inserido já está em uso";
			header('Location: ../cadastroUsuario.php');
		}
		else{
			$senha = md5($senha);

			$sql = "insert into tbl_usuario(nm_usuario,email,cpf,senha,cargo,situacao) values ('$nome','$email','$cpf','$senha','u','a')";

			if (mysqli_query($connect,$sql)) {
				mysqli_close($connect);
				header('Location: ../login.php');
				$_SESSION['msg'] = "Cadastrado com sucesso!";
			}
			else{
				$_SESSION['msg'] = "Erro ao cadastrar";
				header('Location: ../cadastroUsuario.php');
			}
		}	
	}

	
}

?>