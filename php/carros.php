<?php

	session_start();

	$login = $_SESSION["login"];

	$link = mysqli_connect("150.164.102.160", "daw-aluno11", "danilo", "daw-aluno11");

	if (!$link) {
	    echo "Não foi possível conectar ao banco de dados: " . mysqli_error();
	    http_response_code(403);
	    exit;
	}

	$sql = "SELECT c.modelo, c.placa, c.cor, c.blockCarro, c.blockUsuario, c.statusChave
	        FROM   antifurto_carro c
	        JOIN   antifurto_usuario_has_carro uhc on uhc.usuario_login = \"".$login."\";";

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

	$json = array();

	while($row = mysqli_fetch_assoc($result)){

		extract($row);

		$carro = array(
					"modelo" => $modelo,
					"placa" => $placa,
					"cor" => $cor,
					"blockCarro" => $blockCarro,
					"blockUsuario" => $blockUsuario,
					"statusChave" => $statusChave
				);

		array_push($json, $carro);

	}

	echo json_encode($json);

	http_response_code(200);

	mysqli_free_result($result);

	mysqli_close($link);

?>