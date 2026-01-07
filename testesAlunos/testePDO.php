<?php 

    require_once __DIR__ . "/../vendor/autoload.php";
    require_once __DIR__ . "/../functions/novoAluno.php";

    use MD\Estudante;
    use MD\EstudantePDO;
    use MD\Conexao;

    //Criando a tabela de testes

    $pdo = Conexao::criarConexao();
    $pdoAluno = new EstudantePDO($pdo);

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
    var_dump($alunos);

    //Listando aniversariantes
    $aniversariantes = $pdoAluno->aniversariantes(new \DateTimeImmutable("2003-11-14"));
    
    echo "\n\nAniversariantes: \n";
    foreach($aniversariantes as $aniversariante){

        echo "\nId: " . $aniversariante->getId() . 
        ", Nome: " . $aniversariante->getNome() . 
        ", Nascimento: " . $aniversariante->getData_nascimento()->format('Y-m-d');

    }