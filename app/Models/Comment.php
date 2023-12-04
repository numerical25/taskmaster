<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory, UUID;

    public function Owner() {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function CommentedOn() {
        return $this->belongsTo(Blog::class, 'content_id');
    }
}
