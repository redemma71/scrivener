<?php
namespace App\Soa;

use App\Soa\Item;
use App\Soa\Prompt;
use App\Soa\helpers;
use Faker;
use DOMDocument;
use Storage;
define('CARS_NS','http://www.cengage.com/CARS/2');

require_once 'helpers.php';

class MultipleChoice {

    function __construct() {
        $xml = new Item();
        $this->item = new DOMDocument();
        // append Item XML to this item
        $this->item->loadXML($xml->generate());
        $this->faker = Faker\Factory::create();
    }

    public function generateMC($selectType) {
        header("content-type: application/xml; UTF-8");

        if ($selectType === 'multi') {
            $entity_subtype = 'multi-select';
        } else {
            $entity_subtype = 'single-select';
        } 

        $assessment_items = $this->item->getElementsByTagNameNS(CARS_NS,"assessment");
        $assessment_item = $assessment_items->item(0);
        $assessment_item->setAttribute('entity-subtype',$entity_subtype);
        $multiple_choice = $this->item->createElementNS(CARS_NS,'cars:multiple-choice');
        $multiple_choice->setAttribute('cgi',generateCGI());
        // append prompt & paragraph to cars:multiple-choice
        $prompt_obj = new Prompt();
        $prompt_str = $prompt_obj->createPrompt();
        $prompt_dom = new DOMDocument;
        $prompt_dom->loadXML($prompt_str);
        $prompt_node = $prompt_dom->getElementsByTagName("prompt")->item(0);
        $prompt_node = $this->item->importNode($prompt_node,true);
        $multiple_choice->appendChild($prompt_node);

        // append multi- or single-select
        if ($entity_subtype === 'multi-select') {
            $selection_element = 'cars:multi-select';
        } else {    // single-select
            $selection_element = 'cars:single-select';
        }
        $select = $this->item->createElementNS(CARS_NS,$selection_element);
        $select->setAttribute('order','shuffled');
        $select->setAttribute('options-label','lowercase');
        $multiple_choice->appendChild($select);

        // single- and multi-select
        if ($entity_subtype == 'multi-select') {
            $this->createMultiSelect($select);
        } else {    // single-select
            $this->createSingleSelect($select);
        }
        // append cars:multiple-choice to cars:assessment-item
        $assessment_item->appendChild($multiple_choice);
        $this->item->formatOutput = true;
        return $this->item;
    }

    public function createSingleSelect($select_node) {
        $this->createCorrectOptions($select_node,1);
        $number_incorrect = rand(2,5);
        $this->createIncorrectOptions($select_node,$number_incorrect);
        return $this->item->saveXML();
    }

    public function createMultiSelect($select_node) {
            $number_correct = rand(2,5);
            $this->createCorrectOptions($select_node,$number_correct);
            $number_incorrect = rand(2,5);
            $this->createIncorrectOptions($select_node,$number_incorrect);
            return $this->item->saveXML();
    }    


    public function createCorrectOptions($select_node, $number_correct) {
        for ($i = 0; $i < $number_correct; $i++) {
            $correct_answer = $this->faker->unique()->jobTitle;
            $correct_option_obj = new AnswerOption();
            $correct_option_str= $correct_option_obj->createCorrectOption($correct_answer);
            $correct_option_dom = new DOMDocument();
            $correct_option_dom->loadXML($correct_option_str);
            $correct_option_node = $correct_option_dom->getElementsByTagName("correct-option")->item(0);
            $correct_option_node = $this->item->importNode($correct_option_node,true);
            $select_node->appendChild($correct_option_node);
        }
    }

    public function createIncorrectOptions($select_node, $number_incorrect) {
        for ($j= 0; $j < $number_incorrect; $j++) {
            $incorrect_answer = $this->faker->unique()->jobTitle;
            $incorrect_option_obj = new AnswerOption();
            $incorrect_option_str= $incorrect_option_obj->createIncorrectOption($incorrect_answer);
            $incorrect_option_dom = new DOMDocument();
            $incorrect_option_dom->loadXML($incorrect_option_str);
            $incorrect_option_node = $incorrect_option_dom->getElementsByTagName("incorrect-option")->item(0);
            $incorrect_option_node = $this->item->importNode($incorrect_option_node,true);
            $select_node->appendChild($incorrect_option_node);

//            $incorrect_option = $this->item->createElementNS(CARS_NS,'cars:incorrect-option');
//            $incorrect_option->setAttribute('cgi',generateCGI());
//            // randomize minor attributes here
//            $incorrect_answer = $this->item->createElementNS(CARS_NS,'cars:answer',$this->faker->unique()->jobTitle);
//            $incorrect_option->appendChild($incorrect_answer);
//            $randFeedback = rand(1,10);
//            if ($randFeedback >= 6) {
//                $incorrect_feedback = $this->item->createElementNS(CARS_NS,'cars:feedback');
//                $incorrect_feedback_text =  $this->item->createElementNS(CARS_NS,'cars:paragraph',$this->faker->realText(50));
//                $incorrect_feedback->appendChild($incorrect_feedback_text);
//                $incorrect_option->appendChild($incorrect_feedback);
//            }
//            $select->appendChild($incorrect_option);
        }
    }

}

?>