<?php declare(strict_types=1);

namespace custombox\vue;

use custombox\vue\Vue;
use Slim\App;

class VueAccount extends Vue {
	public function render($selecteur): string {
		switch ($selecteur) {
			case 1:
				$content = $this->render_formulaireInscription();
				break;
			case 2:
				$content = $this->render_formulaireConnexion();
				break;
			case 3 :
				$content = $this->render_connexion();
				break;
			case 4 :
				$content = $this->render_profile();
				break;
			case 5 :
				$content = $this->render_accessDenied();
				break;
			case 6 :
				$content = $this->render_formModifCompte();
				break;
			default:
				$content = "Pas de contenu disponible";
		}
		return
			"<!DOCTYPE html>

	<html lang='fr'>
			<head>
				<meta charset=\"utf-8\"/>
				<link rel=\"stylesheet\" media=\"screen\" type=\"text/css\" href=\"web/css/input.css\"/>
				<title>sometext</title>
			</head>
			<body>
				<header>
					<nav>
						<h1><a href=''>CustomBox</a></h1>
					</nav>
				</header>
				
                <div class=\"content\">
					$content
				</div>
				<footer>
					
				</footer>
			</body>
		<html>";
	}

	/**
	 * @return string La chaine html correspondant à un formulaire d'inscription
	 */
	private function render_formulaireInscription(): string {
		$url = $this->container->router->pathFor('inscription');
		return "
			<form action='$url' method='POST'>
			    <h2>INSCRIPTION</h2>
			    
			    <p>Pas de compte ? <a href=''>Se connecter</a></p>
			    
			    <label>Entrez votre prénom</label>
			    <input required type='text' name='prenom' placeholder='Prénom'><br>
			    
			    <label>Entrez votre nom</label>
			    <input required ='text' name='nom' placeholder='Nom'><br>
			
			    <label>Entrez votre adresse e-mail</label>
			    <input required type='text' name='email' placeholder='Adresse e-mail'><br>
			
			    <label>Entrez un mot de passe</label>
			    <input required type='password' name='password' placeholder='Mot de passe'><br>
			    
			    <label>Entrez à nouveau le mot de passe</label>
			    <input required type='password' name='password2' placeholder='Mot de passe'><br>
					
			    <button type='submit' name='submit' value='inscription'>S'inscrire</button>
			</form>
		";
	}

	/**
	 * @return string La chaine html correspondant à un formulaire de connexion
	 */
	private function render_formulaireConnexion(): string {
		return "<section><h2>Connexion</h2>
            <form action=\"" . $this->container->router->pathFor('connexion') . "\" method=\"POST\" name=\"formConnex\" id=\"formConnex\">
				<p><label>Pseudo : </label><input type=\"text\" name=\"username\" size=40 required=\"true\"></p>
				<p><label>Password : </label><input type=\"password\" name=\"password\" size=60 required=\"true\"></p>
				<input type=\"submit\" value=\"Connexion\">
			</form></section>";
	}

	private function render_connexion(): string {
		return "<a href =\"..\">Accueil</a> <script>window.alert(\"Vous êtes connecté\")</script>";
	}

	private function render_deconnexion(): string {
		return "<a href =\"..\">Accueil</a> <script>window.alert(\"Vous êtes déconnecté\")</script>";
	}

	private function render_profile(): string {
		$html = "<section><h2>Mon compte</h2>
        <form action='" . $this->container->router->pathFor('formModifCompte') . "'>
            <input type='submit' name='enter' value='Modifier mon compte'>
        </form>
        <form action='" . $this->container->router->pathFor('supprimerCompte') . " ' method='post'>
            <input type='submit' name='enter' value='Supprimer mon compte'>
        </form>
        <p><ul>
            <li>Mon nom : " . $this->objet->username . "</li>    
            <li>Mon email : " . $this->objet->email . "</li>
        </ul></p></section>
        ";
		return $html;
	}

	private function render_accessDenied(): string {
		return "Vous n'avez pas accès à cette page";
	}

	private function render_formModifCompte(): string {
		$html = "<section><h2>Modifier mon compte</h2>
        <form action='" . $this->container->router->pathFor('modifCompte') . "' method='POST'>
        <ul>
            <li><input type='text' name='email' placeholder='email'></li>
            <li><input type='password' name='password' placeholder='password'></li>
            <li> <input type='submit' name='enter' value='Modifier mon compte'></li>
        </ul>    
        </form></section>";
		return $html;
	}

	private function render_modifCompte() { }
}