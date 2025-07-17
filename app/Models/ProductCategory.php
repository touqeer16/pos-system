<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductCategory extends Pivot
{
    protected $table = 'product_category'; // Explicitly define the pivot table name
}
