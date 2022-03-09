<?php declare(strict_types = 1);

namespace charlyday\controleurs;

use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;
use charlyday\controleurs\Controleur;
use charlyday\vue\VueAccueil;/*3236*/
use charlyday\models\Item;
use charlyday\models\Liste;

class ControleurAccueil extends Controleur
{
    public function __construct(Container $c)
    {
        parent::__construct($c);
    }

	/**
	* Accès à l'accueil
	*/
    function displayAccueil(Request $rq, Response $rs, array $args):Response{
        $v = new VueAccueil($this->container) ;
		$rs->getBody()->write($v->render(1)) ;
		return $rs ;
    }
}





