<form action="{{ $formAction }}" method="POST" style="border-radius: 0px;" class="form-horizontal group-border-dashed">
    {{ $csrf_field }}
    {{ $method_field }}

    <div class="form-group">
        <label class="col-md-3 col-lg-3 control-label">First Name</label>
        <div class="col-md-9 col-lg-6">
            <input type="text" class="form-control" name="first_name" value="{{ $user->profile->first_name or old('first_name') }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 col-lg-3 control-label">Last Name</label>
        <div class="col-md-9 col-lg-6">
            <input type="text" class="form-control" name="last_name" value="{{ $user->profile->last_name or old('last_name') }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 col-lg-3 control-label">Occupation</label>
        <div class="col-md-9 col-lg-6">
            <input type="text" class="form-control" name="occupation" value="{{ $user->profile->occupation or old('occupation') }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 col-lg-3 control-label">Date of Birth</label>
        <div class="col-md-9 col-lg-6">
            <div data-min-view="2" data-date-format="yyyy-mm-dd" class="input-group date datetimepicker">
                <input size="16" type="text" name="date_of_birth" value="{{ $user->profile->date_of_birth or old('date_of_birth') }}" class="form-control"><span class="input-group-addon btn btn-primary"><i class="icon-th mdi mdi-calendar"></i></span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 col-lg-3 control-label">Phone</label>
        <div class="col-md-9 col-lg-6">
            <input type="text" class="form-control"  name="phone" value="{{ $user->profile->phone or old('phone') }}">
        </div>
    </div>

    <div class="row xs-pt-12">
        <div class="col-md-12 col-lg-9">
            <p class="text-right">
                <a href="{{ $cancelRoute}}" class="btn btn-space btn-default">Cancel</a>
                <button type="submit" class="btn btn-space btn-primary">{{ $submit }}</button>
            </p>
        </div>
    </div>
</form>
