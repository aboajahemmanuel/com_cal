<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;



    protected $fillable = [
        'name', 'category_id'
    ];



    public function market()
    {
        return $this->belongsTo(MarketCopy::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
