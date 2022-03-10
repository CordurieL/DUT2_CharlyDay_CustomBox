<?php declare(strict_types=1);

namespace custombox\models;

use Illuminate\Database\Eloquent\Model;
use custombox\models\Categorie;

class Produit extends Model {
	protected $table = 'produit';
	protected $primaryKey = 'id';
	public $timestamps = false;

	public function __construct() {

	}

	/**
	 * fonction qui permet de creer un nouveau produit
	 */
	public function createProduct($productName, $productDescription, $productCategory, $productWeight){
		$this->id = Produit::max('id') + 1;
		$this->titre = $productName;
		$this->description = $productDescription;
		$categorie = Categorie::where('nom', '=', $productCategory)->first()->get("id")->toArray()[0]["id"];
		$this->categorie = $categorie;
		$this->poids = $productWeight;
		$this->save();
	}
}











