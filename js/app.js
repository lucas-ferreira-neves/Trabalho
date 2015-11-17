(function () {

    var app = angular.module('antifurto', []);

    app.controller('PerfilController', ['$http', function ($http) {

            var perfil_this = this;
            perfil_this.perfil = {};

            $http.get("php/perfil.php").success(function (data) {
                perfil_this.perfil = data;
            });

        }]);

    app.controller('CarroController', ['$http', function ($http) {

            var carro_this = this;

            carro_this.carros = [];

            $http.get("php/carros.php").success(function (data) {
                for (var i = 0; i < data.length; i++) {
                    data[i].blockCarro = corrige(data[i].blockCarro);
                    data[i].blockUsuario = corrige(data[i].blockUsuario);
                    data[i].statusChave = corrige(data[i].statusChave);
                }
                carro_this.carros = data;
                console.log(data);
            });

            this.acao = function (acao, placa) {

                $http.post('/setEstado', {"acao": acao, "placa": placa}).then(
                    function (data) {
                        if (data.data.resposta == true) {
                            location.reload();
                        } else {
                            alert("Não foi possível fazer a ação \"" + acao + "\" no carro \"" + placa + "\".");
                        }

                    }, function () {
                        alert("erro");
                    }
                );
            };

        }]);

    app.controller('UserController', ['$http', function ($http) {

            this.efetuaLogin = function (user) {
                $http.post("/verificaUser", user).success(function (data) {
//			alert(data.resposta);
                    if (data.resposta == true) {
                        location.href("login.php");
                    } else {
                        alert("Login ou senha incorretos");
                    }

                }, function () {
                    alert("erro");
                });
            };

        }]);

    function corrige(campo) {
        if (campo == "0")
            return false;
        else
            return true;
    }





})();