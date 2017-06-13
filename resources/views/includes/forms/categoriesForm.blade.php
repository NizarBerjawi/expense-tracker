<form action="{{ $formAction }}" method="POST" style="border-radius: 0px;" class="form-horizontal group-border-dashed">
    {{ $disabled ? '' : csrf_field() }}
    {{ $methodField }}

    <div class="form-group">
        <label class="col-md-3 col-lg-3 control-label">Name</label>
        <div class="col-md-9 col-lg-6">
            <input type="text" class="form-control" {{ $disabled ? 'readonly=readonly' : '' }} name="name" value="{{ $category->name or old('name') }}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 col-lg-3 control-label">Tag</label>
        <div class="col-md-9 col-lg-6">
            <select {{ $disabled ? 'disabled' : '' }} multiple="" class="select2" name="tag_id">
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
                <!-- VIEW CATEGORY -->
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
