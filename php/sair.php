<?php

	session_start();

	unset($_SESSIOM["login"]);

	session_destroy();

	http_response_code(200);

?>