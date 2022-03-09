<?php declare(strict_types = 1);

namespace charlyday\vues;
use Slim\Container;

class Vue
{
	protected $objet;
    protected $container;

	public function __construct(Container $c, $ob=null){
        $this->container = $c;
		$this->objet=$ob;
	}
}