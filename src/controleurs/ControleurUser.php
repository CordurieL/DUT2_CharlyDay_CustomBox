<?php declare(strict_types=1);

namespace custombox\controleurs;

use Illuminate\Support\Facades\Auth;
use custombox\exceptions\AuthException;
use custombox\exceptions\InscriptionException;
use custombox\models\Liste;
use custombox\models\Role;
use custombox\models\User;
use custombox\vue\VueAccount;
use custombox\vue\VueParticipant;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

class ControleurUser {

	private $container;

	public function __construct(Container $c) {
		$this->container = $c;
	}

	public function listerUsers(Request $rq, Response $rs, array $args): Response {
		$users = User::all();
		foreach ($users as $user) {
			$rs->getBody()->write($user . $user->role);
		}
		return $rs;
	}

	public function listerRoles(Request $rq, Response $rs, array $args): Response {
		$roles = Role::all();
		foreach ($roles as $role) {
			$rs->getBody()->write($role);
			$users = $role->users;
			foreach ($users as $user) {
				$rs->getBody()->write($user);
			}
		}
		return $rs;
	}

	/**
	 * Créé un formulaire d'inscription pour un utilisateur
	 */
	public function inscription(Request $rq, Response $rs, array $args): Response {
		$vue = new VueAccount($this->container);
		$html = $vue->render(1);
		$rs->getBody()->write($html);
		// Si le formulaire a été soumis :
		if (isset($_POST['submit'])) {
			// Si le bouton "S'inscrire" a été cliqué :
			if ($_POST['submit'] == 'inscription') {
				$donnees = User::select('email')
					->where('email', $_POST['email'])
					->get();
				// Si l'email est pas déjà présent dans la base de données :
				if ($donnees == []) {
					echo "<p class='erreur'>Vous êtes déjà inscrit avec cette adresse mail.</p>";
				} else {
					if ($_POST['password'] != $_POST['password2']) {
						echo "<p class='erreur'>Les mots de passe ne correspondent pas.</p>";
					} else {
						$email = htmlspecialchars($_POST['email']);
						$prenom = htmlspecialchars($_POST['prenom']);
						$nom = htmlspecialchars($_POST['nom']);
						// Création de l'utilisateur par le modèle :
						$u = new User();
						$u->email = $email;
						$u->prenom = $prenom;
						$u->nom = $nom;
						$u->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
						$u->save();
						$_SESSION['id_user'] = $u->id_user;
						$rs = $rs->withRedirect($this->container->router->pathFor('accueil', ['token' => $args['token']]));
					}
				}
			}
		}
		return $rs;
	}

	public function connexion(Request $rq, Response $rs, array $args): Response {
		$vue = new VueAccount($this->container);
		$html = $vue->render(2);
		$rs->getBody()->write($html);
		echo "frezfrrgezrs";
		// Si le formulaire a été soumis :
		if (isset($_POST['submit'])) {
			// Si le bouton Connexion a été cliqué :
			if ($_POST['submit'] == 'connexion') {
				$pass = $_POST['password'];
				$user = User::where('email', $_POST['email'])->first();
				// Si l'utilisateur existe :
				echo $user;
				echo $pass;
				echo "frezfrrgezrs";
				if ($user != []) {
					echo "<p class='erreur'>Le mot de pagtrgeruoyiferzyhgrsse est incorrect.</p>";

					if (password_verify($pass, $user['password'])) {
						$_SESSION['id_user'] = $user->id_user;
						echo "<p class='erreur'>Le mot de pagtrgeruoyiferzyhgrsse est incorrect.</p>";
						$rs = $rs->withRedirect($this->container->router->pathFor('voirProfil', ['token' => $args['token']]));
					} else {
						echo "<p class='erreur'>Le mot de passe est incorrect.</p>";
					}
				} else {
					echo "<p class='erreur'>Aucun compte ne correspond à cet email.</p>";
				}
			}
		}
		return $rs;
	}

	public function deconnexion(Request $rq, Response $rs, array $args): Response {
		Authentification::deconnexion();
		$rs->write("Vous êtes déconnecté");
		$url = $this->container->router->pathFor('accueil');
		$rs = $rs->withStatus(302)->withHeader('Location', $url);
		return $rs;
	}


	/**
	 * Crée un utilisateur
	 * @param $username String nom d'utilisateur
	 * @param $password String mot de passe
	 * @param $email String email de l'utilisateur
	 * @throws InscriptionException
	 */
	public static function createUser($username, $password, $userRole, $email) {
		// Teste taille du password.
		if (strlen($password) < 12) {
			throw new InscriptionException("Le password doit avoir au moins 12 caractères");
		}
		// Teste au moins 1 majuscule.
		$passwordTestNbMajs = preg_replace('#[a-z]*#', '', $password);
		$nbmaj = strlen($passwordTestNbMajs);
		if ($nbmaj == 0) {
			throw new InscriptionException("Le password doit avoir au moins une majuscule");
		}

		// si ok : hacher $password
		password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);


		// créer et enregistrer l'utilisateur
		$user = new User();
		$user->inscrireUser($username, $password, $userRole, $email);
		$userid = $user->userid;
		self::loadProfile($userid);

	}

	/**
	 * Voir les infos de son compte
	 */
	public function voirProfil(Request $rq, Response $rs, array $args): Response {
		$vue = new VueAccount($this->container);
		if (isset($_SESSION['id_user'])) $rs->write($vue->render(4));
		else $rs->write($vue->render(7));
		return $rs;
	}

	/**
	 * Modifier les infos de son compte
	 */
	public function formModifCompte(Request $rq, Response $rs, array $args): Response {
		try {
			Authentification::checkAccessRights(Authentification::$CREATOR_RIGHTS);
			$userid = $_SESSION['profile']['userid'];
			$user = User::firstWhere('userid', $userid);
			$v = new VueAccount($this->container, $user);
			$rs->write($v->render(6));
		} catch (AuthException $e1) {
			$v = new VueAccount($this->container);
			$rs->write($v->render(5));
		}
		return $rs;
	}

	public function modifCompte(Request $rq, Response $rs, array $args): Response {
		try {
			Authentification::checkAccessRights(Authentification::$CREATOR_RIGHTS);
			$data = $rq->getParsedBody();
			$newMail = filter_var($data['email'], FILTER_SANITIZE_STRING);
			$newPassword = filter_var($data['password'], FILTER_SANITIZE_STRING);
			$user = User::firstWhere('userid', $_SESSION['profile']['userid']);
			$user->password = $newPassword;
			$user->email = $newMail;
			$user->save();
			if (strlen($newPassword) != 0) {
				Authentification::deconnexion();
				$url = $this->container->router->pathFor('formConnexion');
			} else {
				$this->container->router->pathFor('formConnexion');
				$url = $this->container->router->pathFor('voirProfil');
			}
			$rs = $rs->withStatus(302)->withHeader('Location', $url);
		} catch (AuthException $e1) {
			$v = new VueAccount($this->container);
			$rs->write($v->render(5));
		}
		return $rs;
	}

	public function supprimerCompte(Request $rq, Response $rs, array $args): Response {
		try {
			Authentification::checkAccessRights(Authentification::$CREATOR_RIGHTS);
			$userid = $_SESSION['profile']['userid'];
			$user = User::firstWhere('userid', $userid);
			$listes = $user->listes;
			// Suppression des listes
			foreach ($listes as $li) {
				$items = $li->items;
				// Supression des items
				foreach ($items as $item) {
					$item->delete();
				}
				$li->delete();
			}
			$user->delete();
			Authentification::deconnexion();
			$url = $this->container->router->pathFor('accueil');
			$rs = $rs->withStatus(302)->withHeader('Location', $url);
		} catch (AuthException $e1) {
			$v = new VueAccount($this->container);
			$rs->write($v->render(5));
		}
		return $rs;
	}
}