<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CPTicker extends Model
{
    use HasFactory, UUID;

    protected $fillable = [
        'id',
        'name',
        'cp_id',
        'symbol',
        'max_supply'
    ];

    protected $guarded = [
        'quotes'
    ];

    public function Quote() {
        return $this->hasMany(CPTickerQuote::class,'ticker_id', 'id');
    }
}
