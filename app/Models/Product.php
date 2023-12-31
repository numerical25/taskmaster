<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, UUID;

    protected $fillable = [
        'id',
        'name',
        'description',
        'price',
        'image_url'
    ];

    public function RelatedProduct() {
        return $this->hasMany(RelatedProduct::class);
    }
}
