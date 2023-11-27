<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory, UUID;

    protected $fillable = [
        'owner_id',
        'title',
        'details',
    ];


    public function Owner() {
        return $this->belongsTo(User::class,'owner_id');
    }
}
