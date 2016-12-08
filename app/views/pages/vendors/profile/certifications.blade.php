@if ( $isOwner )
	<div class="section">
		<div class="container">
			<h3 class="section-title">Company Licenses, Certifications &amp; Registrations</h3>
			<div class="section-editable">
				<p>List any certifications you may have.</p>
				<div vendor-certifications action="{{{ URL::to('/vendor/' . $vendor->slug . '/certifications') }}}"></div>
			</div>
		</div>
	</div>
@elseif(count($vendor->certifications))
	<div class="section">
		<div class="container">
			<h3 class="section-title">Company Licenses, Certifications &amp; Registrations</h3>
			<div class="section-editable">
				
				
				<table class="full">
					<thead>
						<tr>
							<th>Title</th>
							<th>State</th>
							<th>Accreditation #</th>
							<th>Exp Date</th>
						</tr>
					</thead>
					<tbody>
					@foreach ($vendor->certifications as $certification)
						<tr>
							<td>{{ $certification->name }}</td>
							<td>{{ $certification->state }}</td>
							<td>{{ $certification->value }}</td>
							<td>{{ $certification->date }}</td>
						</tr>
					@endforeach
					</tbody>
				</table>
				
			</div>
		</div>
	</div>
@endif