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

	$sql = "update tbl_evento set reprovado = 's', situacao = 'i' where cod_evento = $Cod";

	if (mysqli_query($connect,$sql)) {
		mysqli_close($connect);
		$_SESSION['msg'] = "Evento reprovado com sucesso!";
		header('Location: ../adm/index.php');
	}
	else{
		$_SESSION['msg'] = "Erro ao reprovar";
		header('Location: ../adm/index.php');
	}

}

?>