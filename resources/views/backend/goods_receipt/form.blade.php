<form role="form" action="" id="goods_receipt" method="POST">
    @csrf
    <div class="box-body">
        <div class="row">
            <div class="form-group col-md-6 {{ $errors->has('w_code') ? 'has-error' : '' }}">
                <div class="fs-13">
                    <label for="company">Mã đơn hàng <span class="title-sup">(*)</span></label>
                </div>
                <div class="row" style="margin: 0px">
                    <div class="col-sm-9" style="padding: 0px; margin: 0px">
                        <input class="form-control random_code" id="random_code" oninput="if(value.length>15)value=value.slice(0,15)" name="w_code" value="{{ old('w_code', isset($warehousing) ? $warehousing->w_code : '') }}" type="text" placeholder="Mã đơn hàng (DHN_ngay/thang/nam)" required>
                    </div>
                    <div class="col-sm-3 default">
                        <button style="margin-left:15px" class="btn btn-blue btn-info btn-change btn-change-code" ><i class="fa fa-fw fa-refresh"></i>  Tạo mã</button>
                    </div>
                    @if($errors->has('u_code'))
                        <span class="help-block">{{$errors->first('u_code')}}</span>
                    @endif
                </div>
            </div>
            <div class="form-group col-md-6 {{ $errors->has('w_name') ? 'has-error' : '' }}">
                <label for="exampleInputEmail1">Nội dung xuất hàng <sup class="title-sup">(*)</sup></label>
                <input type="text" class="form-control" name="w_name" value="{{ old('w_name', isset($warehousing) ? $warehousing->w_name : '') }}" placeholder="Nội dung nhập hàng" required>
                @if($errors->has('w_name'))
                    <span class="help-block">{{$errors->first('w_name')}}</span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6 {{ $errors->has('w_transport_method_id') ? 'has-error' : '' }}">
                <label for="exampleInputEmail1" class="mg-t-10">Phương thức vận chuyển</label>
                <select class="form-control" name="w_transport_method_id">
                    <option value="">Chọn phương thức vận chuyển</option>

                    @foreach($transportMethods as $key => $transport)
                        <option {{ old('w_transport_method_id', isset($warehousing->w_transport_method_id) ? $warehousing->w_transport_method_id : '') == $transport->id ? 'selected' : '' }} value="{{ $transport->id }}">{{ $transport->tm_name }}</option>
                    @endforeach
                </select>
                @if($errors->has('w_transport_method_id'))
                    <span class="help-block">{{$errors->first('w_transport_method_id')}}</span>
                @endif
            </div>
            <div class="form-group col-md-6 {{ $errors->has('w_schedule') ? 'has-error' : '' }}">
                <label for="exampleInputEmail1" class="mg-t-10">Lịch trình </label>
                <input type="text" class="form-control" name="w_schedule" value="{{ old('w_schedule', isset($warehousing) ? $warehousing->w_schedule : '') }}" placeholder="Lịch trình">
                @if($errors->has('w_schedule'))
                    <span class="help-block">{{$errors->first('w_schedule')}}</span>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6 {{ $errors->has('w_status') ? 'has-error' : '' }}">
                <label for="exampleInputEmail1">Trạng thái vận chuyển <sup class="title-sup">(*)</sup></label>
                <select class="form-control" name="w_status">
                    @foreach($status as $key => $item)
                        <option {{ old('w_status', isset($warehousing->w_status) ? $warehousing->w_status : '') == $key ? 'selected' : '' }} value="{{ $key }}">{{ $item }}</option>
                    @endforeach
                </select>
                @if($errors->has('w_status'))
                    <span class="help-block">{{$errors->first('w_status')}}</span>
                @endif
            </div>
        </div>
        <div class="form-group {{ $errors->has('w_note') ? 'has-error' : '' }}">
            <label for="exampleInputEmail1">Ghi chú </label>
            <textarea name="w_note" class="form-control" id="" cols="30" rows="1">{{ old('w_note', isset($warehousing) ? $warehousing->w_note : '') }}</textarea>
            @if($errors->has('w_note'))
                <span class="help-block">{{$errors->first('w_note')}}</span>
            @endif
        </div>
    </div>

    <div class="box-body">
        <label for="exampleInputEmail1">Dữ liệu xuất hàng <sup class="title-sup">(*)</sup></label>
        <table class="table table-bordered" id = "table-import-product" url="{!! route('add.row.export.table') !!}" urlCalculate = "{!! route('export.calculate.total.amount') !!}" urlGetListImei="{{ route('get.list.imei') }}">
            <thead>
                <tr>
                    <th class="text-center">Sản phẩm</th>
                    <th class="text-center">Nhà cung cấp</th>
                    <th class="text-center">Khách hàng</th>
                    <th class="text-center">Số lượng</th>
                    <th class="text-center">Đơn giá</th>
                    <th class="text-center">Tổng tiền</th>
                    <th width="2%" class="text-center">Xóa</th>
                </tr>
            </thead>
            <tbody class="content-table">
                @if (!isset($warehousing))
                    <tr location="0" class="product_0">
                        <td>
                            <select name="pw_product_id[0]" id="" class="form-control select pw_product_id" required>
                                <option value="">Chọn sản phẩm</option>
                                @if($products)
                                    @foreach($products as $key => $product)
                                        <option value="{{ $product->id }}">{{ $product->p_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </td>
                        <td>
                            <select name="pw_supplier_id[0]" id="" class="form-control select" required>
                                <option value="">Chọn nhà cung cấp</option>
                                @if($suppliers)
                                    @foreach($suppliers as $key => $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->s_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </td>
                        <td>
                            <select name="pw_customer_id[0]" id="" class="form-control select" required>
                                <option value="">Chọn khách hàng</option>
                                @if($customers)
                                    @foreach($customers as $key => $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->ct_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </td>
                        <td>
                            <input type="number" class="form-control pw_total_number" name="pw_total_number[0]" value="" placeholder="Số lượng sản phẩm" required min="1">
                        </td>
                        <td>
                            <input type="radio" value="1" name="pw_active_price[0]" checked class="pw_active_price"> Giá nhập
                            <input type="radio" value="2" name="pw_active_price[0]" class="pw_active_price"> Giá bán lẻ
                            <input type="radio" value="3" name="pw_active_price[0]" class="pw_active_price"> Giá bán sỉ
                            <input type="radio" value="4" name="pw_active_price[0]" class="pw_active_price"> Giá khác
                            <input type="number" class="form-control mg-t-10 pw_custom_price" oninput="if(value.length > 8 )value=value.slice(0, 15)" name="pw_custom_price[0]" value="" placeholder="Giá sản phẩm" style="display: none">
                        </td>
                        <td>
                            <p class="pw_total_price"></p>
                            <input type="hidden" class="form-control pw_total_price" name="pw_total_price[0]" value="">
                        </td>
                        <td><a class="btn btn-xs btn-info confirm__btn mg-t-5"><i class="fa fa-trash-o"></i></a></td>
                    </tr>
                @else
                    @if ($warehousing->warehousingProduct->isNotEmpty())
                        @foreach($warehousing->warehousingProduct as $keys => $productData)
                            <tr location="{{ $keys }}" class="product_{{ $keys }}">
                                <td>
                                    <select name="pw_product_id[{{ $keys }}]" id="" class="form-control select pw_product_id" required>
                                        <option value="">Chọn sản phẩm</option>
                                        @if($products)
                                            @foreach($products as $key => $product)
                                                <option {{ $product->id == $productData->pw_product_id ? 'selected=selected' : '' }} value="{{ $product->id }}" >{{ $product->p_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </td>
                                <td>
                                    <select name="pw_supplier_id[{{ $keys }}]" id="" class="form-control select" required>
                                        <option value="">Chọn nhà cung cấp</option>
                                        @if($suppliers)
                                            @foreach($suppliers as $key => $supplier)
                                                <option {{ $supplier->id == $productData->pw_supplier_id ? 'selected=selected' : '' }} value="{{ $supplier->id }}">{{ $supplier->s_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </td>
                                <td>
                                    <select name="pw_customer_id[{{ $keys }}]" id="" class="form-control select" required>
                                        <option value="">Chọn khách hàng</option>
                                        @if($customers)
                                            @foreach($customers as $key => $customer)
                                                <option {{ $customer->id == $productData->pw_customer_id ? 'selected=selected' : '' }} value="{{ $customer->id }}">{{ $customer->ct_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </td>
                                <td>
                                    <input type="number" class="form-control pw_total_number" name="pw_total_number[{{ $keys }}]" value="{{ isset($productData) ? str_replace('-', '', $productData->pw_total_number)  : '' }}" placeholder="Số lượng" required min="1">
                                </td>
                                <td>
                                    <input type="radio" value="1" name="pw_active_price[{{ $keys }}]" {{ $productData->pw_active_price == 1 ? 'checked' : '' }}  class="pw_active_price"> Giá nhập
                                    <input type="radio" value="2" name="pw_active_price[{{ $keys }}]" {{ $productData->pw_active_price == 2 ? 'checked' : '' }} class="pw_active_price"> Giá bán lẻ
                                    <input type="radio" value="3" name="pw_active_price[{{ $keys }}]" {{ $productData->pw_active_price == 3 ? 'checked' : '' }} class="pw_active_price"> Giá bán sỉ
                                    <input type="radio" value="4" name="pw_active_price[{{ $keys }}]" {{ $productData->pw_active_price == 4 ? 'checked' : '' }} class="pw_active_price"> Giá khác
                                    <input type="number" class="form-control mg-t-10 pw_custom_price" oninput="if(value.length > 8 )value=value.slice(0, 15)" name="pw_custom_price[0]" value="{{ $productData->pw_custom_price }}" placeholder="Giá sản phẩm" style="display: {{ $productData->pw_active_price == 4 ? 'block' : 'none' }}">
                                </td>
                                <td>
                                    <p class="pw_total_price">{{ number_format($productData->pw_total_price, 0,',','.') }} <sup>đ</sup></p>
                                    <input type="hidden" class="form-control pw_total_price" name="pw_total_price[{{ $keys }}]" value="{{ $productData->pw_total_price }}">
                                </td>
                                <td><a class="btn btn-xs btn-info mg-t-5 delete-item-product"><i class="fa fa-trash-o"></i></a></td>
                            </tr>
                        @endforeach
                    @else
                        <tr location="0" class="product_0">
                            <td>
                                <select name="pw_product_id[0]" id="" class="form-control select pw_product_id" required>
                                    <option value="">Chọn sản phẩm</option>
                                    @if($products)
                                        @foreach($products as $key => $product)
                                            <option value="{{ $product->id }}">{{ $product->p_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </td>
                            <td>
                                <select name="pw_supplier_id[0]" id="" class="form-control select" required>
                                    <option value="">Chọn nhà cung cấp</option>
                                    @if($suppliers)
                                        @foreach($suppliers as $key => $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->s_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </td>
                            <td>
                                <select name="pw_customer_id[0]" id="" class="form-control select" required>
                                    <option value="">Chọn khách hàng</option>
                                    @if($customers)
                                        @foreach($customers as $key => $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->ct_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </td>
                            <td>
                                <input type="radio" value="1" name="pw_active_price[0]" checked class="pw_active_price"> Giá nhập
                                <input type="radio" value="2" name="pw_active_price[0]" class="pw_active_price"> Giá bán lẻ
                                <input type="radio" value="3" name="pw_active_price[0]" class="pw_active_price"> Giá bán sỉ
                                <input type="radio" value="4" name="pw_active_price[0]" class="pw_active_price"> Giá khác
                                <input type="number" class="form-control mg-t-10 pw_custom_price" oninput="if(value.length > 8 )value=value.slice(0, 15)" name="pw_custom_price[0]" value="" placeholder="Giá sản phẩm" style="display: none">
                            </td>
                            <td>
                                <p class="pw_total_price"></p>
                                <input type="hidden" class="form-control pw_total_price" name="pw_total_price[0]" value="">
                            </td>
                            <td><a class="btn btn-xs btn-info confirm__btn mg-t-5"><i class="fa fa-trash-o"></i></a></td>
                        </tr>
                    @endif
                @endif
            </tbody>
        </table>
    </div>
    <div class="box-body text-right">
        <button type="button" class="btn btn-success mg-t-20 mg-b-15 btn-add-row-import_product"><i class="fa fa-plus-circle"></i> Thêm sản phẩm</button>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <button type="submit" class="btn btn-primary btn-goods-receipt"><i class="fa fa-floppy-o"></i> Lưu thông tin</button>
        <a href="" class="btn btn-danger"><i class="fa fa-close"></i> Huỷ bỏ</a>
    </div>
</form>
@section('script')
    <script>
        $(function () {
            $(document).on("keydown", "form", function(event) {
                return event.key != "Enter";
            });

            document.getElementById("goods_receipt").onkeypress = function(e) {
                var key = e.charCode || e.keyCode || 0;
                if (key == 13) {
                    e.preventDefault();
                }
            }
        })
    </script>
@endsection