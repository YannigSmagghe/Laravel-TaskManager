<form>
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{ $task->id }}" />
    <input type="hidden" name="status" value="{{ $task->status }}" />
    <div class="row form-group">
        <div class="col-sm-12">
            <div class="col-sm-3">
                <span>Title:</span>
            </div>
            <div class="col-sm-9">
                <input type="text" name="title" class="form-control" value="{{ $task->title }}" />
            </div>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-sm-12">
            <div class="col-sm-3">
                <span>Description:</span>
            </div>
            <div class="col-sm-9">
                <input type="text" name="description" class="form-control" value="{{ $task->description }}" />
            </div>
        </div>
    </div>
</form>