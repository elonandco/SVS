@extends('layouts.default')
@section('content')
	@include('partials.vendors.profile.hero')
	@include('partials.vendors.profile.menu')

	<script>
		window.dropUrl = '/bids/{{ $bid->id }}/upload';
		window.removeUrl = '/bids/{{ $bid->id }}/remove/';
		window.files = {{ $bid->attachments->toJson() }}
		@if(Session::get('new_bid') == true)
			window.newBid = true;
		@endif;
	</script>

	<div class="bid-create">
		{{ Form::open(array('url' => 'bids/update', 'id' => 'bid_form',  'data-persist' => 'garlic', 'data-destroy' => 'false')) }}

		<div class="section">
			<div class="container">
				<h2 class="page-title">Request a bid</h2>
			</div>
		</div>

		<div class="section">
			<div class="container">
				@include('partials.vendors.selected')
				{{ $errors->first('vendors', '<span class="error">:message</span>') }}
			</div>
		</div>

		<div class="section">
			<div class="container">
				<h3 class="section-title">Quote info</h3>
				<div class="section-editable">
					<div class="row">
						<div class="column">
							<label for="type" class="form-label">Type of work</label>
							<input name="type" id="type" type="text" class="profile-input" value="{{{ Input::old('type') }}}">
						</div>
					</div>

					<div class="row">
						<div class="column medium-4">
							<label for="start_date" class="form-label">Start Date</label>
							<div class="input-wrapper">
								<input name="start_date" id="start_date" data-next="end_date" type="text" class="profile-input fdatepicker" placeholder="MM/DD/YYYY" value="{{{ Input::old('start_date') }}}">
								<i class="fi fi-calendar"></i>
							</div>
							{{ $errors->first('start_date', '<span class="error">:message</span>') }}
						</div>
						<div class="column medium-4">
							<label for="end_date" class="form-label">End Date</label>
							<div class="input-wrapper">
								<input name="end_date" id="end_date" type="text" class="profile-input fdatepicker" placeholder="MM/DD/YYYY" value="{{{ Input::old('end_date') }}}">
								<i class="fi fi-calendar"></i>
							</div>
							{{ $errors->first('end_date', '<span class="error">:message</span>') }}
						</div>
						<div class="column medium-4">
							<label for="due_date" class="form-label">Due Date</label>
							<div class="input-wrapper">
								<input name="due_date" id="due_date" type="text" class="profile-input fdatepicker" placeholder="MM/DD/YYYY" value="{{{ Input::old('due_date') }}}">
								<i class="fi fi-calendar"></i>
							</div>
							{{ $errors->first('due_date', '<span class="error">:message</span>') }}
						</div>
					</div>
					<div class="row">
						<div class="column">
							<label for="description" class="form-label">Description</label>
							<textarea name="description" id="description" class="profile-textarea">{{{ Input::old('description') }}}</textarea>
							{{ $errors->first('description', '<span class="error">:message</span>') }}
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="section">
			<div class="container">
				<h3 class="section-title">Upload Files</h3>
				<div class="section-editable dropzone" id="bidzone">
						<div class="dz-previews"></div>
						<div class="dz-message">
							<div><span class="cta disabled">Choose File</span></div>
							<div>Or drag 'n drop files here</div>
						</div>
					
				</div>
				<div id="preview-template" style="display: none;">
					<div class="dz-preview dz-file-preview">
					  <div class="dz-details">
					  	<div class="dz-details-content">
					    	<div class="dz-filename"><span data-dz-name></span></div>
					    	<div class="dz-size" data-dz-size></div>
					    </div>
					  </div>
					</div>
				</div>
			</div>
		</div>

		<div class="section">
			<div class="container" align="center">
			<input type="hidden" name="id" value="{{$bid->id}}">
				<button type="submit" class="cta cta-submit">Create Bid</button>
			</div>
		</div>

		{{ Form::close() }}

	</div>
@stop