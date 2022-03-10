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
            $categString = Categorie::where("id", "=", $p->categorie)->get("nom")->toArray()[0]["nom"];
            $p["categorie"] = $categString;
        }
        $v = new VueProduit($this->container, $products);
        $rs->getBody()->write($v->render(1));
        return $rs;
    }
}
