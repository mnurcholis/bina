<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBukuMasuk extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Bukunya()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }
}
