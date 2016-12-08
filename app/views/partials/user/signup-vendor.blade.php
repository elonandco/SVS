<form class="modal-form" id="signup-form-vendor" method="POST" action="{{{ URL::to('users') }}}" accept-charset="UTF-8">
    
    @if (Session::get('error'))
        <div class="alert alert-error alert-danger">
            @if (is_array(Session::get('error')))
                {{ head(Session::get('error')) }}
            @endif
        </div>
    @endif

    @if (Session::get('notice'))
        <div class="alert">{{ Session::get('notice') }}</div>
    @endif

    <ul class="errors"></ul>

    <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
    <div class="row">
        <div class="form-column column medium-6">
            <div class="form-group">
                <label class="form-input-label" for="company">First Name</label>
                <input class="form-control" placeholder="First Name" type="text" name="first_name" id="first_name" value="{{{ Input::old('first_name') }}}">
            </div>
            <div class="form-group">
                <label class="form-input-label" for="company">Last Name</label>
                <input class="form-control" placeholder="Last Name" type="text" name="last_name" id="last_name" value="{{{ Input::old('last_name') }}}">
            </div>
            <div class="form-group">
                <label class="form-input-label" for="company">Company Name</label>
                <input class="form-control" placeholder="Company Name" type="text" name="company" id="company" value="{{{ Input::old('company') }}}">
            </div>
            <div class="form-group">
                <label class="form-input-label" for="email">{{{ Lang::get('confide::confide.e_mail') }}} <small>{{ Lang::get('confide::confide.signup.confirmation_required') }}</small></label>
                <input class="form-control" placeholder="{{{ Lang::get('confide::confide.e_mail') }}}" type="text" name="email" id="email" value="{{{ Input::old('email') }}}">
            </div>
            <div class="form-group">
                <label class="form-input-label" for="password">{{{ Lang::get('confide::confide.password') }}}</label>
                <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password') }}}" type="password" name="password" id="password">
            </div>
        </div>
        <div class="form-column column medium-6">
            <div class="form-group">
                <label class="form-input-label" for="category">Category</label>
                {{ Form::select('category_id', [null=>'Choose Category'] + $categories, null, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                <label class="form-input-label" for="phone">Phone Number</label>
                <input class="form-control" placeholder="Phone Number" type="text" name="phone" id="phone" value="{{{ Input::old('phone') }}}">
            </div>
            <div class="form-group">
                <label class="form-input-label" for="address">Street Address</label>
                <input class="form-control" placeholder="Street Address" type="text" name="address" id="address" value="{{{ Input::old('address') }}}">
            </div>
            <div class="form-group">
                <label class="form-input-label" for="zip">Zip Code</label>
                <input class="form-control" placeholder="Zip Code" type="text" name="zip" id="zip" value="{{{ Input::old('zip') }}}">
            </div>
        </div>
    </div>
    <div class="form-actions form-group">
      <input type="hidden" name="is_vendor" value="1">
      <button type="submit" class="cta btn btn-primary">Get Started</button>
    </div>
</form>