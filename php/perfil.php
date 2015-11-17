<?php

	session_start();

	$login = $_SESSION["login"];

	$link = mysqli_connect("150.164.102.160", "daw-aluno11", "danilo", "daw-aluno11");

	if (!$link) {
	    echo "Não foi possível conectar ao banco de dados: " . mysqli_error();
	    http_response_code(403);
	    exit;
	}

	$sql = "SELECT antifurto_usuario.nome, antifurto_usuario.email, antifurto_usuario.telefone, antifurto_usuario.endereco, antifurto_usuario.cidade, antifurto_usuario.estado
	        FROM   antifurto_usuario
	        WHERE  antifurto_usuario.login = \"".$login."\";";

	$result = mysqli_query($link, $sql);

	if (!$result) {
	    echo "Não foi possível executar a consulta ($sql) no banco de dados: " . mysqli_error();
	    http_response_code(403);
	    exit;
	}

	if (mysqli_num_rows($result) == 0) {
	    echo "Não foram encontradas linhas, nada para mostrar, assim eu estou saindo";
	    http_response_code(403);
	    exit;
	}

	$row = mysqli_fetch_assoc($result);

	extract($row);

	$json = array(
				"login" => $login,
				"nome" => $nome,
				"email" => $email,
				"endereco" => $endereco,
				"cidade" => $cidade,
				"estado" => $estado,
				"telefone" => $telefone
			);

	echo json_encode($json);

	http_response_code(200);

	mysqli_free_result($result);

	mysqli_close($link);

?>