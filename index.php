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

$app->post('/produits[/]',
	ControleurProduit::class . ":displayProducts")->setName("searchProduits");


/**
 * Faire un formulaire pour creer un nouveau produit
 */
$app->get('/creerProduit[/]',
	ControleurProduit::class . ":formCreateProduct")->setName("createProductForm");

/**
 * redirection qui permet de creer le produit et retourner sur l affichage des produits
 */
$app->post('/createProduct[/]',
	ControleurProduit::class . ":createProduct")->setName("createProduct");


/**
 * Faire un formulaire pour pouvoir modifier un produit
 */
$app->get('/modifierProduit/{id_product}',
	ControleurProduit::class . ":formModifyProduct")->setName("modifyProductForm");

/**
 * redirection qui permet de retourner sur la page des items apres en avoir modifier un
 */
$app->post('/modifyProduct[/]',
	ControleurProduit::class . ":modifyProduct")->setName("modifyProduct");


// BOITES  -------------------------------
/**
 * Voir toutes les boites
 */
$app->get('/boites[/]',
	ControleurBoite::class . ":displayBox")->setName("boites");

/**
 * Accès à la création d'une boite
 */
$app->get('/creationBoite[/]',
	ControleurBoite::class . ":formBox")->setName("formBoite");
	
/**
 * Création de la boite
 */
$app->post('/boite[/]',
	ControleurBoite::class . ":createBox")->setName("createBox");
	
/**
 * Liste des boites lorsque connecté
 */
$app->get('/listesBoites[/]',
	ControleurBoite::class . ":listesBoites")->setName("listesBoites");
	
/**
 * Contenu d'une boite
 */
$app->get('/contenuBoite/{id_boite}[/]',
	ControleurBoite::class . ":listesBoites")->setName("listesBoites");

// USER -----------------------------------------------


/**
 * Formulaire inscription
 */
$app->get('/inscription[/]',
	ControleurUser::class . ':inscription')->setName('formInscription');

/**
 * Inscription
 */
$app->post('/inscription[/]',
	ControleurUser::class . ':inscription')->setName('inscription');

/**
 * Formulaire connexion
 */
$app->get('/connexion[/]',
	ControleurUser::class . ':connexion')->setName('formConnexion');

/**
 * Connexion
 */
$app->post('/connexion[/]',
	ControleurUser::class . ':connexion')->setName('connexion');

/**
 * Deconnexion
 */
$app->get('/deconnexion[/]',
	ControleurUser::class . ':deconnexion')->setName('deconnexion');

/**
 * Voir profil
 */
$app->get('/profil[/]',
	ControleurUser::class . ':voirProfil')->setName('profil');

/**
 * formulaire Modification de compte
 */
$app->get('/profil/modifier[/]',
	ControleurUser::class . ':formModifCompte')->setName('formModifCompte');

/**
 * Modification de compte
 */
$app->post('/profil/modifier[/]',
	ControleurUser::class . ':modifCompte')->setName('modifCompte');

/**
 * Suppression de compte
 */
$app->post('/myProfile/deleteAccount[/]',
	ControleurUser::class . ':supprimerCompte')->setName('supprimerCompte');

/**
 * Liste des commandes - administrateur
 */
$app->get('/listeCommandes[/]',
	ControleurUser::class . ':listeCommandes')->setName('listeCommandes');

$app->run();