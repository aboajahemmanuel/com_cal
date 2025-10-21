<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    use HasFactory;

    protected $table = 'market';

    protected $fillable = [
        'name'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
