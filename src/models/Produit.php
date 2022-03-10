<?php declare(strict_types=1);

namespace custombox\models;

use Illuminate\Database\Eloquent\Model;
use custombox\models\Categorie;

class Produit extends Model
{
    protected $table = 'produit';
    protected $primaryKey = 'id_produit';
    public $timestamps = false;

    public function __construct()
    {
    }

    /**
     * fonction qui permet de creer un nouveau produit
     */
    public function createProduct($productName, $productDescription, $productCategory, $productWeight)
    {
        $this->id_produit = Produit::max('id_produit') + 1;
        $this->titre = $productName;
        $this->description = $productDescription;

		//$categorie = Categorie::where('nom', '=', $productCategory)->get("id_categorie")->toArray()[0]["id_categorie"];
		$categorie = Categorie::where('nom', '=', $productCategory)->first();
        $this->categorie = $categorie->id_categorie;
        $this->poids = $productWeight;
        $this->save();
    }

    
    /**
     * fonction qui permet de modifier un produit deja existant
     */
    public function modify($productName){
        
        if($this->titre != $productName){
            $this->titre = $productName;
            $this->save();
        }
    }

    /**
     * fonction qui permet de set l image du produit
     */
    public function setImage($imageName){
        $this->image = $imageName;
        $this->save();
    }
}
