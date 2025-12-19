<?php

    require_once __DIR__ . "/../functions/apagarAluno.php";
    require_once __DIR__ . "/../vendor/autoload.php";

    use MD\Conexao;

    $pdo = Conexao::criarConexao();

    //Excluindo aluno de id específico
    apagarAluno(1, $pdo);

    //Excluindo os registros
    $pdo->exec('DELETE FROM estudantes;');
    echo "\nRegistros da tabela estudante excluídos.";

    //Criar a tabela estudantes 
    $pdo->exec('DROP TABLE estudantes;');
    echo "\nTabela estudantes foi excluida.";
