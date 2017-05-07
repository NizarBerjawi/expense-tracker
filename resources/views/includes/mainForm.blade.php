<div class="col-md-12">
  <div class="panel panel-default panel-border-color panel-border-color-primary">
    <div class="panel-heading panel-heading-divider">{{ $panelHeading }}<span class="panel-subtitle">{{ $panelSubtitle }}</span></div>
    <div class="panel-body">
        @if ($page == 'expenses')
            @include('includes.forms.expensesForm')
        @elseif ($page == 'income')
            @include('includes.forms.incomeForm')
        @elseif ($page == 'categories')
            @include('includes.forms.categoriesForm')
        @endif
    </div>
  </div>
</div>
