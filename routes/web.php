<?php

$router->get('/', 'HomeController@index'); // Root route
$router->get('/clientes', 'ClienteController@index');
$router->post('/clientes', 'ClienteController@store');
$router->get('/clientes/{id}', 'ClienteController@show'); // Exemplo de rota com parâmetro
$router->get('/estoque', 'EstoqueController@index');
// ...adicione outras rotas aqui...
