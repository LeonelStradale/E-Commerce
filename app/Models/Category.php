<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'family_id',
    ];

    // Relación Uno a Muchos Inversa
    public function family()
    {
        return $this->belongsTo(Family::class);
    }

    // Relación Uno a Muchos
    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }
}
