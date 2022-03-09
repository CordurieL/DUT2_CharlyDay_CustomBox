<?php

namespace charly-day\controleurs;

use Slim\Container;

abstract class Controleur{
	
	protected $container;

    public function __construct(Container $c)
    {
        $this->container = $c;
    }
}












