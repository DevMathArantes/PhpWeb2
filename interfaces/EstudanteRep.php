<?php

    namespace IN;

    //Repositório de estudantes
    interface EstudanteRep {

        public function listarAlunos(): array;
        public function aniversariantes(\DateTimeInterface $data) : array;
        public function salvarAluno() : boll;
        public function removerAluno() : boll;        

    }