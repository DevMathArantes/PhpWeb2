<?php

    require_once __DIR__ . "/../vendor/autoload.php";

    use MD\Conexao;

    $pdo = Conexao::criarConexao();

    //Criar a tabela estudantes 
    $pdo->exec('CREATE TABLE estudantes (
        id INTEGER PRIMARY KEY, 
        nome TEXT, 
        data_nascimento TEXT
    );');

    echo "\nTabela estudantes criada com sucesso.";