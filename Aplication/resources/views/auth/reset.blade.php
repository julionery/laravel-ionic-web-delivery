@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">RESETAR SENHA</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Oops!</strong>  Houve alguns problemas com a sua entrada.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
						{!! csrf_field() !!}
						<input type="hidden" name="token" value="{{ $token }}">

						<div class="form-group" style="margin-top: 20px">
							<div class="col-md-8 col-md-offset-2">
								<input type="email" class="form-control" placeholder="Email" autofocus name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-8 col-md-offset-2">
								<input type="password" class="form-control" placeholder="Senha" name="password">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-8 col-md-offset-2">
								<input type="password" class="form-control" placeholder="Confirme a Senha" name="password_confirmation">
							</div>
						</div>

						<div class="form-group" style="margin-bottom: 20px">
							<div class="col-md-8 col-md-offset-2">
								<button type="submit" class="col-xs-12 btn btn-primary">
									Resetar Senha
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
