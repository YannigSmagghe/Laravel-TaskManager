<form>
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{ $user->id }}" />
    <div class="row form-group">
        <div class="col-sm-12">
            <div class="col-sm-3">
                <span>Name:</span>
            </div>
            <div class="col-sm-9">
                <input type="text" name="name" class="form-control" value="{{ $user->name }}" />
            </div>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-sm-12">
            <div class="col-sm-3">
                <span>Email:</span>
            </div>
            <div class="col-sm-9">
                <input type="text" name="email" class="form-control" value="{{ $user->email }}" />
            </div>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-sm-12">
            <div class="col-sm-3">
                <span>Role:</span>
            </div>
            <div class="col-sm-9">
                <select class="form-control" name="role_id">
                    @if ($roles)
                        @foreach ($roles as $role)
                            @if ($role->id == $user->role_id)
                                <option value="{{ $role->id }}" selected="selected">{{ $role->name }}</option>
                            @else
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endif
                        @endforeach
                    @else
                        <option value="0"></option>
                    @endif
                </select>
            </div>
        </div>
    </div>
</form>