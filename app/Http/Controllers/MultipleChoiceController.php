<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Soa\Test;

class MultipleChoiceController extends Controller
{
    public function generateItem() {
        
        $test = new Test();
        $test->generateItem();

        // $iMax = 4;
        // $jMax = 4;
    
        // for ($i = 0; $i < $iMax; $i++) {
        //     $msXML = new MultipleChoice('multi');
        //     $msItem = $msXML->generate();
        //     print $msItem;
        // } 
    
        // for ($j = 0; $j < $jMax; $j++) {
        //     $ssXML = new MultipleChoice('single');
        //     $ssItem = $ssXML->generate();
        //     print $ssItem;
        // }
    
    }
}
