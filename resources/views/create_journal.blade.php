@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">Create Journal</div>

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

						<form method="post" action="{{ route('save.journal') }}" enctype="multipart/form-data">
							@csrf

							<div class="form-group">
								<label for="title">Title</label>
								<input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
							</div>

							<div class="form-group">
								<label for="image">Image journal</label>
								<input type="file" class="form-control-file" id="image" name="image" accept="image/*">
							</div>

							<div class="form-group">
								<label for="short_text">Short text</label>
								<textarea name="short_text" id="short_text" class="form-control" placeholder="Enter short text" rows="5"></textarea>
							</div>

							<div class="form-group">
								<label for="authors">Authors</label>
								<select name="authors[]" id="authors" class="custom-select" required multiple>
									@foreach($authors as $author)
										<option value="{{ $author->id }}">{{ $author->first_name }} {{ $author->last_name }}</option>
									@endforeach
								</select>
							</div>

							<div class="form-group" data-provide="datepicker">
								<label for="date_prod">Date production</label>
								<input type="date" class="form-control" name="date_prod" id="date_prod">
							</div>

							<button type="submit" class="btn btn-primary">Create</button>
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
