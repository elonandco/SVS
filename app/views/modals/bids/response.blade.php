@extends('layouts.modal')
@section('content')
	<h1 class="modal-title">{{ $bid->type }}</h1>
	<div class="modal-section">
		<form action="/bids/{{$bid->id}}/response" class="modal-form" id="bid-response-form" method="post">
			<input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
    		<ul class="errors"></ul>
			<div class="error">Expires in {{ HTMLHelpers::timeAgo($bid->due, true) }}</div>
			<div class="bid-response">
			
				<div class="dollar-input"><span class="dollar-input-currency">$</span><span class="dollar-input-value"><input type="text" name="response" class="form-control" placeholder="1200.00"></span></div>
				<div><button type="submit" class="cta action">Place Bid</button></div>
			</div>
		</form>
	</div>
	<script>
	$.getScript("/assets/scripts/bid.response.js", function(){ SVS.bidResponse() });
	</script>
@stop