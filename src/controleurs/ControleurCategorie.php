<?php declare(strict_types=1);

namespace custombox\controleurs;

use Illuminate\Support\Facades\Auth;
use custombox\exceptions\AuthException;
use custombox\exceptions\InscriptionException;
use custombox\models\Boite;
use custombox\models\Role;
use custombox\models\User;
use custombox\vue\VueAccount;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

class ControleurCategorie {

	private $container;

	public function __construct(Container $c) {
		$this->container = $c;
	}
}