@extends('layout')

@section('content')    
	<div class="col-sm-12">
        <div class="col-xs-12 col-sm-12 wrapper">
            <div class="col-sm-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Date Added</th>
                            <th>Date Updated</th>                            
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($users)
                            @foreach ($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role['name'] }}</td>
                                    <td>{{ date('F d, Y h:i a', strtotime($user->created_at)) }}</td>
                                    <td>{{ date('F d, Y h:i a', strtotime($user->updated_at)) }}</td>
                                    <td>
                                        @if ($user->id == Auth::user()->id)
                                        <a class="actions" href="{{ route('setting') }}" target="_blank"><i class="fa fa-eye" title="View"></i></a>
                                        @else
                                        <a class="actions user_edit" data-user-id="{{ $user->id }}" href="#update_user_form" role="button" data-toggle="modal"><i class="fa fa-edit" title="Edit User"></i></a>                                        
                                        <a class="actions user_delete color-red" data-user-id="{{ $user->id }}" href="#delete_user_form" role="button" data-toggle="modal"><i class="fa fa-trash" title="Delete User"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9">No user found!</td>
                            </tr>
                        @endif          
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="9">{{ $users->links() }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <a class="btn btn-add_new_user_form pull-right" href="#add_new_user_form" role="button" data-toggle="modal" title="Create New User"><i class="fa fa-plus" aria-hidden="true"></i></a>
        
    </div>

    @include('forms.add_new_user')
    @include('forms.update_user')
    @include('forms.delete_user')

@endsection