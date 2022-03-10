<?php
declare(strict_types=1);

namespace custombox\vue;

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

    public function render($selecteur): string
    {
        $content = "";
        switch ($selecteur) {
            case 1:
            {
                $content = $this->displayProducts();
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
