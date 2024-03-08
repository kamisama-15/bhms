<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReceiptController extends Controller
{
    public function receiptPage()
    {
        $studentReceipts = DB::table('receipts')
            ->where('tenants_id', Auth::id())
            ->join('post', 'post.post_id', '=', 'receipts.post_id')
            ->join('users as tenants', 'tenants.id', '=', 'receipts.tenants_id')
            ->join('rooms', 'rooms.room_id', '=', 'receipts.room_id')
            ->get();
        $owner = DB::table('post')
        ->join('users','users.id','post.owner_id')
        ->first();
        return view('receipt.receipt', compact('studentReceipts','owner'));
    }
     
    public function sendReceiptPage($boarders_id) {
        $receipts = DB::table('boarders')
        ->where('boarders.tenants_id', $boarders_id) 
        ->join('post', 'post.owner_id', '=', 'boarders.owner_id')
        ->join('rooms', 'rooms.room_id', '=', 'boarders.room_id')
        ->join('users', 'users.id', '=', 'boarders.tenants_id')
        // ->join('receipts', 'receipts.tenants_id', '=', 'users.id')
        ->get();

        
        $owner = DB::table('users')
            ->where('id', Auth::id())
            ->first(); 
        $studentReceipts = DB::table('boarders')
            ->where('boarders.tenants_id', $boarders_id) 
            ->join('post', 'post.owner_id', '=', 'boarders.owner_id')
            ->join('rooms', 'rooms.room_id', '=', 'boarders.room_id')
            ->join('users', 'users.id', '=', 'boarders.tenants_id')
            ->join('receipts', 'receipts.tenants_id', '=', 'users.id')
            ->get();
        return view('receipt.sendreceipt', compact('receipts', 'owner','studentReceipts'));
    }
    public function sendReceipt(Request $request)
{
    $tenants_id = $request->input('tenants_id');
    $post_id = $request->input('post_id');
    $room_id = $request->input('room_id');
    $boarders_id = $request->input('boarders_id');
    $receipt_amount = $request->input('receipt_amount');
    $receipt_message = $request->input('receipt_message');

    $lastReceiptOR = DB::table('receipts')->max('receipt_OR');

    $newReceiptOR = $lastReceiptOR ? $lastReceiptOR + 1 : 1;

    $formattedReceiptOR = str_pad($newReceiptOR, 4, '0', STR_PAD_LEFT);

    $send = DB::table('receipts')->insert([
        'tenants_id' => $tenants_id,
        'post_id' => $post_id,
        'room_id' => $room_id,
        'boarders_id' => $boarders_id,
        'receipt_amount' => $receipt_amount,
        'receipt_message' => $receipt_message,
        'receipt_OR' => $formattedReceiptOR,
        'receipt_date' => now()->format('d-m-Y'),
    ]);
        return redirect()->back()->with('success', 'Boarder dates updated successfully');
        
    }
   
    
}
