<form action="{{ $formAction }}" method="POST" style="border-radius: 0px;" class="form-horizontal group-border-dashed">
    {{ $csrfField }}
    {{ $methodField }}

    <div class="form-group">
        <label class="col-md-3 col-lg-3 control-label">Account Name</label>
        <div class="col-md-9 col-lg-6">
            <input type="text" class="form-control" name="name" value="{{ $user->bank->name or old('name') }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 col-lg-3 control-label">Bank Name</label>
        <div class="col-md-9 col-lg-6">
            <input type="text" class="form-control" name="bank" value="{{ $user->bankAccount->bank or old('bank') }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 col-lg-3 control-label">Starting Balance</label>
        <div class="col-md-9 col-lg-6">
            <input type="text" class="form-control" name="starting_balance" value="{{ $user->bankAccount->starting_balance or old('starting_balance') }}">
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
