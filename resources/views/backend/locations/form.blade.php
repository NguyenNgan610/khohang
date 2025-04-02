<form role="form" action="" method="POST">
    @csrf
    <div class="box-body">
        <div class="form-group {{ $errors->has('l_name') ? 'has-error' : '' }}">
            <label for="exampleInputEmail1" class="mg-t-10">Tên vị trí <sup class="title-sup">(*)</sup></label>
            <input type="text" class="form-control" name="l_name" value="{{ old('l_name', isset($location) ? $location->l_name : '') }}" placeholder="Tên vị trí">
            @if($errors->has('l_name'))
                <span class="help-block">{{$errors->first('l_name')}}</span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('l_status') ? 'has-error' : '' }}">
            <label for="exampleInputEmail1">Trạng thái</label>
            <select name="l_status" class="form-control">
                @if($status)
                    @foreach($status as $key => $item)
                        <option  {{old('l_status', isset($location) ? $location->l_status : '') == $key ? 'selected=selected' : '' }}  value="{{$key}}">{{$item}}</option>
                    @endforeach
                @endif
            </select>
            <span class="text-danger"><p class="mg-t-5">{{ $errors->first('lb_status') }}</p></span>
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Lưu thông tin</button>
        <a href="{{ route('get.list.locations') }}" class="btn btn-danger"><i class="fa fa-close"></i> Huỷ bỏ</a>
    </div>
</form>