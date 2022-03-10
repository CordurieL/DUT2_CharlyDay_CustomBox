<?php declare(strict_types=1);

namespace custombox\vue;

use custombox\vue\Vue;
use Slim\Container;

class VueBoite extends Vue {

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