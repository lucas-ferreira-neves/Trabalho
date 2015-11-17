<?php

	session_start();

	if(!isset($_SESSION["login"]))
		header("location: login.php");
?>

<!DOCTYPE html>
<html ng-app="antifurto">
	<head>

		<title>L&D Antifurto</title>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

		<script type="text/javascript" src="js/app.js"></script>

		<script type="text/javascript" src="js/sistema.js"></script>

		<meta charset="utf-8"/>

	</head>
	<body>

		<div class="container">
			
			<header>
				<h1 class="text-center">L&D Antifurto</h1>
			</header>

			<div id="perfil" class="col-xs-12 col-md-4" ng-controller="PerfilController as perfilCtrl">
				<h2>Perfil</h2>
				<ul class="list-group">
					<li class="list-group-item">Login: {{perfilCtrl.perfil.login}}</li>
					<li class="list-group-item">Nome: {{perfilCtrl.perfil.nome}}</li>
					<li class="list-group-item">Email: {{perfilCtrl.perfil.email}}</li>
					<li class="list-group-item">Telefone: {{perfilCtrl.perfil.telefone}}</li>
					<li class="list-group-item">Endereço: {{perfilCtrl.perfil.endereco}}</li>
					<li class="list-group-item">Cidade/Estado: {{perfilCtrl.perfil.cidade}} - {{perfilCtrl.perfil.estado}}</li>
				</ul>
				<button id="bt-sair" class="btn btn-danger">Sair</button>
			</div>

			<div id="carros" class="col-xs-12 col-md-8" ng-controller="CarroController as carroCtrl">
				<h2>Seus Carros</h2>

				<table class="table table-hover">
					<thead>
						<tr>
							<th>Modelo</th>
							<th>Placa</th>
							<th>Cor</th>
							<th>Chave</th>
							<th>Ação</th>
						</tr>
					</thead>

					<tbody>
						<tr ng-class="{danger: carro.blockCarro || carro.blockUsuario}" ng-repeat="carro in carroCtrl.carros">
							<td>{{carro.modelo}}</td>
							<td>{{carro.placa}}</td>
							<td>{{carro.cor}}</td>
							<td>
								<span ng-show="carro.statusChave">Ligado</span>
								<span ng-hide="carro.statusChave">Desligado</span>
							</td>
							<td>
								<button ng-click="carroCtrl.acao('bloquear', carro.placa)" ng-hide="carro.blockCarro || carro.blockUsuario" class="btn btn-danger">Bloquear</button>
								<button ng-click="carroCtrl.acao('desbloquear', carro.placa)" ng-show="carro.blockCarro || carro.blockUsuario" class="btn btn-success">Desbloquear</button>
							</td>
						</tr>
					</tbody>
				</table>
                                
                                <pre>{{carroCtrl.carros | json}}</pre>

			</div>

		</div>		

	</body>
</html>