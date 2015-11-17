<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsuarioDao
 *
 * @author strudel
 */
class UsuarioDao {
    public static function getEstado($log, $sen) {
        $con = Connection::getConnection();
        $r = mysqli_query($con, "Select login, senha from antifurto_usuario where login = '$log' && senha = '$sen'");
        $array = mysqli_fetch_array($r);
        
        if(empty($array)){
            return false;
        }else{
            return true;
        }
        
    }
}
