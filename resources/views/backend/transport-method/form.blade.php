<form role="form" action="" method="POST">
    @csrf
    <div class="box-body">
        <div class="row">
            <div class="form-group col-md-6 {{ $errors->has('tm_name') ? 'has-error' : '' }}">
                <label for="exampleInputEmail1">Phương thức vận chuyển <sup class="title-sup">(*)</sup></label>
                <input type="text" class="form-control" name="tm_name" value="{{ old('tm_name', isset($transportMethod) ? $transportMethod->tm_name : '') }}" placeholder="Phương thức vận chuyển">
                @if($errors->has('tm_name'))
                    <span class="help-block">{{$errors->first('tm_name')}}</span>
                @endif
            </div>

            <div class="form-group col-md-6 {{ $errors->has('tm_status') ? 'has-error' : '' }}">
                <label for="exampleInputEmail1">Trạng thái </label> &nbsp;

                <select name="tm_status" id="" class="form-control">
                    @foreach($status as $key => $item)
                        <option {{ old('tm_status', isset($transportMethod->tm_status) ? $transportMethod->tm_status : '') == $key ? 'selected' : '' }} value="{{ $key }}">{{ $item }}</option>
                    @endforeach
                </select>
                @if($errors->has('tm_status'))
                    <span class="help-block">{{$errors->first('tm_status')}}</span>
                @endif
            </div>
        </div>
        {{--<div class="row">--}}
            {{--<div class="form-group col-md-6 {{ $errors->has('tm_cost') ? 'has-error' : '' }}">--}}
                {{--<label for="exampleInputEmail1">Chi phí</label>--}}
                {{--<input type="number" class="form-control" name="tm_cost" value="{{ old('tm_cost', isset($transportMethod) ? $transportMethod->tm_cost : '') }}" placeholder="Chi phí ...">--}}
                {{--@if($errors->has('tm_cost'))--}}
                    {{--<span class="help-block">{{$errors->first('tm_cost')}}</span>--}}
                {{--@endif--}}
            {{--</div>--}}

            {{--<div class="form-group col-md-6 {{ $errors->has('tm_carrier') ? 'has-error' : '' }}">--}}
                {{--<label for="exampleInputEmail1">Đơn vị vận chuyển</label>--}}
                {{--<input type="text" class="form-control" name="tm_carrier" value="{{ old('tm_carrier', isset($transportMethod) ? $transportMethod->tm_carrier : '') }}" placeholder="Đơn vị vận chuyển">--}}
                {{--@if($errors->has('tm_carrier'))--}}
                    {{--<span class="help-block">{{$errors->first('tm_carrier')}}</span>--}}
                {{--@endif--}}
            {{--</div>--}}
        {{--</div>--}}

    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Lưu thông tin</button>
        <a href="{{ route('get.list.transport.method') }}" class="btn btn-danger"><i class="fa fa-close"></i> Huỷ bỏ</a>
    </div>
</form>