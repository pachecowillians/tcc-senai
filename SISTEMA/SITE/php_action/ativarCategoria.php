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

	$sql = "update tbl_categoria set situacao = 'a'  where cod_categoria = $Cod";

	if (mysqli_query($connect,$sql)) {
		mysqli_close($connect);
		$_SESSION['msg'] = "Categoria alterada com sucesso!";
		header('Location: ../adm/admCategoria.php');
	}
	else{
		$_SESSION['msg'] = "Erro ao alterar";
		header('Location: ../adm/admCategoria.php');
	}
}

?>