<?php

namespace custombox\vue;

class VueElements extends Vue {
	function renderHead(string $title): string
    {
		return <<<HTML
        <!DOCTYPE html>
		<html lang='fr'>
			<head>
				<meta charset="UTF-8"/>
				<link rel="stylesheet" href="/assets/styles/css/main.min.css"/>
				  <meta name="viewport" content="width=device-width, initial-scale=1.0">
				<title>$title</title>
			</head>
			<body>
HTML;
	}

	function renderHeader(): string
    {
		if (isset($_SESSION['id_user']))
			$url = $this->container->router->pathFor('profil');
		else
			$url = $this->container->router->pathFor('inscription');
		return <<<HTML
            <header>
                <nav class="container-large">
                    <h1>
                        <a href="/">
                            <span class="text-base">L'Atelier </span><span class="text-orange">19</span>.<span class="text-green">71</span>
                        </a>
                    </h1>

                    <div class="icons-container">
                        <a href="/creationBoite">
                            <img src="/assets/icons/shopping-bag.svg" alt="user icon" class="icon">
                        </a>
                        <a href=$url>
                            <img src="/assets/icons/user.svg" alt="user icon" class="icon">
                        </a>
                        
                    </div>

                   

                </nav>
            </header>
            <main>
HTML;
	}

	function renderFooter() {
		return <<<HTML
                </main>
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