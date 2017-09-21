@extends('layout')

@section('content')
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 wrapper">
    	<div class="row task-list"></div>

        <a class="btn btn-add_new_task_form" href="#add_new_task_form" role="button" data-toggle="modal" title="Create New Task"><i class="fa fa-plus" aria-hidden="true"></i></a>
    </div>

    <div class="col-xs-12 col-sm-6 col-md-4 sub-task-wrapper">
        <div class="wrapper-header">
            <button type="button" class="close" aria-hidden="true">&times;</button>
        </div>
        <div class="wrapper-body">
            <div class="sub-task-list"></div>
        </div>
        <div class="wrapper-footer"></div>
    </div>

    <script type="text/javascript">
    	$(document).ready(function() {
    		getTasks('/tasks');
    	});
    </script>

    @include('forms.add_new_task')
    @include('forms.update_task')
    @include('forms.delete_task')

    @include('forms.add_new_sub_task')
    @include('forms.update_sub_task')

@endsection