@extends('backend.layouts.app')
@section('content')
    <section class="content-header">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Danh sách ô vị trí</h3>

                    <div class="box-tools">
                        <a href="{!! route('get.create.box') !!}" class="btn btn-success"><i class="fa fa-plus-circle"></i>Thêm mới</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <tbody>
                        <tr>
                            <th style="width: 60px" class="text-center">STT</th>
                            <th>Tên ô vị trí</th>
                            <th>Vị trí</th>
                            <th>Trạng thái</th>
                            <th style="width: 150px">Thao tác khác</th>
                        </tr>
                        @if(!$boxs->isEmpty())
                            @foreach($boxs as $key => $box)
                                <tr>
                                    <td style="width: 60px" class="text-center">{{$key + 1}}</td>
                                    <td>{{ $box->lb_name }}</td>
                                    <td>{{ isset($box->location) ? $box->location->l_name : '' }}</td>
                                    <td>{{ isset($status[$box->lb_status]) ? $status[$box->lb_status] : '' }}</td>
                                    <td style="width: 150px">
                                        <a href="{{ route('get.update.box', $box->id) }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('get.delete.box', $box->id) }}" class="btn btn-xs btn-info confirm__btn"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="box-footer text-right">
                    {{ $boxs->appends($query = '')->links() }}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </section>
@endsection