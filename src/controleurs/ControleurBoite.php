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
use custombox\controleurs\ControleurBoite;
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
	public function createBox(Request $rq, Response $rs, array $args): Response {
		$container = $this->container;
		$param = $rq->getParsedBody();
		$box = new Boite();

		$userid = $_SESSION['id_user'];
		if (isset($param['id_user'])) {
			$box->createBox($param['taille'], $param['couleur'], $param['message'], $param['id_user']);
		} else {
			$box->createBox($param['taille'], $param['couleur'], $param['message']);
		}

		$v = new VueBoite($this->container, $box);
		$rs->getBody()->write($v->render(2));

		return $rs;
	}

	/**
	 * Permet de créer une boite
	 */
	public function formBox(Request $rq, Response $rs, array $args): Response {
		$container = $this->container;

		$param = $rq->getParsedBody();
		$v = new VueBoite($this->container, null);
		$rs->getBody()->write($v->render(3));

		return $rs;
	}

	/**
	 * Permet d'afficher toutes les boites
	 */
	public function displayBox(Request $rq, Response $rs, array $args): Response {
		$items = Boite::all();
		$v = new VueBoite($this->container, $items);
		$rs->getBody()->write($v->render(1));

		return $rs;
	}

	/**
	 * Permet d'afficher toutes les boites d'un compte
	 */
	public function listesBoites(Request $rq, Response $rs, array $args): Response {
		$container = $this->container;

		$userid = $_SESSION['id_user'];
		if (isset($param['id_user'])) {
			$items = Boite->where('id_user', '=', $param['id_user'])->get();
			$v = new VueBoite($this->container, $items);
			$rs->getBody()->write($v->render(4));
        }

		return $rs;
	}
	
	/**
	* Permet d'afficher toutes les boites d'un compte
	*/
	public function listesBoites(Request $rq, Response $rs, array $args) :Response{
		$container = $this->container ;
		
		$userid = $_SESSION['id_user'];
		if(isset($param['id_user'])){
            $items=Boite->where('id_user','=',$param['id_user'])->get();
			$v = new VueBoite($this->container,$items);
			$rs->getBody()->write($v->render(4)) ;
        }
		
		return $rs ;
	}
}













