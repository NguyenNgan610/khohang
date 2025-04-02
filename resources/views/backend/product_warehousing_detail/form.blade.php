<form role="form" action="" method="POST">
    @csrf
    <div class="box-body">

        <div class="form-group {{ $errors->has('c_code') ? 'has-error' : '' }}">
            <div class="fs-13">
                <label for="company">Imei </label>
            </div>
            <div class="col-sm-12" style="display: inline-block; padding: 0px;">
                <input class="form-control" id="random_code" value="{{ old('pwd_imei', isset($product) ? $product->pwd_imei : '') }}" type="text" disabled>
            </div>
        </div>


        <div class="form-group {{ $errors->has('p_location_id') ? 'has-error' : '' }}">
            <label for="exampleInputEmail1">Vị trí <span class="title-sup">(*)</span></label>
            <select name="pwd_location_id" class="form-control" id="location" url="{{ route('ajax.get.box') }}">
                <option value="">Chọn vị trí</option>
                @if($locations)
                    @foreach($locations as $location)
                        <option  {{old('pwd_location_id ', isset($product) ? $product->pwd_location_id : '') == $location->id ? 'selected=selected' : '' }}  value="{{$location->id}}">{{$location->l_name}}</option>
                    @endforeach
                @endif
            </select>
            <span class="text-danger"><p class="mg-t-5">{{ $errors->first('pwd_location_id') }}</p></span>
        </div>

        <div class="form-group {{ $errors->has('pwd_box_id') ? 'has-error' : '' }}">
            <label for="exampleInputEmail1">Ô vị trí <span class="title-sup">(*)</span></label>
            <select name="pwd_box_id" class="form-control" id="location-box">
                <option value="">Chọn ô vị trí</option>
                @if($boxs)
                    @foreach($boxs as $box)
                        <option  {{old('pwd_box_id', isset($product) ? $product->pwd_box_id : '') == $box->id ? 'selected=selected' : '' }}  value="{{$box->id}}">{{$box->lb_name}}</option>
                    @endforeach
                @endif
            </select>
            <span class="text-danger"><p class="mg-t-5">{{ $errors->first('pwd_box_id') }}</p></span>
        </div>

        <div class="form-group {{ $errors->has('pwd_note') ? 'has-error' : '' }}">
            <label for="exampleInputEmail1">Ghi chú </label>
            <textarea class="form-control" rows="5" name="pwd_note">{{ old('pwd_note', isset($product) ? $product->pwd_note : '') }}</textarea>
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Lưu thông tin</button>
    </div>
</form>