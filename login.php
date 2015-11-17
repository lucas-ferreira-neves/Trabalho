<?php

	session_start();

	if(isset($_SESSION["login"]))
		header("location: sistema.php");
?>

<!DOCTYPE html>
<html>

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

		<script type="text/javascript" src="js/init.js"></script>
		
                    <script type="text/javascript" src="js/app.js"></script>
                    <script type="text/javascript" src="js/login.js"></script>

	</head>

	<body ng-app="antifurto">

		<header>
			<h1 class="text-center">
				L&D Antifurto
			</h1>
		</header>

            <div class="container col-xs-offset-2 col-xs-8 col-md-offset-4 col-md-4" ng-controller="UserController as controlador">
                    <form id="form-login" ng-submit="controlador.efetuaLogin(user)">
<!--                    <form action="index.php/verificaUser">    -->
				<h2>Autentique-se</h2>
				<p>
					<input class="form-control" name="login" ng-model="user.login" type="text" placeholder="Login" required/>
				</p>
				<p>
					<input class="form-control" name="senha" ng-model="user.senha" type="password" placeholder="Senha" required/>
				</p> 
				<button type="submit" class="btn btn-success">Entrar</button>
			</form>
                {{user}}
		</div>

	</body>

</html>