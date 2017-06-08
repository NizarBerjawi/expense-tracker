<form id="reset-password" class="col-sm-12 form-horizontal" action="{{ $formAction }}" method="POST" role="form">
    {{ $csrfField }}

    <div class="form-group">
        <label class="col-sm-3 control-label">Old Password</label>
        <div class="col-sm-9">
            <input id="password" type="password" class="form-control" name="old_password" required>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label">New Password</label>
        <div class="col-sm-9">
            <input id="password" type="password" class="form-control" name="password" required>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-3 control-label">Confirm New Password</label>
        <div class="col-sm-9">
            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-12">
            <p class="text-right">
                <a class="btn btn-default" href="{{ $cancelRoute }}">Cancel</a>
                <button class="btn btn-primary" type="submit">{{ $submit }}</button>
            </p>
        </div>
    </div>
</form>
