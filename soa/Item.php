<?php

require_once '../vendor/fzaninotto/faker/src/autoload.php';
require_once 'helpers.php';

class Item {

    function Item() {
        $faker = Faker\Factory::create();

        $this->title = $faker->sentence(2);
        $this->entityType = "assessment-item";
        $this->schemaVersion = "2.15";
        $this->entityVersion = "1.0";
        $this->entityDerivative = "";
    }
        
 
    public function generate() {
    header( "content-type: application/xml; UTF-8" );
        $xml = new DOMDocument("1.0","UTF-8");
        $xml_item = $xml->createElement("cars:assessment-item");
        $xml_item->setAttribute('cgi',generateCGI());
        $xml_item->setAttribute('schema-version',$this->schemaVersion);
        $xml_item->setAttribute('entity-type',$this->entityType);
        $xml_item->setAttribute('entity-version',$this->entityVersion);
        $xml_item->setAttribute('entity-derivative',$this->entityDerivative);
        $xml_title = $xml->createElement("cars:title",$this->title);
        $xml_item->appendChild($xml_title);
        $xml->appendChild($xml_item);
        return $xml->saveXML();
    }

}

?>