<?php declare(strict_types=1);

namespace custombox\models;

use Illuminate\Database\Eloquent\Model;

class Typebox extends Model {
	protected $table = 'typebox';
	protected $primaryKey = 'id_modele';
	public $timestamps = false;

	public function __construct() {

	}
	
	/**
	* Permet de creer un type de boite
	*/
	public function createTypeBox($poidsmax,$poidsobjet){
		$poidsmax=filter_var($poidsmax,FILTER_SANITIZE_NUMBER_FLOAT);
		$poidsobjet=filter_var($poidsobjet,FILTER_SANITIZE_NUMBER_FLOAT);
		
		$this->$poidsmax=$poidsmax;
		$this->$poidsobjetmax=$poidsobjet;
       
        $this->save();
	}
	
	/**
	* Permet de modifier une boite
	*/
	public function modifyTypeBox($poidsmax=null,$poidsobjet=null){
		if($poidsmax!=null){
			$poidsmax=filter_var($poidsmax,FILTER_SANITIZE_NUMBER_FLOAT);
			$this->$poidsmax=$poidsmax;
		}
		
		if($poidsmax!=null){
			$poidsobjet=filter_var($poidsobjet,FILTER_SANITIZE_NUMBER_FLOAT);
			$this->$poidsobjetmax=$poidsobjet;
		}
       
        $this->save();
	}
}









