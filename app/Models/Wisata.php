<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function gallery()
    {
        return $this->hasMany(GaleryWisata::class);
    }
}
