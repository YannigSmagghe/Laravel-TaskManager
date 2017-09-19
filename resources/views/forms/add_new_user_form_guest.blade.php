<div id="add_new_user_form_guest" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add New User</h4>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" name="status" value="1">
                    <div class="row form-group">
                        <div class="col-sm-12">
                            <div class="col-sm-3">
                                <span>Name:</span>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-12">
                            <div class="col-sm-3">
                                <span>Username:</span>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" name="username" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-12">
                            <div class="col-sm-3">
                                <span>Email:</span>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" name="email" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-12">
                            <div class="col-sm-3">
                                <span>Role:</span>
                            </div>
                            <div class="col-sm-9">
                                <select name="role_id" class="form-control">
                                        <option value="2">user</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-12">
                            <div class="col-sm-3">
                                <span>Password:</span>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" name="password" class="form-control" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-create-user-guest"><i class="fa fa-check"></i> Create</button>
            </div>
        </div>
    </div>
</div>