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

if (isset($_GET['id'])) {

	$Cod = clear($_GET['id']);

	$sql = "update tbl_usuario set situacao = 'i'  where cod_usuario = $Cod";

	if (mysqli_query($connect,$sql)) {
		mysqli_close($connect);
		$_SESSION['msg'] = "Usuario alterado com sucesso!";
		header('Location: ../adm/admPerfil.php?id='.$Cod);
	}
	else{
		$_SESSION['msg'] = "Erro ao alterar";
		header('Location: ../adm/admPerfil.php?id='.$Cod);
	}
}

?>