@extends('backend.layouts.app')
@section('content')
    <section class="content-header">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Danh sách vị trí</h3>

                    <div class="box-tools">
                        <a href="{!! route('get.create.locations') !!}" class="btn btn-success"><i class="fa fa-plus-circle"></i>Thêm mới</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <tbody>
                            <tr>
                                <th style="width: 60px" class="text-center">STT</th>
                                <th>Tên vị trí</th>
                                <th>Trạng thái</th>
                                <th style="width: 150px">Thao tác khác</th>
                            </tr>
                            @if(!$locations->isEmpty())
                                @foreach($locations as $key => $location)
                                    <tr>
                                        <td style="width: 60px" class="text-center">{{$key + 1}}</td>
                                        <td>{{ $location->l_name }}</td>
                                        <td>{{ isset($status[$location->l_status]) ? $status[$location->l_status] : '' }}</td>
                                        <td style="width: 150px">
                                            <a href="{{ route('get.update.locations', $location->id) }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('get.delete.locations', $location->id) }}" class="btn btn-xs btn-info confirm__btn"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="box-footer text-right">
                    {{ $locations->appends($query = '')->links() }}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </section>
@endsection