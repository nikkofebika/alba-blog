<aside class="main-sidebar">
	<section class="sidebar">
		<div class="user-panel">
			<div class="pull-left image">
				<img src="{{ asset(auth()->user()->photo) }}" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p>{{ Auth::user()->name }}</p>
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>
		<?php $active_menu = isset($active_menu) ? $active_menu : '' ?>
		<ul class="sidebar-menu" data-widget="tree">
			<li class="header">MAIN NAVIGATION</li>
			<li class="{{ $active_menu == 'dashboard' ? 'active' : '' }}">
				<a href="{{ url('console') }}">
					<i class="fa fa-dashboard"></i> <span>Dashboard</span>
				</a>
			</li>
			<li class="{{ $active_menu == 'users' ? 'active' : '' }}">
				<a href="{{ url('console/users') }}">
					<i class="fa fa-users"></i> <span>User</span>
				</a>
			</li>
			<li class="{{ $active_menu == 'posts' ? 'active' : '' }}">
				<a href="{{ url('console/posts') }}">
					<i class="fa fa-newspaper-o"></i> <span>Post</span>
				</a>
			</li>
			<li class="{{ $active_menu == 'categories' ? 'active' : '' }}">
				<a href="{{ url('console/categories') }}">
					<i class="fa fa-bookmark-o"></i> <span>Category</span>
				</a>
			</li>
			<li class="{{ $active_menu == 'tags' ? 'active' : '' }}">
				<a href="{{ url('console/tags') }}">
					<i class="fa fa-bookmark-o"></i> <span>Tag</span>
				</a>
			</li>
			<li class="{{ $active_menu == 'facilities' ? 'active' : '' }}">
				<a href="{{ url('console/facilities') }}">
					<i class="fa fa-bookmark-o"></i> <span>Fasilitas</span>
				</a>
			</li>
			<li class="treeview {{ $active_menu == 'rooms' || $active_menu == 'booking_schedules' ? 'active' : '' }}">
				<a href="#">
					<i class="fa fa-home"></i> <span>Ruangan</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="{{ $active_menu == 'rooms' ? 'active' : '' }}"><a href="{{ url('console/rooms') }}"><i class="fa fa-circle-o"></i> Daftar Ruangan</a></li>
					<li class="{{ $active_menu == 'booking_schedules' ? 'active' : '' }}"><a href="{{ url('console/rooms/booking_schedules') }}"><i class="fa fa-circle-o"></i> Jadwal Booking</a></li>
				</ul>
			</li>
			<li class="{{ $active_menu == 'medical' ? 'active' : '' }}">
				<a href="{{ url('console/medical') }}">
					<i class="fa fa-medkit"></i> <span>Medical</span>
				</a>
			</li>
			<li class="{{ $active_menu == 'company-policies' ? 'active' : '' }}">
				<a href="{{ url('console/company-policies') }}">
					<i class="fa fa-lock"></i> <span>Company Policy</span>
				</a>
			</li>
			<li class="{{ $active_menu == 'teams' ? 'active' : '' }}">
				<a href="{{ url('console/teams') }}">
					<i class="fa fa-users"></i> <span>Team</span>
				</a>
			</li>
			<li>
				<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
					<i class="fa fa-sign-out"></i> <span>Logout</span>
				</a>
				<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
					@csrf
				</form>
			</li>
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>