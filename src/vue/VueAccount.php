<?php declare(strict_types=1);

namespace custombox\vue;

use custombox\models\User;

class VueAccount extends Vue {

	public function render($selecteur): string {
		$vueElements = new VueElements($this->container);
		$content = $vueElements->renderHead("Account") . $vueElements->renderHeader();
		switch ($selecteur) {
			case 1:
				$content .= $this->render_inscription();
				break;
			case 2:
				$content .= $this->render_connexion();
				break;
			case 5 :
				$content .= $this->render_accessDenied();
				break;
			case 6 :
				$content .= $this->render_formModifCompte();
				break;
			case 7 :
				$content .= $this->render_profil();
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
<div class="form-inscription">
    <div class="inscription-left">
        <h3>INFORMATIONS</h3>

        <p>Si vous avez déja un compte, connectez vous</p>
        <a href="/connexion" class="connexion-inscription">connexion</a>

		<img src="/assets/img/logo/logo_grand.png" alt="" srcset="">
    </div>
    <div class="inscription-right">
        <form action='$url' method='POST' class="">
            <h1>INSCRIPTION</h1>

            <div class="inscription-nom-prenom">
                <div class="form-inscription__label">
                    <label>Prénom</label>
                    <input required type='text' name='prenom' placeholder='Prénom'><br>
                </div>
            
                <div class="form-inscription__label">
                    <label>Nom</label>
                    <input required='text' name='nom' placeholder='Nom'><br>
                </div>
            </div>
            <div class="inscription-email">
                <div class="form-inscription__label">
                    <label>E-mail</label>
                    <input required type='text' name='email' placeholder='Adresse e-mail'><br>
                </div>
            </div>

        <div class="inscription-mdp">
            <div class="form-inscription__label">
                <label>Mot de passe</label>
                <input required type='password' name='password' placeholder='Mot de passe'><br>
            </div>
        
            <div class="form-inscription__label">
                <label>Confirmer</label>
                <input required type='password' name='password2' placeholder='Mot de passe'><br>
            </div>
        </div>
        <button type='submit' name='submit' value='inscription'>S'inscrire</button>
        </form>
    </div>
</div>
HTML;
	}

	/**
	 * @return string La chaine html correspondant à un formulaire de connexion
	 */
	private function render_connexion(): string {
		$url = $this->container->router->pathFor('connexion');
		$inscription = $this->container->router->pathFor('inscription');
		return <<<HTML
<div class="form-connexion">
    <div class="connexion-left">
        <h3>INFORMATIONS</h3>

        <p>Si vous n'avez pas de compte, enregistrez vous</p>
        <a href="/inscription" class="connexion-inscription">S'enregistrer</a>

		<img src="/assets/img/logo/logo_grand.png" alt="" srcset="">
    </div>
    <div class="connexion-right">
        <form action='$url' method='POST' class="">
            <h1>SE CONNECTER</h1>
			<p class="form-connexion__label">
						<label>Adresse email : </label>
						<input type='text' name='email' size=40 required='true'>
					</p>
					<p class="form-connexion__label">
						<label>Mot de passe : </label>
						<input type='password' name='password' size=60 required='true'>
					</p>
        	<button type='submit' name='submit' value='connexion'>Se connecter</button>
        </form>
    </div>
</div>
HTML;
	}

	private function render_accessDenied(): string {
		return "Vous n'avez pas accès à cette page";
	}

	private function render_formModifCompte(): string {
		$compte = $this->objet;
		$html = "<section><h2>Modifier mon compte</h2>
        <form action='" . $this->container->router->pathFor('modifCompte') . "' method='POST'>
        <ul>
            <li><input type='text' name='email' value='$compte->email'></li>
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
		$user = User::where('id_user', '=', $_SESSION['id_user'])->first();
		$url = $this->container->router->pathFor('modifCompte');
		return <<<HTML
<div class="form-profil">
    <div class="profil-left">
        <h3>INFORMATIONS</h3>

        <p>Si vous avez fini, retournez à l'accueil</p>
        <a href="/" class="">Accueil</a>

		<img src="/assets/img/logo/logo_grand.png" alt="" srcset="">
    </div>
    <div class="profil-right">
        <form action='$url' method='POST' class="">
            <h1>MES INFORMATIONS</h1>
			<div class="profil-inscription__label profil-nom-prenom">
				<div>
				<label for="nom">Mon nom : </label>
				<input type='nom' name='nom' value='$user->nom'>
				</div>
				<div>
				<label for="prenom">Mon prenom : </label><input type='prenom' name='prenom' value='$user->prenom'>
				</div>



			</div>
			<div class="profil-inscription__label">
				<label for="email">Mon email : </label><input type='text' name='email' value='$user->email'></li>
			</div>
			<div>
				<label for="password">Mon nouveau mot de passe (optionel)</label><input type='password' name='password' placeholder='new password'>
			</div>

        	<button type='submit' name='submit' value='Modifier mon compte'>Mettre à jour</button>
        </form>
    </div>
</div>
HTML;
	}

	private function render_modifCompte() { }
}