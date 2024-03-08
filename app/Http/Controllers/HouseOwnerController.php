<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class HouseOwnerController extends Controller
{
    public function post()  
    {
        return view('boardOwner.post');
    }
}
