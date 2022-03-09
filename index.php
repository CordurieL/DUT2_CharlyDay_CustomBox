<?php

require_once 'vendor/autoload.php';

session_start();

$configuration = [
	'settings' => [
		'displayErrorDetails' => true,
		'dbconf' => './src/conf.ini']];

$c = new Container($configuration);
$app = new App($c);
$db = new DB();
$db->addConnection(parse_ini_file($configuration['settings']['dbconf']));
$db->setAsGlobal();
$db->bootEloquent();



// Routes ////////////////////////////
$app->get('/', MainController::class . ':afficherAccueil')->setName('Accueil');



/////////////////////////////////////


// Lancement de l'application
try	$app->run();
catch (Throwable $e) echo $e->getMessage();