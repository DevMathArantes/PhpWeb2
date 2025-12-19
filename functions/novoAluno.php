<?php

    require_once __DIR__ . '/../vendor/autoload.php';

    use MD\Estudante;

    //Facilita a introdução de registros na tabela
    function novoAluno(string $nome, \DateTimeImmutable $data_nascimento, PDO $pdo): void{
        
        $novoEstudante = new Estudante(null, $nome, $data_nascimento);

        $sql = "INSERT INTO estudantes (
                nome, 
                data_nascimento
            ) VALUES (
                :nome, 
                :data_nascimento
            )";

        //Utilizando o prepare statement para evitar SQL injection
        $statement = $pdo->prepare($sql);

        //Caso precise alterar o valor do registro após o sql, utilize bindParam em vez de bindValue
        $statement->bindValue(':nome', $novoEstudante->getNome());
        $statement->bindValue(':data_nascimento', $novoEstudante->getData_nascimento()->format(format:'Y-m-d'));
        
        //Verificando se o comando execute() foi bem sucedido
        if($statement->execute()){
            echo "Sucessso ao inserir o estudante {$nome} (nascimento: {$data_nascimento->format('d/m/Y')})" . PHP_EOL;
        }else{
            echo "Erro ao inserir o estudante: {$nome} (nascimento: {$data_nascimento->format('d/m/Y')})" . PHP_EOL;
        };

    }