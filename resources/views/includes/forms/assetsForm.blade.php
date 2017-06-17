<form action="{{ $formAction }}" method="POST" style="border-radius: 0px;" class="form-horizontal group-border-dashed">
    {{ $csrfField }}
    {{ $methodField }}

    <div class="form-group">
        <label class="col-md-3 col-lg-3 control-label">Name</label>
        <div class="col-md-9 col-lg-6">
            <input type="text" class="form-control" name="name" value="{{ $asset->name or old('name') }}" {{ $disabled ? 'disabled' : '' }} placeholder="e.g. Bank Account ABC">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 col-lg-3 control-label">Starting Balance</label>
        <div class="col-md-9 col-lg-6">
            <input type="text" class="form-control" name="starting_balance" value="{{ $asset->starting_balance or old('starting_balance') }}" {{ $disabled ? 'disabled' : '' }} placeholder="1000000">
        </div>
    </div>

    @if(!$disabled)
    <div class="row xs-pt-12">
        <div class="col-md-12 col-lg-9">
            <p class="text-right">
                <a href="{{ $cancelRoute}}" class="btn btn-space btn-default">Cancel</a>
                <button type="submit" class="btn btn-space btn-primary">{{ $submit }}</button>
            </p>
        </div>
    </div>
    @endif
</form>
