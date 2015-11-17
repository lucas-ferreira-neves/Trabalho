<?php

  session_start();

  $login_post = $_POST["login"];
  $senha_post = $_POST["senha"];

  $link = mysqli_connect("150.164.102.160", "daw-aluno11", "danilo", "daw-aluno11");

  if (!$link) {
      echo "Não foi possível conectar ao banco de dados: " . mysqli_error();
      http_response_code(403);
      exit;
  }

  $sql = "SELECT antifurto_usuario.login, antifurto_usuario.senha
          FROM   antifurto_usuario
          WHERE  antifurto_usuario.login = \"".$login_post."\";";

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

  if(strcmp($login, $login_post) == 0 && strcmp($senha, $senha_post) == 0){
    // Login efetuado
    $_SESSION["login"] = $login;
    http_response_code(200);
  } else{
    // Senha incorreta
    http_response_code(403);
  }

  mysqli_free_result($result);

  mysqli_close($link);

?>
