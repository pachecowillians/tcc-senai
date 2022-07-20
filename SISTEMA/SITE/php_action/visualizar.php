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

	$id = clear($_GET['id']);

	$sql = "UPDATE tbl_evento set vizualizado = 's' where cod_evento = ".$id;

	if (mysqli_query($connect,$sql)) {
		mysqli_close($connect);
		$_GET['msg'] = "Evento atulizado com sucesso com sucesso!";
		header('Location: ../adm/index.php');
	}
	else{
		$_GET['msg'] = "Erro ao cadastrar";
		header('Location: ../adm/index.php');
	}
}

?>