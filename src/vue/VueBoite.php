<?php declare(strict_types=1);

namespace custombox\vue;

use custombox\vue\Vue;
use Slim\Container;

class VueBoite extends Vue {
	/**
	* Création d'une boite qui amène sur la liste des produits
	*/
	private function render_createBox():String{
		return $res;
	}
		
	/**
	* Affiche toutes les boites pour les administrateurs
	*/
	private function render_displayBox():String{
		if($this->objet!==null){
			$res="<section><ol>Toutes les boites :";
			foreach($this->objet as $l){
				$res=$res."<li><p>Numéro : $l->id_boite Etat : $l->etat
				Message : $l->message Poids max : $l->poidsmax Taille : $l->taille</p></li>";
			}
			$res=$res."</ol></section>";
		}
		else{
			$res="<section><p>Il n'y a actuellement aucune boite.</p></section>";
		}

		return $res;
	}
	
	/**
	* Formulaire de création d'une boite
	*/
	private function render_formBox():String{
		$res="<div><form action='".$this->container->router->pathFor('createBox')."'>
				<p><label>Taille : </label><input type=\"text\" name=\"taille\" size=40 required=\"true\"></p>
				<p><label>Couleur : </label><input type=\"text\" name=\"couleur\" size=40 required=\"true\"></p>
				<p><label>Message : </label><input type=\"text\" name=\"message\" size=100 required=\"true\"></p>
				<input type='submit' name='ajouterBoite' value='Créer une boite'>
			</form></div>";
		return $res;
	}

	public function render($selecteur): string {
		switch ($selecteur) {
			case 1 : {
				$content = $this->render_displayBox();
				break;
			}
			case 2 : {
				$content = $this->render_createBox();
				break;
			}
			case 3 : {
				$content = $this->render_formBox();
				break;
			}
			default :
			{
				$content = "Pas de contenu<br>";
				break;
			}
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
						<h1><a href =" . $this->container->router->pathFor("accueil") . ">The Wishlist</a></h1>
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
}