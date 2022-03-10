<?php declare(strict_types=1);

namespace custombox\vue;

use Slim\Container;

class VueProduit {
	protected $objet;
	protected $container;

	public function __construct(Container $c, $ob = null) {
		$this->container = $c;
		$this->objet = $ob;
	}

	public function render($selecteur): string {
		switch ($selecteur) {
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
				<link rel=\"stylesheet\" media=\"screen\" type=\"text/css\" href=\"web/css/style.css\"/>
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