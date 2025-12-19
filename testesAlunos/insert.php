<?php

    require_once __DIR__ . "/../functions/novoAluno.php";
    require_once __DIR__ . "/../vendor/autoload.php";

    use MD\Conexao;

    $pdo = Conexao::criarConexao();

    //Registrar novos alunos na base de dados
    novoAluno("Matheus", new \DateTimeImmutable("2003-11-14"), $pdo);
    novoAluno("Micael", new \DateTimeImmutable("2003-11-11"), $pdo);
    novoAluno("Guilherme", new \DateTimeImmutable("2003-11-12"), $pdo);
    novoAluno("Carlos", new \DateTimeImmutable("2003-11-13"), $pdo);
    novoAluno("Ana", new \DateTimeImmutable("2003-11-14"), $pdo);
    novoAluno("Miguel", new \DateTimeImmutable("2003-11-15"), $pdo);
    novoAluno("Davi", new \DateTimeImmutable("2003-11-16"), $pdo);
    novoAluno("João", new \DateTimeImmutable("2003-11-17"), $pdo);
    novoAluno("José", new \DateTimeImmutable("2003-11-18"), $pdo);
    novoAluno("Maicon", new \DateTimeImmutable("2003-11-19"), $pdo);
    novoAluno("Luna", new \DateTimeImmutable("2003-11-10"), $pdo);

    echo "\nAlunos inseridos com sucesso.";