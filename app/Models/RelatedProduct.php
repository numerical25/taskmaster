<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatedProduct extends Model
{
    use HasFactory, UUID;

    public function Related() {
        return $this->belongsTo(Product::class,'related_product_id');
    }
}
