<style type="text/css">
	#logout, #logout:hover {
		background-color: unset;
		padding: unset;
	}
</style>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
	<!-- Control sidebar content goes here -->
	<div class="p-3">
	  <!-- <h5>Title</h5>
	  <p>Sidebar content</p> -->

	  <a id="logout" class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
	  	{{ __('Logout') }}
	  </a>
	  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
	  	@csrf
	  </form>
	</div>
</aside>
<!-- /.control-sidebar -->