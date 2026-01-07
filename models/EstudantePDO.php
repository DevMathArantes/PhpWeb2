<?php

    namespace MD;

    use IN\EstudanteRep;
    use MD\Conexao;
    use MD\Estudante;
    use MD\Telefone;
    use PDO;

    class EstudantePDO implements EstudanteRep{

        private PDO $conexao;

        //Função construtora
        public function __construct(PDO $conectar){
            $this->conexao = $conectar;
        }

        //Retorna uma lista com todos os alunos registrados
        public function listarAlunos(): array{

            $sql = "SELECT * FROM estudantes;";
            $statement = $this->conexao->prepare($sql);
            $statement->execute();

            return $this->hidratarAluno($statement);
        }

        //Retorna aniversariantes da data informada
        public function aniversariantes(\DateTimeInterface $data) : array{
            
            $sql = "SELECT * FROM estudantes WHERE data_nascimento = :data_nascimento";
            $statement = $this->conexao->prepare($sql);
            $status = $statement->execute([
                ":data_nascimento" => $data->format('Y-m-d')
            ]);

            return $this->hidratarAluno($statement);

        }

        //Salvar aluno
        public function salvarAluno(Estudante $estudante) : bool{

            if($estudante->getId() === null){

                return $this->insert($estudante);

            }

            return $this->update($estudante);

        }

        //Inserindo um aluno no banco de dados
        public function insert(Estudante $estudante): bool{

            $sql = "INSERT INTO estudantes (nome, data_nascimento) VALUES (:nome, :data_nascimento)";
            $statement = $this->conexao->prepare($sql);

            $status = $statement->execute([
                ":nome" => $estudante->getNome(),
                ":data_nascimento" => $estudante->getData_nascimento()->format('Y-m-d')
            ]);

            if($status){

                $estudante->defineId($this->conexao->lastInsertId());

            }

            return $status;
        }

        //Atualizando os dados de um aluno
        public function update(Estudante $estudante): bool{

            $sql = "UPDATE estudantes SET nome = :nome, data_nascimento = :data_nascimento WHERE id = :id";
            $statement = $this->conexao->prepare($sql);
            $status = $statement->execute([
                ":nome" => $estudante->getNome(),
                ":data_nascimento" => $estudante->getData_nascimento()->format('Y-m-d'),
                ":id" => $estudante->getId()
            ]);

            return $status;

        }

        //Função para remover aluno por id
        public function removerAluno(int $id) : bool{

            $statement = $this->conexao->prepare("DELETE FROM estudantes WHERE id = :id");
            $statement->bindValue(':id', $id, PDO::PARAM_INT);

            return $statement->execute();

        }

        //Retorna a lista de alunos como objetos
        public function hidratarAluno(\PDOStatement $statement) : array{

            $alunos = [];

            while($registro = $statement->fetch()){
                $alunos[] = new Estudante(
                    $registro['id'],
                    $registro['nome'],
                    new \DateTimeImmutable($registro['data_nascimento'])
                );

            }

            return $alunos;

        }

        //Retorna um array com alunos que possuem telefone
        public function alunosComTelefone() : array {
            
            $sql = 'SELECT estudantes.id,
                                estudantes.nome,
                                estudantes.data_nascimento,
                                telefones.id AS telefone_id,
                                telefones.ddd,
                                telefones.numero
                        FROM estudantes
                        JOIN telefones ON estudantes.id = telefones.id_estudante;';

            $statement = $this->conexao->query($sql);
            $resultado = $statement->fetchAll();
            $listaEstudantes = [];

            foreach ($resultado as $registro) {

                //Verifica se o array ja possui este id (aluno)
                if(!array_key_exists($registro['id'], $listaEstudantes)){
                    $listaEstudantes[$registro['id']] = new Estudante(
                        $registro['id'],
                        $registro['nome'],
                        new \DateTimeImmutable($registro['data_nascimento'])
                    );
                }

                $telefone = new Telefone($registro['telefone_id'], $registro['ddd'], $registro['numero']);
                $listaEstudantes[$registro['id']]->addTelefone($telefone);

            }

            return $listaEstudantes;
        }

    }