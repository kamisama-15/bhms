<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
class RoomsController extends Controller
{
    public function rooms(){
        // $rooms = DB::table('rooms')
        // ->where('owner_id',Auth::id())
        // ->get();
        $bhs = DB::table('post')
        ->where('owner_id',Auth::id())
        ->get();
        // return view('rooms.rooms',['rooms' => $rooms]);
        return view ('rooms.rooms',compact('bhs'));
    }
    public function boardinghouserooms($post_id)
    {
        $rooms = DB::table('rooms')
            ->where('owner_id', Auth::id())
            ->where('post_id', $post_id)
            ->get();
    
        $post = DB::table('post')
            ->where('post_id', $post_id)
            ->first();
    
        $roomTenantsCount = [];
        foreach ($rooms as $room) {
            $roomTenantsCount[$room->room_id] = DB::table('boarders')
                ->where('room_id', $room->room_id)
                ->count();
        }
    
        return view('rooms.boardinghouserooms', compact('rooms', 'post', 'roomTenantsCount'));
    }
    
    
    public function addrooms(Request $request)
    {
        $owner_id = $request->input('owner_id');
        $post_id = $request->input('post_id');
    
        $latestRoom = DB::table('rooms')
            ->where('owner_id', $owner_id)
            ->where('post_id',$post_id)
            ->max('room_number');
    
        $numRooms = $request->input('numRooms');
    
        $request->validate([
            'numRooms' => 'required|integer|min:1',
            'owner_id' => 'required|integer',
            'post_id' => 'required|integer',
        ]);
    
        $roomData = [];
    
        $startRoomNumber = $latestRoom ? $latestRoom + 1 : 1;
    
        for ($i = $startRoomNumber; $i < $startRoomNumber + $numRooms; $i++) {
            $roomData[] = [
                'owner_id' => $owner_id,
                'post_id' => $post_id,
                'room_number' => $i,
                'status'=> 'Available',
            ];
        }
    
        DB::table('rooms')->insert($roomData);
    
        return redirect()->back()->with('success', 'Rooms added successfully.');
    }
    
    public function roomdetails($room_id) {
        $rooms = DB::table('rooms')
            ->where('room_id', $room_id)
            ->first();

        if (!$rooms) {
            abort(404);
        }

        return view('rooms.roomdetails', compact('rooms'));
    }
    public function price(Request $request){
        $validator = Validator::make($request->all(), [
            'roomPrice' => 'required',
            'roomId' => 'required',
            'room_type' => 'required',
            'room_pax' => 'required',
            'room_file' => 'required|image|max:2048',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $newPrice = $request->input('roomPrice'); 
        $roomId = $request->input('roomId');
        $room_type = $request->input('room_type');
        $room_pax = $request->input('room_pax');
        $room_number = $request->input('room_number'); 
        $room_file_number = $room_number . '.jpg';
    
        if ($request->hasFile('room_file')) {
            $file = $request->file('room_file');
            $filename = $room_file_number; 
            $filePath = "public/room_files/{$roomId}/{$room_number}/" . $filename;
            $directory = "public/room_files/{$roomId}/{$room_number}";

            if (!Storage::disk('local')->exists($directory)) {
                Storage::disk('local')->makeDirectory($directory);
            }
        
            $filePath = "{$directory}/{$filename}";
        
            Storage::disk('local')->put($filePath, file_get_contents($file));
        }
    
        DB::table('rooms')
            ->where('room_id', $roomId)
            ->update([
                'room_price' => $newPrice,
                'room_type' => $room_type,
                'room_pax' => $room_pax,
                'room_file' => $room_file_number,
            ]);
    
        return redirect()->back()->with('success', 'Room price updated successfully.');
    }
    
    
    public function view_reservation($room_id)
    {
        $rooms = DB::table('rooms')
            ->select('rooms.*', 'reservations.*', 'users.*')
            ->join('reservations', 'rooms.room_id', '=', 'reservations.room_id')
            ->join('users', 'reservations.tenants_id', '=', 'users.id')
            ->where('rooms.room_id', $room_id)
            ->where('reservations.res_void', '=', 0)
            ->get(); 

        return view('rooms.roomreservations', compact('rooms'));
    }


    public function room_delete($room_id)
    {
        $room = DB::table('rooms')->where('room_id', $room_id)->first();
    
        if (!$room) {
            return redirect()->back()->with('error', 'Room not found.');
        }
    
        if ($room->owner_id != Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }
    
        $ownerId = Auth::id();
        $room_number = $room->room_number;
        $room_file_number = $room_number . '.jpg';
    
        if ($room->room_file && Storage::disk('local')->exists("public/room_files/{$ownerId}/{$room_number}/{$room_file_number}")) {
            Storage::disk('local')->delete("public/room_files/{$ownerId}/{$room_number}/{$room_file_number}");
        }
    
        DB::table('rooms')->where('room_id', $room_id)->delete();
    
        return redirect()->back()->with('success', 'Room deleted successfully.');
    }
    
    
    



}
