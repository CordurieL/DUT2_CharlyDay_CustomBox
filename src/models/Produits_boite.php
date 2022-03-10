<?php declare(strict_types=1);

namespace custombox\models;

use Illuminate\Database\Eloquent\Model;

class Produits_boite extends Model {
	protected $table = "produits_boite";
	protected $primaryKey = ['id_produit', 'id_boite'];
	public $incrementing = false;
	public $timestamps = false;

	/**
	 * Set the keys for a save update query.
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	protected function setKeysFor(Builder $query) {
		$keys = $this->getKeyName();
		if (!is_array($keys))
			return parent::setKeysForSaveQuery($query);
		foreach ($keys as $keyName)
			$query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
		return $query;
	}

	/**
	 * Get the primary key value for a save query.
	 *
	 * @param mixed $keyName
	 * @return mixed
	 */
	protected function getKeyFor($keyName = null) {
		if (is_null($keyName))
			$keyName = $this->getKeyName();

		if (isset($this->original[$keyName]))
			return $this->original[$keyName];

		return $this->getAttribute($keyName);
	}
}