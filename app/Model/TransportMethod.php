<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TransportMethod extends Model
{
    //
    protected $table = 'transport_methods';

    const STATUS_LOCKED = 0;
    const STATUS_ACTIVE = 1;

    const STATUS = [
        1 => "Hoạt động",
        0 => "Tạm dừng",
    ];

    protected $fillable = [
        'tm_name', 'tm_carrier', 'tm_cost', 'tm_status', 'created_at', 'updated_at',
    ];

}
