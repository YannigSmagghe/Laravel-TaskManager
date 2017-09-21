@extends('layout')

@section('content')
	<div class="col-sm-12">
        <div class="col-xs-12 col-sm-6 col-sm-offset-3 wrapper">        
            <form id="setting_form" action="{{ route('setting') }}" method="POST">
                {{ csrf_field() }}           
            	<div class="row form-group">
            		<div class="col-sm-12">
        				<div class="col-sm-4">Name:</div>
                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
                        </div>
        			</div>
            	</div>
                <div class="row form-group">
                    <div class="col-sm-12">
                        <div class="col-sm-4">Username:</div>
                        <div class="col-sm-8">
                            <input type="text" disabled="disabled" class="form-control" value="{{ Auth::user()->username }}">
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm-12">
                        <div class="col-sm-4">Email:</div>
                        <div class="col-sm-8">
                            <input type="text" name="email" class="form-control" value="{{ Auth::user()->email }}">
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm-12">
                        <div class="col-sm-4">Role:</div>
                        <div class="col-sm-8">
                            <select class="form-control" disabled="disabled">
                                @foreach ($roles as $role)
                                    @if ($role->id == Auth::user()->role_id)
                                        <option value="{{ $role->id }}" selected="selected">{{ $role->name }}</option>
                                    @else
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm-12">
                        <div class="col-sm-4">Password:</div>
                        <div class="col-sm-8">
                            <input type="text" name="password" class="form-control" value="">
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-sm-12" style="text-align: right; padding-right: 30px;">
                        <a class="btn btn-setting-save" onclick="$('#setting_form').submit();"><i class="fa fa-save"></i> Save</a>
                    </div>
                </div>
            </form>
        </div>
    </div>    
@endsection