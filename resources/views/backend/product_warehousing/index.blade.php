@extends('backend.layouts.app')
@section('content')
    <section class="content-header">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">@if($type) Danh sách sản phẩm đã nhập @else Danh sách sản phẩm đã xuất @endif</h3>
                    <div class="box-header" style="width: 100%;">
                        <form action="" class="form-inline">
                            <div class="col-sm-3" style="padding-left: 0px">
                                <select name="pw_product_id" class="form-control" style="width: 100%;">
                                    <option value="">Chọn sản phẩm</option>
                                    @if($listProducts)
                                        @foreach($listProducts as $pro)
                                            <option  {{Request::get('pw_product_id')  == $pro->id ? 'selected=selected' : '' }}  value="{{$pro->id}}">{{$pro->p_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            @if ($type)
                                <div class="col-sm-3">
                                    <select name="pw_supplier_id" class="form-control" style="width: 100%;">
                                        <option value="">Chọn nhà cung cấp</option>
                                        @if($suppliers)
                                            @foreach($suppliers as $supplier)
                                                <option  {{Request::get('pw_supplier_id')  == $supplier->id ? 'selected=selected' : '' }}  value="{{$supplier->id}}">{{$supplier->s_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            @else
                            <div class="col-sm-3">
                                <select name="pw_customer_id" class="form-control" style="width: 100%;">
                                    <option value="">Chọn khách hàng</option>
                                    @if($customers)
                                        @foreach($customers as $customer)
                                            <option  {{Request::get('pw_customer_id')  == $customer->id ? 'selected=selected' : '' }}  value="{{$customer->id}}">{{$customer->ct_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            @endif

                            @if($type)
                            <div class="col-sm-2">
                                <select name="pw_status" class="form-control" style="width: 100%;">
                                    <option value="">Trạng thái</option>
                                    <option {{Request::get('pw_status')  == 1 ? 'selected=selected' : '' }} value="1">Săp hết hạn</option>
                                    <option {{Request::get('pw_status')  == 2 ? 'selected=selected' : '' }} value="2">Đã hết hạn</option>
                                </select>
                            </div>
                            @endif
                            <div class="col-sm-1" style=" margin-right: 30px;">
                                <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Tìm kiếm</button>
                            </div>
                            <div class="col-sm-2">
                                <a href="@php echo  strstr(url()->full(),'?') == true ? url()->full() . '&export=excel' : url()->full() . '?export=excel' @endphp" class="btn btn-block btn-success"><i class="fa fa-fw fa-file-excel-o"></i>  Export excel</a>
                            </div>
                        </form>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 2%;" class="text-center">STT</th>
                            <th>Tên sản phẩm</th>
                            @if($type)
                                <th>Nhà cung cấp</th>
                            @else
                            <th>Khách hàng</th>
                            @endif

                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th style="width: 8%;">Đơn vị</th>
                            @if($type)
                            <th>Ngày sản xuất</th>
                            @endif
                            <th>Tổng tiền</th>
                            <th>Ngày @if($type) nhập @else xuất @endif </th>
                            <th style="width: 2%;">Thao tác khác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $key => $product)
                            <tr>
                                <td style="width: 2%;">{{ $key + 1 }}</td>
                                <td>
                                    <p class="text-type-doccument" data-toggle="tooltip" data-placement="top" title="{{ $product->product->p_name }}" >
                                        <span class="content-space" title="{{ $product->product->p_name }}">
                                            {{ $product->product->p_name }}
                                        </span>
                                    </p>
                                </td>
                                @if($type)
                                    <td>{{ isset($product->supplier) ? $product->supplier->s_name : '' }}</td>
                                @else
                                    <td>{{ isset($product->customer) ? $product->customer->ct_name : '' }}</td>
                                @endif

                                <td>{{ str_replace('-', '', $product->pw_total_number) }}</td>
                                <td>
                                    @switch($product->pw_active_price)
                                        @case(1)
                                        {{ number_format($product->product->p_entry_price, 0, ',', '.') }}<sup>đ</sup>
                                        @break
                                        @case(2)
                                        {{ number_format($product->product->p_retail_price, 0, ',', '.') }}<sup>đ</sup>
                                        @break
                                        @case(3)
                                        {{ number_format($product->product->p_cost_price, 0, ',', '.') }}<sup>đ</sup>
                                        @break
                                        @case(4)
                                        {{ number_format($product->pw_custom_price, 0, ',', '.') }}<sup>đ</sup>
                                        @break
                                        @default
                                        {{ number_format($product->product->p_entry_price, 0, ',', '.') }}<sup>đ</sup>
                                        @break
                                    @endswitch
                                </td>
                                <td>{{ $product->product->unit->u_name }}</td>
                                @if($type)
                                <td>{{ $product->pw_manufacturing_date }}</td>
                                @endif
                                <td>{{ number_format($product->pw_total_price, 0, ',', '.') }}<sup>đ</sup></td>
                                <td>{{ $product->created_at }}</td>
                                <td style="width: 2%;">
                                    @php
                                        $typeDetail = $type ? 1 : 2;
                                    @endphp
                                    @if ($type)
                                    {{--<a href="{{ route('get.list.product.warehousing.detail', ['id' => $product->id, 'type' => 1]) }}" class="btn btn-xs btn-info mg-t-5"><i class="fa fa-eye"></i></a>--}}
                                    @else
                                        {{--<a href="{{ route('get.list.product.warehousing.export.detail', ['id' => $product->id, 'type' => 2]) }}" class="btn btn-xs btn-info mg-t-5"><i class="fa fa-eye"></i></a>--}}
                                    @endif
                                    <a href="{!! route('delete.product.goods_issue', $product->id) !!}" class="btn btn-xs btn-info confirm__btn mg-t-5"><i class="fa fa-trash-o"></i></a>
                                    @if(!$type)
                                    <a href="{{ route('get.warranty', $product->id) }}" class="btn btn-xs btn-info mg-t-5" title="Phiếu bảo hành"><i class="fa fa-fw fa-black-tie"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
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