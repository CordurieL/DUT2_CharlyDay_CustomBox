<?php declare(strict_types=1);


namespace custombox\vue;

use custombox\vue\Vue;
use Slim\Container;

class VueAccueil extends Vue {
	/**
	 * Accueil
	 */
	private function render_displayAccueil(): string {
		$html = "<section><h2>Que voulez-vous faire ?</h2>
			<form action='" . $this->container->router->pathFor('listesPubliques') . "' method='GET'>
				<input type='submit' value='Consulter les listes publiques'>
			</form>

			<form action='" . $this->container->router->pathFor('formCheckList') . "' method ='GET'>
			    <input type='submit' value='Voir une liste partagée'>

			</form>";
		// Si l'utilisateur n'est pas connecté :
		if (!isset($_SESSION['profile'])) {
			$html .= "<form action = \"" . $this->container->router->pathFor('formInscription') . "\" method='GET'>
			    <input type='submit' value=\"S'inscrire\">
            </form>
            <form action=\"" . $this->container->router->pathFor('formConnexion') . "\" method='GET'>
			    <input type='submit' value=\"Se connecter\">
            </form></section>
		";
		} // Si il est connecté
		else {
			$html .= "
                <form action =" . $this->container->router->pathFor('listesPersos') . " method='GET'>
                    <input type='submit' value='Voir mes listes'>
                </form>
                <form action = '" . $this->container->router->pathFor('voirProfil') . "' method='GET'>
			        <input type='submit' value='Voir mon profil'>
                </form>
                <form action = '" . $this->container->router->pathFor('deconnexion') . "' method='GET'>
			        <input type='submit' value='Se déconnecter'>
                </form></section>";

		}
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
                <div class="content\">
					$content
				</div>
				<footer>

				</footer>
			</body>
		<html>
HTML;

		return $html;

	}
}