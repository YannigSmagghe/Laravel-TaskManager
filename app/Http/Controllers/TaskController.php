<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Task;
use App\SubTask;
use Auth;

class TaskController extends Controller
{

    public function index() {

    	$tasks = Task::orderBy('created_at', 'DESC')->paginate(10);

    	return response()->json([
    		'status'	=>	true,
			'tasks' 	=> 	view('tasks')->with(['tasks' => $tasks])->render()
		], 200);

    }

    public function store(Request $request)
    {

    	$validation = Validator::make($request->all(), Task::$rules);

    	if ($validation->fails()) {
			return response()->json([
				'status'	=>	false,
				'message'	=>	'Error occured in creating task!',
				'errors' 	=> 	$validation->errors()->getMessages()
			], 422);
    	}

    	$task = new Task();
    	$task->user_id = Auth::user()->id;
    	$task->title = $request->title;
    	$task->description = $request->description;
    	$task->status = 1;
    	$task->save();

    	return response()->json([
    		'status'	=>	true,
			'message' 	=> 'Task created successfully!'
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

    	$task = Task::find($id);

    	if(!$task) {
    		return response()->json([
				'status'	=>	false,
				'message'	=>	'Task no found!'
			], 404);
    	}

    	$status = array();
    	$status[1] = 'Active';
    	$status[2] = 'Pending';
    	$status[3] = 'Completed';

    	return response()->json([
    		'status'	=>	true,
			'form' 		=> view('forms.update_task_form')->with(['task' => $task, 'status' => $status])->render()
		], 200);

	}

	public function update(Request $request)
    {

    	$validation = Validator::make($request->all(), Task::$rules);

    	if ($validation->fails()) {
			return response()->json([
				'status'	=>	false,
				'message'	=>	'Error occured in updating task!',
				'errors' 	=> 	$validation->errors()->getMessages()
			], 422);
    	}

    	$task_id = $request->id;

    	$task = Task::find($task_id);
    	$task->title = $request->title;
    	$task->description = $request->description;
    	$task->status = $request->status;
    	$task->save();

    	return response()->json([
    		'status'	=>	true,
			'message' 	=> 'Task updated successfully!'
		], 200);

    }

    public function updateStatus($id = false, $status = false)
    {

        if(!$id || !$status) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Parameter missing!'
            ], 400);
        }

        $task = Task::find($id);

        $task->status = $status;
        $task->save();

        if($status == 3) {
            SubTask::where('task_id', '=', $id)->update(['status' => 3]);
        }

        return response()->json([
            'status'    =>  true,
            'message'   =>  'Status changed!',
            'task'      =>  view('task')->with(['task' => $task])->render()
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

    	$task_id = $request->id;

    	$task = Task::find($task_id);

    	if(!$task) {
    		return response()->json([
				'status'	=>	false,
				'message'	=>	'Task no found!'
			], 404);
    	}

    	$subtasks = SubTask::where('task_id', $task_id)->delete();
    	$task->delete();

    	return response()->json([
    		'status'	=>	true,
			'message' 	=> 'Task deleted successfully!'
		], 200);

    }
}
