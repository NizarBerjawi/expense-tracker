<div id="delete-modal" tabindex="-1" role="dialog" style="" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <div class="text-danger"><span class="modal-main-icon mdi mdi-close-circle-o"></span></div>
                    <h3>{{ $confirmation_text }}</h3>

                    <form class="mod-form" action="" method="POST">
                        {{ csrf_field() }}
                        {{ method_field("DELETE") }}

                        <button type="button" data-dismiss="modal" class="btn btn-space btn-default">Cancel</button>
                        <button type="submit" class="btn btn-space btn-danger">Delete</button>
                    </form>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
