<?php declare(strict_types=1);

namespace custombox\vue;

use custombox\vue\Vue;
use Slim\Container;

class VueBoite extends Vue {
	/**
	* Création d'une boite qui amène sur la liste des produits
	*/
	private function render_createBox():String{
		$res="<p>Votre boîte est créée !<a href=\"".
				$this->container->router->pathFor('produits')."\">
				Retour aux produids.</a>";
		return $res;
	}

	/**
	 * Affiche toutes les boites pour les administrateurs
	 */
	private function render_displayBox(): string {
		if ($this->objet !== null) {
			$res = "<section><ol>Toutes les boites :";
			foreach ($this->objet as $l) {
				$res = $res . "<li><p>Numéro : $l->id_boite Etat : $l->etat
				Message : $l->message Poids max : $l->poidsmax Taille : $l->taille</p></li>";
			}
			$res = $res . "</ol></section>";
		} else {
			$res = "<section><p>Il n'y a actuellement aucune boite.</p></section>";
		}

		return $res;
	}

	/**
	 * Formulaire de création d'une boite
	 */
	private function render_formBox(): string {
		$res = "<div><form method=\"POST\" name=\"formboite\" action='" . $this->container->router->pathFor('createBox') . "'>
				<p><label>Taille : </label><input type=\"text\" name=\"taille\" size=40 required=\"true\"></p>
				<p><label>Couleur : </label><input type=\"text\" name=\"couleur\" size=40 required=\"true\"></p>
				<p><label>Message : </label><input type=\"text\" name=\"message\" size=100 required=\"true\"></p>
				<input type='submit' name='ajouterBoite' value='Créer une boite'>
			</form></div>";
		return $res;
	}
	
	/**
	* Listes des boites d'un compte
	*/
	private function render_listesBoites():String{
		if($this->objet!==null){
			$res="<section><ol>Toutes vos boites :";
			foreach($this->objet as $l){
				$res=$res."<li><a href=\"".
				$this->container->router->pathFor('listesPersos')."\">
				<p>Numéro : $l->id_boite Etat : $l->etat
				Message : $l->message Poids max : $l->poidsmax Taille : $l->taille</p></li></a>";
			}
			$res=$res."</ol></section>";
		}
		else{
			$res="<section><p>Il n'y a actuellement aucune boite.</p></section>";
		}

		return $res;
	}
	
	/**
	* Listes des boites d'un compte
	*/
	private function render_contenuBoite():String{
		if($this->objet!==null){
			$res="<section><ol>Toutes vos boites :";
			foreach($this->objet as $l){
				$res=$res."<li><a href=\"".
				$this->container->router->pathFor('listesPersos')."\">
				<p>Numéro : $l->id_boite Etat : $l->etat
				Message : $l->message Poids max : $l->poidsmax Taille : $l->taille</p></li></a>";
			}
			$res=$res."</ol></section>";
		}
		else{
			$res="<section><p>Il n'y a actuellement aucune boite.</p></section>";
		}

		return $res;
	}

	public function render($selecteur): string {
		$vueElements = new VueElements($this->container);
        $content = $vueElements->renderHead("Boites") . $vueElements->renderHeader();
		switch ($selecteur) {
			case 1 : {
				$content .= $this->render_displayBox();
				break;
			}
			case 2 : {
				$content .= $this->render_createBox();
				break;
			}
			case 3 : {
				$content .= $this->render_formBox();
				break;
			}
			case 4 : {
				$content .= $this->render_listesBoites();
				break;
			}
			case 5 : {
				$content .= $this->render_contenuBoite();
				break;
			}
			default :
			{
				$content .= "Pas de contenu<br>";
				break;
			}
		}

		return $content . $vueElements->renderFooter();
	}
}