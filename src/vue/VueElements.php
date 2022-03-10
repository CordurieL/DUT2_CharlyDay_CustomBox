<?php

namespace custombox\vue;

class VueElements {


	public function __construct() {
	}

	function renderHead(string $title) {
		return <<<HTML
        <!DOCTYPE html>
		<html lang='fr'>
			<head>
				<meta charset="UTF-8"/>
				<link rel="stylesheet" href="assets/styles/css/main.min.css"/>
				  <meta name="viewport" content="width=device-width, initial-scale=1.0">
				<title>$title</title>
			</head>
			<body>
HTML;

	}

	function renderHeader() {
		if (isset($_SESSION['id_user'])) {
			$url = $this->container->router->pathFor('inscription');
		}
		return <<<HTML
            <header>
                <nav class="container-large ">
                    <h1>
                        <a href="/">
                            <span class="text-base">L'Atelier </span><span class="text-orange">19</span>.<span class="text-green">71</span>
                        </a>
                    </h1>
                    <a href="">
                        <img src="assets/icons/user.svg" alt="user icon" class="user-icon">
                    </a>
                    
                </nav>
            </header>
            <main>
HTML;
	}
    function renderFooter() {
        return <<<HTML
                    <footer>
                        <nav class="container-large ">
                            <h1>
                                <a href="/">
                                    <span class="text-base">L'Atelier </span><span class="text-orange">19</span>.<span class="text-green">71</span>
                                </a>
                            </h1>                       
                            <a href="" class="text-greyed">CGU</a>
                            <a href="" class="text-greyed">Qui sommes nous?</a>
                        </nav>
                    </footer>
                </body>
            <html>

HTML;
    }
}