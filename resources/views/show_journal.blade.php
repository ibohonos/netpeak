@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">Authors</div>

				<div class="card-body">
					@if (session('status'))
						<div class="alert alert-success" role="alert">
							{{ session('status') }}
						</div>
					@endif

					<div class="row">
						@if($journal->image)
							<div class="col-md-4">
								<img class="p-2 align-self-center" src="{{ $journal->image }}" style="width: 100%;">
							</div>
							<div class="col-md-8">
						@else
							<div class="col-md-12">
						@endif
							<h2 class="text-center">{{ $journal->title }}</h2>
							<p>{!! nl2br(e($journal->text)) !!}</p>
							<p class="text-right">
								<strong>{{ \Carbon\Carbon::parse($journal->date_prod)->format('d.m.Y') }}</strong>
							</p>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<h4 class="text-center">Journal authors</h4>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="list-group">
								@forelse($authors as $author)
									<div class="list-group-item list-group-item-action">
										<a href="{{ route('show.author', $author->id) }}" class="card-link">
											<h4 class="d-inline-flex p-2 align-self-center">{{ $author->last_name }} {{ $author->first_name }}</h4>
										</a>
										@if(Auth::id() && Auth::user()->is_admin)
											<a href="{{ route('delete.author') }}" class="d-inline-flex p-2 align-self-center float-right card-link text-danger" onclick="event.preventDefault();
																 document.getElementById('delete-form-{{ $author->id }}').submit();">Delete</a>
											<form id="delete-form-{{ $author->id }}" action="{{ route('delete.author') }}" method="POST" style="display: none;">
												@csrf
												<input type="hidden" name="author_id" value="{{ $author->id }}">
											</form>
											<a href="{{ route('edit.author', $author->id) }}" class="d-inline-flex p-2 align-self-center float-right card-link">Edit</a>
										@endif
									</div>
								@empty
									<div class="list-group-item list-group-item-action">
										<h4 class="text-center">No results</h4>
									</div>
								@endforelse
							</div>
						</div>
					</div>

					<div class="row pt-4">
						<div class="col-md-12">
							{{ $authors->links() }}
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
