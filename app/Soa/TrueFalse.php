<?php

namespace App\Soa;

use App\Soa\Item;
use App\Soa\helpers;
use Faker;
use DomDocument;
use Storage;

require_once 'helpers.php';

class TrueFalse {
    
    function __construct() {
        $xml = new Item();
        $this->item = new DOMDocument();
        // append Item XML to this item
        $this->item->loadXML($xml->generate());
        $this->faker = Faker\Factory::create();
    }

    public function generateTF() {
        header("content-type: application/xml; UTF-8");

        $assessment_items = $this->item->getElementsByTagnameNS("http://www.cengage.com/CARS/2","assessment");
        $assessment_item = $assessment_items->item(0);
        $assessment_item->setAttribute('entity-subtype','true-false');
        $true_false = $this->item->createElementNS('http://www.cengage.com/CARS/2','cars:true-false');
        $true_false->setAttribute('cgi',generateCGI());
        // append prompt and paragraph to cars:true-false
        // this should be abstracted
        $prompt = $this->item->createElementNS('http://www.cengage.com/CARS/2','cars:prompt');
        $promptPara = $this->item->createElementNS('http://www.cengage.com/CARS/2','cars:paragraph',$this->faker->realText(100)); 
        $prompt->appendChild($promptPara);
        $true_false->appendChild($prompt);
        $tFArray = array('true','false');
        $tfRand = rand(0,1);
        $answerIsTOrF = $tFArray[$tfRand];
        
        if ($answerIsTOrF == 'true') {
            // correct option: this should be abstracted
            $correct_option = $this->item->createElementNS('http://www.cengage.com/CARS/2','cars:correct-option');
            $correct_option->setAttribute('cgi',generateCGI());
            $correct_option->setAttribute('true-false-option-type','true');
            // randomize minor attributes here
            $correct_answer = $this->item->createElementNS('http://www.cengage.com/CARS/2','cars:answer','true');
            $correct_option->appendChild($correct_answer);
            $randFeedback = rand(1,10);
            if ($randFeedback >= 6) {
                $correct_feedback = $this->item->createElementNS('http://www.cengage.com/CARS/2','cars:feedback',$this->faker->realText(50));
                $correct_option->appendChild($correct_feedback);
            }
            $true_false->appendChild($correct_option);

            // incorrect option: this should be abstracted
            $incorrect_option = $this->item->createElementNS('http://www.cengage.com/CARS/2','cars:incorrect-option');
            $incorrect_option->setAttribute('cgi',generateCGI());
            $incorrect_option->setAttribute('true-false-option-type','false');
            // randomize minor attributes here
            $incorrect_answer = $this->item->createElementNS('http://www.cengage.com/CARS/2','cars:answer','false');
            $incorrect_option->appendChild($incorrect_answer);
            $randFeedback = rand(1,10);
            if ($randFeedback >= 6) {
                $incorrect_feedback = $this->item->createElementNS('http://www.cengage.com/CARS/2','cars:feedback',$this->faker->realText(50));
                $incorrect_option->appendChild($incorrect_feedback);
            }
            $true_false->appendChild($incorrect_option);

        } else {

          // correct option: 
          // TODO: Use a class here. AnswerOptions.php
          $correct_option = $this->item->createElementNS('http://www.cengage.com/CARS/2','cars:correct-option');
          $correct_option->setAttribute('cgi',generateCGI());
          $correct_option->setAttribute('true-false-option-type','false');
          // randomize minor attributes here
          $correct_answer = $this->item->createElementNS('http://www.cengage.com/CARS/2','cars:answer','false');
          $correct_option->appendChild($correct_answer);
          $randFeedback = rand(1,10);
          if ($randFeedback >= 6) {
              $correct_feedback = $this->item->createElementNS('http://www.cengage.com/CARS/2','cars:feedback');
              $correct_feedback_text =  $this->item->createElementNS('http://www.cengage.com/CARS/2','cars:paragraph',$this->faker->realText(50));
              $correct_feedback->appendChild($correct_feedback_text);
              $correct_option->appendChild($correct_feedback);
          }
          $true_false->appendChild($correct_option);

          // incorrect option
          // TODO: Use a class here. See AnswerOptions.php
          $incorrect_option = $this->item->createElementNS('http://www.cengage.com/CARS/2','cars:incorrect-option');
          $incorrect_option->setAttribute('cgi',generateCGI());
          $incorrect_option->setAttribute('true-false-option-type','true');
          // randomize minor attributes here
          $incorrect_answer = $this->item->createElementNS('http://www.cengage.com/CARS/2','cars:answer','true');
          $incorrect_option->appendChild($incorrect_answer);
          $randFeedback = rand(1,10);
          if ($randFeedback >= 6) {
              $incorrect_feedback = $this->item->createElementNS('http://www.cengage.com/CARS/2','cars:feedback');
              $incorrect_feedback_text =  $this->item->createElementNS('http://www.cengage.com/CARS/2','cars:paragraph',$this->faker->realText(50));
              $incorrect_feedback->appendChild($incorrect_feedback_text);
              $incorrect_option->appendChild($incorrect_feedback);
          }
          $true_false->appendChild($incorrect_option);
        }

        $randOverallFeedback = rand(1,10);
        if ($randOverallFeedback > 9) {
            $overall_feedback = $this->item->createElementNS('http://www.cengage.com/CARS/2','cars:feedback');
            $overall_feedback_text = $this->item->createElementNS('http://www.cengage.com/CARS/2','cars:paragraph',$this->faker->realText(50));
            $overall_feedback->appendChild($overall_feedback_text);
            $true_false->appendChild($overall_feedback);
        }

         // append cars:true-false to cars:assessment-item
         $assessment_item->appendChild($true_false);
         $this->item->formatOutput = true;
         // return $item->save($storagePath.'test.xml');
         return $this->item;
    
    }

}

?>