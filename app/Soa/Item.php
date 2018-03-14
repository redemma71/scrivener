<?php

namespace App\Soa;

use App\Soa\helpers;
use Faker;
use DomDocument;

require_once 'helpers.php';

class Item {

    function Item() {}
    
    public function generate() {
        header( 'content-type: application/xml; UTF-8' );
        $faker = Faker\Factory::create();
        $title = $faker->lexify('Select Assessment ????');
        $xml = new DOMDocument('1.0','UTF-8');
        $xml_item = $xml->createElementNS('http://www.cengage.com/CARS/2','cars:assessment');
        $xml_item->setAttribute('cgi',generateCGI());
        $xml_item->setAttribute('schema-version','2.15');
        $xml_item->setAttribute('entity-type','assessment-item');
        $xml_item->setAttribute('entity-version','1.0');
        $xml_item->setAttribute('entity-derivative',' ');
        $xml_title = $xml->createElement('cars:title',$title);
        $xml_item->appendChild($xml_title);
        $xml->appendChild($xml_item);
        return $xml->saveXML();
    }
}

?>