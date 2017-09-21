<div class="col-sm-12">
	@if (!empty($subtasks))
		@foreach ($subtasks as $subtask)
			@include('subtask', ['subtask' => $subtask])
		@endforeach
	@else
		<div class="no_result">
			No Sub Task created yet!
		</div>
	@endif
</div>