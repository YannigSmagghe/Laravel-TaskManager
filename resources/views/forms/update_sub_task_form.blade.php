<form>
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{ $subtask->id }}" />
    <input type="hidden" name="task_id" value="{{ $subtask->task_id }}" />
    <input type="hidden" name="status" value="{{ $subtask->status }}" />
    <div class="row form-group">
        <div class="col-sm-12">
            <div class="col-sm-3">
                <span>Title:</span>
            </div>
            <div class="col-sm-9">
                <input type="text" name="title" class="form-control" value="{{ $subtask->title }}" />
            </div>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-sm-12">
            <div class="col-sm-3">
                <span>Description:</span>
            </div>
            <div class="col-sm-9">
                <input type="text" name="description" class="form-control" value="{{ $subtask->description }}" />
            </div>
        </div>
    </div>    
</form>