<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Connection
 *
 * @author strudel
 */
class Connection {
    
    public static function getConnection() {
        return mysqli_connect("alunos.coltec.ufmg.br", "daw-aluno11", "danilo", "daw-aluno11");
    }
    
}
