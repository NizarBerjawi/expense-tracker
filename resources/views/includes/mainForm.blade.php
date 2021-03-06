<div class="col-md-12">
  <div class="panel panel-default panel-border-color panel-border-color-primary">
    <div class="panel-heading panel-heading-divider">{{ $panelHeading }}
        <!-- Only show edit button in the view resource page -->
        @if (isset($model) and $disabled)
        <div class="tools">
            <a href='{{ route("user.$resource.edit", $model->id) }}' type="submit" class="icon mdi mdi-edit"></a>
        </div>
        @endif
    </div>
    <div class="panel-body">
        @include("includes.forms.{$resource}Form")
    </div>
  </div>
</div>
