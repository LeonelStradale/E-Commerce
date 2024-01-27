<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku',
        'name',
        'description',
        'image_path',
        'price',
        'stock',
        'subcategory_id',
    ];

    // Relación Uno a Muchos Inversa
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    // Relación Uno a Muchos
    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    // Relación Muchos a Muchos
    public function options()
    {
        return $this->belongsToMany(Option::class)
            ->using(OptionProduct::class)
            ->withPivot('features')
            ->withTimestamps();
    }
}
