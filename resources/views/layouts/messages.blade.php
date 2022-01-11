@if(count($errors) > 0)
	@foreach($errors->all() as $error)
		<div class="alert alert-danger" style="text-align: right;">
			{{$error}}
		</div>
	@endforeach
@endif

@if(session('success'))
	<div class="alert alert-success" style="text-align: right;">
		{{session('success')}}
	</div>
@endif

@if(session('error'))
	<div class="alert alert-danger" style="text-align: right;">
		{{session('error')}}
	</div>
@endif
