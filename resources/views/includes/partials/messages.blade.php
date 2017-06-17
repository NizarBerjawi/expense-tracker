@if (count($errors) > 0)
    <div class="col-sm-6 col-md-offset-3">
        <div role="alert" class="alert alert-danger alert-icon alert-dismissible">
            <div class="icon"><span class="mdi mdi-close-circle-o"></span></div>
            <div class="message">
                <button type="button" data-dismiss="alert" aria-label="Close" class="close">
                    <span aria-hidden="true" class="mdi mdi-close"></span>
                </button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif

@if (session('success'))
    <div class="row col-sm-6 col-sm-offset-3">
        <div role="alert" class="alert alert-success alert-icon alert-dismissible">
            <div class="icon"><span class="mdi mdi-check"></span></div>
            <div class="message">
                <button type="button" data-dismiss="alert" aria-label="Close" class="close">
                    <span aria-hidden="true" class="mdi mdi-close"></span>
                </button>
                {!! session('success') !!}
            </div>
        </div>
    </div>
@endif
