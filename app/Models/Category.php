<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'market_id'
    ];


    public function market()
    {
        return $this->belongsTo(MarketCopy::class);
    }


    public function denomination()
    {
        return $this->belongsTo(Denomination::class);
    }

    // public function contract()
    // {
    //     return $this->hasOne(Contract::class);
    // }
}
