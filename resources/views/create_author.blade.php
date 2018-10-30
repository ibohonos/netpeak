@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">Create Author</div>

					<div class="card-body">
						@if (session('status'))
							<div class="alert alert-success" role="alert">
								{{ session('status') }}
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

						<form method="post" action="{{ route('save.author') }}">
							@csrf

							<div class="form-group">
								<label for="first_name">First name</label>
								<input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First name" required>
							</div>

							<div class="form-group">
								<label for="last_name">Last name</label>
								<input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter Last name" required>
							</div>

							<button type="submit" class="btn btn-primary">Create</button>
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
