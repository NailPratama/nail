<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\CoverImage;
use App\Models\User;

class InfoController extends Controller
{
   public function index(){
   	$coverimage = CoverImage::all();
   	return view('info', compact('coverimage'));
   }
}
