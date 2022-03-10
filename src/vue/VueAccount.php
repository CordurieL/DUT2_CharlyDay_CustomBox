<?php declare(strict_types=1);

namespace custombox\vue;

use custombox\models\User;

class VueAccount extends Vue {

	public function render($selecteur): string {
		$vueElements = new VueElements($this->container);
		$content = $vueElements->renderHead("Account") . $vueElements->renderHeader();
		switch ($selecteur) {
			case 1:
				$content = $this->render_inscription();
				break;
			case 2:
				$content = $this->render_connexion();
				break;
			case 5 :
				$content .= $this->render_accessDenied();
				break;
			case 6 :
				$content .= $this->render_formModifCompte();
				break;
			case 7 :
				$content = $this->render_profil();
				break;
			default:
				$content .= "Pas de contenu disponible";
		}
		return $content . $vueElements->renderFooter();
	}

	/**
	 * @return string La chaine html correspondant à un formulaire d'inscription
	 */
	private function render_inscription(): string {
		$url = $this->container->router->pathFor('inscription');
		$connection = $this->container->router->pathFor('connexion');
		return <<<HTML
			<form action='$url' method='POST' class="form-inscription">
			    <h2>INSCRIPTION</h2>
			    
			    <p>Déjà un compte ? <a href=$connection>Se connecter</a></p>
			    
				<div class="form-inscription__label">
					<label>Entrez votre prénom</label>
					<input required type='text' name='prenom' placeholder='Prénom'><br>
				</div>

			    <div class="form-inscription__label">
					<label>Entrez votre nom</label>
					<input required ='text' name='nom' placeholder='Nom'><br>
				</div>

				<div class="form-inscription__label">
			    	<label>Entrez votre adresse e-mail</label>
			    	<input required type='text' name='email' placeholder='Adresse e-mail'><br>
				</div>
			
				<div class="form-inscription__label">
			 		<label>Entrez un mot de passe</label>
			    	<input required type='password' name='password' placeholder='Mot de passe'><br>
				</div>
			    
				<div class="form-inscription__label">
			    	<label>Entrez à nouveau le mot de passe</label>
			    	<input required type='password' name='password2' placeholder='Mot de passe'><br>
				</div>
				
			    <button type='submit' name='submit' value='inscription'>S'inscrire</button>
			</form>
HTML;
	}

	/**
	 * @return string La chaine html correspondant à un formulaire de connexion
	 */
	private function render_connexion(): string {
		$url = $this->container->router->pathFor('connexion');
		$inscription = $this->container->router->pathFor('inscription');
		if (isset($_SESSION['id_user'])) {
			$user_id = $_SESSION['id_user'];
		}
		$user_id = $_SESSION['user_id'];
		return <<<HTML
			<section>
				<h2>Connexion</h2>
				<p>Pas de compte ?<a href=$inscription>S'inscrire</a></p>
				<form action='$url' method='POST' name='formConnex' id='formConnex'>
					<p><label>Adresse email : </label><input type='text' name='email' size=40 required='true'></p>$user_id fr erefre
					<p><label>Mot de passe : </label><input type='password' name='password' size=60 required='true'></p>
					<input type='submit' name='submit' value='connexion'>
				</form>
			</section>
		HTML;
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

	private function render_deconnexion(): string {
		return "<a href ='..'>Accueil</a> <script>window.alert('Vous êtes déconnecté')</script>";
	}

	private function render_profil(): string {
		$user = User::where('id_user', '=', $_SESSION['id_user'])->get()->toArray();
		return <<<HTML
			<section>
				<h2>Mon compte</h2>
				<h3>{$user->prenom} {$user->nom}</h3>
			</section>
		HTML;
	}

	private function render_modifCompte() { }
}