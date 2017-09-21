<div id="add_new_sub_task_form" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add New Sub Task</h4>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" name="status" value="1">
                    <input type="hidden" name="task_id" value="">
                    <div class="row form-group">
                        <div class="col-sm-12">
                            <div class="col-sm-3">
                                <span>Title:</span>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" name="title" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-12">
                            <div class="col-sm-3">
                                <span>Description:</span>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" name="description" class="form-control" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-create-sub-task"><i class="fa fa-check"></i> Create</button>
            </div>
        </div>
    </div>
</div>