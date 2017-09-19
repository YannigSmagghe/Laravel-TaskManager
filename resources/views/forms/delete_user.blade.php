<div id="delete_user_form" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Delete User</h4>
            </div>
            <div class="modal-body">
                <span>Are you sure?</span>
                <form style="display: none;">
                    <input type="hidden" name="id" value="">
                    {{ method_field('DELETE') }} 
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-delete-user"><i class="fa fa-check"></i> Delete</button>
            </div>
        </div>
    </div>
</div>