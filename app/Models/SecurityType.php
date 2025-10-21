<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecurityType extends Model
{
    use HasFactory;


    protected $table = 'security_type';


    public function denominations()
    {
        return $this->belongsTo(Denomination::class);
    }


    // public function securities()
    // {
    //     return $this->hasMany(Security::class, 'security_type');
    // }


    // public function securities()
    // {
    //     return $this->hasMany(Security::class, 'security_type');
    // }
}
