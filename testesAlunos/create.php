<?php

    require_once __DIR__ . "/../vendor/autoload.php";

    use MD\Conexao;

    $pdo = Conexao::criarConexao();

    //Criar a tabela estudantes caso ela ainda não exista
    $pdo->exec('CREATE TABLE IF NOT EXISTS estudantes (
        id INTEGER PRIMARY KEY, 
        nome TEXT, 
        data_nascimento TEXT
    );');

    echo "\nTabela estudantes criada com sucesso.";

    //Criando a tabela telefones com chave secundária apontando para o id dos alunos
    $pdo->exec('CREATE TABLE IF NOT EXISTS telefones (
        id INTEGER PRIMARY KEY, 
        ddd TEXT, 
        numero TEXT,
        id_estudante INTEGER,
        FOREIGN KEY (id) REFERENCES estudantes (id)
    );');

    echo "\nTabela telefones criada com sucesso.";