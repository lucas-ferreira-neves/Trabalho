<?php

class CarroDao {
    public static function getEstado($placa) {
        $con = Connection::getConnection();
        $r = mysqli_query($con, "Select blockUsuario, blockCarro from antifurto_carro where placa = '$placa';");
        
        $linha = mysqli_fetch_array($r);
        
        if($linha['blockUsuario'] == 1 || $linha['blockCarro'] == 1){
            return true;
        }else
            return false;
        
    }
    
    public static function setEstado($carro){
        $con = Connection::getConnection();
        
        $estado = 0;
        
        if(strcmp($carro->acao, "desbloquear") == 0){
            $estado = 0;
            $q = "Update antifurto_carro set blockUsuario = 0, blockCarro = 0 where placa = '$carro->placa';";
        }else{
            $estado = 1;
            $q = "Update antifurto_carro set blockUsuario = 1 where placa = '$carro->placa';";
        }
        
        $r = mysqli_query($con, $q);
        
        return $r;
    }
    
    
    public static function getSituacao($placa){
        $con = Connection::getConnection();
        
        $r = mysqli_query($con, "Select statusChave from antifurto_carro where placa = '$placa';");
        
        $linha = mysqli_fetch_array($r);
        
        return $linha["statusChave"];
    }
    
    
    public static function setStituacao($carro){
        $con = Connection::getConnection();
        
        if(strcmp($carro->status, "ligar") == 0){
            $estado = 1;
            $q = "Update antifurto_carro set statusChave = 1 where placa = '$carro->placa';";
            echo $q;
        }else{
            $estado = 0;
            $q = "Update antifurto_carro set statusChave = 0 where placa = '$carro->placa';";
            echo $q;
        }
        $r = mysqli_query($con, $q);
    }

    
    public static function usuarioHasCarro($usuario, $placa){
        $con = Connection::getConnection();
        $q = "Select * from antifurto_usuario_has_carro where usuario_login = '$usuario' && carro_placa = '$placa'";
        
        $r = mysqli_query($con, $q);
        
        $array = mysqli_fetch_array($r);
        
//        echo $q;
        
        if(empty($array))
            return false;    
        else
            return true;
    }
    
}
