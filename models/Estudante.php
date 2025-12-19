<?php

    namespace MD;

    class Estudante{

        private ? int $id;
        private string $nome;
        private \DateTimeImmutable $data_nascimento;

        public function __construct(?int $id, string $nome, \DateTimeImmutable $data_nascimento)
        {
            $this->id = $id;
            $this->nome = $nome;
            $this->data_nascimento = $data_nascimento;
        }

        public function defineId(int $id): void{

            if (!is_null($this->id)) {
                throw new \DomainException(message:'Você só pode definir o ID uma vez');
            }

            $this->id = $id;
            
        }

        //Métodos Getters
        public function getId(): ?int
        {
            return $this->id;
        }
        public function getNome(): string
        {
            return $this->nome;
        }
        public function getData_nascimento(): \DateTimeImmutable
        {
            return $this->data_nascimento;
        }

        //Método Setters
        public function setNome(string $novoNome): void{

            $this->nome = $novoNome;

        }

        //Retorna a idade de acordo com a data de nascimento 
        public function idade(): int{
            return $this->data_nascimento->diff(new \DateTimeImmutable())->y;
        }
    }