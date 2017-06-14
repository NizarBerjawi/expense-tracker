<form action="{{ $formAction }}" method="POST" style="border-radius: 0px;" class="form-horizontal group-border-dashed">
    {{ $csrfField }}
    {{ $methodField }}

    <div class="form-group">
        <label class="col-md-3 col-lg-3 control-label">From</label>
        <div class="col-md-9 col-lg-6">
            <select class="form-control" name="transfer_from">
                @foreach ($assets as $asset)
                    <option value="{{ $asset->id }}">{{ $asset->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 col-lg-3 control-label">To</label>
        <div class="col-md-9 col-lg-6">
            <select class="form-control" name="transfer_to">
                @foreach ($assets as $asset)
                    <option value="{{ $asset->id }}">{{ $asset->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 col-lg-3 control-label">Amount</label>
        <div class="col-md-9 col-lg-6">
            <input type="text" class="form-control" name="amount" value="{{ old('amount') }}">
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
