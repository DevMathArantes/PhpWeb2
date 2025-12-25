<?php

    require_once __DIR__ . "/../vendor/autoload.php";

    use MD\Conexao;
    use MD\Estudante;
    use MD\EstudantePDO;

    $conexao = Conexao::criarConexao();
    $pdo = new EstudantePDO($conexao);
    
    //Teste de transações (rollBack cancela e commit finaliza)
    
    $conexao->beginTransaction();

    try{

        $primeiro = new Estudante(null, "Testes de transação 1", new \DateTimeImmutable("2003-11-14"));   
        $pdo->salvarAluno($primeiro);
        

        $segundo = new Estudante(null, "Testes de transação 2", new \DateTimeImmutable("2003-11-14")); 
        $pdo->salvarAluno($segundo);

        $conexao->commit();
        
    } catch(\PDOException $erro){

        echo $erro->getMessage();
        $conexao->rollBack();

    }

    