<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BoardersController extends Controller
{
    public function boardersPage()
    {
        $boarders = DB::table('boarders')
            ->where('owner_id', Auth::id()) 
            ->join('users', 'users.id', '=', 'boarders.tenants_id')
            ->get();
        return view('boarders.boarders', compact('boarders'));
    }
    public function boarderReservationPage(){
        $boarderreservations = DB::table('reservations')
        ->where('tenants_id', Auth::id()) 
        ->join('post','post.owner_id','=','reservations.owner_id')
        ->join('rooms','rooms.room_id','=','reservations.room_id')
        ->join('users','users.id','=','post.owner_id')
        ->get();
        return view('boarders.boardersreservation',compact('boarderreservations'));
    }
    public function studentBoarders(){
        $studentboarders = DB::table('boarders')
        ->where('tenants_id', Auth::id()) 
        // ->join('rooms','rooms.room_number','=','boarders.room_number')
        ->join('post','post.owner_id','=','boarders.owner_id')
        ->get();

        $boarderspayments = DB::table('payment_details')
        ->where('tenants_id', Auth::id()) 
        ->join('boarders','payment_details.owner_id','=','boarders.owner_id')
        ->get();
        return view('boarders.studentboarders',compact('studentboarders','boarderspayments'));
    }
    public function updateDate(Request $request, $boarderId)
{
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    DB::table('boarders')
        ->where('boarders_id', $boarderId)
        ->update([
            'start_date' => $startDate,
            'end_date' => $endDate
        ]);

    return redirect()->back()->with('success', 'Boarder dates updated successfully');
}
}
