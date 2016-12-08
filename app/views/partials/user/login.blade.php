<form role="form" class="modal-form" method="POST" action="{{{ URL::to('/login') }}}" id="login-form" accept-charset="UTF-8">
    <div class="errors"></div>
    <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
        <div class="form-group">
            <label for="email" class="form-input-label">{{{ Lang::get('confide::confide.e_mail') }}}</label>
            <input class="form-control" tabindex="1" placeholder="{{{ Lang::get('confide::confide.e_mail') }}}" type="text" name="email" id="email" value="{{{ Input::old('email') }}}">
        </div>
        <div class="form-group">
        <label for="password" class="form-input-label">
            {{{ Lang::get('confide::confide.password') }}}
        </label>
        <input class="form-control" tabindex="2" placeholder="{{{ Lang::get('confide::confide.password') }}}" type="password" name="password" id="password">
        <p class="help-block">
            <a href="/forgot" class="modal-cta ">Forgot Password</a>
        </p>
        </div>
        <div class="checkbox help-block">
            <label for="remember">
                <input tabindex="4" type="checkbox" name="remember" id="remember" value="1"> {{{ Lang::get('confide::confide.login.remember') }}}
            </label>
        </div>
        @if (Session::get('error'))
            <div class="alert alert-error alert-danger">{{{ Session::get('error') }}}</div>
        @endif

        @if (Session::get('notice'))
            <div class="alert">{{{ Session::get('notice') }}}</div>
        @endif
        <div class="form-actions form-group">
            <button tabindex="3" type="submit" class="cta btn btn-default">Log In</button>
        </div>
</form>
