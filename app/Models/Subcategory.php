<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
    ];

    // Relación Uno a Muchos Inversa
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relación Uno a Muchos
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
