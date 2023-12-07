<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berkas extends Model
{
    use HasFactory;

    protected $table = 'berkas';
    protected $fillable = ['nama','ekstensi','ukuran'];

    public function getUkuranAttribute($value)
    {
        return number_format($value / 1024, 1);
    }
}
