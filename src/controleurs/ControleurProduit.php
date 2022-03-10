<?php declare(strict_types=1);

namespace custombox\controleurs;

use custombox\exceptions\AuthException;
use custombox\models\Produit;
use custombox\vue\VueAccount;
use custombox\vue\VueProduit;
use custombox\controleurs\Controleur;
use custombox\models\Boite;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

class ControleurProduit extends Controleur {
	public function __construct(Container $c) {
		parent::__construct($c);
	}
}






