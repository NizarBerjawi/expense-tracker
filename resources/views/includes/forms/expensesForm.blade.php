<form action="{{ $formAction }}" method="POST" style="border-radius: 0px;" class="form-horizontal group-border-dashed">
    {{ $disabled ? '' : csrf_field() }}
    {{ $methodField }}

    <div class="form-group">
        <label class="col-md-3 col-lg-3 control-label">Name</label>
        <div class="col-md-9 col-lg-6">
            <input type="text" class="form-control" {{ $disabled ? 'readonly=readonly' : '' }} name="name" value="{{ $expense->name or old('name') }}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 col-lg-3 control-label">Date</label>
        <div class="col-md-9 col-lg-6">
            <div data-min-view="2" data-date-format="yyyy-mm-dd" class="input-group date datetimepicker">
                <input size="16" {{ $disabled ? 'readonly=readonly' : '' }} type="text" name="date" value="{{ $expense->date or old('date') }}" class="form-control"><span class="input-group-addon btn btn-primary"><i class="icon-th mdi mdi-calendar"></i></span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 col-lg-3 control-label">Amount</label>
        <div class="col-md-9 col-lg-6">
            <input type="text" class="form-control" {{ $disabled ? 'readonly=readonly' : '' }} name="amount" value="{{ $expense->amount or old('amount') }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 col-lg-3 control-label">Asset</label>
        <div class="col-md-9 col-lg-6">
            <select {{ $disabled ? 'disabled' : '' }} multiple="" class="select2" name="asset_id">
                @if (!isset($expense))
                    <!-- NEW EXPENSE -->
                    @foreach($assets as $asset)
                        <option value="{{ $asset->id }}">{{ $asset->name }}</option>
                    @endforeach
                @elseif (isset($assets) and isset($expense))
                    <!-- EDIT EXPENSE -->
                    @foreach($assets as $asset)
                        <option {{ $expense->asset_id == $asset->id ? "selected" : "" }} value="{{ $asset->id }}">{{ $asset->name }}</option>
                    @endforeach
                @elseif (isset($expense) and isset($expense->asset_id))
                    <!-- VIEW EXPENSE -->
                    <option value="{{ $expense->asset->id }}" selected>{{ $expense->asset->name }}</option>
                @endif
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 col-lg-3 control-label">Category</label>
        <div class="col-md-9 col-lg-6">
            <select {{ $disabled ? 'disabled' : '' }} multiple="" class="select2" name="category_id">
                @if (isset($categories) and !isset($expense))
                    <!-- NEW EXPENSE -->
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                @elseif (isset($categories) and isset($expense))
                    <!-- EDIT EXPENSE -->
                    @foreach($categories as $category)
                        <option {{ $expense->category_id == $category->id ? "selected" : "" }} value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                @elseif (isset($expense) and isset($expense->category))
                    <!-- VIEW EXPENSE -->
                    <option value="{{ $expense->category->id }}" selected>{{ $expense->category->name }}</option>
                @endif
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 col-lg-3 control-label">Description</label>
        <div class="col-md-9 col-lg-6">
            <textarea class="form-control" {{ $disabled ? 'readonly=readonly' : '' }} name="description" rows="10">{{ $expense->description or old('description') }}</textarea>
        </div>
    </div>

    @if(!$disabled)
    <div class="row xs-pt-12">
        <div class="col-md-12 col-lg-9">
            <p class="text-right">
                <a href="{{ $cancelRoute}}" class="btn btn-space btn-default">Cancel</a>
                <button type="submit" class="btn btn-space btn-primary">{{ $button }}</button>
            </p>
        </div>
    </div>
    @endif
</form>
