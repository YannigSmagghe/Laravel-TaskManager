<div class="col-sm-12">
	<table class="table">
		<thead>
			<tr>
				<th>Task ID</th>
				<th>Title</th>
				<th>Description</th>
				<th>Created By</th>						
				<th>Date Added</th>
				<th>Date Updated</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@if ($tasks)
				@foreach ($tasks as $task)
					@include('task', ['task' => $task])
				@endforeach
			@else
				<tr>
					<td colspan="8">No task found!</td>
				</tr>
			@endif			
		</tbody>
		<tfoot>
			<tr>
				<td colspan="8">{{ $tasks->links() }}</td>
			</tr>
		</tfoot>
	</table>
</div>