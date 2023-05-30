<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlamatUser extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function Lokasi()
    {
        return $this->hasOne(Region::class, 'region_id', 'region_id');
    }
}
