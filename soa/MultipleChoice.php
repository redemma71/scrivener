<?php

require_once 'Item.php';
require_once 'helpers.php';

class MultipleChoice extends Item {

    function MultipleChoice($selectType) {
        $this->xml = new Item;
        if ($selectType == 'multi') {
            $this->entitySubtype = 'multi-select';
        } else {
            $this->entitySubtype = 'single-select';
        }    
    }

    public function generate() {
        $faker = Faker\Factory::create();
        $item = new DOMDocument();
        $item->loadXML($this->xml->generate());
        $assessment_items = $item->getElementsByTagName('cars:assessment-item');
        $assessment_items[0]->setAttribute('entity-subtype',$this->entitySubtype);
        $multiple_choice = $item->createElement('cars:multiple-choice');
        $multiple_choice->setAttribute('cgi',generateCGI());

        // append prompt & paragraph to cars:multiple-choice
        $prompt = $item->createElement('cars:prompt');
        $promptPara = $item->createElement('cars:paragraph',$faker->realText(100)); 
        $prompt->appendChild($promptPara);
        $multiple_choice->appendChild($prompt);

        // single- and multi-select
        if ($this->entitySubtype == 'multi-select') {
            $selectionElement = 'cars:multi-select';
        } else {    // single-select
            $selectionElement = 'cars:single-select';
        }
        $select = $item->createElement($selectionElement);
        $select->setAttribute('order','shuffled');
        $select->setAttribute('options-label','lowercase');
        $multiple_choice->appendChild($select);
        
        // single- and multi-select
        if ($this->entitySubtype == 'multi-select') {
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
        $assessment_items[0]->appendChild($multiple_choice);
        $item->formatOutput = true;
        return $item->saveXML();


  
    }

}

?>