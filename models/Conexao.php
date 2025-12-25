<?php

    namespace MD;
    
    use PDO;

    class Conexao {

        public static function criarConexao() : PDO {

            $banco = __DIR__ . '/../banco.sqlite';

            $conexao = new PDO('sqlite:' . $banco);

            //PDO::ERRMODE_EXCEPTION: O valor que diz ao PHP para lançar uma exceção (um erro que pode ser 
            // "capturado") sempre que ocorrer um problema.
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //Define o modo como os dados serão retornados (como arrays associativos)
            $conexao->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            return $conexao;
        }

    }