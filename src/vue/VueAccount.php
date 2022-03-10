<?php declare(strict_types=1);

namespace custombox\vue;

use custombox\vue\Vue;
use Slim\App;

class VueAccount extends Vue {

	public function render($selecteur): string {
		$vueElements = new VueElements();
        $content = $vueElements->renderHead("Account") . $vueElements->renderHeader();
		switch ($selecteur) {
			case 1:
				$content .= $this->render_formulaireInscription();
				break;
			case 2:
				$content .= $this->render_formulaireConnexion();
				break;
			case 3 :
				$content .= $this->render_connexion();
				break;
			case 4 :
				$content .= $this->render_profile();
				break;
			case 5 :
				$content .= $this->render_accessDenied();
				break;
			case 6 :
				$content .= $this->render_formModifCompte();
				break;
			default:
				$content .= "Pas de contenu disponible";
		}
        return $content . $vueElements->renderFooter();
    }

	/**
	 * @return string La chaine html correspondant à un formulaire d'inscription
	 */
	private function render_formulaireInscription(): string {
		$url = $this->container->router->pathFor('inscription');
		return <<<HTML
			<form action='$url' method='POST' class="form-inscription">
			    <h2>INSCRIPTION</h2>
			    
			    <p>Pas de compte ? <a href=''>Se connecter</a></p>
			    
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
	private function render_formulaireConnexion(): string {
		$url = $this->container->router->pathFor('inscription');
		return "<section><h2>Connexion</h2>
            <form action='" . $this->container->router->pathFor('connexion') . "' method='POST' name='formConnex' id='formConnex'>
				<p><label>Pseudo : </label><input type='text' name='username' size=40 required='true'></p>
				<p><label>Password : </label><input type='password' name='password' size=60 required='true'></p>
				<input type='submit' value='Connexion'>
			</form></section>";
	}

	private function render_deconnexion(): string {
		return "<a href ='..'>Accueil</a> <script>window.alert('Vous êtes déconnecté')</script>";
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