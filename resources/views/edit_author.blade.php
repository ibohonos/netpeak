@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">Edit Author</div>

					<div class="card-body">
						@if (session('status'))
							<div class="alert alert-success" role="alert">
								{{ session('status') }}
							</div>
						@endif

						@if (session('error'))
							<div class="alert alert-danger" role="alert">
								{{ session('error') }}
							</div>
						@endif

						@if ($errors->any())
							<div class="alert alert-danger">
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif

						<form method="post" action="{{ route('update.author') }}" enctype="multipart/form-data">
							@csrf

							<div class="form-group">
								<label for="first_name">First name</label>
								<input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter first name" value="{{ $author->first_name }}" required>
							</div>

							<div class="form-group">
								<label for="last_name">Last name</label>
								<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter last name" value="{{ $author->last_name }}" required>
							</div>

							<input type="hidden" name="author_id" value="{{ $author->id }}">
							<button type="submit" class="btn btn-primary">Update</button>
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
