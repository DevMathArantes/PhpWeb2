<?php

    namespace MD;

    class Telefone{

        private ? int $id;
        private string $ddd;
        private string $numero;

        public function __construct(? int $id, string $ddd, string $numero){
            $this->id = $id;
            $this->ddd = $ddd;
            $this->numero = $numero;
        }

        //Retorna o telefone formatado
        public function formatTelefone() : string{

            return "($this->ddd) $this->numero";

        }

    }