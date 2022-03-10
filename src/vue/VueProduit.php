<?php
declare(strict_types=1);

namespace custombox\vue;
use custombox\models\Categorie;

use Slim\Container;

class VueProduit
{
    protected $objet;
    protected $container;

    public function __construct(Container $c, $ob = null)
    {
        $this->container = $c;
        $this->objet = $ob;
    }

    public function displayProducts() : string
    {
        $products = $this->objet;
        $content = "
		<input type=\"text\" id=\"rechercheProduit\" placeholder=\"Rechercher un produit\"/>
		<div id=\"products-list\">
		<div class='productLine' id='productLineRef'>
			<span class='productLineTitle'>Nom de produit</span>
			<span = class='productLineDescr'>Descriptif</span>
			<span class ='productLineCateg'>Catégorie</span>
			<span class='productLineWeight'>Poids (Kg)</span>
		</div><br><hr><br>";
        foreach ($products as $p) {
            $content .= "<div class='productLine'><span class='productLineTitle'>$p[titre]</span><span = class='productLineDescr'>$p[description]</span><span class ='productLineCateg'>$p[categorie]</span><span class='productLineWeight'>$p[poids]</span></div><br>";
        }
        $content .= "</div>";
        return $content;
    }

    /**
	 * @return string La chaine html correspondant à un formulaire de creation de produit
	 */
	private function render_formulaireCreation(): string {

        $selectBox = "<select name='choixCategorie' class='styleinput'>";
        foreach($this->objet as $categ){
            $selectBox = $selectBox . "<option>$categ[nom]</option>";
        }
        $selectBox = $selectBox . "</select>";

		return "<section><h2>Création d'un nouveau produit</h2>
            <form action='" . $this->container->router->pathFor('createProduct') . "' method='POST' name='formCreateProduct' id='formCreateProduct' enctype='multipart/form-data'>
				<p><label>Nom du produit : </label><input type='text' name='productName' size=40 required='true'></p>
                <p><label>Description du produit : </label><input type='text' name='productDescription' size=40 required='true'></p>
				<p><label>Catégorie du produit : </label>$selectBox</p>
				<p><label>Poids du produit : </label><input type='float' name='productWeight' size=60 required='true'></p>
				<input type='submit' value='Confirmer'>
			</form></section>";
	}

    public function render($selecteur): string
    {
        $content = "";
        switch ($selecteur) {
            case 1:
            {
                $content = $this->displayProducts();
                break;
            }
            case 2 :
            {
                $content = $this->render_formulaireCreation();
                break;
            }
            default:
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
				<link rel=\"stylesheet\" media=\"screen\" type=\"text/css\" href=\"../assets/styles/css/main.css\"/>				<title>sometext</title>
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
