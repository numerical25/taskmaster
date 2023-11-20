<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CPTickerQuote extends Model
{
    use HasFactory, UUID;

    public function Ticker() {
        return $this->belongsTo(CPTicker::class);
    }
}
