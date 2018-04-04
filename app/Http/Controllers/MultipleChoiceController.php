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

        $question_type = $_POST['question_type'];
        $num_items = $_POST['num_items'];
    
        $storagePath = Storage::disk('soa')->getDriver()->getAdapter()->getPathPrefix();
    
        if ($question_type == 'multi') {
            for ($i = 1; $i <= $num_items; $i++) {
                $msXML = new MultipleChoice();
                $msItem = $msXML->generateMC($question_type);
                $msItem->save($storagePath . $question_type . '-' . $i . '.xml');
            }
        } elseif ($question_type == 'single') {
            for ($i = 1; $i <= $num_items; $i++) {
                $msXML = new MultipleChoice();
                $msItem = $msXML->generateMC($question_type);
                $msItem->save($storagePath . $question_type . '-' . $i . '.xml');
            }
        } else {
            return;
        }

        return response()-> json(
            [
               'success' => true,
               'message' => 'items created'
            ]
        );
    }
}
