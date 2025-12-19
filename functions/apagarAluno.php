<?php

    function apagarAluno(int $id, PDO $pdo): void{

        $sql = "DELETE FROM estudantes WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);

        if($statement->execute()){
            echo "\nAluno de id = " . $id . " excluído com sucesso.";
        } else{
            echo "\nErro ao excluír o aluno de id = " . $id;
        }

    }

            /*
            O bindValue pode receber um terceiro valor que serve para dizer qual tipo de variável
            é esperada:
            
            Sintaxe: PDO::PARAM_X

            Valores de X:

            INT: inteiros
            STR: strings
            BOO: booleanos
            LOB: arquivos

            Obs: O bindValue pode ser chamado mais de uma vez para reaproveitar o SQL e executar
            novamente com o execute()
        */