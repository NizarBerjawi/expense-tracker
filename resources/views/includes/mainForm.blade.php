<div class="col-md-12">
  <div class="panel panel-default panel-border-color panel-border-color-primary">
    <div class="panel-heading panel-heading-divider">{{ $panelHeading }}<span class="panel-subtitle">{{ $panelSubtitle }}</span></div>
    <div class="panel-body">
      <form action="{{ $formAction }}" method="POST" style="border-radius: 0px;" class="form-horizontal group-border-dashed">
        {{ $disabled ? '' : csrf_field() }}
        {{ $methodField }}

        @if ($page == 'expenses')
          <div class="form-group">
            <label class="col-md-3 col-lg-3 control-label">Name</label>
            <div class="col-md-9 col-lg-6">
              <input type="text" class="form-control" {{ $disabled ? 'readonly=readonly' : '' }} name="name" value="{{ $category->name or old('name') }}">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 col-lg-3 control-label">Date</label>
            <div class="col-md-9 col-lg-6">
              <div data-min-view="2" data-date-format="yyyy-mm-dd" class="input-group date datetimepicker">
                <input size="16" {{ $disabled ? 'readonly=readonly' : '' }} type="text" name="date" value="{{ $category->date or old('date') }}" class="form-control"><span class="input-group-addon btn btn-primary"><i class="icon-th mdi mdi-calendar"></i></span>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-3 col-lg-3 control-label">Category</label>
            <div class="col-md-9 col-lg-6">
              <input type="text" {{ $disabled ? 'readonly=readonly' : '' }} class="form-control" name="category" value="{{ old('category') }}">
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-3 col-lg-3 control-label">Description</label>
            <div class="col-md-9 col-lg-6">
              <textarea class="form-control" {{ $disabled ? 'readonly=readonly' : '' }} name="description" rows="10">{{ $category->description or old('description') }}</textarea>
            </div>
          </div>
        @elseif ($page == 'categories')
          <div class="form-group">
            <label class="col-md-3 col-lg-3 control-label">Name</label>
            <div class="col-md-9 col-lg-6">
              <input type="text" class="form-control" {{ $disabled ? 'readonly=readonly' : '' }} name="name" value="{{ $category->name or old('name') }}">
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-3 col-lg-3 control-label">Tag</label>
            <div class="col-md-9 col-lg-6">
              <select {{ $disabled ? 'disabled' : '' }} multiple="" class="tags" name="tagData">
                @if (isset($tags) and !isset($category))
                  <!-- NEW CATEGORY -->
                  @foreach($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                  @endforeach
                @elseif (isset($tags) and isset($category))
                  <!-- EDIT CATEGORY -->
                  @foreach($tags as $tag)
                    <option {{ $category->tag_id == $tag->id ? "selected" : "" }} value="{{ $tag->id }}">{{ $tag->name }}</option>
                  @endforeach
                @elseif (isset($category))
                  <!-- SHOW CATEGORY -->
                  <option value="{{ $category->tag->id }}" selected>{{ $category->tag->name }}</option>
                @endif
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-3 col-lg-3 control-label">Description</label>
            <div class="col-md-9 col-lg-6">
              <textarea class="form-control" {{ $disabled ? 'readonly=readonly' : '' }} name="description" rows="10">{{ $category->description or old('description') }}</textarea>
            </div>
          </div>
        @endif

        @if(!$disabled)
          <div class="row xs-pt-12">
            <div class="col-md-12 col-lg-9">
              <p class="text-right">
                <button type="submit" class="btn btn-space btn-primary">Add</button>
                <a href="{{ route('expenses.create') }}" class="btn btn-space btn-default">Cancel</a>
              </p>
            </div>
          </div>
        @endif
      </form>
    </div>
  </div>
</div>
