<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class AdminController extends Controller
{
    public function houseowners(){
        $homeowners = DB::table('users')
        ->where('user_type', 'homeowner')
        ->get();
        return view ('adminpage.houseowners',['homeowners' => $homeowners]);
    }
    public function studentregisters()
{
    $students = DB::table('users')
        ->where('user_type', 'student')
        ->get();

    return view('adminpage.students', ['students' => $students]);
}

}
