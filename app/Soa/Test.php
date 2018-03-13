<?php 
namespace App\Soa;
use App\Soa\MultipleChoice;
use App\Soa\Item;
use DOMDocument;

class Test {

    public function wassup() {
        echo "What's up?";
    }


    public function generateItem() {
       
        // $test = new Item();
        // $item = new DOMDocument();
        // $item->loadXML($test->generate());
        // echo $item->saveXML();

        $msXML = new MultipleChoice();
        $msItem = $msXML->generate('multi');
        print $msItem;

        // $iMax = 4;
        // $jMax = 4;
    
        // for ($i = 0; $i < $iMax; $i++) {
        //     $msXML = new MultipleChoice();
        //     $msItem = $msXML->generate('multi');
        //     print $msItem;
        // } 
    
        // for ($j = 0; $j < $jMax; $j++) {
        //     $ssXML = new MultipleChoice();
        //     $ssItem = $ssXML->generate('single');
        //     print $ssItem;
        // }
    }


}

?>