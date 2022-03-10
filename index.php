<?php

require_once __DIR__ . '/vendor/autoload.php';
$config = require_once __DIR__ . "/src/conf/settings.php";

use custombox\controleurs\ControleurProduit;
use custombox\controleurs\ControleurUser;
use custombox\controleurs\ControleurBoite;
use custombox\controleurs\ControleurAccueil;
use custombox\controleurs\ControleurCategorie;
use Illuminate\Database\Capsule\Manager as DB;

session_start();

// header('Location: index.php');

$container = new Slim\Container($config);
$app = new \Slim\App($config);

$db = new DB();
$config = parse_ini_file('./src/conf/conf.ini');
if ($config) $db->addConnection($config);
$db->setAsGlobal();
$db->bootEloquent();


// ACCUEIL -----------------------------
/**
 * Page d'accueil
 */
$app->get('/',
	ControleurAccueil::class . ":displayAccueil")->setName("accueil");


// PRODUITS ------------------------------
/**
 * Voir tous les produits disponibles sur le site
 */
$app->get('/produits[/]',
	ControleurProduit::class . ":displayProducts")->setName("produits");

/**
 * Faire un formulaire pour 
 */
$app->get('/createProductForm[/]', 
    ControleurProduit::class . ":formCreateProduct")->setName("createProductForm");

/**
 * Voir tous les produits disponibles sur le site 
 */
$app->post('/createProduct[/]', 
    ControleurProduit::class . ":createProduct")->setName("createProduct");


// BOITES  -------------------------------
/**
 * Voir toutes les boites
 */
$app->get('/boites[/]', 
    ControleurBoite::class . ":displayBox")->setName("boites");

/**
 * Donner de l'argent pour une cagnotte
 */
$app->post('/item/participer_cagnotte/{id}[/]',
	ControleurProduit::class . ':giveCagnotte')->setName('donner_cagnotte');


$app->run();