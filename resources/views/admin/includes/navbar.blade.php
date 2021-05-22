<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="index3.html" class="brand-link">
		<img src="{{asset("assets/dist/img/AdminLTELogo.png")}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
			 style="opacity: .8">
		<span class="brand-text font-weight-light">Admin Page</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->


		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<a class="text-center" href="#">
				<div  class="profile-img">
					<img class="mx-auto img-circle img-thumbnail" height="150" width="100" src="{{asset("images/admins/".Auth::user()->image)}}">
				</div>
				<h5 style="font-weight: bold">{{Auth::user()->name}}</h5>
				@if(Auth::user()->super_admin==1)
					<h6 class="mt-2">Website Owner</h6>
				@else<h6 class="mt-2">Website Administrator</h6>
				@endif
				<p class="text-muted font-size-sm">{{Auth::user()->email}}</p>
				<p class="text-secondary ml-4"><a class="btn btn-info ml-5 mb-2" style="color:whitesmoke;" href="{{route('admin.profile')}}">Edit Profile</a></p>
			</a>
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

						<li class="nav-item ">
							<a href="{{route('admin.index')}}" class="nav-link @if(\Illuminate\Support\Facades\Request::is('*admin*'))active @endif">
								<i class="nav-icon fas fa-tachometer-alt"></i>
								<p>Dashboard</p>
							</a>
						</li>

				<li class="nav-item has-treeview @if(\Illuminate\Support\Facades\Request::is('*banks*')) menu-open @endif">

					<a href="#" class="nav-link @if(\Illuminate\Support\Facades\Request::is('*banks*'))active @endif">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Banks
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item ">
							<a href="{{route('admin.banks.index')}}" class="nav-link @if(\Illuminate\Support\Facades\Request::is('*banks*'))active @endif">
								<i class="far fa-circle nav-icon"></i>
								<p>Show Banks</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{route('admin.banks.create')}}" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Add Bank</p>
							</a>
						</li>

					</ul>
				</li>

				<li class="nav-item has-treeview ">
					<a href="{{route('admin.customers.index')}}" class="nav-link @if(\Illuminate\Support\Facades\Request::is('*customers*'))active @endif">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Customers
						</p>
					</a>
				</li>

				<li class="nav-item has-treeview ">
					<a href="{{route('admin.transactions.index')}}" class="nav-link @if(\Illuminate\Support\Facades\Request::is('*transactions*'))active @endif">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Transactions
						</p>
					</a>
				</li>

				@if (Auth::check()&&Auth::user()->super_admin==1)

				<li class="nav-item has-treeview ">
					<a href="{{route('admin.admins.index')}}" class="nav-link @if(\Illuminate\Support\Facades\Request::is('*admins*'))active @endif">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Admins
						</p>
					</a>
				</li>
				@endif

				<li class="nav-item has-treeview @if(\Illuminate\Support\Facades\Request::is('*website*'))menu-open @endif">
					<a href="#" class="nav-link @if(\Illuminate\Support\Facades\Request::is('*website*'))active @endif">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Website Control
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">

						<li class="nav-item has-treeview @if(\Illuminate\Support\Facades\Request::is('*website/aboutusheader*'))menu-open @elseif(\Illuminate\Support\Facades\Request::is('*website/aboutusshortcut*'))menu-open @endif">
							<a href="#" class="nav-link @if(\Illuminate\Support\Facades\Request::is('*website/aboutusheader*'))active @elseif(\Illuminate\Support\Facades\Request::is('*website/aboutusshortcut*'))active @endif">
								<i class="nav-icon fas fa-tachometer-alt"></i>
								<p>
									About Us
									<i class="right fas fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="{{route('admin.aboutusheader.index')}}" class="nav-link @if(\Illuminate\Support\Facades\Request::is('*website/aboutusheader*'))active @endif">
										<i class="far fa-circle nav-icon"></i>
										<p>Headers</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="{{route('admin.aboutusshortcut.index')}}" class="nav-link @if(\Illuminate\Support\Facades\Request::is('*website/aboutusshortcut*'))active @endif">
										<i class="far fa-circle nav-icon"></i>
										<p>Shortcuts</p>
									</a>
								</li>

							</ul>
						</li>

						<li class="nav-item">
							<a href="{{route('admin.header.index')}}" class="nav-link @if(\Illuminate\Support\Facades\Request::is('*website/header*'))active @endif">
								<i class="far fa-circle nav-icon"></i>
								<p>Header</p>
							</a>
						</li>

						<li class="nav-item ">
							<a href="{{route('admin.gallery.index')}}" class="nav-link @if(\Illuminate\Support\Facades\Request::is('*website/gallery*'))active @endif">
								<i class="far fa-circle nav-icon"></i>
								<p>
									Gallery
								</p>
							</a>
						</li>

						<li class="nav-item ">
							<a href="{{route('admin.howitworks.index')}}" class="nav-link @if(\Illuminate\Support\Facades\Request::is('*website/howitworks*'))active @endif">
								<i class="far fa-circle nav-icon"></i>
								<p>
									How It Works
								</p>
							</a>
						</li>

						<li class="nav-item ">
							<a href="{{route('admin.ourservices.index')}}" class="nav-link @if(\Illuminate\Support\Facades\Request::is('*website/ourservices*'))active @endif">
								<i class="far fa-circle nav-icon"></i>
								<p>
									Our Services
								</p>
							</a>
						</li>

						<li class="nav-item ">
							<a href="{{route('admin.testimonials.index')}}" class="nav-link @if(\Illuminate\Support\Facades\Request::is('*website/testimonials*'))active @endif">
								<i class="far fa-circle nav-icon"></i>
								<p>
									Testimonials
								</p>
							</a>
						</li>

						<li class="nav-item ">
							<a href="{{route('admin.contactusmanage.index')}}" class="nav-link @if(\Illuminate\Support\Facades\Request::is('*website/contactusmanage*'))active @endif">
								<i class="far fa-circle nav-icon"></i>
								<p>
									Contact Us Manage
								</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item has-treeview ">
					<a href="{{route('admin.contact.show')}}" class="nav-link @if(\Illuminate\Support\Facades\Request::is('*contact*'))active @endif">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Messages
						</p>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<script>
    // Get the modal
    var modal = document.getElementById('id01');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>