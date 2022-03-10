<?php declare(strict_types=1);

namespace custombox\models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model {

	protected $table = "categorie";
	protected $primaryKey = "id";
	public $timestamps = false;
}