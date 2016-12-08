<form method="POST" id="forgot-form" class="modal-form" action="{{ URL::to('/users/forgot_password') }}" accept-charset="UTF-8">
    <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
    <ul class="errors"></ul>
    <div class="form-group">
        <label for="email" class="form-input-label">{{{ Lang::get('confide::confide.e_mail') }}}</label>
        <div class="input-append input-group">
            <input class="form-control" placeholder="{{{ Lang::get('confide::confide.e_mail') }}}" type="text" name="email" id="email" value="{{{ Input::old('email') }}}">
            <span class="input-group-btn">
                <input class="cta btn btn-default" type="submit" value="{{{ Lang::get('confide::confide.forgot.submit') }}}">
            </span>
        </div>
    </div>
</form>
