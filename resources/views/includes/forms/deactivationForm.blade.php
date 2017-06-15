<form action="{{ $formAction }}" class="actions" data-target="#delete-modal" method='POST'>
    {{ $csrfField }}
    {{ $methodField }}
    <div class="form-group text-center xs-pt-5">
        <button class="btn btn-danger" type="button" type="submit">{{ $submit }}</button>
    </div>
</form>
