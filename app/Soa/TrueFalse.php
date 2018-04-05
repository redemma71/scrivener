<?php

namespace App\Soa;

use App\Soa\Item;
use App\Soa\Prompt;
use App\Soa\AnswerOption;
use App\Soa\helpers;
use Faker;
use DOMDocument;
use Storage;
define('CARS_NS','http://www.cengage.com/CARS/2');

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

        $assessment_items = $this->item->getElementsByTagNameNS(CARS_NS,"assessment");
        $assessment_item = $assessment_items->item(0);
        $assessment_item->setAttribute('entity-subtype','true-false');
        $true_false = $this->item->createElementNS(CARS_NS,'cars:true-false');
        $true_false->setAttribute('cgi',generateCGI());
        
        // append prompt and paragraph to cars:true-false
        $prompt_obj = new Prompt();
        $prompt_str = $prompt_obj->createPrompt();
        $prompt_dom = new DOMDocument;
        $prompt_dom->loadXML($prompt_str);
        $prompt_node = $prompt_dom->getElementsByTagName("prompt")->item(0);
        $prompt_node = $this->item->importNode($prompt_node,true);
        $true_false->appendChild($prompt_node);
        
        // append correct-option
        $tf_array = array('true','false');
        $tf_array_rand = array_rand($tf_array);
        $correct_answer = $tf_array[$tf_array_rand];
        $correct_option_obj = new AnswerOption();
        $correct_option_str= $correct_option_obj->createCorrectOption($correct_answer);
        $correct_option_dom = new DOMDocument();
        $correct_option_dom->loadXML($correct_option_str);
        $correct_option_node = $correct_option_dom->getElementsByTagName("correct-option")->item(0);
        $correct_option_node = $this->item->importNode($correct_option_node,true);
        $true_false->appendChild($correct_option_node);

        // incorrect option
        $incorrect_option = $this->item->createElementNS(CARS_NS,'cars:incorrect-option');
        $incorrect_option->setAttribute('cgi',generateCGI());
        $incorrect_option->setAttribute('true-false-option-type','false');
        // randomize minor attributes here
        $incorrect_answer = $this->item->createElementNS(CARS_NS,'cars:answer','false');
        $incorrect_option->appendChild($incorrect_answer);
        $randFeedback = rand(1,10);
        if ($randFeedback >= 6) {
            $incorrect_feedback = $this->item->createElementNS(CARS_NS,'cars:feedback',$this->faker->realText(50));
            $incorrect_option->appendChild($incorrect_feedback);
        }
        $true_false->appendChild($incorrect_option);

        $randOverallFeedback = rand(1,10);
        if ($randOverallFeedback > 9) {
            $overall_feedback = $this->item->createElementNS(CARS_NS,'cars:feedback');
            $overall_feedback_text = $this->item->createElementNS(CARS_NS,'cars:paragraph',$this->faker->realText(50));
            $overall_feedback->appendChild($overall_feedback_text);
            $true_false->appendChild($overall_feedback);
        }

         // append cars:true-false to cars:assessment-item
         $assessment_item->appendChild($true_false);
         $this->item->formatOutput = true;
         return $this->item;
    
    }

}

?>