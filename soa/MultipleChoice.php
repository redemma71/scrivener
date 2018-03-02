<?php

require_once '../vendor/fzaninotto/faker/src/autoload.php';
require_once './Item.php';
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

    public function generateAnswerOptions() {
        $optionXML = new DOMDocument();
        $option = $optionXML->createElement('cars:test');
        $optionXML->appendChild($option);
        return $optionXML->saveXML($option);
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
        $promptPara = $item->createElement('cars:paragraph',$faker->paragraph(2)); 
        $prompt->appendChild($promptPara);
        $multiple_choice->appendChild($prompt);
        
        // single- and multi-select
        if ($this->entitySubtype == 'multi') {
            $selectionElement = 'cars:multi-select';
        } else {    // single-select
            $selectionElement = 'cars:single-select';
        }
        $select = $item->createElement($selectionElement);
        $select->setAttribute('order','shuffled');
        $select->setAttribute('options-label','lowercase');
        $multiple_choice->appendChild($select);
        
        // answer options
        $answerXML = $this->generateAnswerOptions();
        echo $answerXML;
        // $node = $answerXML->getElementsByTagName('cars:test');
        // echo $node[0]->nodeType;
        //$node = $item->importNode($node->item(0),true);
        //$multiple_choice->appendChild($node);


        // append cars:multiple-choice to cars:assessment-item
        $assessment_items[0]->appendChild($multiple_choice);
        $item->formatOutput = true;
        return $item->saveXML();


  
    }

}

?>