<?php

namespace App\Soa;

use App\Soa\helpers;
use Faker;
use DOMDocument;

require_once 'helpers.php';

abstract class AbstractComponent {
    
    function __construct() {
        $this->dom = new DOMDocument();
         $this->faker = Faker\Factory::create();
    }

}

?>