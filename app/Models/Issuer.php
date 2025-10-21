<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issuer extends Model
{
    use HasFactory;

    protected $table = 'issuers';

    protected $fillable = [
        'name',

    ];
}
