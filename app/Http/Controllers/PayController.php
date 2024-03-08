<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PayController extends Controller
{
    public function pay()
    {
        $paymentPosts = DB::table('payment_details')
            ->where('owner_id', Auth::id())
            ->get();
        return view('payment.payment', ['paymentPosts' => $paymentPosts]); 
    }
    

    public function paymentdetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gcash_number' => 'required',
            'gcash_name' => 'required',
            'owner_id' => 'required',
            'file' => 'required|image|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $ownerId = $request->input('owner_id');
        $gcash_number = $request->input('gcash_number');
        $gcash_name = $request->input('gcash_name');
        $file = $request->file('file');

        if ($file) {
            $fileName = $ownerId . 'qrcode.jpg';

            Storage::disk('local')->put('public/owner_payment_details/' . $fileName, file_get_contents($file));

            DB::table('payment_details')->insert([
                'owner_id' => $ownerId,
                'gcash_number' => $gcash_number,
                'gcash_name' => $gcash_name,
                'file' => $fileName,
                'created_at' => now(),
            ]);

            return redirect()->back()->with('success', 'Payment details uploaded successfully.');
        } else {
            return redirect()->back()->with('error', 'File is empty or missing.');
        }
    }
    public function paymentdelete($pay_id){
        $paymentDetail = DB::table('payment_details')->where('pay_id', $pay_id)->first();
    
        if (!$paymentDetail) {
            return redirect()->back()->with('error', 'Payment detail not found.');
        }
    
        if ($paymentDetail->owner_id != Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }
    
        if ($paymentDetail->file && Storage::disk('local')->exists('public/owner_payment_details/' . $paymentDetail->file)) {
            Storage::disk('local')->delete('public/owner_payment_details/' . $paymentDetail->file);
        }
    
        DB::table('payment_details')->where('pay_id', $pay_id)->delete();
    
        return redirect()->back()->with('success', 'Payment detail deleted successfully.');
    }
    
    
}
