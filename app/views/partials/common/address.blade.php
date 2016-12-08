<p class="form-input" ng-model="$parent.formData.{{$model}}.address">{{ $address->address }}</p>
<p>
	<span class="form-input"  ng-model="$parent.formData.{{$model}}.city">{{ $address->city }}</span>
	<span class="form-input"  ng-model="$parent.formData.{{$model}}.state">{{ $address->state }} </span>
	<span class="form-input"  ng-model="$parent.formData.{{$model}}.zip">{{ $address->zip }}</span>
</p>