<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SplPriorityQueue;

class TestController extends Controller
{
    //
    public function psnr(Request $request){
        $request->validate([
            "coverimage" => "required|image|mimes:png",
            "originalImage" => "required"
        ]);
        
       $url = $request->file('coverimage')->store('testcoverimage');
        $stegoimage = imagecreatefrompng(Storage::path($url));
        $heightstego = imagesy($stegoimage);
        $widthstego = imagesx($stegoimage);
        
        $pixel_stego = $this->getpixelimage($heightstego, $widthstego, $stegoimage);
        $original = imagecreatefrompng('storage/'.$request->originalImage);
        $heightoriginal = imagesy($original);
        $widthoriginal = imagesx($original);
        $pixel_original = $this->getpixelimage($heightoriginal, $widthoriginal, $original);
        
        $PSNR = $this->psnr_($heightstego, $widthstego, $pixel_stego, $heightoriginal, $widthoriginal, $pixel_original);
        Storage::delete($url);
        return back()->with('hasil_psnr', round($PSNR,2));
    }
    
    public function psnr_($heightstego, $widthstego, $pixel_stego, $heightoriginal, $widthoriginal, $pixel_original){
        $x = 0;
        if ($heightstego == $heightoriginal && $widthstego == $widthoriginal) {
            for ($i=0; $i < $heightoriginal; $i++) { 
                for ($j=0; $j < $widthoriginal; $j++) { 
                    $red_stego = ($pixel_stego[$i][$j]>>16) &0xFF;
                    $red_ori = ($pixel_original[$i][$j]>>16) &0xFF;
                    $x += pow($red_stego-$red_ori,2);
                }
            }
            $MSE = $x / ($heightoriginal*$widthoriginal);
        }
        $PSNR = 10 * log10(pow(255,2)/$MSE);
        return $PSNR;
    }
   
    
    public function getpixelimage($height, $width, $image){
        for ($i=0; $i < $height; $i++) { 
            for ($j=0; $j <$width ; $j++) { 
                $coverdata[$i][$j] = imagecolorat($image, $j, $i); 
            }
        }
        return $coverdata;
    }
    
   
    
}
