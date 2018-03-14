<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Soa\Test;

class MultipleChoiceController extends Controller
{
    public function generateItem() {
        
        $test = new Test();
        $test->generateItem();
    }
}
