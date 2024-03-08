<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class BoardingHouseController extends Controller
{
    public function boardinghouse(){
       
        $posts = DB::table('post')
        ->get();

        return view('boardinghouse.boardinghouse', ['posts' => $posts]);
    }

    public function reservationPage($post_id, $owner_id) {
        $rooms = DB::table('rooms')
            ->where('rooms.post_id', $post_id)
            ->get();
        $post  = DB::table('post')
            ->where('owner_id',$owner_id)
            ->first();
        $owner = DB::table('users')
            ->where('id', $owner_id)
            ->first();
    
        $payments = DB::table('payment_details')
            ->where('owner_id', $owner_id)
            ->get();
    
        $reservations = DB::table('reservations')
            ->where('owner_id', $owner_id)
            ->get();
        $roomTenantsCount = [];
            foreach ($rooms as $room) {
                $roomTenantsCount[$room->room_id] = DB::table('boarders')
                    ->where('room_id', $room->room_id)
                    ->count();
            }
        return view('boardinghouse.reservation', compact('rooms', 'payments', 'owner', 'reservations','post','roomTenantsCount'));
    }
    
    
    
    
    
    public function createreservation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'room_id' => 'required',
            'room_number' => 'required',
            'owner_id' => 'required',
            'reservation_file' => 'required|image|max:2048',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $tenant_id = Auth::id();
        $roomId = $request->input('room_id');
        $roomNumber = $request->input('room_number');
        $ownerId = $request->input('owner_id');
        $reservationFile = $request->file('reservation_file');
    
        if ($reservationFile) {
            $fileName = $tenant_id . '_' . time() . '_' . uniqid() . '.' . $reservationFile->getClientOriginalExtension();
    
            $filePath = 'public/reservation_file/' . $fileName;
            Storage::disk('local')->put($filePath, file_get_contents($reservationFile));
    
            DB::table('reservations')->insert([
                'tenants_id' => $tenant_id,
                'room_id' => $roomId,
                'owner_id' => $ownerId,
                'room_number' => $roomNumber,
                'reservation_file' => $fileName,
                'res_void' => 0,
            ]);
            DB::table('rooms')->where('room_id', $roomId)->where('room_number', $roomNumber)->update(['status' => 'In Reservation']);
            return redirect()->back()->with('success', 'Reservation created successfully.');
        } else {
            return redirect()->back()->with('error', 'File is empty or missing.');
        }
    }

    public function acceptReservation(Request $request)
    {
        $id = $request->input('id');
        $room_number = $request->input('room_number');
        $owner_id = $request->input('owner_id');
        $res_id = $request->input('res_id');
        $room_id = $request->input('room_id');
        
        $boarders_add = DB::table('boarders')->insert([
            'room_id' => $room_id,
            'room_number' => $room_number,
            'tenants_id' => $id,
            'owner_id' => $owner_id,
            'start_date' => now(),
            'end_date' => Carbon::parse(now())->addDays(30),
        ]);
        
        if ($boarders_add) {
            DB::table('reservations')
                ->where('res_id', $res_id)
                ->where('tenants_id', $id)
                ->where('owner_id', $owner_id)
                ->where('room_number', $room_number)
                ->update(['res_void' => 1]);
            
            DB::table('rooms')
                ->where('room_id', $room_id)
                ->where('room_number', $room_number)
                ->update(['status' => 'Occupied']);
            
            return redirect()->route('rooms')->with('success', 'Reservation accepted successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to accept reservation.');
        }
    }
    
    
    


    public function deleteReservation($res_id, $room_id)
{
    $reservation = DB::table('reservations')->where('res_id', $res_id)->first();

    if (!$reservation) {
        return redirect()->back()->with('error', 'Reservation not found.');
    }

    if ($reservation->room_id != $room_id) {
        return redirect()->back()->with('error', 'Invalid reservation data.');
    }

    DB::table('reservations')->where('res_id', $res_id)->delete();

    DB::table('rooms')->where('room_id', $room_id)->update(['status' => 'Available']);

    return redirect()->back()->with('success', 'Reservation declined and deleted successfully.');
}



    
    
}
