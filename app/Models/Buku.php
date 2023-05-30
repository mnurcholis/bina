<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Kategorine()
    {
        return $this->hasOne(Kategori::class, 'kategori_id');
    }
}
