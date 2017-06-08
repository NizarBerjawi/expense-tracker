<form action="{{ $formAction }}" method='POST'>
    {{ $csrfField }}
    {{ $methodField }}
    <div class="form-group text-center xs-pt-5">
        <button class="btn btn-danger" type="submit">{{ $submit }}</button>
    </div>
</form>
