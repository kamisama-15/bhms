<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class PostController extends Controller
{
    public function post()
    {
        $userPosts = DB::table('post')
            ->where('owner_id', Auth::id())
            ->get();
    
        return view('post.post', ['userPosts' => $userPosts]);
    }
    
    public function createpost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bh_name' => 'required',
            'location' => 'required',
            'boarding_house_address' => 'required',
            'description' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $ownerId = Auth::id();
        $bh_name = $request->input('bh_name');
        $location = $request->input('location');
        $boarding_house_address = $request->input('boarding_house_address');
        $description = $request->input('description');
        $file = $request->file('file');
    
        if ($file) {
            $uniqueId = Str::uuid()->toString(); // Generate unique identifier
            $fileName = $ownerId . '_' . $uniqueId . '.jpg'; 
    
            Storage::disk('local')->put('public/post_file/' . $fileName, file_get_contents($file));
    
            DB::table('post')->insert([
                'bh_name' => $bh_name,
                'owner_id' => $ownerId,
                'location' => $location,
                'boarding_house_address' => $boarding_house_address,
                'description' => $description,
                'post_file' => $fileName,
                'created_at' => now(),
            ]);
    
            return redirect()->back()->with('success', 'Post created successfully.');
        } else {
            return redirect()->back()->with('error', 'File is empty or missing.');
        }
    }
    

    public function deletepost($id)
    {
        $post = DB::table('post')->where('post_id', $id)->first();

        if (!$post) {
            return redirect()->back()->with('error', 'Post not found.');
        }

        if ($post->owner_id != Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        if ($post->post_file && Storage::disk('local')->exists('public/post_file/' . $post->post_file)) {
            Storage::disk('local')->delete('public/post/' . $post->post_file);
        }

        DB::table('post')->where('post_id', $id)->delete();

        return redirect()->back()->with('success', 'Post deleted successfully.');
    }

    public function edit_post(Request $request, $post_id)
    {
        $validator = Validator::make($request->all(), [
            'edit_bh_name' => 'required',
            'edit_location' => 'required',
            'edit_boarding_house_address' => 'required',
            'edit_description' => 'required',
            'edit_file' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $post = DB::table('post')->where('post_id', $post_id)->first();

        if (!$post) {
            return redirect()->back()->with('error', 'Post not found.');
        }

        if ($post->owner_id != Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $edit_bh_name = $request->input('edit_bh_name');
        $edit_location = $request->input('edit_location');
        $edit_boarding_house_address = $request->input('edit_boarding_house_address');
        $edit_description = $request->input('edit_description');
        $edit_post_file = $request->file('edit_file');

        $update_data = [
            // 'post_id'=>$post_id,
            'bh_name' => $edit_bh_name,
            'location' => $edit_location,
            'boarding_house_address' => $edit_boarding_house_address,
            'description' => $edit_description,
        ];

        if ($edit_post_file) {
            $uniqueId = Str::uuid()->toString();
            $fileName = $post->owner_id . '_' . $uniqueId . '.jpg'; 

            Storage::disk('local')->put('public/post_file/' . $fileName, file_get_contents($edit_post_file));

            if ($post->post_file && Storage::disk('local')->exists('public/post_file/' . $post->post_file)) {
                Storage::disk('local')->delete('public/post_file/' . $post->post_file);
            }

            $update_data['post_file'] = $fileName;
        }

        DB::table('post')->where('post_id', $post_id)->update($update_data);

        return redirect()->back()->with('success', 'Post updated successfully.');
    }


    
    


    
    
    

}
