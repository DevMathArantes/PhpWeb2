<?php 

    require_once __DIR__ . "/../vendor/autoload.php";
    require_once __DIR__ . "/../functions/novoAluno.php";

    use MD\Estudante;
    use MD\EstudantePDO;
    use MD\Conexao;

    //Criando a tabela de testes

    $banco = __DIR__ . "/../banco.sqlite";
    $pdo = new PDO('sqlite:' . $banco);

    $pdoAluno = new EstudantePDO($pdo);

    $pdo->exec('CREATE TABLE estudantes (
        id INTEGER PRIMARY KEY, 
        nome TEXT, 
        data_nascimento TEXT
    );');

    echo "\nTabela estudantes criada com sucesso.";

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

    echo "\n__________Testes do EstudantePDO__________\n";

    //Salvando novo aluno
    echo "\nNovo aluno\n";
    
    $novoAluno = new Estudante(null, "Novo Aluno", new \DateTimeImmutable("1540-11-14"), $pdo);
    echo "\nId: " . $novoAluno->getId() . 
        ", Nome: " . $novoAluno->getNome() . 
        ", Nascimento: " . $novoAluno->getData_nascimento()->format('Y-m-d');
    
    $pdoAluno->salvarAluno($novoAluno);

    //Removendo um aluno
    echo "\n\nRemovendo o Id: 1";
    $pdoAluno->removerAluno(1);

    //Atualizando aluno
    echo "\n\nAtualizando novo aluno: \n";

    $novoAluno = new Estudante(12, "Mesmo Aluno", new \DateTimeImmutable("1540-11-14"), $pdo);
    echo "\nId: " . $novoAluno->getId() . 
        ", Nome: " . $novoAluno->getNome() . 
        ", Nascimento: " . $novoAluno->getData_nascimento()->format('Y-m-d');

    $pdoAluno->salvarAluno($novoAluno);

    //Listando alunos
    $alunos = $pdoAluno->listarAlunos();

    echo "\n\nLista Geral: \n";
    foreach($alunos as $aluno){

        echo "\nId: " . $aluno->getId() . 
        ", Nome: " . $aluno->getNome() . 
        ", Nascimento: " . $aluno->getData_nascimento()->format('Y-m-d');

    }

    //Listando aniversariantes
    $aniversariantes = $pdoAluno->aniversariantes(new \DateTimeImmutable("2003-11-14"));
    
    echo "\n\nAniversariantes: \n";
    foreach($aniversariantes as $aniversariante){

        echo "\nId: " . $aniversariante->getId() . 
        ", Nome: " . $aniversariante->getNome() . 
        ", Nascimento: " . $aniversariante->getData_nascimento()->format('Y-m-d');

    }

    $pdo->exec('DROP TABLE estudantes;');
    echo "\n\nTabela estudantes excluída com sucesso";