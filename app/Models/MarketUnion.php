<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketUnion extends Model
{
    use HasFactory;

    protected $table = 'market_union';


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
