<?php declare(strict_types=1);

namespace charlyday\vues;

use charlyday\vues\Vue;
use Slim\Container;

class VueAccueil extends Vue {
	/**
	 * Accueil
	 */
	private function render_displayAccueil(): string {
		$html = "
			<h1>Accueil</h1>
			<form action='" . $this->container->router->pathFor('test') . "' method='GET'>
				<input type='submit' value='Test'>
			</form>
		";
		return $html;
	}

	private function render_displayTest(): string {
		$html = "
			<h1>Test</h1>
		";
		return $html;
	}

	public function render($selecteur): string {
		switch ($selecteur) {
			case 1 :
			{
				$content = $this->render_displayAccueil();
				break;
			}
			case 2 :
			{
				$content = $this->render_displayTest();
				break;
			}
			default :
			{
				$content = "Pas de contenu<br>";
				break;
			}
		}

		return <<<END
		<!DOCTYPE html>

		<html lang='fr'>
			<head>
				<meta charset='utf-8'>
				<link rel='stylesheet' media='screen' type='text/css' href='web/css/style.css'/>
				<title>sometext</title>
			</head>
			<body>
				<header>
					<nav>
						<h1>The Wishlist</h1>
					</nav>
				</header>
				
				<div class='content'>
					$content
				</div>
				<footer>

				</footer>
			</body>
		<html lang='fr'>
		END;
	}
}