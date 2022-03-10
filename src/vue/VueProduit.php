<?php
declare(strict_types=1);

namespace custombox\vue;

use custombox\models\Categorie;

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
        $content = <<<HTML
		<input type="text" id="" placeholder="Rechercher un produit"/>
		<div id="\">
		<div class='' id=''>
			<div class=''>Nom de produit</div>
			<div = class=''>Descriptif</div>
			<div class =''>Catégorie</div>
			<div class=''>Poids (Kg)</div>
		</div>"
        <div class="products-container container-large">
HTML;
        foreach ($products as $p) {
            $content .= <<<HTML
            <div class='product'>
                <div class='productLineImage'>
                    <img src='../assets/img/produits/$p[image]' style='max-width: 300px' alt='Image du produit $p[titre]'>
                </div>
                <div class=''>$p[titre]</div>
                <div = class=''>$p[description]</div>
                <div class =''>$p[categorie]</div>
                <div class=''>$p[poids]</div>
            </div>
HTML;
        }
            $content .= "</div>";
        return $content;
    }

    /**
     * @return string La chaine html correspondant à un formulaire de creation de produit
     */
    private function render_formulaireCreation(): string
    {
        $selectBox = "<select name='choixCategorie' class='styleinput'>";
        foreach ($this->objet as $categ) {
            $selectBox = $selectBox . "<option>$categ[nom]</option>";
        }
        $selectBox = $selectBox . "</select>";

		return "<section><h2>Création d'un nouveau produit</h2>
            <form action='" . $this->container->router->pathFor('createProduct') . "' method='POST' name='formCreateProduct' id='formCreateProduct' enctype='multipart/form-data'>
				<p><label>Nom du produit : </label><input type='text' name='productName' size=40 required='true'></p>
                <p><label>Description du produit : </label><input type='text' name='productDescription' size=40 required='true'></p>
				<p><label>Catégorie du produit : </label>$selectBox</p>
				<p><label>Poids du produit : </label><input type='float' name='productWeight' size=60 required='true'></p>
                <label>Uploader une image : </label>
                <input type='file' name='file_img' id='img'>
                </br>
				<input type='submit' value='Confirmer'>
			</form></section>";
    }

    public function render($selecteur): string
    {
        $vueItem = new VueElements($this->container);
        $content = $vueItem->renderHead("Produits") . $vueItem->renderHeader();
        switch ($selecteur) {
            case 1:
            {
                $content .= $this->displayProducts();
                break;
            }
            case 2 :
            {
                $content .= $this->render_formulaireCreation();
                break;
            }
            default:
            {
                $content .= "Pas de contenu<br>";
                break;
            }
        }

        return $content . $vueItem->renderFooter();
    }
}
