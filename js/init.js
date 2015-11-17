(function(){

	// Confere se há um usuário na sessão

	$.ajax({

		url: "php/init.php",
		method: "GET",
		success: function(){
			
		},
		error: function(){
			location.href="http://webservercoltec.coltec.ufmg.br/~dpcc/antifurto3/login.html";
		}

	});


})();