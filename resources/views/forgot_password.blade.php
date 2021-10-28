@extends('layouts.default')
@section('content')
<section class="mt-3">
	<div class="container">
		<div class="row">
			<div class="col-md-6 mx-auto col-sm-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="text-center">
							<h3><i class="fa fa-lock fa-4x"></i></h3>
							<h2 class="text-center">Forgot Password?</h2>
							<p>You can reset your password here.</p>
							<div class="panel-body">
								<form id="register-form" role="form" autocomplete="off" class="form" method="post">
									@csrf
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
											<input id="email" name="email" placeholder="email address" class="form-control"  type="email">
										</div>
									</div>
									<button type="submit" class="btn btn-primary btn-block btn-lg mt-3">Reset Password</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection