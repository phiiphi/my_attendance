@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        EMPLOYEE
    </div>
    <div class="card-body">
        <form action="{{ route("admin.driver.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                <label for="first_name">Firstname</label>
                <input type="text" id="first_name" name="first_name" class="form-control" value="" required>
                @if($errors->has('first_name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('first_name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.name_helper') }}
                </p>
            </div>
            <div class="form-row">  
                <div class="col-md-6 mb-3 hide-div {{ $errors->has('surname') ? 'has-error' : '' }}" id="surname">         
                    <label for="surname">Surname</label>
                    <input type="text" id="surname" name="surname" class="form-control" required>
                    @if($errors->has('surname'))
                        <em class="invalid-feedback">
                            {{ $errors->first('surname') }}
                        </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.user.fields.password_helper') }}
                    </p>
                </div>
                <div class="col-md-6 mb-3 hide-div {{ $errors->has('lincense_weight') ? 'has-error' : '' }}" id="lincense_weight">         
                    <label for="text">Lincense Type</label>
                    <input type="text" id="lincense_weight" name="lincense_weight" class="form-control" required>
                    @if($errors->has('lincense_weight'))
                        <em class="invalid-feedback">
                            {{ $errors->first('lincense_weight') }}
                        </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.user.fields.password_helper') }}
                    </p>
                </div>
            </div>
            <div class="form-row">           
                <div class="col-md-6 mb-3 hide-div" id="phone">
                    <label class="text-uppercase" for="phone">Phone</label>
                    <input type="text" id="phone" name="phone" class="form-control" required>
                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-md-6 mb-3 hide-div" id="car_number">
                    <label class="text-uppercase" for="car_number">Car Number</label>
                    <input type="text" id="car_number" name="car_number" class="form-control" required>
                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>     
        </form>
    </div>
</div>
@endsection