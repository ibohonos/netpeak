@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">Dashboard</div>

				<div class="card-body">
					@if (session('status'))
						<div class="alert alert-success" role="alert">
							{{ session('status') }}
						</div>
					@endif

					<div class="list-group">
						@foreach($journals as $journal)
							<div class="list-group-item list-group-item-action">
								<a href="#" class="card-link">
									@if($journal->image)
										<img class="d-inline-flex p-2 align-self-center" src="{{ $journal->image }}" style="width: 10%;">
									@endif
									<h4 class="d-inline-flex p-2 align-self-center">{{ $journal->title }}</h4>
								</a>
								@if(Auth::id() && Auth::user()->is_admin)
									<a href="{{ route('delete.journal') }}" class="d-inline-flex p-2 align-self-center float-right card-link text-danger" onclick="event.preventDefault();
														 document.getElementById('delete-form-{{ $journal->id }}').submit();">Delete</a>
									<form id="delete-form-{{ $journal->id }}" action="{{ route('delete.journal') }}" method="POST" style="display: none;">
										@csrf
										<input type="hidden" name="journal_id" value="{{ $journal->id }}">
									</form>
									<a href="{{ route('edit.journal', $journal->id) }}" class="d-inline-flex p-2 align-self-center float-right card-link">Edit</a>
								@endif
							</div>
						@endforeach
					</div>

					{{ $journals->links() }}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
