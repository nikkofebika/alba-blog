@extends('layouts.default')
@section('content')
<script type="text/javascript">
	document.querySelector("body").style.backgroundColor = "#E5E5E5";
</script>
<style type="text/css">
	.b-example-divider {
		flex-shrink: 0;
		width: 1.5rem;
		height: 100vh;
		background-color: rgba(0, 0, 0, .1);
		border: solid rgba(0, 0, 0, .15);
		border-width: 1px 0;
		box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
	}

	.bi {
		vertical-align: -.125em;
		pointer-events: none;
		fill: currentColor;
	}

	.dropdown-toggle { outline: 0; }

	.nav-flush .nav-link {
		border-radius: 0;
	}

	.btn-toggle {
		display: inline-flex;
		align-items: center;
		padding: .25rem .5rem;
		font-weight: 600;
		color: rgba(0, 0, 0, .65);
		background-color: transparent;
		border: 0;
	}
	.btn-toggle:hover,
	.btn-toggle:focus {
		color: rgba(0, 0, 0, .85);
		background-color: #d2f4ea;
	}

	.btn-toggle::before {
		width: 1.25em;
		line-height: 0;
		content: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='rgba%280,0,0,.5%29' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 14l6-6-6-6'/%3e%3c/svg%3e");
		transition: transform .35s ease;
		transform-origin: .5em 50%;
	}

	.btn-toggle[aria-expanded="true"] {
		color: rgba(0, 0, 0, .85);
	}
	.btn-toggle[aria-expanded="true"]::before {
		transform: rotate(90deg);
	}

	.btn-toggle-nav a {
		display: inline-flex;
		padding: .1875rem .5rem;
		margin-top: .125rem;
		margin-left: 1.25rem;
		text-decoration: none;
	}

	.scrollarea {
		overflow-y: auto;
	}

	.fw-semibold { font-weight: 600; }
	.lh-tight { line-height: 1.25; }

	.nav-item .collapse ul li.active, .nav-item .collapse ul li:hover {
		background: #0d6efd;
		border-radius: 3px;
	}

	.nav-item .collapse ul li.active a, .nav-item .collapse ul li:hover a {
		color: #ffffff !important;
	}
</style>
<div class="container" style="max-width: 1240px;">
	<div class="row" style="margin-top: 120px; margin-bottom: 50px;">
		<h2 class="text-center mb-3">DASHBOARD</h2>
		<div class="col-md-3 mb-3">
			<div class="d-flex flex-column flex-shrink-0 p-3 shadow rounded bg-white">
				<ul class="nav nav-pills flex-column mb-auto">
					<li class="nav-item">
						<a href="{{ url('dashboard') }}" class="nav-link link-dark" data-bs-toggle="collapse" data-bs-target="#profile-collapse">
							<i class="bx bx-user me-2"></i> Profil <span class="float-end"><i class="bx bx-chevron-right"></i></span>
						</a>
						<div class="collapse @if(in_array($active_menu, ['personal-identity','education-training','family','working-experience'])) show @endif" id="profile-collapse">
							<ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
								<li class="@if($active_menu === 'personal-identity') active @endif"><a class="link-dark rounded" href="{{ url('dashboard/profile/personal-identity') }}">Personal Identity</a></li>
								<li class="@if($active_menu === 'education-training') active @endif"><a href="{{ url('dashboard/profile/education-training') }}" class="link-dark rounded">Education & Training</a></li>
								<li class="@if($active_menu === 'family') active @endif"><a href="{{ url('dashboard/profile/family') }}" class="link-dark rounded">Family</a></li>
								<li class="@if($active_menu === 'working-experience') active @endif"><a href="{{ url('dashboard/profile/working-experience') }}" class="link-dark rounded">Working Experience</a></li>
							</ul>
						</div>
					</li>
					<li>
						<a href="{{ url('dashboard/attendance') }}" class="nav-link <?php echo $active_menu === 'attendance' ? 'active' : 'link-dark' ?>">
							<i class="bx bx-fingerprint me-2"></i> Attendance
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ url('dashboard') }}" class="nav-link link-dark" data-bs-toggle="collapse" data-bs-target="#lr-collapse">
							<i class="bx bx-door-open me-2"></i> Leave Request <span class="float-end"><i class="bx bx-chevron-right"></i></span>
						</a>
						<div class="collapse @if(in_array($active_menu, ['leave-request','leave-balance','leave-approval'])) show @endif" id="lr-collapse">
							<ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
								<li class="@if($active_menu === 'leave-request') active @endif"><a class="link-dark rounded" href="{{ url('dashboard/leave-request') }}">Leave Request</a></li>
								<li class="@if($active_menu === 'leave-balance') active @endif"><a href="{{ url('dashboard/leave-request/leave-balance') }}" class="link-dark rounded">Leave Balance</a></li>
								<li class="@if($active_menu === 'leave-approval') active @endif"><a href="{{ url('dashboard/leave-request/leave-approval') }}" class="link-dark approval">Leave Approval</a></li>
							</ul>
						</div>
					</li>
					<li>
						<a href="{{ url('dashboard/room') }}" class="nav-link <?php echo $active_menu === 'room' ? 'active' : 'link-dark' ?>">
							<i class="bx bx-calendar me-2"></i> Booking Room
						</a>
					</li>
					<li>
						<a href="{{ url('dashboard/medical') }}" class="nav-link <?php echo $active_menu === 'medical' ? 'active' : 'link-dark' ?>">
							<i class="bx bx-plus-medical me-2"></i> Medical
						</a>
					</li>
					<li>
						<a href="javascript:void(0)" class="nav-link link-dark" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
							<i class="bx bx-log-out-circle me-2"></i> Logout
						</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
					</li>
				</ul>
			</div>
		</div>
		<div class="col-md-9">
			@yield('contentdashboard')
		</div>
	</div>
</div>
@endsection