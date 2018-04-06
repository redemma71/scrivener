<?php

namespace App\Soa;

use App\Soa\AbstractComponent;

class Feedback extends AbstractComponent {
    
    function __construct() {
        parent::__construct();
    }

    function createFeedback() {
        $feedback = $this->dom->createElementNS(CARS_NS,'cars:feedback');
        $feedback_paragraph = $this->dom->createElementNS(CARS_NS,'cars:paragraph',$this->faker->realText(100));
        $feedback->appendChild($feedback_paragraph);
        $this->dom->appendChild($feedback);
        return $this->dom->saveXML($feedback);
    }    


}

?>