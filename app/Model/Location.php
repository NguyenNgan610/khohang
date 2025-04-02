<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //
    protected $table = 'locations';

    protected $fillable = [
        'l_name', 'l_status', 'created_at', 'updated_at',
    ];

    const STATUS = [
        2 => 'Còn chỗ',
        1 => 'Hết chỗ',
    ];
}
