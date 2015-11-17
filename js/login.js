(function(){

	$(document).ready(function(){

		$("#form-login").submit(function(){

			event.preventDefault();

			var campos = $(this).serialize();

			console.log(campos);

			$.ajax({
				url: "php/login.php",
				type: "POST",
				data: campos,
				dataType: "html",
				success: function(){
					location.href = "sistema.php";
				},
				error: function(xhr){
					if(xhr.status == 403){
						alert("Login ou senha incorretos.")
					} else{
						alert("Erro: " + xhr.status)
					}
				}
			});


		});

	});

})();