<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Mail\NailEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class ForgotController extends Controller
{
    public function Mail(Request $request){
        $validated_data = $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);
        $user = DB::table('users')->where('email', $request->email)->first();
        if ($user != null && Hash::check($request->password, $user->password)) {
            Mail::to($request->email)->send(new NailEmail($user->slug_coverimage));
            return back()->with('link_message','Link pembaharuan stego image telah terkirim ke email anda');
        } else{
            return back()->with('link_message','Masukan anda tidak sesuai dengan data yang sebenarnya');
        }      
            
        }
	}
