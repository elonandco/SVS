@extends('layouts.modal')
@section('content')
	<h1 class="modal-title">Add to Bid</h1>
	<div class="modal-section">
		<select>
			
			@foreach($bids as $bid)
			<option value="{{$bid->id}}">{{$bid->category->name}}</option>
			@endforeach
		</select>
	</div>
@stop