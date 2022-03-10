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
	public function createBox($taille,$couleur,$message){
		$taille=filter_var($taille,FILTER_SANITIZE_STRING);
		$couleur=filter_var($couleur,FILTER_SANITIZE_STRING);
		$message=filter_var($message,FILTER_SANITIZE_STRING);
		
        $this->taille=$taille;
		$this->couleur=$couleur;
		$this->message=$message;
       
        $this->save();
	}
	
	/**
	* Permet de modifier une boite
	*/
	public function modifyBox($taille=null,$couleur=null,$message=null){
		if($taille!=null){
			$taille=filter_var($taille,FILTER_SANITIZE_STRING);
			$this->taille=$taille;
		}
		
		if($couleur!=null){
			$couleur=filter_var($couleur,FILTER_SANITIZE_STRING);
			$this->couleur=$couleur;
		}
		
		if($message!=null){
			$message=filter_var($message,FILTER_SANITIZE_STRING);
			$this->message=$message;
		}
		
        $this->save();
	}
}









