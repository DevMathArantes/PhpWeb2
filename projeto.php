<?php

    require "vendor/autoload.php";

    use GuzzleHttp\Client;
    use Symfony\Component\DomCrawler\Crawler;
    use Buscador\Buscador;

    $cliente = new Client(['base_uri' => 'https://www.alura.com.br/']);
    $crawler = new Crawler();
    $busca = new Buscador($cliente, $crawler);

    $cursos = $busca->buscar('/cursos-online-programacao/php', 'span.card-curso__nome');

    foreach ($cursos as $curso) {
        echo "-Curso: " . $curso . PHP_EOL;
    }

    //Testando autoload na linha abaixo (retire o commentário)
    //TesteAutoload::testarAutoload();

    //Testando autoload de arquivo na linha abaixo (retire o commentário)
    //testarAutoloadFile();

?>