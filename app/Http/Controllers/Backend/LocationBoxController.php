<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\LocationBox;
use App\Model\Location;
use App\Http\Requests\LocationBoxRequest;


class LocationBoxController extends Controller
{
    public function __construct()
    {
        view()->share([
            'box_active' => 'active',
            'locations' => Location::all(),
            'status' => LocationBox::STATUS
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $boxs = LocationBox::with('location');
        $boxs = $boxs->orderBy('id', 'DESC')->paginate(20);
        return view('backend.boxs.index', compact('boxs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.boxs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocationBoxRequest $request)
    {
        //
        if ($this->processCreateOrUpdate($request)) {
            return redirect()->back()->with('success','[Success] Thêm mới thành công.');
        }

        return redirect()->back()->with('danger', '[Error] Đã xảy ra lỗi không thể lưu dữ liệu.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $box = LocationBox::find($id);
        if (!$box) {
            return redirect()->route('get.list.box')->with('danger', '[Error] Đã xảy ra lỗi dữ liệu không tồn tại.');
        }
        return view('backend.boxs.update', compact('box'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LocationBoxRequest $request, $id)
    {
        //
        if ($this->processCreateOrUpdate($request, $id)) {
            return redirect()->back()->with('success','[Success] Chỉnh sửa thành công.');
        }
        return redirect()->back()->with('danger', '[Error] Đã xảy ra lỗi không thể lưu dữ liệu.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
        $box = LocationBox::find($id);
        if (!$box) {
            return redirect()->route('get.list.box')->with('danger', '[Error] Đã xảy ra lỗi không thể xóa dữ liệu.');
        }

        try {
            $location_id = $box->lb_location_id;

            if($box->delete()) {
                $number = LocationBox::where(['lb_location_id' => $location_id, 'lb_status' => 2])->count();
                if ($number == 0) {
                    $location = Location::find($location_id);
                    if ($location) {
                        $location->update(['l_status', 2]);
                    }
                }
            }
            return redirect()->back()->with('success','[Success] Xóa thành công.');
        } catch (\Exception $exception) {
            \Log::error($exception);
            return redirect()->back()->with('danger', '[Error] Đã xảy ra lỗi không thể xóa dữ liệu.');
        }
    }

    public function processCreateOrUpdate($request, $id = NULL)
    {
        $data = $request->except('_token');
        $data['updated_at'] = now();


        \DB::beginTransaction();
        try {
            if ($id === NULL) {
                $data['created_at'] = now();

                LocationBox::insert($data);

                $location = Location::find($data['lb_location_id']);
                if ($location) {
                    $location->update(['l_status' => 2]);
                }
            } else {
                if ($data['lb_status'] == 2) {
                    $location = Location::find($data['lb_location_id']);
                    if ($location) {
                        $location->update(['l_status' => 2]);
                    }
                } else {
                    $number = LocationBox::where(['lb_location_id' => $data['lb_location_id'], 'lb_status' => 2])->count();
                    if ($number == 0) {
                        $location = Location::find($data['lb_location_id']);
                        if ($location) {
                            $location->update(['l_status', 2]);
                        }
                    }
                }
                LocationBox::find($id)->update($data);
            }
            \DB::commit();
            return true;
        } catch (\Exception $exception) {
            \DB::rollBack();
            \Log::error($exception);
            return false;
        }
    }

    public function ajaxGetBox(Request $request)
    {
        if ($request->ajax())
        {
            $id = $request->location_id;
            $boxs = LocationBox::where('lb_location_id', $id)->where('lb_status', 2)->get();

            if ($boxs->isEmpty()) {
                return response([
                    'code' => 404
                ]);
            }

            return response([
                'code' => 200,
                'boxs' => $boxs
            ]);
        }
    }
}
