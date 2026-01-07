<?php

    require_once __DIR__ . "/../vendor/autoload.php";

    use MD\Conexao;

    $pdo = Conexao::criarConexao();

    //Criando tabelas caso ainda não existam
    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS estudantes (
            id INTEGER PRIMARY KEY, 
            nome TEXT, 
            data_nascimento TEXT
        );
        
        CREATE TABLE IF NOT EXISTS telefones (
            id INTEGER PRIMARY KEY, 
            ddd TEXT, 
            numero TEXT,
            id_estudante INTEGER,
            FOREIGN KEY (id_estudante) REFERENCES estudantes (id)
        );

    ');

    echo "\nTabelas criadas com sucesso.";