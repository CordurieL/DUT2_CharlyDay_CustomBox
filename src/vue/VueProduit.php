<?php
declare(strict_types=1);

namespace custombox\vue;

use custombox\models\Categorie;

use Slim\Container;

class VueProduit
{
    protected $objet;
    protected $container;
    protected array $tab;

    public function __construct(Container $c, $ob = null, $t = [])
    {
        $this->container = $c;
        $this->objet = $ob;
        $this->tab = $t;
    }

    public function displayProducts() : string
    {
        $products = $this->objet;
        $searchBarContent = $this->tab[0];
        $selectBox = "<select name=\"choixCategorie\" class='styleinput'>";
        $selectBox = $selectBox . "<option value=\"0\">Tous</option>";
        foreach ($this->tab[1] as $categ) {
            if ($categ['id_categorie'] == $this->tab[2]) {
                $selectBox = $selectBox . "<option value='$categ[id_categorie]' selected='selected'>$categ[nom]</option>";
            } else {
                $selectBox = $selectBox . "<option value='$categ[id_categorie]'>$categ[nom]</option>";
            }
        }
        $selectBox = $selectBox . "</select>";
        $content = <<<HTML
        <form method='POST' name='formSearchbar' id='formSearchbar'>
		    <input type="text" class = "search-product" name="searchbar" id="" placeholder="Rechercher un produit" value='$searchBarContent'/>
            <p><label>Catégorie du produit : </label>$selectBox</p>
            <input type='submit' value='Rechercher'>
        </form>
		<div id="\">
		<div class='' id=''>
			<div class=''>Nom de produit</div>
			<div class=''>Descriptif</div>
			<div class =''>Catégorie</div>
			<div class=''>Poids (Kg)</div>
		</div>
        <div class="products-container container-large">
HTML;
        foreach ($products as $p) {
            $numProd = $p['id_produit'];
            $urlAddPanier = $this->container->router->pathFor('ajouterPanier', ['id_product'=>$numProd]);
            echo $urlAddPanier;
            $content .= <<<HTML
            <div class='product'>
                <div class='productLineImage'>
                    <img src='../assets/img/produits/$p[image]' style='max-width: 300px' alt='Image du produit $p[titre]'>
                </div>
                <div class=''>$p[titre]</div>
                <div class=''>$p[description]</div>
                <div class =''>$p[categorie]</div>
                <div class=''>$p[poids]</div>
                    <a href='$urlAddPanier' name='addButton'>Ajouter</a>
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

    /**
     * @return string La chaine html correspondant à un formulaire de modification
     */
    private function render_formulaireModification(): string
    {
        $url = $this->container->router->pathFor('modifyProduct');
        $url_retour = $this->container->router->pathFor('produits');
        $produit = $this->objet;
        return <<<HTML
        <section>
            <a href=$url_retour><button>Retourner au listing des items</button></a>
            <h2>Modification du produit "$produit->titre"</h2>
            <form action=$url method='POST' name='formCreateProduct' id='formCreateProduct' enctype='multipart/form-data'>
                <input type='hidden' name="id_product" value=$produit->id_produit>
				<p><label>Nouvelle désignation du produit : </label><input type='text' name='productName' size=40 required='true'></p>
                <label>Voulez-vous changer l'image ? </label>
                <input type='file' name='file_img' id='img'>
                </br>
				<input type='submit' value='Confirmer'>
			</form>
        </section>
HTML;
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
            case 3 :
            {
                $content .= $this->render_formulaireModification();
            }
            default:
            {
                $content .= "Pas de contenu<br>";
                break;
            }
        }

        $vueElem = new VueElements($this->container);

        $html = $vueElem->renderHead("Produits");
        $html .= $vueElem->renderHeader();

        $html .=
           "	
                <div class=\"content\">
					$content
				</div>
				</main>";
        return $content . $vueItem->renderFooter();

        return $html;
    }
}
