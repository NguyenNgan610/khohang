@extends('backend.layouts.app')
@section('content')

    <section class="content-header">
        <div class="col-xs-12">
            <div class="box">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Cập nhật dữ liệu sản phẩm</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    @include('backend.product_warehousing_detail.form')
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </section>
@endsection