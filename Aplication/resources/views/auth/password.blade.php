@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading text-center">RESETAR SENHA</div>
				<div class="panel-body">
					@if (session('status'))
						<div class="alert alert-success">
							{{ session('status') }}
						</div>
					@endif

					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Oops!</strong> Houve alguns problemas com a sua entrada.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
						{!! csrf_field() !!}

						<div class="form-group" style="margin-top: 20px">
							<div class="col-md-10 col-md-offset-1">
								<input type="email" class="form-control" placeholder="Email" autofocus name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group" style="margin-bottom: 20px">
							<div class="col-md-10 col-md-offset-1">
								<button type="submit" class="col-xs-12 btn btn-primary">
									Envie o link de redefinição de senha!
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
