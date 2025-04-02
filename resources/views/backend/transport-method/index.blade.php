@extends('backend.layouts.app')
@section('content')
    <section class="content-header">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Phương thức vận chuyển</h3>

                    <div class="box-tools">
                        <a href="{!! route('get.create.transport.method') !!}" class="btn btn-success"><i class="fa fa-plus-circle"></i>Thêm mới</a>
                    </div>
                </div>
                <div class="box-header">
                    <div class="pull-left">
                        <form action="" class="form-inline">
                            <input type="text" class="form-control" name="tm_name" placeholder="Phương thức vận chuyển ..." value="{{ Request::get('tm_name') }}">
                            <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Tìm kiếm</button>
                        </form>
                    </div>

                    <div class="clearfix"></div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered">
                        <tbody>
                            <tr>
                                <th width="2%" class="text-center">STT</th>
                                <th>Phương thức vận chuyển</th>
                                {{--<th>Đơn vị vận chuyển</th>--}}
                                {{--<th>Chi phí vận chuyển</th>--}}
                                <th>Trạng thái</th>
                                <th>Thao tác khác</th>
                            </tr>
                            @if(!$transportMethods->isEmpty())
                                @foreach($transportMethods as $key => $transport)
                                    <tr>
                                        <td widtd="2%" class="text-center">{{$key + 1}}</td>
                                        <td>{{ $transport->tm_name }}</td>
                                        {{--<td>{{ $transport->	tm_carrier }}</td>--}}
                                        <td>{{ isset($status[$transport->tm_status]) ? $status[$transport->tm_status] : '' }}</td>
                                        <td>
                                            <a href="{{ route('get.update.transport.method',$transport->id) }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('get.delete.transport.method',$transport->id) }}" class="btn btn-xs btn-info confirm__btn"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="box-footer text-right">
                    {{ $transportMethods->appends($query = '')->links() }}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </section>
@endsection