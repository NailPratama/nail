<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\CoverImage;
use SplPriorityQueue;

class LoginController extends Controller
{
    //
    public function index(Request $request){
        
        $request->validate([
            "coverimage" => "required|image|mimes:png"
        ]);
        $url = $request->file('coverimage')->store('coverimage');
        $imgpng = imagecreatefrompng(Storage::path($url));
        $height = imagesy($imgpng);
        $width = imagesx($imgpng);
        
        try {
            for ($i=0; $i < $height; $i++) {
                for ($j=0; $j < $width; $j++) {
                    $stego[$i][$j] = imagecolorat($imgpng, $j, $i);
                }
            }
            for ($i=0; $i < $height ; $i++) {
                $xxx = 0; 
                for ($j=0; $j + 1 < $width; $j+=2) { 
                    $x = ($stego[$i][$j] >> 16) &0xFF;
                    $y = ($stego[$i][$j + 1] >> 16) &0xFF;
                    $h[$i][$xxx] = $x - $y;
                    $l[$i][$xxx] = floor(($x + $y) / 2);
                    $xxx++;
                }
            } 
        } catch (\Throwable $th) {
            echo("ERROR");
        }
        
        if (!isset($h)) {
            return;
        }
        
        // mebuat new set
        $B = null;
        for ($i=0; $i < $height; $i++) { 
            for ($j=0; $j < count($h[$i]); $j++) { 
                $chg0 = 2 * floor($h[$i][$j] / 2) + 0;
                $chg1 = 2 * floor($h[$i][$j] / 2) + 1;
                $qualified = min(2 * (255 - $l[$i][$j]) , 2 * $l[$i][$j] + 1);
                if (abs($chg0) <= $qualified && abs($chg1) <= $qualified) {
                    $new_set[$i][$j] = "CH";
                } else{
                    $new_set[$i][$j] = "NC";
                }
            }
        }
        
        $index = 0;
        for ($i=0; $i < $height ; $i++) { 
            for ($j=0; $j < count($new_set[$i]); $j++) { 
                if ($new_set[$i][$j] == "CH") {
                    $binary_h = decbin($h[$i][$j]);
                    $B .= substr($binary_h, strlen($binary_h) - 1, 1);
                } 
            }
        }
        
        try {
            $P = $this->ekstraksi_DE($B, $new_set, $h, $l, $height, $width, $stego);
        } catch (\Throwable $th) {
            Storage::delete($url);
            return back()->with("login_error", "Tidak Berhasil");
        }
        
        if (isset($P)) {
            $P = explode("+", $P);
            $validated_data["email"] = $P[0];
            $validated_data["password"] = $P[1];
            $validated_data["slug_coverimage"] = $P[2];
            if(Auth::attempt($validated_data)){
                $request->session()->regenerate();
                Storage::delete($url);
                return redirect()->intended('/dashboard');
            }           
            Storage::delete($url);
            return back()->with("login_error", "Tidak Berhasil");
        }
        
    }
    
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    public function export_png($image, $url){
        header('Content-type:image/png');
        imagepng($image, $url);
        imagedestroy($image);
    }
    public function get_stego($height, $width, $stego, $l, $h_bfr_exp, $imgcoverdata){
        for ($i=0; $i < $height ; $i++) { 
            $xxx = 0;
            for ($j=0; $j + 1 < $width ; $j+=2) { 
                $x_exp = ($l[$i][$xxx] + floor(($h_bfr_exp[$i][$xxx] + 1) / 2));
                $y_exp = ($l[$i][$xxx] - floor($h_bfr_exp[$i][$xxx] / 2));
                if ($y_exp < 0 || $y_exp > 255) {
                    ddd($y_exp."+".$xxx."+".$j);
                }
                $color = imagecolorallocate($imgcoverdata, $x_exp, ($stego[$i][$j] >> 8) &0xFF,  ($stego[$i][$j]) &0xFF);
                imagesetpixel($imgcoverdata, $j, $i, $color);
                $color = imagecolorallocate($imgcoverdata,  $y_exp, ($stego[$i][$j + 1] >> 8) &0xFF, ($stego[$i][$j + 1]) &0xFF);
                imagesetpixel($imgcoverdata, $j + 1, $i, $color);
                $xxx++;
            }
        }
        return $imgcoverdata;
    }
    
    public function decode_RLE($strRLE){
        $explodeRLE = explode("|", $strRLE);
        $decodeRLE = null;
        for ($i=0; $i < count($explodeRLE); $i++) { 
            $biner = substr($explodeRLE[$i], 0, 1);
            $count = substr($explodeRLE[$i], 1, (strlen($explodeRLE[$i]) - 1));
            for ($j=0; $j < $count; $j++) { 
                $decodeRLE .= $biner;
            }
        }
        return $decodeRLE;
    }
    
    public function texttobinary($text){
        // membagi teks menjadi array
        $characters = str_split($text);
        // mengubah array teks menjadi biner
        $binaryText = [];
        foreach ($characters as $character){
            $data = unpack('H*', $character);
            $binaryText[] = str_pad(base_convert($data[1], 16, 2), 7, "0", STR_PAD_LEFT);;
        }
        // menggabungkan semua biner menjadi satu variabel
        $binaryTextImplode = implode('', $binaryText);
        return $binaryTextImplode;
    } 
    
    public function binarytotext($binary){
        $returntext = null;
        // mengubah biner menjadi teks
        for ($i=0; $i + 6 < strlen($binary) ; $i+=7) { 
            $returntext .= pack('H*', dechex(bindec(substr($binary, $i, 7))));
        }
        return $returntext;
    }
    
   
    function ekstraksi_DE($B, $new_set, $h, $l, $height, $width, $stego){
        $data = $this->binarytotext($B);
        $data = explode("&&", $data);
        $length_header = $data[0];
        $length_header = explode("&", $length_header);
        $length_L = $length_header[0];
        $length_C = $length_header[1];
        $length_P = $length_header[2];
        
        $binary_length_header = strlen($this->texttobinary($data[0]."&&"));
        
        $start_L = $binary_length_header;
        $L = substr($B, $start_L, $length_L);
        $RLE_locmap = $this->huffman_decompress($L);
        $strlocmap = $this->decode_RLE($RLE_locmap);
        
        $start_C = $start_L + strlen($L);
        $C = substr($B, $start_C, $length_C);
        $RLE_C = $this->huffman_decompress($C);
        $LSB = $this->decode_RLE($RLE_C);
        // return var_dump(substr($LSB,278,1));
        
        $start_P = $start_C + strlen($C);
        $P = $this->binarytotext(substr($B, $start_P, $length_P));
        return $P;
        
        $locmapindex = 0;
        for ($i=0; $i < $height; $i++) { 
            for ($j=0; $j < count($new_set[$i]); $j++) { 
                $locmap[$i][$j] = substr($strlocmap, $locmapindex, 1);
                $locmapindex++;
            }
        }

       
        $imgcoverdata = imagecreatetruecolor($width, $height);
        $imgcoverdata = $this->get_stego($height, $width, $stego, $l, $h_bfr_exp, $imgcoverdata);
        $this->export_png($imgcoverdata, "storage/coverdata/RestoreDE.png");


    }
  
    function huffman_encode($symb2freq) {
        $heap = new SplPriorityQueue;
        $heap->setExtractFlags(SplPriorityQueue::EXTR_BOTH);
        foreach ($symb2freq as $sym => $wt)
        $heap->insert(array($sym => ''), -$wt);
        
        while ($heap->count() > 1) {
            $lo = $heap->extract();
            $hi = $heap->extract();
            foreach ($lo['data'] as &$x)
            $x = '1'.$x;
            foreach ($hi['data'] as &$x)
            $x = '0'.$x;
            $heap->insert($lo['data'] + $hi['data'],
            $lo['priority'] + $hi['priority']);
        }
        $result = $heap->extract();
        return $result['data'];
    }
    
    function huffman_compress($txt){
        $arr_text = str_split($txt);
        $symb2freq = array_count_values(str_split($txt));
        $huff = $this->huffman_encode($symb2freq);
        $code = null;
        for($i=0;$i<count($arr_text);$i++){
            $code .= $huff[$arr_text[$i]]; 
        }
        $sym = null;
        foreach ($symb2freq as $key => $value) {
            $sym .= ($key." ".$symb2freq[$key]." ");
        }
        
        $sym = $this->texttobinary($sym."--");
        $result = $sym.$code;
        $length_result = $this->texttobinary(strlen($code)."--");
        $result = $length_result.$result;
        return $result;
    }
    
    function huffman_decompress($encode) {
        $sym = $this->binarytotext($encode);
        $arr_sym = explode("--", $sym);
        $length_code = $arr_sym[0];
        $sym = $arr_sym[1];
        $length_start = strlen($this->texttobinary($length_code."--".$sym."--"));
        $arr_sym = explode(" ", $sym);
        $symb2freq=array();
        for ($i=0; $i+1 < count($arr_sym); $i+=2) { 
            $symb2freq += [$arr_sym[$i]=>(int)($arr_sym[$i+1])];
        }
        $huff = $this->huffman_encode($symb2freq);
        $code = substr($encode, $length_start,$length_code);
        $subs_code = null;
        $txt = null;
        $indexhuff = array();
        foreach ($huff as $key => $value) {
            array_push($indexhuff, $key);
        }
        for ($i=0; $i < strlen($code) ; $i++) { 
            $subs_code .= substr($code, $i, 1);
            for ($j=0; $j < count($indexhuff); $j++) { 
                if ($subs_code===$huff[$indexhuff[$j]]) {
                    $txt.=$indexhuff[$j];
                    $subs_code = null;
                }
            }
        }
        return $txt;
    }
}
