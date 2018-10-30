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
							<a href="#" class="list-group-item list-group-item-action">
								@if($journal->image)
									<img class="d-inline-flex p-2 align-self-center" src="{{ $journal->image }}" style="width: 10%;">
								@endif
								<h4 class="d-inline-flex p-2 align-self-center">{{ $journal->title }}</h4>
								<p class="d-inline-flex p-2 align-self-center float-right">Delete</p>
							</a>
						@endforeach
					</div>

					{{ $journals->links() }}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
