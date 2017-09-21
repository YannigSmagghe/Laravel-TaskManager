<tr>
	<th scope="row">{{ $task->id }}</th>
	<td>{{ $task->title }}</td>
	<td>{{ $task->description }}</td>
	<td>{{ $task->user['name'] }}</td>
	<td>{{ date('F d, Y h:i a', strtotime($task->created_at)) }}</td>
	<td>{{ date('F d, Y h:i a', strtotime($task->updated_at)) }}</td>
	<td>
		<ul>
			<li class="dropdown">
				@if ($task->status != 3)
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						@if ($task->status == 1)
							<span class="status-tag active">Active <span class="caret"></span></span>
						@elseif ($task->status == 2)
							<span class="status-tag pending">Pending <span class="caret"></span></span>
						@endif
					</a>

					<ul class="dropdown-menu" role="menu">
		            	<li>
		                    <a class="task-status-action" data-task-id="{{ $task->id }}" data-status="1">
		                        Active
		                    </a>
		                </li>
		                <li>
		                    <a class="task-status-action" data-task-id="{{ $task->id }}" data-status="2">
		                        Pending
		                    </a>
		                </li>
		                <li>
		                    <a class="task-status-action" data-task-id="{{ $task->id }}" data-status="3">
		                        Completed
		                    </a>
		                </li>
		            </ul>
		        @else
		        	<span class="status-tag completed">Completed</span>
	            @endif
			</li>
		</ul>									
	</td>
	<td>
		<a class="actions task_view" data-task-id="{{ $task->id }}"><i class="fa fa-eye" title="View"></i></a>
		@if(Auth::user()->role_id == 1 || Auth::user()->role_id == 3)
		<a class="actions task_edit" data-task-id="{{ $task->id }}" href="#update_task_form" role="button" data-toggle="modal"><i class="fa fa-edit" title="Edit Task"></i></a>
		@endif
		@if(Auth::user()->role_id == 1)
		<a class="actions task_delete color-red" data-task-id="{{ $task->id }}" href="#delete_task_form" role="button" data-toggle="modal"><i class="fa fa-trash" title="Delete Task"></i></a>
		@endif
	</td>
</tr>