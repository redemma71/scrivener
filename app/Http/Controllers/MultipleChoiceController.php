<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Soa\Item;
use App\Soa\MultipleChoice;
use DOMDocument;
use Storage;

class MultipleChoiceController extends Controller
{
    public function generateItems() {

        $select_type = $_POST['select_type'];
        $num_items = $_POST['num_items'];

        // return response()->json(
        // [
        //     'selectType' => "{$select_type}",
        //     'numItems' => "{$num_items}",
        //     'yadda' => 'master_of_my_domain'
        // ]
        // ,200);
    
        $storagePath = Storage::disk('soa')->getDriver()->getAdapter()->getPathPrefix();
    
        for ($i = 1; $i <= $num_items; $i++) {
            $msXML = new MultipleChoice();
            $msItem = $msXML->generateMC($select_type);
            $msItem->save($storagePath . $select_type . '-' . $i . '.xml');
        } 
        return response()-> json(
            [
               'success' => true,
               'message' => 'items created'
            ]
        );
    }
}
