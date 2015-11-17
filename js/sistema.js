(function(){
	$(document).ready(function(){

		$("#bt-sair").click(function(){

			$.ajax({
				url: "php/sair.php",
				type: "GET",
				success: function(){
					location.href="login.php";
				},
				error: function(xhr){
					alert("Error " + xhr.status)
				}
			});

		});

	});
})();