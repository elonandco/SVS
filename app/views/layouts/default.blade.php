<!doctype html>
<html lang="en" ng-app="SVS" >
<head>
	@include('includes.head')
</head>
<body class="{{ HTMLHelpers::bodyClass() }}">
	<div class="page-container">

		@include('includes.header')

		<div class="page-content" ng-cloak>

			@yield('content')

		</div>

		@include('includes.footer')

	</div>
	<div id="modal" class="modal loading"></div>

	@include('includes.scripts')
	
</body>
</html>