<?php

    namespace Buscador;

    use GuzzleHttp\ClientInterface;
    use Symfony\Component\DomCrawler\Crawler;

    //Classe que busca elementos em uma página web
    class Buscador{

        private $cliente;
        private $crawler;

        public function __construct(ClientInterface $cliente, Crawler $crawler){
            $this->cliente = $cliente;
            $this->crawler = $crawler;
        }

        //Função que busca o corpo html de uma url e filtra os elementos com o seletor css
        public function buscar(string $url, string $seletor): array{

            //Faz a requisição GET na url
            $resposta = $this->cliente->request('GET', $url);

            //Pega o corpo da resposta
            $html = $resposta->getBody();

            //Adiciona o html ao crawler
            $this->crawler->addHtmlContent($html);
            
            //Filtra os elementos com o seletor css
            $elementos = $this->crawler->filter($seletor);

            $resultados = [];

            foreach($elementos as $elemento){

                //Adiciona o texto do elemento ao array resultados
                $resultados[] = $elemento->textContent;

            }

            return $resultados;
        }

    }