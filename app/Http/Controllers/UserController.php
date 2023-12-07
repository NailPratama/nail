<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CoverImage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use SplPriorityQueue;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class UserController extends Controller
{
   
    public function store(Request $request)
    {
        //
        $validated_data = $request->validate([
            'username' => 'required',
            'password' => 'required',
            'email' => 'required|email|unique:users',
            'coverimage' => 'required',
            'slug_coverimage'=> 'required',
        ]);
        $coverimage = CoverImage::firstWhere('id', $validated_data['coverimage']);
        $img = imagecreatefrompng("storage/".$coverimage->path);
        $width = imagesx($img);
        $height = imagesy($img);
        $message = $validated_data["email"] . "+" . $validated_data["password"] . "+" . $validated_data["slug_coverimage"];
        $P = $this->texttobinary($message);
        $T = 0;
        $coverdata = $this->getpixelimage($height, $width, $img);
        $h = $this->get_h($height, $width, $coverdata);
        $l = $this->get_l($height, $width, $coverdata);
        $credentials = array(
            'email' => $validated_data["email"],
            'password' => $validated_data["password"]
        );
        $this->de($img,$width,$height,$message,$P,$T,$coverdata,$h,$l,$validated_data["email"]);
        $validated_data["password"] = Hash::make($validated_data["password"]);
        User::create($validated_data);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    
    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   
    public function update(Request $request, User $user)
    {
        //
        // ddd($request->url_name);
        $rules = [
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'coverimage' => 'required'
        ];
        
        if ($request->email != $user->email) {
            $rules["email"] = $rules['email'].'|unique:users';
        }
        
        $validated_data = $request->validate($rules);
        
        $coverimage = CoverImage::firstWhere('id', $validated_data['coverimage']);
        $slug = $coverimage->slug;
        $slug = uniqid($slug, true);
        
        $img = imagecreatefrompng("storage/".$coverimage->path);
        $width = imagesx($img);
        $height = imagesy($img);
        
        $validated_data["slug_coverimage"] = base64_encode($validated_data["email"].$slug);
        $message = $validated_data["email"] . "+" . $validated_data["password"] . "+" . $validated_data["slug_coverimage"];
        $P = $this->texttobinary($message);
        $T = 0;
        $coverdata = $this->getpixelimage($height, $width, $img);
        $h = $this->get_h($height, $width, $coverdata);
        $l = $this->get_l($height, $width, $coverdata);
        
        $credentials = array(
            'email' => $validated_data["email"],
            'password' => $validated_data["password"]
        );

        $this->de($img,$width,$height,$message,$P,$T,$coverdata,$h,$l,$validated_data["email"]);
        $validated_data["password"] = Hash::make($validated_data["password"]);
        
        User::where('id', $user->id)->update($validated_data);
        
        if ($request->url_name == "recovery") {
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                
                return redirect()->intended('/dashboard');
            }
            echo("Gagal Otentikasi");
        } else{
            return redirect('/dashboard');
        }
        
    }
    
    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    
    
    public function forgot(Request $request){
        $validated_data = $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);
        
        if(Auth::attempt($validated_data)){
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
    }
    public function de($img,$width,$height,$message,$P,$T,$coverdata,$h,$l,$email){
        global $tekspesan2, $original_set2;
        do{
            global $tekspesan, $original_set;
            $original_set = $this->get_original_set($h, $l, $T);
            global $capacity;
            $capacity = $this->get_capacity($original_set);
            $location_map = $this->get_location_map($original_set);
            $LSB = $this->get_LSB($original_set, $h);
            
            $strlocmap = null;
            for ($i=0; $i < count($location_map); $i++) { 
                $strlocmap .= implode('', $location_map[$i]);
            }
            $RLE_locmap = $this->RLE($strlocmap);
            $L= $this->huffman_compress($RLE_locmap);
            $length_L = $this->texttobinary(strlen($L));
            
            $RLE_C = $this->RLE($LSB);
            $C = $this->huffman_compress($RLE_C);
            $length_C = $this->texttobinary(strlen($C));
            
            $length_P = $this->texttobinary(strlen($P));
            
            $konjungsi = $this->texttobinary("&");
            $limitheader = $this->texttobinary("&&");
            $tekspesan = $length_L.$konjungsi.$length_C.$konjungsi.$length_P.$limitheader.$L.$C.$P;
            
            if ($T > 255) {
                if (strlen($tekspesan) > $capacity) {
                    break;
                }
            }
            $T+=51;
    }while (strlen($tekspesan) > $capacity);
    
        $h_sisipan = $this->get_h_sisipan($tekspesan, $height, $width, $original_set, $h);
        $stego = imagecreatetruecolor($width, $height);
        $stego = $this->get_stego($height, $width, $coverdata, $l, $h_sisipan, $stego);
        if (file_exists("storage/$email")) {
            $this->export_png($stego, "storage/$email/$email"."DE.png");
        } else{
            mkdir("storage/$email", 0777, true);
            $this->export_png($stego, "storage/$email/$email"."DE.png");
        }
        return $L;
    }
    
    public function getpixelimage($height, $width, $image){
        for ($i=0; $i < $height; $i++) { 
            for ($j=0; $j <$width ; $j++) { 
                $coverdata[$i][$j] = imagecolorat($image, $j, $i); 
            }
        }
        return $coverdata;
    }
    
    public function get_h($height, $width, $coverdata){
        for ($i=0; $i < $height; $i++) { 
            $xxx = 0;
            for ($j=0; $j + 1 < $width; $j+=2) { 
                $x = ($coverdata[$i][$j] >> 16) &0xFF;
                $y = ($coverdata[$i][$j + 1] >> 16) &0xFF;
                $h[$i][$xxx] = $x - $y;
                $xxx++;
            }
        }
        return $h;
    }
    
    public function get_l($height, $width, $coverdata){
        for ($i=0; $i < $height; $i++) { 
            $xxx = 0;
            for ($j=0; $j + 1 < $width; $j+=2) { 
                $x = ($coverdata[$i][$j] >> 16) &0xFF;
                $y = ($coverdata[$i][$j + 1] >> 16) &0xFF;
                $l[$i][$xxx] = floor(($x + $y)/2);
                $xxx++;
            }
        }
        return $l;
    }
    
   
    public function get_original_set($h, $l, $T){
        for ($i=0; $i < count($h); $i++) { 
            for ($j=0; $j < count($h[$i]) ; $j++) { 
                $exp0 = 2 * $h[$i][$j] + 0;
                $exp1 = 2 * $h[$i][$j] + 1;
                $qualified = min(2 * (255 - $l[$i][$j]) , 2 * $l[$i][$j] + 1);
                $chg0 = 2 * floor($h[$i][$j] / 2) + 0;
                $chg1 = 2 * floor($h[$i][$j] / 2) + 1;
                if (abs($exp0) <= $qualified && abs($exp1) <= $qualified) {
                    if ($h[$i][$j] == 0 || $h[$i][$j] == (-1)) {
                        $original_set[$i][$j] = "EZ";
                    }elseif (abs($h[$i][$j]) <= $T ) {
                        $original_set[$i][$j] = "EN1";
                    }else{
                        $original_set[$i][$j] = "EN2";
                    }
                } elseif(abs($chg0) <= $qualified && abs($chg1) <= $qualified){
                    $original_set[$i][$j] = "CN";
                } else{
                    $original_set[$i][$j] = "NC";
                }
            }
        }
        return $original_set;
    }
    
    public function get_capacity($original_set){
        $EZ = 0;
        $EN1 = 0;
        $EN2 = 0;
        $CN = 0;
        for ($i=0; $i < count($original_set); $i++) { 
            for ($j=0; $j < count($original_set[$i]) ; $j++) { 
                if ($original_set[$i][$j] == "EZ") {
                    $EZ++;
                } elseif ($original_set[$i][$j] == "EN1") {
                    $EN1++;
                } elseif ($original_set[$i][$j] == "EN2") {
                    $EN2++;
                } elseif ($original_set[$i][$j] == "CN") {
                    $CN++;
                }
            }
        }
        $capacity = $EZ + $EN1 + $EN2 + $CN;
        return $capacity;
    }
    
    public function get_location_map($original_set){
        for ($i=0; $i < count($original_set); $i++) { 
            for ($j=0; $j < count($original_set[$i]); $j++) { 
                if ($original_set[$i][$j] == "EZ" || $original_set[$i][$j] == "EN1") {
                    $location_map[$i][$j] = 1;
                } else{
                    $location_map[$i][$j] = 0;
                }
            }
        }
        return $location_map;
    }
    
    public function get_LSB($original_set, $h){
        $LSB = null;
        for ($i=0; $i < count($original_set); $i++) { 
            for ($j=0; $j < count($original_set[$i]); $j++) { 
                if ($original_set[$i][$j] == "EN2" || $original_set[$i][$j] == "CN") {
                    if ($h[$i][$j] != 1 && $h[$i][$j] != -2) {
                        $binary_h = decbin($h[$i][$j]);
                        $LSB .= substr($binary_h, strlen($binary_h) - 1, 1);
                    }
                }
            }
        }
        return $LSB;
    }
    
    public function binarytotext($binary){
        $returntext = null;
        
        for ($i=0; $i + 6 < strlen($binary) ; $i+=7) { 
            
            $returntext .= pack('H*', dechex(bindec(substr($binary, $i, 7))));
        }
        return $returntext;
    }
    
    public function texttobinary($text){
        $characters = str_split($text);
        
        $binaryText = [];
        foreach ($characters as $character){
            $data = unpack('H*', $character);
            $binaryText[] = str_pad(base_convert($data[1], 16, 2), 7, "0", STR_PAD_LEFT);;
        }
        
        $binaryTextImplode = implode('', $binaryText);
        
        return $binaryTextImplode;
    }
    
    public function RLE($teks){
        $n = strlen($teks);
        $returntext = null;
        for ($i=0; $i < $n ; $i++) { 
            $count = 1;
            while ($i < ($n - 1) && substr($teks, $i, 1) == substr($teks, $i + 1, 1)) {
                $count++;
                $i++;
            }
            $returntext .= substr($teks, $i, 1).$count."|"; 
        }
        return $returntext;
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
    
    public function get_h_sisipan($tekspesan, $height, $width, $original_set, $h){
        $secretIndex = 0;
        $tekspesan_length = strlen($tekspesan);
        for ($i=0; $i < $height; $i++) { 
            for ($j=0; $j < count($h[$i]); $j++) {
                $subs = substr($tekspesan, $secretIndex, 1);
                $int = ($subs);
                if ($original_set[$i][$j] == "EZ" || $original_set[$i][$j] == "EN1") {
                    if ($secretIndex < $tekspesan_length) {
                        $h_sisipan[$i][$j] = 2 * $h[$i][$j] + $int;
                        $secretIndex++;
                    } else{
                        $h_sisipan[$i][$j] = 2 * $h[$i][$j] + 0;
                    }
                } elseif($original_set[$i][$j] == "EN2" || $original_set[$i][$j] == "CN"){
                    if ($secretIndex < $tekspesan_length) {
                        $h_sisipan[$i][$j] = 2 * floor($h[$i][$j]/2) + $int;
                        $secretIndex++;
                    } else{
                        $h_sisipan[$i][$j] = 2 * floor($h[$i][$j]/2) + 0;
                    }
                } else{
                    $h_sisipan[$i][$j] = $h[$i][$j];
                }
            }
        }
        return $h_sisipan;
    }
    
    public function get_stego($height, $width, $coverdata, $l, $h_sisipan, $stego){
        for ($i=0; $i < $height ; $i++) { 
            $xxx = 0;
            for ($j=0; $j + 1 < $width ; $j+=2) { 
                $x_exp = ($l[$i][$xxx] + floor(($h_sisipan[$i][$xxx] + 1) / 2));
                $y_exp = ($l[$i][$xxx] - floor($h_sisipan[$i][$xxx] / 2));
                $color = imagecolorallocate($stego, $x_exp, ($coverdata[$i][$j] >> 8) & 0xFF,  ($coverdata[$i][$j]) & 0xFF);
                imagesetpixel($stego, $j, $i, $color);
                $color = imagecolorallocate($stego,  $y_exp, ($coverdata[$i][$j + 1] >> 8) & 0xFF, ($coverdata[$i][$j + 1]) & 0xFF);
                imagesetpixel($stego, $j + 1, $i, $color);
                $xxx++;
            }
        }
        return $stego;
    }
    
    public function export_png($image, $url){
        header('Content-type:image/png');
        imagepng($image, $url);
        imagedestroy($image);
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
        // echo(strlen($code));
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
        $huff = $this->encode($symb2freq);
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
