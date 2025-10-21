<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Security extends Model
{
    use HasFactory;


    public function securityType()
    {
        return $this->belongsTo(SecurityType::class);
    }


    protected $fillable = [
        'name',
        'security_type_id',
        'haircut_profile',
        'securityprice',

    ];



    // Define the relationship with SecurityType
    // public function securityType()
    // {
    //     return $this->belongsTo(SecurityType::class, 'id');
    // }


    // public function menuMenuCategories()
    // {
    //     return $this->hasMany('MenuMenuCategory', 'item_id');
    // }
}
