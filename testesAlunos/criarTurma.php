<?php

    require_once __DIR__ . "/../vendor/autoload.php";

    use MD\Conexao;
    use MD\Estudante;
    use MD\EstudantePDO;

    $conexao = Conexao::criarConexao();
    $pdo = new EstudantePDO($conexao);
    
    //Teste de transações (rollBack cancela e commit finaliza)
    
    $conexao->beginTransaction();

    $primeiro = new Estudante(
        null,
        "Testes de transação 1",
        new \DateTimeImmutable("2003-11-14")
    );   
    if(!$pdo->salvarAluno($primeiro)){
        $conexao->rollBack();
    }
    

    $segundo = new Estudante(
        null,
        "Testes de transação 2",
        new \DateTimeImmutable("2003-11-14")
    ); 
    if(!$pdo->salvarAluno($segundo)){
        $conexao->rollBack();
    }

    $conexao->commit();


    