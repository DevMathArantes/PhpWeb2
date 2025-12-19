<?php

    use IN\EstudanteRep;
    use MD\Conexao;
    use MD\Estudante;
    use PDO;

    class EstudantePDO implements EstudanteRep{

        private \PDO $conexao;

        public function __construct(){
            $this->conexao = Conexao::criarConexao();
        }

        //Retorna uma lista com todos os alunos registrados
        public function listarAlunos(): array{

            //Query
            $registros = $this->conexao->query("SELECT * FROM estudantes;");
            $alunos = [];

            //Controle para grandes volumes de dados
            while($registro = $registros->fetch(\PDO::FETCH_ASSOC)){

                $registro = new Estudante(
                    $registro['id'],
                    $registro['nome'],
                    new \DateTimeImmutable($registro['data_nascimento'])
                );

                $alunos[] = $registro;
            }

            return $alunos;
        }

        public function aniversariantes(\DateTimeInterface $data) : array{

        }

        public function salvarAluno(Estudante $estudante) : boll{

            if($estudante->getId() === null){

                return $this->insert($estudante);

            }

            return $this->update($estudante);

        }

        //Inserindo um aluno no banco de dados
        public function insert(Estudante $estudante): boll{

            $sql = "INSERT INTO estudantes (nome, data_nascimento) VALUES (:nome, :data_nascimento)";
            $statement = $this->conexao->prepare($sql);

            $status = $statement->execute([
                ":nome" => $estudante->getNome(),
                ":data_nascimento" => $estudante->getData_nascimento()
            ]);

            if($status){

                $estudante->defineId($this->conexao->lastInsertId());

            }

            return $status;
        }

        //Atualizando os dados de um aluno
        public function update(Estudante $estudante): boll{

            $sql = "UPDATE estudantes SET nome = :nome, data_nascimento = :data_nascimento WHERE id = :id";
            $statement = $this->conexao->prepare($sql);
            $status = $statement->execute([
                ":nome" => $estudante->getNome(),
                ":data_nascimento" => $estudante->getData_nascimento(),
                ":id" => $estudante->getId()
            ]);

        }

        //Função para remover aluno por id
        public function removerAluno($id) : boll{

            $statement = $this->conexao->prepare("DELETE FROM estudantes WHERE id = :id");
            $statement->bindValue(':id', $id, PDO::PARAM_INT);

            return $statement->execute();

        }


    }