<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\CoverImage;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class PostController extends Controller
{
    public function index()
    {

    	$user =  Auth()->user()->id;
        $data = Post::where('user_id', $user)->get();
    	return view('upload', compact('data'));
    }

    public function create()
    {
    	return view('createpost');
    }	

    public function store(Request $request)
    {
        
        
       // $validatedData['file'] = $request->file('file')->store('drive');
        $data = new post();
        $data->nama = $request->nama;
        $file = $request->file;
        $filename = time().'.'.$file->getClientOriginalExtension();
        $request->file->move('drive',$filename);
        $data->file = $filename;
        $user = Auth()->user()->id;
        $data->user_id = $user; 



        $data->save();

        return redirect('upload');
    }



    public function destroy($id)
    {
        
       $data = Post::find($id);
       $data->delete();

       return redirect('upload');
    }   

    public function download(Request $request, $file)
    {
        return response()->download(public_path('drive/'.$file));
    }

  
}
