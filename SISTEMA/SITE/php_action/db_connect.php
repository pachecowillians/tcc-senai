<?php  

	// Informações da conexão

	$serverName = 'localhost';
	$userName = 'root';
	$senha = '';
	$db_name = 'db_radardafesta';

	// Conectar com o banco de dados

	$connect = mysqli_connect($serverName,$userName,$senha,$db_name);

	// Define o padrão de texto do banco para aceitar acentos

	mysqli_set_charset($connect,"utf8");

	// Testa a conexão e apresenta erros

	if (mysqli_connect_error()) {
		echo "Erro na conexão: ".mysqli_connect_error();
	}

?>