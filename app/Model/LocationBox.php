<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LocationBox extends Model
{
    //
    protected $table = 'location_boxs';

    protected $fillable = [
        'lb_location_id', 'lb_name', 'lb_status', 'created_at', 'updated_at',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'lb_location_id', 'id');
    }

    const STATUS = [
        2 => 'Còn trống',
        1 => 'Đã dùng',
    ];
}
