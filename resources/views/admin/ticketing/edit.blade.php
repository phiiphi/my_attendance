@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        SELL TICKET
    </div>
    <div class="card-body">
        <form class="needs-validation" method="POST" action="{{route('admin.ticketing.update',$ticket->id)}}"  enctype="multipart/form-data">
        {{ csrf_field() }}
        @method('PUT')
            <div class="form-group {{ $errors->has('ticket_number') ? 'has-error' : '' }}">
                <label for="ticket_number">Ticket Number</label>
                <input type="text" id="ticket_number" name="ticket_number" value="{{ $ticket->ticket_number }}"class="form-control" value="" required>
                @if($errors->has('ticket_number'))
                    <em class="invalid-feedback">
                        {{ $errors->first('ticket_number') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.name_helper') }}
                </p>
            </div>
            <div class="form-row">  
                <div class="col-md-6 mb-3 hide-div {{ $errors->has('ticket_description') ? 'has-error' : '' }}" id="ticket_description">         
                    <label for="ticket_description">Tickets Description</label>
                    <input type="text" id="ticket_description" name="ticket_description" class="form-control" value="{{ $ticket->ticket_description }}" required>
                    @if($errors->has('ticket_description'))
                        <em class="invalid-feedback">
                            {{ $errors->first('ticket_description') }}
                        </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.user.fields.password_helper') }}
                    </p>
                </div>
                <div class="col-md-6 mb-3 hide-div {{ $errors->has('price') ? 'has-error' : '' }}" id="company">         
                    <label for="text">Price</label>
                    <input type="text" id="price" name="price" value="{{ $ticket->price }}" class="form-control" required>
                    @if($errors->has('price'))
                        <em class="invalid-feedback">
                            {{ $errors->first('price') }}
                        </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.user.fields.password_helper') }}
                    </p>
                </div>
            </div>
            <div class="form-group {{ $errors->has('car_number') ? 'has-error' : '' }}">
                <label for="car_number">Car Number*</label>
                <input type="text" id="car_number" name="car_number" value="{{ $ticket->car_number }}"class="form-control" required>
                @if($errors->has('car_number'))
                    <em class="invalid-feedback">
                        {{ $errors->first('car_number') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.email_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>     
        </form>
    </div>
</div>
@endsection