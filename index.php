<?php

require_once __DIR__ .'/vendor/autoload.php';
$config = require_once __DIR__ . "/src/conf/settings.php";

use Slim\App;
use Slim\Container;
use Illuminate\Database\Capsule\Manager as DB;
use charlyday\controleurs\ControleurAccueil;

session_start();

$container = new Container($config);
$app =new App($config);

$db=new DB();
$config=parse_ini_file('./src/conf/conf.ini');
if($config) $db->addConnection($config);
$db->setAsGlobal();
$db->bootEloquent();


// Routes /////////////
$app->get('/', ControleurAccueil::class.":displayAccueil")->setName("accueil");

$app->get('/test', ControleurAccueil::class.":displayTest")->setName("test");

$app->run();