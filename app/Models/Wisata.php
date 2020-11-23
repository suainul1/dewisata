<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function gallery()
    {
        return $this->hasMany(GaleryWisata::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function tiket()
    {
        return $this->hasMany(Tiket::class);
    }
}
