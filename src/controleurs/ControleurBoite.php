<?php declare(strict_types=1);

namespace custombox\controleurs;

use Illuminate\Support\Facades\Auth;
use custombox\exceptions\AuthException;
use custombox\models\User;
use custombox\vue\VueAccount;
use custombox\vue\VueBoite;
use custombox\vue\VueItem;
use custombox\models\Liste;
use custombox\controleurs\Controleur;
use custombox\models\Item;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

class ControleurBoite extends Controleur {
	public function __construct(Container $c) {
		parent::__construct($c);
	}
}










