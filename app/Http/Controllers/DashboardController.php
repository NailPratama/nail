<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CoverImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    
    public function index(){
        $download = true;
        $email = Auth()->user()->email;
        $updated_at = Auth()->user()->updated_at;
        $now = date("Y-m-d h:i:s");
        $diff = floor((strtotime($now) - strtotime($updated_at))/60);
        if (($diff>30 && file_exists('storage/'.$email)) || !file_exists('storage/'.$email.'/'.$email.'DE.png')) {
            Storage::deleteDirectory($email);
            $download = false;
            }elseif(!file_exists('storage/'.$email)){
                $download = false;
            }elseif($diff > 30){
                $download = true;
        }
        return view('dashboard', ["download" => $download]);
    }

    public function download(Request $request){
        
        return response()->download('Storage/' . $request->url_coverimage);
        
    }
}
