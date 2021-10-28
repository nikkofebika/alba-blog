@extends('layouts.default')
@push('styles')
<style type="text/css" media="screen">
	.form-signin {
		width: 100%;
		max-width: 330px;
		padding: 15px;
		margin: auto;
	}

	.form-signin .checkbox {
		font-weight: 400;
	}

	.form-signin .form-floating:focus-within {
		z-index: 2;
	}

	.form-signin input[type="email"] {
		margin-bottom: -1px;
		border-bottom-right-radius: 0;
		border-bottom-left-radius: 0;
	}

	.form-signin input[type="password"] {
		margin-bottom: 10px;
		border-top-left-radius: 0;
		border-top-right-radius: 0;
	}
</style>
@endpush
@section('content')
<div class="container mt-5" >
	<div class="row">
		<div class="col-lg-12 my-5">
			<div class="form-signin text-center">
				<form>
					<img class="mb-4" src="{{ asset('assets/img/logo_cafe.png') }}" class="img-responsive">
					<h1 class="h3 mb-3 fw-normal">Please sign in</h1>

					<div class="form-floating">
						<input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
						<label for="floatingInput">Email address</label>
					</div>
					<div class="form-floating">
						<input type="password" class="form-control" id="floatingPassword" placeholder="Password">
						<label for="floatingPassword">Password</label>
					</div>

					<div class="checkbox mb-3">
						<label>
							<input type="checkbox" value="remember-me"> Remember me
						</label>
					</div>
					<button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection