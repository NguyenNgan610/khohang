<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Warehousing extends Model
{
    protected $table = 'warehousing';
    //
    const STATUS = [
        0 => "Đang đóng gói",
        1 => "Đã xuất kho",
        2 => "Đang giao",
        3 => "Đã hoàn thành",
        4 => "Trả về",
    ];
    protected $fillable = [
        'pw_user_id', 'w_transport_method_id', 'w_code', 'w_name', 'w_note', 'w_type', 'w_schedule', 'w_status', 'created_at', 'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'pw_user_id', 'id');
    }

    public function transport()
    {
        return $this->belongsTo(TransportMethod::class, 'w_transport_method_id', 'id');
    }

    public function warehousingProduct() {
        return $this->hasMany(ProductWarehousing::class, 'pw_warehousing_id', 'id');
    }
}
