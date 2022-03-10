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
					<div class="container-products-accueil container-large">
						<div class = "category-image-acceuil">
							<img src="assets/img/categories/1.png" alt="" srcset="">
						</div>
						<div class = "category-image-acceuil">
							<img src="assets/img/categories/2.png" alt="" srcset="">
						</div>
						<div class = "category-image-acceuil">
							<img src="assets/img/categories/3.png" alt="" srcset="">
						</div>
						<div class = "category-image-acceuil">
							<img src="assets/img/categories/4.png" alt="" srcset="">
						</div>
						<div class = "category-image-acceuil">
							<img src="assets/img/categories/5.png" alt="" srcset="">
						</div>
					</div>
				</div>
				</main>
HTML;

		$html .= $vueElem->renderFooter();

		return $html;

	}
}