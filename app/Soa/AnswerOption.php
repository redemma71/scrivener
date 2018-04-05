<?php

namespace App\Soa;

use App\Soa\helpers;
use Faker;
use DOMDocument;
require_once 'helpers.php';

class AnswerOption {

    function __construct() {
        $this->dom = new DOMDocument();
        $this->correct_random_feedback = rand(1,10);
        $this->incorrect_random_feedback = rand(1,10);
        $this->faker = Faker\Factory::create();
    }

    function createCorrectOption($correct) {
        $correct_option = $this->dom->createElementNS(CARS_NS,'cars:correct-option');
        $correct_option->setAttribute('cgi',generateCGI());
        // if ($correct === 'true' || $correct === 'false') {
            $correct_option->setAttribute('true-false-option-type',$correct);
        // }
        // randomize minor attributes here
        $correct_answer = $this->dom->createElementNS(CARS_NS,'cars:answer',$correct);
        $correct_option->appendChild($correct_answer);
        if ($this->correct_random_feedback >= 6) {
            $correct_feedback = $this->dom->createElementNS(CARS_NS,'cars:feedback',$this->faker->realText(50));
            $correct_option->appendChild($correct_feedback);
        }
        $this->dom->appendChild($correct_option);
        return $this->dom->saveXML($correct_option);
    }

    // public function createIncorrectOption($incorrect_answer) {
    //         $incorrect_option = $this->dom->createElementNS('http://www.cengage.com/CARS/2','cars:incorrect-option');
    //         $incorrect_option->setAttribute('cgi',generateCGI());
    //         // if ($incorrect_answer === 'true' || $incorrect_answer === 'false') {
    //         //     $correct_option->setAttribute('true-false-option-type',$incorrect_answer);
    //         // }
    //         // randomize minor attributes here
    //         $incorrect_answer = $this->dom->createElementNS('http://www.cengage.com/CARS/2','cars:answer',$incorrect_answer);
    //         $incorrect_option->appendChild($incorrect_answer);
    //         if ($this->randomFeedback >= 6) {
    //             $incorrect_feedback = $this->dom->createElementNS('http://www.cengage.com/CARS/2','cars:feedback',$this->faker->realText(50));
    //             $incorrect_option->appendChild($incorrect_feedback);
    //         }
    //         $this->dom->appendChild($incorrect_option);
    //         return $this->dom->saveXML($incorrect_option);
    // }

}

?>