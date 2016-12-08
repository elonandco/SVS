<!doctype html>
<html lang="en" ng-app="SVS">
<head>
	@include('includes.head')
</head>
<body class="{{ HTMLHelpers::bodyClass() }}">
	<div class="page-container">
		<div class="page-content">

			@yield('content')

		</div>
	</div>
	<div id="modal" class="modal loading"></div>

	@include('includes.scripts')
</body>
</html>