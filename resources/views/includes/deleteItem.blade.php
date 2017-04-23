<div class="col-md-12">
  <div class="panel panel-border-color panel-border-color-danger">
    <div class="panel-heading panel-heading-divider">Danger Zone</div>
    <div class="panel-body text-center">
      <form action="{{ $deleteRoute }}" method="POST" style="border-radius: 0px;" class="form-horizontal group-border-dashed">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button type="submit" class="btn btn-space btn-danger">Delete</button>
      </form>
    </div>
  </div>
</div>
