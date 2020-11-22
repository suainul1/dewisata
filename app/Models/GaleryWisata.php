<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleryWisata extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function wisata()
    {
        return $this->belongsTo(Wisata::class);
    }
}
