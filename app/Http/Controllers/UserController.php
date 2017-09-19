<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;
use Auth;

class UserController extends Controller
{
    public function index()
    {
    	$roles = Role::all();

    	return view('user.setting')
    		->with([
    			'roles'	=>	$roles
    		]);

    }

    public function getUsers()
    {

    	$users = User::where('is_active', 1)->orderBy('created_at', 'DESC')->paginate(10);
    	$roles = Role::all();

    	return view('user.users')
    		->with([
    			'users' => $users,
    			'roles'	=>	$roles
    		]);

    }

    public function store(Request $request)
    {
    	$validation = Validator::make($request->all(), User::$rules);

    	if ($validation->fails()) {
			return response()->json([
				'status'	=>	false,
				'errors' 	=> 	$validation->messages()
			], 400);
    	}

    	$user = new User();

    	$user->name = $request->name;
    	$user->username = $request->username;
    	$user->email = $request->email;
    	$user->role_id = $request->role_id;    	
    	$user->password = Hash::make($request->password);
    	$user->is_active = 1;
    	$user->save();

    	return response()->json([
			'status'	=>	true,
			'message' 	=> 	'User created successfully!'
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

    	$user = User::find($id);

    	if(!$user) {
    		return response()->json([
				'status'	=>	false,
				'message'	=>	'User no found!'
			], 404);
    	}

    	$roles = Role::all();

    	return response()->json([
    		'status'	=>	true,
			'form' 		=> view('forms.update_user_form')->with(['user' => $user, 'roles' => $roles])->render()
		], 200);

	}

    public function update(Request $request)
    {

    	$validation = Validator::make($request->all(), [
	        'name' 	=> 'required|min:3|max:255',
	        'email' => 'required|email',
	    ]);

    	if ($validation->fails()) {
    		if ($request->ajax()) {
				return response()->json([
					'status'	=>	false,
					'errors' 	=> 	$validation->messages()
				], 400);
			} else {
				return \Redirect::to('setting')
	                ->with([
	                    'errors'	=>	$validation->messages()
	                ], 400);
			}
    	}

    	if($request->id) {
    		$user = User::find($request->id);
    	} else {
    		$user = Auth::user();
    	}

    	$user->name = $request->name;
    	$user->email = $request->email;

    	if($request->password) {
    		$user->password = Hash::make($request->password);
    	}

    	if($request->role_id) {
    		$user->role_id = $request->role_id;
    	}

    	$user->save();

    	if ($request->ajax()) {

			return response()->json([
				'status'	=>	true,
				'message'	=>	'User updated successfully!'
			], 200);

		} else {

			return \Redirect::to('setting')
                ->with([
                    'success'	=>	'Setting updated successfully!'
                ], 200);

		}

    }

    public function destroy(Request $request)
    {

    	if(!$request->id) {
    		return response()->json([
				'status'	=>	false,
				'message'	=>	'Parameter missing!'
			], 400);
    	}

    	$user_id = $request->id;

    	$user = User::find($user_id);

    	if(!$user) {
    		return response()->json([
				'status'	=>	false,
				'message'	=>	'User no found!'
			], 404);
    	}

    	$user->is_active = 0;
    	$user->save();

    	return response()->json([
    		'status'	=>	true,
			'message' 	=> 'User deleted successfully!'
		], 200);

    }

}
