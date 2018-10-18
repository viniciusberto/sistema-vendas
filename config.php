<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require './vendor/autoload.php';

define('DIRETORIO', realpath(__DIR__));
define('TITLE', 'Vendys');
define('HTML_BASE', 'http://localhost:8000/');
define('VIEWS', DIRETORIO . '/views');

define('CACHE', DIRETORIO . '/cache');
define('CACHE_VIEWS', CACHE . '/views');

/*
Temas: default, bootstrap

Temas bootswatch: cosmo, cyborg, darkly, journal, readable, sandstone, simplex, slate, superhero, yeti
Mais temas em http://bootswatch.com/
*/
define('TWITTER_BOOTSTRAP_TEMA', 'cosmo');

define('BD_HOST', 'localhost');
define('BD_USUARIO', 'root');
define('BD_SENHA', '001001');
define('BD_NOME', 'vendas');

define('CATEGORIA_INATIVO', '0');
define('CATEGORIA_ATIVO', '1');

define('CLIENTE_INATIVO', '0');
define('CLIENTE_ATIVO', '1');

define('PRODUTO_INATIVO', '0');
define('PRODUTO_ATIVO', '1');
define('PRODUTO_MANUTENCAO', '2');

define('USUARIO_INATIVO', '0');
define('USUARIO_ATIVO', '1');

define('VENDA_ABERTA', '0');
define('VENDA_FECHADA', '1');

require DIRETORIO . '/lib/funcoes.php';