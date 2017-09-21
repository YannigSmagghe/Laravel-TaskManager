<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\SubTask;
use Auth;

class SubTaskController extends Controller
{
    public function index($id = null)
    {
    	$subtasks = array();

    	$subtasks = SubTask::where('task_id', $id)->orderBy('created_at', 'DESC')->get();

    	return response()->json([
    		'status'	=>	true,
			'subtasks' 	=> 	view('subtasks')->with(['subtasks' => $subtasks])->render()
		], 200);

    }

    public function store(Request $request)
    {

    	$validation = Validator::make($request->all(), SubTask::$rules);

    	if ($validation->fails()) {
			return response()->json([
				'status'	=>	false,
				'message'	=>	'Error occured in creating sub task!',
				'errors' 	=> 	$validation->errors()->getMessages()
			], 422);
    	}

    	$subtask = new SubTask();
    	$subtask->task_id = $request->task_id;
    	$subtask->title = $request->title;
    	$subtask->description = $request->description;
    	$subtask->status = 1;
    	$subtask->save();

    	return response()->json([
    		'status'	=>	true,
    		'subtask' 	=> 	view('subtask')->with(['subtask' => $subtask])->render(),
			'message' 	=> 'Sub Task created successfully!'
		], 200);

    }

    public function updateForm($id = false)
    {

    	if(!$id) {
    		return response()->json([
				'status'	=>	false,
				'message'	=>	'Parameter missing!'
			], 422);
    	}

    	$subtask = SubTask::find($id);

    	if(!$subtask) {
    		return response()->json([
				'status'	=>	false,
				'message'	=>	'Sub Task no found!'
			], 404);
    	}

    	return response()->json([
    		'status'	=>	true,
			'form' 		=> view('forms.update_sub_task_form')->with(['subtask' => $subtask])->render()
		], 200);

	}

    public function updateStatus($id = false, $status = false)
    {

    	if(!$id || !$status) {
    		return response()->json([
	    		'status'	=>	false,
				'message' 	=> 	'Parameter missing!'
			], 400);
    	}

    	$subtask = SubTask::find($id);

    	$subtask->status = $status;
    	$subtask->save();

    	return response()->json([
    		'status'	=>	true,
    		'message'	=>	'Status changed!',
			'subtask' 	=> 	view('subtask')->with(['subtask' => $subtask])->render()
		], 200);

    }

    public function update(Request $request)
    {

    	$validation = Validator::make($request->all(), SubTask::$rules);

    	if ($validation->fails()) {
			return response()->json([
				'status'	=>	false,
				'message'	=>	'Error occured in updating sub task!',
				'errors' 	=> 	$validation->errors()->getMessages()
			], 422);
    	}

    	$subtask_id = $request->id;

    	$subtask = SubTask::find($subtask_id);
    	$subtask->title = $request->title;
    	$subtask->description = $request->description;
    	$subtask->save();

    	return response()->json([
    		'status'	=>	true,
			'message' 	=> 'Sub Task updated successfully!',
			'id'		=>	$subtask_id,
			'subtask' 	=> 	view('subtask')->with(['subtask' => $subtask])->render()
		], 200);

    }

    public function destroy(Request $request)
    {

    	if(!$request->id) {
    		return response()->json([
				'status'	=>	false,
				'message'	=>	'Parameter missing!'
			], 400);
    	}

    	$sub_task_id = $request->id;

    	$sub_task = SubTask::find($sub_task_id);

    	if(!$sub_task) {
    		return response()->json([
				'status'	=>	false,
				'message'	=>	'Sub Task no found!'
			], 404);
    	}

    	$sub_task->delete();

    	return response()->json([
    		'status'	=>	true,
			'message' 	=> 'Sub Task deleted successfully!'
		], 200);

    }
}
