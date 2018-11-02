@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">Edit Journal</div>

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

						<form method="post" action="{{ route('update.journal') }}" enctype="multipart/form-data">
							@csrf

							<div class="form-group">
								<label for="title">Title</label>
								<input type="text" class="form-control" id="title" name="title" placeholder="Enter title" value="{{ $journal->title }}" required>
							</div>

							<div class="form-group">
								<label for="image">Image journal</label>
								<input type="file" class="form-control-file" id="image" name="image" accept="image/*">
								@if($journal->image)
									<input type="hidden" name="img_url" value="{{ $journal->image }}">
								@endif
							</div>

							<div class="form-group">
								<label for="short_text">Short text</label>
								<textarea name="short_text" id="short_text" class="form-control" placeholder="Enter short text" rows="5">{{ $journal->text }}</textarea>
							</div>

							<div class="form-group">
								<label for="authors">Authors</label>
								<select name="authors[]" id="authors" class="custom-select" required multiple>
									@foreach($authors as $author)
										<option value="{{ $author->id }}" @if(in_array($author->id, $id_authors)) selected @endif>{{ $author->first_name }} {{ $author->last_name }}</option>
									@endforeach
								</select>
							</div>

							<div class="form-group" data-provide="datepicker">
								<label for="date_prod">Date production</label>
								<input type="date" class="form-control" name="date_prod" id="date_prod" value="{{ \Carbon\Carbon::parse($journal->date_prod)->format('Y-m-d') }}">
							</div>
							<input type="hidden" name="journal_id" value="{{ $journal->id }}">
							<!-- Button trigger modal -->
							<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Preview</button>
							<button type="submit" class="btn btn-primary">Update</button>
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<h2 class="text-center" id="title_view"></h2>
							<p id="text_view"></p>
							<p class="text-right" id="date_view">
								<strong></strong>
							</p>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	<script
		src="https://code.jquery.com/jquery-3.3.1.min.js"
		integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
		crossorigin="anonymous"></script>

	<script type="text/javascript">
		jQuery(document).ready(function () {
			$('#myModal').on('shown.bs.modal', function () {
				$('#title_view').text($('#title').val());
				$('#text_view').html($('#short_text').val().replace(/\n/g, "<br />"));
				$('#date_view strong').text($('#date_prod').val());
			})
		});
	</script>
@endsection
