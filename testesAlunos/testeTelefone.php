<?php

    require_once __DIR__ . "/../vendor/autoload.php";

    use MD\Conexao;
    use MD\EstudantePDO;
    use MD\Estudante;
    use MD\Telefone;

    $pdo = Conexao::criarConexao();
    $estudantePdo = new EstudantePDO($pdo);

    $alunosComTelefone = $estudantePdo->alunosComTelefone();

    foreach($alunosComTelefone as $aluno){

        echo "\n\nAluno: " . $aluno->getNome() . " Telefones: \n";

        $telefones = $aluno->verTelefones();

        foreach($telefones as $telefone){

            echo "\n" . $telefone->formatTelefone();

        }

    }