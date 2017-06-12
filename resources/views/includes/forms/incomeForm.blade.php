<form action="{{ $formAction }}" method="POST" style="border-radius: 0px;" class="form-horizontal group-border-dashed">
    {{ $disabled ? '' : csrf_field() }}
    {{ $methodField }}

    <div class="form-group">
        <label class="col-md-3 col-lg-3 control-label">Name</label>
        <div class="col-md-9 col-lg-6">
            <input type="text" class="form-control" {{ $disabled ? 'readonly=readonly' : '' }} name="name" value="{{ $income->name or old('name') }}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 col-lg-3 control-label">Date</label>
        <div class="col-md-9 col-lg-6">
            <div data-min-view="2" data-date-format="yyyy-mm-dd" class="input-group date datetimepicker">
                <input size="16" {{ $disabled ? 'readonly=readonly' : '' }} type="text" name="date" value="{{ $income->date or old('date') }}" class="form-control"><span class="input-group-addon btn btn-primary"><i class="icon-th mdi mdi-calendar"></i></span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 col-lg-3 control-label">Amount</label>
        <div class="col-md-9 col-lg-6">
            <input type="text" class="form-control" {{ $disabled ? 'readonly=readonly' : '' }} name="amount" value="{{ $income->amount or old('amount') }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 col-lg-3 control-label">Bank Account</label>
        <div class="col-md-9 col-lg-6">
            <select {{ $disabled ? 'disabled' : '' }} multiple="" class="select2" name="bank_account_id">
                @if (!isset($income))
                    <!-- NEW EXPENSE -->
                    @foreach($bankAccounts as $account)
                        <option value="{{ $account->id or old('bank_account_id')}}" {{ $account->id == old('bank_account_id') ? "selected" : "" }}>{{ $account->name }}</option>
                    @endforeach
                @elseif (isset($bankAccounts) and isset($income))
                    <!-- EDIT EXPENSE -->
                    @foreach($bankAccounts as $account)
                        <option {{ $income->bank_account_id == $account->id ? "selected" : "" }} value="{{ $account->id }}">{{ $account->name }}</option>
                    @endforeach
                @elseif (isset($income) and isset($income->bank_account_id))
                    <!-- VIEW EXPENSE -->
                    <option value="{{ $income->bankAccount->id }}" selected>{{ $income->bankAccount->name }}</option>
                @endif
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 col-lg-3 control-label">Category</label>
        <div class="col-md-9 col-lg-6">
            <select {{ $disabled ? 'disabled' : '' }} multiple="" class="select2" name="category_id">
                @if (isset($categories) and !isset($income))
                    <!-- NEW INCOME -->
                    @foreach($categories as $category)
                        <option value="{{ $category->id or old('category_id') }}" {{ $category->id == old('category_id') ? "selected" : "" }}>{{ $category->name }}</option>
                    @endforeach
                @elseif (isset($categories) and isset($income))
                    <!-- EDIT INCOME -->
                    @foreach($categories as $category)
                        <option {{ $income->category_id == $category->id ? "selected" : "" }} value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                @elseif (isset($income) and isset($income->category))
                    <!-- VIEW INCOME -->
                    <option value="{{ $income->category->id }}" selected>{{ $income->category->name }}</option>
                @endif
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 col-lg-3 control-label">Description</label>
        <div class="col-md-9 col-lg-6">
            <textarea class="form-control" {{ $disabled ? 'readonly=readonly' : '' }} name="description" rows="10">{{ $income->description or old('description') }}</textarea>
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
