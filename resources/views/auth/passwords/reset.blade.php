@extends('layouts.default')
@section('content')
<div class="container mt-5">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="card shadow">
				<div class="card-header text-center"><h2>{{ __('Reset Password') }}</h2></div>
				<div class="card-body">
					<form method="POST" action="{{ route('password.update') }}">
						@csrf
						<input type="hidden" name="token" value="{{ $token }}">
						<div class="mb-3 pb-1">
							<div class="form-outline">
								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
								<label  class="form-label">{{ __('E-Mail Address') }}</label>
								@error('email')
								<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
						</div>

						<div class="mb-3 pb-1">
							<div class="form-outline">
								<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" />
								<label  class="form-label">{{ __('Password') }}</label>
								@error('password')
								<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
						</div>

						<div class="mb-3 pb-1">
							<div class="form-outline">
								<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
								<label  class="form-label">{{ __('Confirm Password') }}</label>
								@error('password')
								<div class="invalid-feedback">{{ $message }}</div>
								@enderror
							</div>
						</div>
						<center><button type="submit" class="btn btn-primary btn-lg">{{ __('Reset Password') }}</button></center>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
