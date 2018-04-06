<?php 

namespace App\Soa;

use App\Soa\AbstractComponent;

class Prompt extends AbstractComponent {

    function __construct() {
        parent::__construct();
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