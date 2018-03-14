<?php 
namespace App\Soa;
use App\Soa\MultipleChoice;
use App\Soa\Item;
use DOMDocument;
use Storage;

class Test {

    public function wassup() {
        echo "What's up?";
    }


    public function generateItem() {
       
        $iMax = 4;
        $jMax = 4;
        $storagePath = Storage::disk('soa')->getDriver()->getAdapter()->getPathPrefix();
    
        for ($i = 1; $i <= $iMax; $i++) {
            $msXML = new MultipleChoice();
            $msItem = $msXML->generateMC('multi');
            $msItem->save($storagePath . 'multi' . $i . '.xml');
        } 
    
        for ($j = 1 ; $j <= $jMax; $j++) {
            $ssXML = new MultipleChoice();
            $ssItem = $ssXML->generateMC('single');
            $ssItem->save($storagePath . 'single' . $j . '.xml');
        }
    }


}

?>