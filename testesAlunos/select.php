<?php

    require_once __DIR__ . "/../functions/novoAluno.php";
    require_once __DIR__ . "/../vendor/autoload.php";

    use MD\Estudante;

    use MD\Conexao;

    $pdo = Conexao::criarConexao();

    //Testando o fetchAll (serve para pequenos volumes de dados)
    echo "\n\n___________________Teste do fetchAll___________________\n\n";
    $registros = $pdo->query('SELECT * FROM estudantes');
    $estudantes = $registros->fetchAll();
    var_dump($estudantes);

    //Tratamento para grandes volumes de dados
    echo "\n\n___________________Teste do fetch (grandes volumes)___________________\n\n";
    $registros = $pdo->query('SELECT * FROM estudantes');
    while ($estudante = $registros->fetch()) {

        $estudanteObj = new Estudante(
            $estudante['id'],
            $estudante['nome'],
            new \DateTimeImmutable($estudante['data_nascimento'])
        );

        echo "\n" . $estudanteObj->getNome() . " - idade: " . $estudanteObj->idade(). PHP_EOL;
    }

    //Chamando uma única linha
    echo "\n\n___________________Teste do fetch (registro único)___________________\n\n";
    $registro = $pdo->query('SELECT * FROM estudantes WHERE id = 1');
    $estudante = $registro->fetch();
    echo "Teste do método fetch: \n Nome: " . 
    $estudante['nome'] . ", Nascimento: " . 
    $estudante['data_nascimento'] . PHP_EOL;

    //Teste de chamada por colunas
    echo "\n\n___________________Teste do fetchColumn___________________\n\n";
    $registro = $pdo->query('SELECT * FROM estudantes WHERE id = 1');
    echo "\nID encontrado: " . $registro->fetchColumn(0) . PHP_EOL;

    
