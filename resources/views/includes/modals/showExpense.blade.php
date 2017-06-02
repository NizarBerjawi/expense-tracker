<div id="show-expense" tabindex="-1" role="dialog" class="modal fade colored-header colored-header-primary">
    <div class="modal-dialog custom-width">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close md-close"><span class="mdi mdi-close"></span></button>
                <h3 class="modal-title">Expense Details</h3>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Name</label>
                    <input id="name" type="text" class="form-control" readonly name="name" value="">
                </div>

                <div class="form-group">
                    <label>Date</label>
                    <div data-min-view="2" data-date-format="yyyy-mm-dd" class="input-group date datetimepicker">
                        <input id="date" size="16" readonly type="text" name="date" value="" class="form-control"><span class="input-group-addon btn btn-primary"><i class="icon-th mdi mdi-calendar"></i></span>
                    </div>
                </div>

                <div class="form-group">
                    <label>Amount</label>
                    <input id="amount" type="text" class="form-control" readonly name="amount" value="">
                </div>

                <div class="form-group">
                    <label>Category</label>
                    <select disabled id="category" multiple="" class="select2" name="category_id">
                        <!-- Options added dynamically -->
                    </select>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea id="description" class="form-control" readonly name="description" rows="10"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default md-close">Back</button>
                <a id="edit-item" class="btn btn-primary" href="">Edit</a>
            </div>
        </div>
    </div>
</div>
