<?php

require_once 'helpers.php';

class MultipleChoice extends Item {

    function MultipleChoice($selectType) {
        if ($selectType == 'multi') {
            $this->entitySubtype = 'multi-select';
        } else {
            $this->entitySubtype = 'single-select';
        }    
    }

    public function generate($xml) {
       
        $item = new DOMDocument();
        $item->loadXML($xml);
        $assessment_items = $item->getElementsByTagName('cars:assessment-item');
        $assessment_items[0]->setAttribute('entity-subtype',$this->entitySubtype);
        $multiple_choice = $item->createElement('cars:multiple-choice');
        $multiple_choice->setAttribute('cgi',generateCGI());
        $assessment_items[0]->appendChild($multiple_choice);
        return $item->saveXML();
  
    }

}

?>