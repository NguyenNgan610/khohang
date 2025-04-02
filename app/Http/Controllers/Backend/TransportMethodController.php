<?php

namespace App\Http\Controllers\Backend;

use App\Model\TransportMethod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransportMethodRequest;

class TransportMethodController extends Controller
{
    public function __construct()
    {
        view()->share([
            'transport_method' => 'active',
            "status" => TransportMethod::STATUS,
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $transportMethods = TransportMethod::select('*');

        if ($request->tm_name) {
            $transportMethods = $transportMethods->where('tm_name','like','%'.$request->tm_name.'%');
        }

        $transportMethods = $transportMethods->orderBy('id', 'DESC')->paginate(20);

        return view('backend.transport-method.index', compact('transportMethods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.transport-method.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransportMethodRequest $request)
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
     * @param  \App\TransportMethod  $transportMethod
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $transportMethod = TransportMethod::find($id);
        if (!$transportMethod) {
            return redirect()->route('get.list.transport.method')->with('danger', '[Error] Đã xảy ra lỗi dữ liệu không tồn tại.');
        }
        return view('backend.transport-method.update', compact('transportMethod'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TransportMethod  $transportMethod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
     * @param  \App\TransportMethod  $transportMethod
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
        $transportMethod = TransportMethod::findOrFail($id);
        if (!$transportMethod) {

            return redirect()->route('get.list.transport.method')->with('danger', '[Error] Đã xảy ra lỗi không thể xóa dữ liệu.');
        }

        try {
            $transportMethod->delete();
            return redirect()->back()->with('success','[Success] Xóa thành công.');
        } catch (\Exception $exception) {
            \Log::error($exception);
            return redirect()->back()->with('danger', '[Error] Đã xảy ra lỗi không thể xóa dữ liệu.');
        }
    }

    /**
     * @param $request
     * @param null $id
     * @return bool
     */
    public function processCreateOrUpdate($request, $id = NULL)
    {
        $data = $request->except('_token');
        $data['updated_at'] = now();

        \DB::beginTransaction();
        try {
            if ($id === NULL) {
                $data['created_at'] = now();
                TransportMethod::create($data);
            } else {
                TransportMethod::find($id)->update($data);
            }
            \DB::commit();
            return true;
        } catch (\Exception $exception) {
            \DB::rollBack();
            \Log::error($exception);
            return false;
        }
    }
}
