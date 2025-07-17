<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'price'];

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category')->using(ProductCategory::class);
    }

    //Accessor: Format Price as Currency
    public function getFormattedPriceAttribute()
    {
        return '$' . number_format($this->attributes['price'], 2);
    }

    //Mutator: Ensure First Letter of Name is Capitalized
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst($value);
    }
}
