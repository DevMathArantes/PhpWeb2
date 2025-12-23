<?php

    namespace IN;
     
    use MD\Estudante;

    //Repositório de estudantes
    interface EstudanteRep {

        public function listarAlunos(): array;
        public function aniversariantes(\DateTimeInterface $data) : array;
        public function salvarAluno(Estudante $estudante) : bool;
        public function removerAluno(int $id) : bool;        

    }