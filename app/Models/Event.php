<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_title_code',
        'event_description',
        'start_date',
        'start_time',
        'end_date',
        'end_time',
        'category_id',
        // any other attributes you want to be mass-assignable
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
