<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Soa\Item;
use App\Soa\TrueFalse;
use DOMDocument;
use Storage;

class TrueFalseController extends Controller
{
    public function generateItems() {

        $question_type = $_POST['question_type'];
        $num_items = $_POST['num_items'];
    
        $storagePath = Storage::disk('soa')->getDriver()->getAdapter()->getPathPrefix();
    
        for ($i = 1; $i <= $num_items; $i++) {
            $tfXML = new TrueFalse();
            $tfItem = $tfXML->generateTF();
            $tfItem->save($storagePath . $question_type . '-' . $i . '.xml');
        }

        return response()-> json(
            [
               'success' => true,
               'message' => 'items created'
            ]
        );
    }
}