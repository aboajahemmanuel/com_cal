<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventPending extends Model
{
    use HasFactory;

    protected $table = 'events_pending';
}
