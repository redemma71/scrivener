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
            $entitySubtype = 'multi-select';
        } else {
            $entitySubtype = 'single-select';
        } 

        $assessment_items = $this->item->getElementsByTagNameNS(CARS_NS,"assessment");
        $assessment_item = $assessment_items->item(0);
        $assessment_item->setAttribute('entity-subtype',$entitySubtype);
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
        if ($entitySubtype === 'multi-select') {
            $selectionElement = 'cars:multi-select';
        } else {    // single-select
            $selectionElement = 'cars:single-select';
        }
        $select = $this->item->createElementNS(CARS_NS,$selectionElement);
        $select->setAttribute('order','shuffled');
        $select->setAttribute('options-label','lowercase');
        $multiple_choice->appendChild($select);

        // single- and multi-select
        if ($entitySubtype == 'multi-select') {
            $this->createMultiSelect($select);
        } else {    // single-select
            $this->createSingleSelect($select);
        }
        // append cars:multiple-choice to cars:assessment-item
        $assessment_item->appendChild($multiple_choice);
        $this->item->formatOutput = true;
        // return $item->save($storagePath.'test.xml');
        return $this->item;
    }

    public function createSingleSelect($select) {
        $this->createCorrectOptions($select,1); 
        $numIncorrect = rand(1,5);
        $this->createIncorrectOptions($select);
        return $this->item->saveXML();
    }

    public function createMultiSelect($select) {
            $numCorrect = rand(2,5);
            $this->createCorrectOptions($select,$numCorrect);    
            $numIncorrect = rand(1,5);
            $this->createIncorrectOptions($select);
            return $this->item->saveXML();
    }    


    public function createCorrectOptions($select,$numCorrect) {
        for ($i = 0; $i < $numCorrect; $i++) {
            $correct_option = $this->item->createElementNS(CARS_NS,'cars:correct-option');
            $correct_option->setAttribute('cgi',generateCGI());
            // randomize minor attributes here
            $correct_answer = $this->item->createElementNS(CARS_NS,'cars:answer',$this->faker->unique()->jobTitle);
            $correct_option->appendChild($correct_answer);
            $randFeedback = rand(1,10);
            if ($randFeedback >= 6) {
                $correct_feedback = $this->item->createElementNS(CARS_NS,'cars:feedback');
                $correct_feedback_text =  $this->item->createElementNS(CARS_NS,'cars:paragraph',$this->faker->realText(50));
                $correct_feedback->appendChild($correct_feedback_text);
                $correct_option->appendChild($correct_feedback);
            }
            $select->appendChild($correct_option);
        }
    }

    public function createIncorrectOptions($select) {
        for ($j= 0; $j < 5; $j++) {
            $incorrect_option = $this->item->createElementNS(CARS_NS,'cars:incorrect-option');
            $incorrect_option->setAttribute('cgi',generateCGI());
            // randomize minor attributes here
            $incorrect_answer = $this->item->createElementNS(CARS_NS,'cars:answer',$this->faker->unique()->jobTitle);
            $incorrect_option->appendChild($incorrect_answer);
            $randFeedback = rand(1,10);
            if ($randFeedback >= 6) {
                $incorrect_feedback = $this->item->createElementNS(CARS_NS,'cars:feedback');
                $incorrect_feedback_text =  $this->item->createElementNS(CARS_NS,'cars:paragraph',$this->faker->realText(50));
                $incorrect_feedback->appendChild($incorrect_feedback_text);
                $incorrect_option->appendChild($incorrect_feedback);
            }
            $select->appendChild($incorrect_option);
        }
    }

}

?>