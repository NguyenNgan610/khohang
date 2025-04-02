<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ProductWarehousingDetail;
use App\Model\Location;
use App\Model\LocationBox;

class ProductWarehousingDetailExportController extends Controller
{
    //
    public function __construct()
    {
        $locations = Location::where('l_status', 2)->get();
        $boxs = LocationBox::where('lb_status', 2)->get();

        view()->share([
            'export_menu' => 'active',
            'export_list_product' => 'active',
            'locations' => $locations,
            'boxs' => $boxs,
        ]);
    }

    public function index(Request $request, $id)
    {
        $type = isset($request->type) ? $request->type : ProductWarehousingDetail::TYPE_IMPORT;

        $products = ProductWarehousingDetail::with(['product', 'location', 'box'])->where(['pwd_product_warehousing_export_id' => $id, 'pwd_status' => $type]);
        $products = $products->orderByDesc('id')->paginate(10);

        $viewData = [
            'products' => $products,
            'type' => $type
        ];

        return view('backend.product_warehousing_detail.index', $viewData);
    }
}
