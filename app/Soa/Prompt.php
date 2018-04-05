<?php 

namespace App\Soa;

use App\Soa\helpers;
use Faker;
use DOMDocument;

require_once 'helpers.php';

class Prompt {

    function __construct() {
        $this->dom = new DOMDocument();
        $this->faker = Faker\Factory::create();
    }


    function createPrompt() {
        $prompt = $this->dom->createElementNS(CARS_NS,'cars:prompt');
        $promptPara = $this->dom->createElementNS(CARS_NS,'cars:paragraph',$this->faker->realText(100)); 
        $prompt->appendChild($promptPara);
        $this->dom->appendChild($prompt);
        return $this->dom->saveXML($prompt);
    }

}

?>