@extends('backend.layouts.app')
@section('content')
    <section class="content-header">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Danh sách sản phẩm</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <tbody>
                        <tr>
                            <th widtd="2%" class="text-center">STT</th>
                            <th>Tên sản phẩm</th>
                            
                            <th>Vị trí</th>
                            <th>Ghi chú</th>
                            @if($type == 2)
                            <th>Trạng thái</th>
                            @endif
                            @if($type == 1)
                            <th>Thao tác khác</th>
                            @endif
                        </tr>
                        @if(!$products->isEmpty())
                            @foreach($products as $key => $product)
                                <tr>
                                    <td widtd="2%" class="text-center">{{$key + 1}}</td>
                                    <td>
                                        {{ $product->product->p_name }}
                                    </td>
                                    <td>{{ $product->pwd_imei }}</td>
                                    <td>{{ $product->location !== null ? $product->location->l_name : '' }} @if ($product->box) - {{ $product->box->lb_name }} @endif</td>
                                    <td>{{ $product->pwd_note }}</td>
                                    @if($type == 2)
                                    <td>
                                        {{ $product->pwd_status !== 1 ? 'Đã xuất' : '' }}
                                    </td>
                                    @endif
                                    @if($type == 1)
                                    <td>
                                        <a href="{{ route('get.list.product.warehousing.update', $product->id) }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('delete.product.warehousing.detail',$product->id) }}" class="btn btn-xs btn-info confirm__btn"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                    @endif
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