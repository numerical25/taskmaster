<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name'
    ];
    protected $guarded = ['id'];

    public function Parents() {
        return $this->hasMany(SiteCategory::class,'parent_id');
    }

    public function Children() {
        return $this->hasMany(SiteCategory::class,'child_id');
    }

}
