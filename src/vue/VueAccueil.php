<?php declare(strict_types=1);


namespace custombox\vue;

use custombox\vue\Vue;
use Slim\Container;

class VueAccueil extends Vue {
	/**
	 * Accueil
	 */
	private function render_displayAccueil(): string {
		$html="";
		return $html;
	}

	public function render($selecteur): string {
		switch ($selecteur) {
			case 1 :
			{
				$content = $this->render_displayAccueil();
				break;
			}
			default :
			{
				$content = "Pas de contenu<br>";
				break;
			}
		}

        $vueElem = new VueElements();

        $html = $vueElem->renderHead("accueil");
		$html .= $vueElem->renderHeader();
        $html .= <<<HTML
                <div class="center-logo">
					<img src="assets/img/logo/logo_grand.png" alt="" srcset="" class="">
				</div>
				<div>
					
				</div>
				</main>
				<footer>

				</footer>
			</body>
		<html>
HTML;

		return $html;

	}
}