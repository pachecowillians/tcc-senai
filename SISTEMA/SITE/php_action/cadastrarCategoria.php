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

if (isset($_POST['btCategoria'])) {

	$nome = clear($_POST['txtCategoria']);

	$sql = "insert into tbl_categoria(nm_categoria,situacao) values ('$nome','a')";

	if (mysqli_query($connect,$sql)) {
		mysqli_close($connect);
		$_SESSION['msg'] = "Categoria cadastrada com sucesso!";
		header('Location: ../adm/admCategoria.php');
	}
	else{
		$_SESSION['msg'] = "Erro ao cadastrar";
		header('Location: ../adm/admCategoria.php');
	}
}

?>