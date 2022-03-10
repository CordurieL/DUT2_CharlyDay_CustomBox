<?php declare(strict_types=1);

namespace custombox\controleurs;

use Illuminate\Support\Facades\Auth;
use custombox\exceptions\AuthException;
use custombox\models\User;
use custombox\vue\VueAccount;
use custombox\vue\VueBoite;
use custombox\vue\VueItem;
use custombox\models\Boite;
use custombox\controleurs\Controleur;
use custombox\controleurs\ControleurBOite;
use custombox\models\Item;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

class ControleurBoite extends Controleur {
	public function __construct(Container $c) {
		parent::__construct($c);
	}
	
	
	/**
	* Permet de créer une boite
	*/
	public function createBox(Request $rq, Response $rs, array $args) :Response{
		$container = $this->container ;
		
		/*$userid = $_SESSION['profile']['userid'];
		if(isset($param['profile']['userid'])){
            $publique = true;
        }
        else{
            $publique = false;
        }*/
		
		$param=$rq->getParsedBody();
		$box=new Boite();
		$box->createBox($param['taille'],$param['couleur'],$param['message']);
		$v = new VueListe($this->container,$box);
		$rs->getBody()->write($v->render(2)) ;
		
		return $rs ;
	}
	
	/**
	* Permet d'afficher toutes les boites
	*/
	public function displayBox(Request $rq, Response $rs, array $args) :Response{
		$container = $this->container ;
		
		$items=Boite::all();
		$v = new VueBoite($this->container,$items);
		$rs->getBody()->write($v->render(1)) ;
		
		return $rs ;
	}
}










