<?php

    namespace MD;
    
    use PDO;

    class Conexao {

        public static function criarConexao() : PDO {
            $banco = __DIR__ . '/../banco.sqlite';
            return new PDO('sqlite:' . $banco);
        }

    }