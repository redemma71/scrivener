<?php

namespace App\Soa;

use App\Soa\Item;
use App\Soa\helpers;
use Faker;
use DomDocument;

require_once 'helpers.php';

class MultipleChoice {

    function MultipleChoice() {}

    public function generate($selectType) {
        
        header("content-type: application/xml; UTF-8");
        
        if ($selectType == 'multi') {
            $entitySubtype = 'multi-select';
        } else {
            $entitySubtype = 'single-select';
        } 

        $xml = new Item();
        $item = new DOMDocument();
        $item->loadXML($xml->generate());
        $faker = Faker\Factory::create();
        $assessment_items = $item->getElementsByTagNameNS("http://www.cengage.com/CARS/2","assessment");
        $assessment_item = $assessment_items->item(0);
        $assessment_item->setAttribute('entity-subtype','yadda');
        $multiple_choice = $item->createElement('cars:multiple-choice');
        $multiple_choice->setAttribute('cgi',generateCGI());

        // append prompt & paragraph to cars:multiple-choice
        $prompt = $item->createElement('cars:prompt');
        $promptPara = $item->createElement('cars:paragraph',$faker->realText(100)); 
        $prompt->appendChild($promptPara);
        $multiple_choice->appendChild($prompt);

        // single- and multi-select
        if ($entitySubtype == 'multi-select') {
            $selectionElement = 'cars:multi-select';
        } else {    // single-select
            $selectionElement = 'cars:single-select';
        }
        $select = $item->createElement($selectionElement);
        $select->setAttribute('order','shuffled');
        $select->setAttribute('options-label','lowercase');
        $multiple_choice->appendChild($select);
        
        // single- and multi-select
        if ($entitySubtype == 'multi-select') {
            $numCorrect = rand(2,5);
            $numIncorrect = rand(1,5);
            for ($i = 0; $i < $numCorrect; $i++) {
                $correct_option = $item->createElement("cars:correct-option");
                $correct_option->setAttribute('cgi',generateCGI());
                // randomize minor attributes here
                $correct_answer = $item->createElement("cars:answer",$faker->unique()->colorName);
                $correct_option->appendChild($correct_answer);
                $randFeedback = rand(1,10);
                if ($randFeedback >= 6) {
                    $correct_feedback = $item->createElement('cars:feedback',$faker->realText(50));
                    $correct_option->appendChild($correct_feedback);
                }
                $multiple_choice->appendChild($correct_option);
            }    

            for ($j= 0; $j < $numIncorrect; $j++) {
                $incorrect_option = $item->createElement("cars:incorrect-option");
                $incorrect_option->setAttribute('cgi',generateCGI());
                // randomize minor attributes here
                $incorrect_answer = $item->createElement("cars:answer",$faker->unique()->colorName);
                $incorrect_option->appendChild($incorrect_answer);
                $randFeedback = rand(1,10);
                if ($randFeedback >= 6) {
                    $incorrect_feedback = $item->createElement('cars:feedback',$faker->realText(50));
                    $incorrect_option->appendChild($incorrect_feedback);
                }
                $multiple_choice->appendChild($incorrect_option);
            }
        } else {    // single-select
            $correct_option = $item->createElement("cars:correct-option");
            $correct_option->setAttribute('cgi',generateCGI());
            $correct_answer = $item->createElement("cars:answer",$faker->unique()->jobTitle);
                $correct_option->appendChild($correct_answer);
                $randFeedback = rand(1,10);
                if ($randFeedback >= 6) {
                    $correct_feedback = $item->createElement('cars:feedback',$faker->realText(50));
                    $correct_option->appendChild($correct_feedback);
                }
            $multiple_choice->appendChild($correct_option);
            
            $numIncorrect = rand(1,5);
            for ($j= 0; $j < $numIncorrect; $j++) {
                $incorrect_option = $item->createElement("cars:incorrect-option");
                $incorrect_option->setAttribute('cgi',generateCGI());
                // randomize minor attributes here
                $incorrect_answer = $item->createElement("cars:answer",$faker->jobTitle);
                $incorrect_option->appendChild($incorrect_answer);
                $randFeedback = rand(1,10);
                if ($randFeedback >= 6) {
                    $incorrect_feedback = $item->createElement('cars:feedback',$faker->realText(50));
                    $incorrect_option->appendChild($incorrect_feedback);
                }
                $multiple_choice->appendChild($incorrect_option);
            }
        }

        // append cars:multiple-choice to cars:assessment-item
        // $item->appendChild($multiple_choice);
        $assessment_item->appendChild($multiple_choice);
        $item->formatOutput = true;
        return $item->saveXML();
    }

}

?>