<?php declare(strict_types = 1);

namespace charlyday\vues;

use charlyday\vues\Vue;
use Slim\Container;

class VueAccueil extends Vue
{	
	/**
	* Accueil
	*/
	private function render_displayAccueil() :String{
		$html = "
			<h1>Accueil</h1>
		";
        return $html;
	}
	
	public function render($selecteur) :String{
		switch ($selecteur) {
			case 1 : {
				$content = $this->render_displayAccueil();
				break;
			}
			default : {
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
						<h1>The Wishlist</h1>
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