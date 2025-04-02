<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ProductWarehousingDetail;
use App\Model\ProductWarehousing;
use App\Model\Location;
use App\Model\LocationBox;
use App\Http\Requests\ProductWarehousingDetailRequest;

class ProductWarehousingDetailController extends Controller
{
    //
    public function __construct()
    {
        $locations = Location::where('l_status', 2)->get();
        $boxs = LocationBox::where('lb_status', 2)->get();

        view()->share([
            'list_product_detail' => 'active',
            'import_list_product' => 'active',
            'locations' => $locations,
            'boxs' => $boxs,
        ]);
    }

    public function index(Request $request, $id)
    {
        $type = isset($request->type) ? $request->type : ProductWarehousingDetail::TYPE_IMPORT;

        $products = ProductWarehousingDetail::with(['product', 'location', 'box'])->where(['pwd_product_warehousing_id' => $id, 'pwd_status' => $type]);
        $products = $products->orderByDesc('id')->paginate(10);


        $viewData = [
            'products' => $products,
            'type' => $type
        ];

        return view('backend.product_warehousing_detail.index', $viewData);
    }

    public function edit($id)
    {
        $product = ProductWarehousingDetail::find($id);

        if (!$product) {
            return redirect()->back()->with('danger', '[Error] Đã xảy ra lỗi dữ liệu không tồn tại.');
        }

        return view('backend.product_warehousing_detail.update', compact('product'));
    }

    public function update(ProductWarehousingDetailRequest $request, $id)
    {
        $data = $request->except('_token');

        $product = ProductWarehousingDetail::find($id);

        if (!$product) {
            return redirect()->back()->with('danger', '[Error] Đã xảy ra lỗi không thể xóa dữ liệu.');
        }

        \DB::beginTransaction();
        try {

            if ($product->update($data)) {
                $boxs = LocationBox::where(['lb_status' => 2, 'lb_location_id' => $request->pwd_location_id])->get();
                if ($boxs->count() < 1 || $boxs->count() == 1) {
                    $location = Location::find($request->pwd_location_id);
                    if ($location) {
                        $location->update(['l_status' => 1]);
                    }
                }

                $box = LocationBox::find($request->pwd_box_id);

                if ($box) {
                    $box->update(['lb_status' => 1]);
                }
            }

            \DB::commit();
            return redirect()->back()->with('success','[Success] Chỉnh sửa thành công.');
        } catch (\Exception $exception) {
            \DB::rollBack();
            \Log::error($exception);
            return false;
        }
    }

    public function delete($id)
    {
        $product = ProductWarehousingDetail::find($id);

        if (!$product) {
            return redirect()->back()->with('danger', '[Error] Đã xảy ra lỗi không thể xóa dữ liệu.');
        }

        \DB::beginTransaction();
        try {
            $product_warehousing_id = $product->pwd_product_warehousing_id;
            if ($product->delete()) {
                $listImeis = ProductWarehousingDetail::where('pwd_product_warehousing_id', $product_warehousing_id)->pluck('pwd_imei');
                if ($listImeis->count() > 0) {
                    $arrayImei = $listImeis->toArray();
                }

                $productWarehousing = ProductWarehousing::find($product_warehousing_id);
                if ($productWarehousing) {
                    if (!empty($arrayImei)) {
                        $productWarehousing->pw_list_imei = implode(',', $arrayImei);
                    }
//                    if ($productWarehousing->pw_total_number > 0) {
//                        $productWarehousing->pw_total_number = $productWarehousing->pw_total_number - 1;
//                    }
                    $productWarehousing->save();
                }
            }


            \DB::commit();
            return redirect()->back()->with('success','[Success] Xóa thành công.');
        } catch (\Exception $exception) {
            \DB::rollBack();
            \Log::error($exception);
            return false;
        }
    }

    public function getListImei(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->product_id;

            if ($id) {
                $listImeis = ProductWarehousingDetail::where(['pwd_product_id' => $id, 'pwd_status' => 1])->get();

                return response([
                    'code' => 200,
                    'imeis' => $listImeis
                ]);
            }
        }
    }
}
