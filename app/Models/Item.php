<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'item_name',
        'item_category',
        'item_price',
        'item_description',
        'item_condition',
        'item_type',
        'owner_name',
        'owner_contact_number',
        'owner_address',
        'owner_lat',
        'owner_lng',
    ];

    protected $table = 'item';
}
