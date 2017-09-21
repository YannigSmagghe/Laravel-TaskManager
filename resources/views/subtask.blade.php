<div class="subtasks subtask-{{ $subtask->id }}">
	<div class="subtask_title">		
		{{ $subtask->title }}
	</div>
	<div class="subtask_description">{{ $subtask->description }}</div>
	<div class="subtask_date_added">{{ date('F d, Y h:i a', strtotime($subtask->created_at)) }}</div>
	<div class="subtask_actions">
		<div class="subtask_status">
			<ul>
				<li class="dropdown">
					@if ($subtask->status != 3)
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
							@if ($subtask->status == 1)
								<span class="status-tag active">Active <span class="caret"></span></span>
							@elseif ($subtask->status == 2)
								<span class="status-tag pending">Pending <span class="caret"></span></span>
							@endif
						</a>

						<ul class="dropdown-menu" role="menu">
		                	<li>
		                        <a class="subtask-status-action" data-sub-task-id="{{ $subtask->id }}" data-status="1">
		                            Active
		                        </a>
		                    </li>
		                    <li>
		                        <a class="subtask-status-action" data-sub-task-id="{{ $subtask->id }}" data-status="2">
		                            Pending
		                        </a>
		                    </li>
		                    <li>
		                        <a class="subtask-status-action" data-sub-task-id="{{ $subtask->id }}" data-status="3">
		                            Completed
		                        </a>
		                    </li>
		                </ul>
	                @else
	                	<span class="status-tag completed">Completed</span>
	                @endif
				</li>
			</ul>
		</div>

		<div class="subtask_delete">
			@if(Auth::user()->role_id == 1 || Auth::user()->role_id == 3)
			<a class="subtask-edit" data-sub-task-id="{{ $subtask->id }}">
				<i class="fa fa-edit"></i>
			</a>
			@endif
			
			@if(Auth::user()->role_id == 1)
			<a class="subtask-delete" data-sub-task-id="{{ $subtask->id }}">
				<i class="fa fa-trash color-red"></i>
				<form style="display: none;">
                    <input type="hidden" name="id" value="{{ $subtask->id }}">
                    {{ method_field('DELETE') }} 
                </form>
			</a>
			@endif
		</div>
	</div>
</div>