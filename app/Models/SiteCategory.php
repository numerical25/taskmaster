<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteCategory extends Model
{
    use HasFactory, UUID;

    protected $fillable = [
        'parent_id',
        'child_id',
        'site_id'
    ];


    public function Site() {
        return $this->belongsTo(Site::class);
    }

    public function Parent() {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function Child() {
        return $this->belongsTo(Category::class, 'child_id');
    }
}
