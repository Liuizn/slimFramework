<?php
require 'vendor/autoload.php';

$app = new \Slim\App;

//Requisição Simples
$app->get('/zoologico', function ()
{
    echo 'Bem vindo ao zoológico';
});

//Requisição com parâmetros dinâmicos
$app->get('/cigarros/{modelo}', function ($request, $response) {

    $modelo = $request->getAttribute('modelo');

    if($modelo == 'palha')
    {
        echo 'Coyote 18 reais';
    }
    else if($modelo == 'filtro')
    {
        echo 'lucky strike 9 reais';
    }
    else
    {
        echo 'não encontrado';
    }
});

//Encurtando URLS
$app->get('/tes/tes/tes/tenis/{marca}', function ($request, $response)
{
    $marcas = array(
        "nike"      => 'airmax',
        "adidas"    => 'ultraboost',
        "fila"      => 'spriz',
        "puma"      => 'smash'
    );

    $marca = $request->getAttribute('marca');

    if(in_array($marca, array_keys($marcas)))
    {
        echo $marcas[$marca]. ' disponível';
    }
    else 
    {
        echo 'Não trabalhamos com esta empresa';
    }

})->setName('produtos');

$app->get('/calcados', function ($request, $response)
{
    $retorno = $this->get("router")->pathFor("produtos", ["marca" => 'nike']);

    echo $retorno;
});


//parametros opcionais.
$app->get('/usuario[/{login}]', function ($request, $response)
{
    $usuarios = array("esdras","bruno", "rafa","mateus", "luiz");

    $login = $request->getAttribute('login');

    if(!empty($login) && in_array($login, $usuarios))
    {
        echo 'Bem Vindo ' . $login;
    }
    else
    {
        print '<h1>Lista de Usuários</h1> </br>';

        foreach ($usuarios as $usuario) 
        {
            print $usuario;
            echo '</br>';
        }
    }
    
});

//Agrupamento de Rotas
$app->group('/honda', function () {

    $this->get('/suv', function ($request, $response) {

        echo 'CRV';
    });

    $this->get('/sedan', function ($request, $response) {

        echo 'Honda Civic';
    });
});

$app->group('/fiat', function () {

    $this->get('/suv', function ($request, $response) 
    {
        echo 'Pulse';
    });

    $this->get('/sedan', function ($request, $response)
    {
        echo 'Cronos';
    });
});

$app->run();
