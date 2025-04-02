@extends('backend.layouts.app')
@section('content')

    <section class="content-header">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Danh sách sản phẩm</h3>

                    <div class="box-tools">
                        <a href="{{ route('get.create.product') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i>Thêm mới</a>
                    </div>
                    <div class="box-header" style="margin-top: 15px;">
                        <form action="" class="form-inline">
                            <div class="row">
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="p_code" placeholder="Tìm mã sản phẩm ..." value="{{ Request::get('p_code') }}" style="width: 100%;">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="p_name" placeholder="Tìm tên sản phẩm ..." value="{{ Request::get('p_name') }}" style="width: 100%;">
                                </div>
                                <div class="col-sm-3">
                                    <select name="p_category_id" class="form-control" style="width: 100%;">
                                        <option value="">Loại sản phẩm</option>
                                        @if($categories)
                                            @foreach($categories as $category)
                                                <option  {{Request::get('p_category_id')  == $category->id ? 'selected=selected' : '' }}  value="{{$category->id}}">{{$category->c_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <select name="p_unit_id" class="form-control" style="width: 100%;">
                                        <option value="">Đơn vị tính</option>
                                        @if($units)
                                            @foreach($units as $unit)
                                                <option  {{Request::get('p_unit_id') == $unit->id ? 'selected=selected' : '' }}  value="{{$unit->id}}">{{$unit->u_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                {{--<div class="col-sm-3" style="margin-top: 15px;">--}}
                                    {{--<select name="p_location_id" class="form-control" style="width: 100%;">--}}
                                        {{--<option value="">Vị trí</option>--}}
                                        {{--@if($locations)--}}
                                            {{--@foreach($locations as $location)--}}
                                                {{--<option  {{Request::get('p_location_id') == $location->id ? 'selected=selected' : '' }}  value="{{$location->id}}">{{$location->l_name}}</option>--}}
                                            {{--@endforeach--}}
                                        {{--@endif--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                                <div class="col-sm-3" style="margin-top: 15px;">
                                    <select name="p_status" class="form-control" style="width: 100%;">
                                        <option value="">Trạng thái</option>
                                        <option value="1">Đang bán</option>
                                        <option value="2">Tạm dừng</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-info" style="margin-top: 15px;"><i class="fa fa-search"></i> Tìm kiếm</button>
                            </div>
                        </form>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <tbody>
                            <tr>
                                <th style="width: 40px" class="text-center">STT</th>
                                <th>Ảnh</th>
                                <th>Mã sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Danh mục</th>
                                <th>Đơn vị tính</th>
                                {{--<th>Vị trí</th>--}}
                                <th>Người tạo</th>
                                <th>Giá nhập</th>
                                <th>Giá bán lẻ</th>
                                <th>Giá bán sỉ</th>
                                <th>Trạng thái</th>
                                <th>Thao tác khác</th>
                            </tr>
                            @if(!$products->isEmpty())
                                @foreach($products as $key => $product)
                                    <tr>
                                        <td style="width: 40px; vertical-align: middle;" class="text-center">{{$key + 1}}</td>
                                        <td style="vertical-align: middle;"><img src="{!! !empty($product->p_images) ? asset('uploads/products/'.$product->p_images) : asset('admin/images/no-image.png') !!}" alt="" width="100" height="100"></td>
                                        <td style="vertical-align: middle;">{{ $product->p_code }}</td>
                                        <td style="vertical-align: middle;">
                                            <p class="text-type-doccument" data-toggle="tooltip" data-placement="top" title="{{ $product->p_name }}" >
                                                <span class="content-space" title="{{ $product->p_name }}">
                                                    {{ $product->p_name }}
                                                </span>
                                            </p>
                                        </td>
                                        <td style="vertical-align: middle;">{{ $product->category !== null ? $product->category->c_name : '' }}</td>
                                        <td style="vertical-align: middle;">{{ $product->unit !== null ? $product->unit->u_name : '' }}</td>
                                        {{--<td style="vertical-align: middle;">{{ $product->location !== null ? $product->location->l_name : '' }} @if ($product->box) - {{ $product->box->lb_name }} @endif</td>--}}
                                        <td style="vertical-align: middle;">{{ $product->user !== null ? $product->user->full_name : '' }}</td>
                                        <td style="vertical-align: middle;">{{ number_format($product->p_entry_price, 0, ',', '.') }}<sup>đ</sup></td>
                                        <td style="vertical-align: middle;">{{ number_format($product->p_retail_price, 0, ',', '.') }}<sup>đ</sup></td>
                                        <td style="vertical-align: middle;">{{ number_format($product->p_cost_price, 0, ',', '.') }}<sup>đ</sup></td>
                                        <td class="text-center" style="vertical-align: middle;">
                                            @if($product->p_status == 1)
                                                <span class="btn btn-block btn-success btn-xs" style="width: 75%">Đang bán</span>
                                            @else
                                                <span class="btn btn-block btn-danger btn-xs" style="width: 75%">Tạm dừng</span>
                                            @endif
                                        </td>
                                        <td style="vertical-align: middle;">
                                            <a href="{{ route('get.update.product',$product->id) }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('get.delete.product',$product->id) }}" class="btn btn-xs btn-info confirm__btn"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="box-footer text-right">
                    {{ $products->appends($query = '')->links() }}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </section>
@endsection