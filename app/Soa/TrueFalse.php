<?php

namespace App\Soa;

use App\Soa\Item;
use App\Soa\Prompt;
use App\Soa\Feedback;
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
        $incorrect_option_obj = new AnswerOption();
        if ($correct_answer === 'false') {
            $incorrect_option_str = $incorrect_option_obj->createIncorrectOption('true');
        } else {
            $incorrect_option_str = $incorrect_option_obj->createIncorrectOption('false');
        }
        $incorrect_option_dom = new DOMDocument();
        $incorrect_option_dom->loadXML($incorrect_option_str);
        $incorrect_option_node = $incorrect_option_dom->getElementsByTagName("incorrect-option")->item(0);
        $incorrect_option_node = $this->item->importNode($incorrect_option_node,true);
        $true_false->appendChild($incorrect_option_node);

        $random_overall_feedback = rand(1,10);
        if ($random_overall_feedback > 9) {
            $overall_feedback_obj = new Feedback();
            $overall_feedback_str= $overall_feedback_obj->createFeedback();
            $overall_feedback_dom = new DOMDocument();
            $overall_feedback_dom->loadXML($overall_feedback_str);
            $overall_feedback_node = $overall_feedback_dom->getElementsByTagName("feedback")->item(0);
            $overall_feedback_node = $this->item->importNode($overall_feedback_node,true);
            $true_false->appendChild($overall_feedback_node);
            // $overall_feedback = $this->item->createElementNS(CARS_NS,'cars:feedback');
            // $overall_feedback_text = $this->item->createElementNS(CARS_NS,'cars:paragraph',$this->faker->realText(50));
            // $overall_feedback->appendChild($overall_feedback_text);
            // $true_false->appendChild($overall_feedback);
        }

         // append cars:true-false to cars:assessment-item
         $assessment_item->appendChild($true_false);
         $this->item->formatOutput = true;
         return $this->item;
    }

}

?>