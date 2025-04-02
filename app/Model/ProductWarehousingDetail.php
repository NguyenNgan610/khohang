<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductWarehousingDetail extends Model
{
    //
    const TYPE_IMPORT = 1;
    const TYPE_EXPORT = 2;
    protected $table = 'product_warehousing_details';


    protected $fillable = [
        'pwd_product_warehousing_id', 'pwd_product_warehousing_export_id', 'pwd_product_id', 'pwd_location_id', 'pwd_box_id', 'pwd_imei', 'pwd_status', 'pwd_note', 'pwd_type', 'created_at', 'updated_at',
    ];

    public function warehousing()
    {
        return $this->belongsTo(ProductWarehousing::class, 'pwd_product_warehousing_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'pwd_product_id', 'id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'pwd_location_id', 'id');
    }

    public function box()
    {
        return $this->belongsTo(LocationBox::class, 'pwd_box_id', 'id');
    }
}
