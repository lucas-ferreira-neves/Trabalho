<?php

//	session_start();
//
//	if(!isset($_SESSION["login"]))
//		header("location: login.php");


    require 'Slim/Slim.php';
    \Slim\Slim::registerAutoloader();

    $app = new \Slim\Slim();
    
    $app->post('/verificaUser', function() {
        $request = \Slim\Slim::getInstance()->request();

        $the_body = $request->getBody();


        $user = json_decode($the_body);
        $ar = new stdClass();
        $ar->resposta = false;
        if(UsuarioDao::getEstado($user->login, $user->senha)){
           
        $ar->resposta = true;
        
        $_SESSION["login"] = $user->login;
        $_SESSION["senha"] = $user->senha;
        
        }
        else{
            
        $ar->resposta = false;
        }
        
        echo json_encode($ar);
    });
    
    
    $app->get('/getEstado/:placa', function($placa){
        session_start();

	if(!isset($_SESSION["login"])){
//		header("location: login.php");
            echo "Voce nao tem permissao para fazer esse tipo de requisicao";
        }
        else{
            $usuario = $_SESSION["login"];
            
            if(!CarroDao::usuarioHasCarro($usuario, $placa)){
                echo "Esse usuario nao pode requisitar dados desse carro";
            }
            else{
                if(CarroDao::getEstado($placa)){
                    echo "Bloqueado";

                }else{
                    echo "Desbloqueado";
                }
            }
        }
    });
    
    $app->post('/setEstado', function() {
        session_start();
        if(!isset($_SESSION["login"])){
//		header("location: login.php");
            echo "Voce nao tem permissao para fazer esse tipo de requisicao";
        }
        else{
            $request = \Slim\Slim::getInstance()->request();

            $the_body = $request->getBody();

            $carro = json_decode($the_body);

            $ar = array();
            ////////////////////////////////////////////
            $usuario = $_SESSION["login"];
            
            if(!CarroDao::usuarioHasCarro($usuario, $carro->placa)){
                echo "Esse usuario nao pode requisitar dados desse carro";
            }
            else{
                if(CarroDao::setEstado($carro))
                    $ar["resposta"] = true;
                else
                    $ar["resposta"] = false;

                echo json_encode($ar);
            }
        }
    });
    
    
    $app->get('/statusChave/:placa', function($placa){
        session_start();
        if(!isset($_SESSION["login"])){
//		header("location: login.php");
            echo "Voce nao tem permissao para fazer esse tipo de requisicao";
        }
        else{
            $usuario = $_SESSION["login"];
            
            if(!CarroDao::usuarioHasCarro($usuario, $placa)){
                echo "Esse usuario nao pode requisitar dados desse carro";
            }
            else{
                $resp["status"] = 0;

                if(CarroDao::getSituacao($placa)){
                    $resp["status"] = 1;
                    echo json_encode($resp);
                }else{
                    $resp["status"] = 0;
                    echo json_encode($resp);
                }
            }
        }
    });
    
    $app->post('/setStatus/', function(){ //// Será usado somente pelo arduino
        session_start();
        if(!isset($_SESSION["login"])){
//		header("location: login.php");
            echo "Voce nao tem permissao para fazer esse tipo de requisicao";
        }
        else{
            $request = \Slim\Slim::getInstance()->request();
            $the_body = $request->getBody();
            $carro = json_decode($the_body);
            ///////////////////////////////////
            $usuario = $_SESSION["login"];
            
            if(!CarroDao::usuarioHasCarro($usuario, $carro->placa)){
                echo "Esse usuario nao pode requisitar dados desse carro";
            }else{
                CarroDao::setStituacao($carro);
            }
        }
    });
    
    
    
    $app->run();



?>