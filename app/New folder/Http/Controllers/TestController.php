<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SplPriorityQueue;

class TestController extends Controller
{
    //
    public function fidelity(Request $request){
        $request->validate([
            "coverimage" => "required|image|mimes:png",
            "originalImage" => "required"
        ]);
        
        // upload dan mendapatkan pixel dari stegoimage
        $url = $request->file('coverimage')->store('testcoverimage');
        $stegoimage = imagecreatefrompng(Storage::path($url));
        $heightstego = imagesy($stegoimage);
        $widthstego = imagesx($stegoimage);
        
        $pixel_stego = $this->getpixelimage($heightstego, $widthstego, $stegoimage);
        
        
        // mendapatkan pixel dari original image
        $original = imagecreatefrompng('storage/'.$request->originalImage);
        $heightoriginal = imagesy($original);
        $widthoriginal = imagesx($original);
        $pixel_original = $this->getpixelimage($heightoriginal, $widthoriginal, $original);
        
        // $PSNR = $this->psnr_lou($heightstego, $widthstego, $pixel_stego, $heightoriginal, $widthoriginal, $pixel_original);
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
    public function psnr_lou($heightstego, $widthstego, $pixel_stego, $heightoriginal, $widthoriginal, $pixel_original){
        $h = $this->get_h($heightstego, $widthstego, $pixel_stego);
        $l = $this->get_l($heightstego, $widthstego, $pixel_stego);
        $x_stegoimage = $this->x_psnr($h, $l);
        
        $h = $this->get_h($heightoriginal, $widthoriginal, $pixel_original);
        $l = $this->get_l($heightoriginal, $widthoriginal, $pixel_original);
        $x_originalimage = $this->x_psnr($h, $l);
        
        $count = 0;
        for ($i=0; $i < count($x_stegoimage); $i++) { 
            for ($j=0; $j < count($x_stegoimage[$i]); $j++) { 
                $count += pow(abs($x_stegoimage[$i][$j] - $x_originalimage[$i][$j]), 2);
            }
        }
        
        // $penyebut = count($x_originalimage) * count($x_originalimage[0]);
        $penyebut = $heightoriginal * $widthoriginal;
        $MSE = $count / $penyebut;
        $PSNR = 10 * log10(pow(255,2) / $MSE);
        
        return $PSNR;
    }
    
    public function x_psnr($h, $l){
        for ($i=0; $i < count($h); $i++) { 
            for ($j=0; $j < count($h[$i]) ; $j++) { 
                $x[$i][$j] = $l[$i][$j] + ($h[$i][$j]/2);
            }
        }
        
        return $x;
    }
    
    
    public function capacity(Request $request){
        $request->validate([
            "coverimage" => "required|image|mimes:png",
        ]);
        $url = $request->file('coverimage')->store('testcoverimage');
        $T = 0;
        global $P;
        $img =  imagecreatefrompng('storage/'.$url);
        $width = imagesx($img);
        $height = imagesy($img);
        $stegoimage = $this->getpixelimage($height, $width, $img);
        $h = $this->get_h($height, $width, $stegoimage);
        $l = $this->get_l($height, $width, $stegoimage);
        $cap_RDE = $this->cap_RDE($h, $l, $P, $T);
        $cap_DE = $this->cap_DE($h, $l, $P, $T);
        Storage::delete($url);
        var_dump($cap_RDE);
    }
    
    public function cap_RDE($h, $l, $P, $T){
        do{
            global $bitstream, $original_set, $h_reduksi;
            $h_reduksi = $this->get_h_reduksi($h);     
            $location_map_reduksi = $this->get_location_map_reduksi($h, $h_reduksi);
            $original_set = $this->get_original_set($h_reduksi, $l, $T);
            global $capacity;
            $capacity = $this->get_capacity($original_set);
            $location_map = $this->get_location_map($original_set);
            $LSB = $this->get_LSB($original_set, $h_reduksi);
            
            // kompresi locmap reduksi
            $strlocmap_red = null;
            for ($i=0; $i < count($location_map); $i++) { 
                $strlocmap_red .= implode('', $location_map_reduksi[$i]);
            }
            $RLE_locmap_reduksi = $this->RLE($strlocmap_red);
            $L_reduksi= $this->huffman_compress($RLE_locmap_reduksi);
            $length_L_reduksi = $this->texttobinary(strlen($L_reduksi));
            
            // kompresi locmap
            $strlocmap = null;
            for ($i=0; $i < count($location_map); $i++) { 
                $strlocmap .= implode('', $location_map[$i]);
            }
            $RLE_locmap = $this->RLE($strlocmap);
            $L= $this->huffman_compress($RLE_locmap);
            $length_L = $this->texttobinary(strlen($L));
            
            // kompresi LSB
            $RLE_C = $this->RLE($LSB);
            $C = $this->huffman_compress($RLE_C);
            $length_C = $this->texttobinary(strlen($C));
            
            // menghitung panjang P
            $length_P = $this->texttobinary(strlen($P));
            
            // // mendapatkan nilai Bitstream
            $konjungsi = $this->texttobinary("&");
            $limitheader = $this->texttobinary("&&");
            $bitstream = $length_L_reduksi.$konjungsi.$length_L.$konjungsi.$length_C.$konjungsi.$length_P.$limitheader.$L_reduksi.$L.$C.$P;
            
            if ($T > 255) {
                if (strlen($bitstream) > $capacity) {
                    echo(strlen($bitstream)." ". $capacity);
                    exit();
                }
            }
            $T+=51;
        }while (strlen($bitstream) > $capacity);
        
        $all_cap = $capacity;
        $cap_locmap = strlen($bitstream);
        $cap_payload = floor(($capacity - strlen($bitstream))/8);
        
        $return_RDE = $cap_payload;
        return $return_RDE;
    }
    
    public function cap_DE($h, $l, $P, $T){
        do{
            global $bitstream, $original_set;
            $original_set = $this->get_original_set($h, $l, $T);
            global $capacity;
            $capacity = $this->get_capacity($original_set);
            $location_map = $this->get_location_map($original_set);
            $LSB = $this->get_LSB($original_set, $h);
            
            
            // kompresi locmap
            $strlocmap = null;
            for ($i=0; $i < count($location_map); $i++) { 
                $strlocmap .= implode('', $location_map[$i]);
            }
            $RLE_locmap = $this->RLE($strlocmap);
            $L= $this->huffman_compress($RLE_locmap);
            $length_L = $this->texttobinary(strlen($L));
            
            // kompresi LSB
            $RLE_C = $this->RLE($LSB);
            $C = $this->huffman_compress($RLE_C);
            $length_C = $this->texttobinary(strlen($C));
            
            // menghitung panjang P
            $length_P = $this->texttobinary(strlen($P));
            
            // // mendapatkan nilai Bitstream
            $konjungsi = $this->texttobinary("&");
            $limitheader = $this->texttobinary("&&");
            $bitstream = $length_L.$konjungsi.$length_C.$konjungsi.$length_P.$limitheader.$L.$C.$P;
            
            if ($T > 255) {
                if (strlen($bitstream) > $capacity) {
                    echo(strlen($bitstream)." ". $capacity);
                    exit();
                }
            }
            $T+=51;
        }while (strlen($bitstream) > $capacity);
        
        $all_cap = $capacity;
        $cap_locmap = strlen($bitstream);
        $cap_payload = floor(($capacity - strlen($bitstream))/8);
        
        $return_DE = [$all_cap, $cap_locmap, $cap_payload];
        return $return_DE;
    }
    
    // mendapatkan pixel image
    public function getpixelimage($height, $width, $image){
        for ($i=0; $i < $height; $i++) { 
            for ($j=0; $j <$width ; $j++) { 
                $coverdata[$i][$j] = imagecolorat($image, $j, $i); 
            }
        }
        return $coverdata;
    }
    
    // mendapatkan nilai selisih
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
    
    // mendapatkan nilai rata rata
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
    
    // melakukan reduksi pada selisih
    public function get_h_reduksi($h){
        for ($i=0; $i < count($h); $i++) {
            for ($j=0; $j < count($h[$i]); $j++) { 
                if ($h[$i][$j] < 2) {
                    $h_reduksi[$i][$j] = $h[$i][$j];
                }else{
                    $h_reduksi[$i][$j] = $h[$i][$j] - pow(2, floor(log10($h[$i][$j])/log10(2)) - 1);
                }
            }
        }
        return $h_reduksi;
    }
    
    // menentukan location map selisih yang tereduksi
    public function get_location_map_reduksi($h, $h_reduksi){
        for ($i=0; $i < count($h_reduksi) ; $i++) { 
            for ($j=0; $j < count($h_reduksi[$i]) ; $j++) { 
                $criteria1 = pow(2, floor(log10($h_reduksi[$i][$j]) / log10(2)));
                $criteria2 = pow(2, floor(log10($h[$i][$j]) / log10(2)));
                if ($h[$i][$j] == $h_reduksi[$i][$j]) {
                    $location_map_reduksi[$i][$j] = 0;
                } else {
                    $location_map_reduksi[$i][$j] = 1;
                }
            }
        }
        return $location_map_reduksi;
    }
    
    // menentukan original set
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
    
    // mendapatkan kapasitas gambar dalam menampung pesan rahasia
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
    
    // menentukan location map selisih yang dapat disisipi pesan
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
    
    // mendapatkan LSB dari selisih EN2 dan CN
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
    
    // konversi biner ke ASCII
    public function binarytotext($binary){
        $returntext = null;
        
        // mengubah biner menjadi teks
        for ($i=0; $i + 6 < strlen($binary) ; $i+=7) { 
            
            $returntext .= pack('H*', dechex(bindec(substr($binary, $i, 7))));
        }
        return $returntext;
    }
    
    // konversi ASCII ke biner
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
    
    // kompresi Run Length Encoding
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
    
}
