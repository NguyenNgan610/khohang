<form role="form" action="" method="POST">
    @csrf
    <div class="box-body">
        <div class="form-group {{ $errors->has('lb_name') ? 'has-error' : '' }}">
            <label for="exampleInputEmail1" class="mg-t-10">Tên ô vị trí <sup class="title-sup">(*)</sup></label>
            <input type="text" class="form-control" name="lb_name" value="{{ old('lb_name', isset($box) ? $box->lb_name : '') }}" placeholder="Tên ô vị trí">
            @if($errors->has('lb_name'))
                <span class="help-block">{{$errors->first('lb_name')}}</span>
            @endif
        </div>

        <div class="form-group {{ $errors->has('lb_location_id') ? 'has-error' : '' }}">
            <label for="exampleInputEmail1">Vị trí <sup class="title-sup">(*)</sup></label>
            <select name="lb_location_id" class="form-control">
                <option value="">Chọn vị trí </option>
                @if($locations)
                    @foreach($locations as $location)
                        <option  {{old('lb_location_id', isset($box) ? $box->lb_location_id : '') == $location->id ? 'selected=selected' : '' }}  value="{{$location->id}}">{{$location->l_name}}</option>
                    @endforeach
                @endif
            </select>
            <span class="text-danger"><p class="mg-t-5">{{ $errors->first('lb_location_id') }}</p></span>
        </div>

        <div class="form-group {{ $errors->has('lb_status') ? 'has-error' : '' }}">
            <label for="exampleInputEmail1">Trạng thái</label>
            <select name="lb_status" class="form-control">
                @if($status)
                    @foreach($status as $key => $item)
                        <option  {{old('lb_status', isset($box) ? $box->lb_status : '') == $key ? 'selected=selected' : '' }}  value="{{$key}}">{{$item}}</option>
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