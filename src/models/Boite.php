<?php declare(strict_types=1);

namespace custombox\models;

use Illuminate\Database\Eloquent\Model;

class Boite extends Model {
	protected $table = 'boite';
	protected $primaryKey = 'id';
	public $timestamps = false;

	public function __construct() {

	}
	
	/**
	* Permet de creer une boite
	*/
	public function createBox($taille,$couleur,$message,$id=null){
		$taille=filter_var($taille,FILTER_SANITIZE_STRING);
		$couleur=filter_var($couleur,FILTER_SANITIZE_STRING);
		$message=filter_var($message,FILTER_SANITIZE_STRING);
		if($id!=null){
			$iduser=filter_var($id,FILTER_SANITIZE_NUMBER_INT);
			$this->id_user=$iduser;
		}
		
        $this->taille=$taille;
		$this->couleur=$couleur;
		$this->message=$message;
       
        $this->save();
	}
}









