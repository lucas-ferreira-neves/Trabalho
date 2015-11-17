<?php

	$conexao = mysqli_connect("150.164.102.160", "daw-aluno11", "danilo", "daw-aluno11");

	if(!$conexao){
		http_response_code(403);
	}

	$req = json_decode(@file_get_contents('php://input'), true);

	$acao = $req["acao"];
	$placa = $req["placa"];

	if(strcmp($acao, "bloquear") == 0) {

		$sql = "UPDATE antifurto_carro
				SET blockUsuario=1
				WHERE placa = \"".$placa."\";";

		echo $sql;

		$r = mysqli_query($conexao, $sql);

		if(!$r) {
			http_response_code(403);
		} else{
			http_response_code(200);
		}

	} else if(strcmp($acao, "desbloquear") == 0) {

		$sql = "UPDATE antifurto_carro
				SET blockUsuario=0, blockCarro=0
				WHERE placa = \"".$placa."\";";

		echo $sql;

		$r = mysqli_query($conexao, $sql);

		if(!$r) {
			http_response_code(403);
		} else{
			http_response_code(200);
		}

	} else{
		http_response_code(403);
	}

?>