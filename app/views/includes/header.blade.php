<div class="header">
	<div class="logo-container">
		<h1><a href="/" class="logo">Select Vendor Services</a></h1>
		<a class="hamburger" id="mobile-menu" href="#"><span class="menu-text">Menu</span></a>
		@if (isset($is_search))
			<a class="search-icon" id="search-menu" href="#"><span class="menu-text">Search</span></a>
		@endif	
	</div>

	@if (Confide::user())
	<div class="menu">
		<div class="account-menu">
			<div class="profile-link">
				<img src="{{Confide::user()->avatar}}" class="avatar" alt=""> {{Confide::user()->first_name}} {{Confide::user()->last_name}}
			</div>
			<ul class="profile-menu">
				<li><a href="/profile/{{Confide::user()->vendors->first()->slug}}" class="profile-menu-link">My Profile</a></li>
				<li><a href="javascript:;" class="profile-menu-link">Account Settings</a></li>
				<li><a href="/bids" class="profile-menu-link">Bid Requests</a></li>
				<li><a href="/logout" class="profile-menu-link">Logout</a></li>
			</ul>
		</div>
	</div>
	@else
	<div class="menu">
		<a href="/signup" class="cta modal-cta primary">Sign Up</a>
		<a href="/login" class="cta  modal-cta secondary">Log In</a>
	</div>
	@endif
	<div class="menu-overlay"></div>
</div>