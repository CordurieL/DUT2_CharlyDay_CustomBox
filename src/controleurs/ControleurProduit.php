<?php
declare(strict_types=1);

namespace custombox\controleurs;

use custombox\exceptions\AuthException;
use custombox\models\Produit;
use custombox\models\Categorie;
use custombox\vue\VueAccount;
use custombox\vue\VueProduit;
use custombox\controleurs\Controleur;
use custombox\models\Boite;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

class ControleurProduit extends Controleur
{
    public function __construct(Container $c)
    {
        parent::__construct($c);
    }

    /**
     * Affichage de l ensemble des produits
     */
    public function displayProducts(Request $rq, Response $rs, array $args): Response
    {
        $products = Produit::all();
        foreach ($products as $p) {
            $categString = Categorie::where("id_categorie", "=", $p->categorie)->get("nom")->toArray()[0]["nom"];
            $p["categorie"] = $categString;
        }
        $v = new VueProduit($this->container, $products);
        $rs->getBody()->write($v->render(1));
        return $rs;
    }

    /**
     * cree un formulaire pour que l administrateur puisse creer un nouveau produit
     * @return string chaine html qui contient le formulaire
     */
    public function formCreateProduct(Request $rq, Response $rs, array $args): Response
    {
        $categories = Categorie::all();
        // on prepare le formulaire pour que l admin puisse creer un produit
        $vue = new VueProduit($this->container, $categories);
        $html = $vue->render(2);
        $rs->getBody()->write($html);
        return($rs);
    }

    /**
     * fonction qui creer le produit
     */
    public function createProduct(Request $rq, Response $rs, array $args): Response
    {
        // on recupere les donnees du nouveau produit
        $data = $rq->getParsedBody();
        $productName = filter_var($data['productName'], FILTER_SANITIZE_STRING);
        $productCategory = filter_var($data['choixCategorie'], FILTER_SANITIZE_STRING);
        $productDescription = filter_var($data['productDescription'], FILTER_SANITIZE_STRING);
        $productWeight = filter_var($data['productWeight'], FILTER_SANITIZE_NUMBER_FLOAT);
        $newProduct = new Produit();

		// on cree le produit
		$newProduct->createProduct($productName, $productDescription, $productCategory, $productWeight);

		/**
		 * en cas d upload de fichier on verifie que c est bien une image
		 */
		if(isset($_FILES["file_img"])){
			// si une image etait donnee par upload on va verifier qu elle est recevable
			$image_name = $_FILES['file_img']['name'];
			$image_temp_name = $_FILES['file_img']['tmp_name'];
			$image_type = $_FILES['file_img']['type'];
			$repertoire = getcwd() . "/assets/img/produits/";
			$fichierAutorisee = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
		
			// on verifie l extension
			$extension = pathinfo($image_name, PATHINFO_EXTENSION);
			if(array_key_exists($extension, $fichierAutorisee)){
				
				// on verifie le type de fichier
				if(in_array($image_type, $fichierAutorisee)){
		
					$nom_image = $newProduct->id_produit . "." . $extension;
					move_uploaded_file($image_temp_name, $repertoire . $nom_image);
				}
			}
			$newProduct->setImage($nom_image);
		}

        // on revoie sur la page ou sont tous les produits
        return($rs->withRedirect($this->container->router->pathFor("produits")));
    }
}
