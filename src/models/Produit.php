<?php declare(strict_types=1);

namespace custombox\models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model {
	protected $table = 'produit';
	protected $primaryKey = 'id';
	public $timestamps = false;

	public function __construct() {

	}
}











