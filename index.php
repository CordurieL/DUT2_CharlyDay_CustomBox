<?php

//require_once __DIR__ .'/vendor/autoload.php';
$config = require_once __DIR__ . "/src/conf/settings.php";

use charlyday\controleurs\ControleurAccueil;
use Illuminate\Database\Capsule\Manager as DB;

session_start();

$container = new Slim\Container($config);
$app =new \Slim\App($config);

$db=new DB();
$config=parse_ini_file('./src/conf/conf.ini');
if($config) $db->addConnection($config);
$db->setAsGlobal();
$db->bootEloquent();


// ACCUEIL -----------------------------
/**
 * Page d'accueil
 */
$app->get('/',
    ControleurAccueil::class.":displayAccueil")->setName("accueil");


$app->run();