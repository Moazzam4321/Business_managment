<div class="col-md-8">
    <div class="card">
        <div class="card-header" style="margin-left: 550px;margin-top: 100px;margin-bottom: 10px;">{{ __('Sign Up') }}</div>

        <div class="card-body">
            <div style="position: absolute;left: 400px;border: 5px solid red;margin: top 10px;">
                <form method="POST" action="{{ route('sign_up') }}">
                    
                    <div class="form-group" style="padding-top: 10px;">
                        <label for="name" style="padding-left: 5px;">{{ __('First_name:') }}</label>
                        <input style="margin-left: 45px;" id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    </div>

                    <div class="form-group" style="padding-top: 10px;">
                        <label for="name" style="padding-left: 5px;">{{ __('Last_name:') }}</label>
                        <input style="margin-left: 45px;" id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    </div>

                    <div class="form-group" style="padding-top: 10px;">
                        <label for="email" style="padding-left: 5px;">{{ __('E-Mail Address:') }}</label>
                        <input style="margin-left: 13px;" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email">
                    </div>

                    <div class="form-group" style="padding-top: 10px;">
                        <label for="dob" style="padding-left: 5px;">{{ __('Date of Birth') }}</label>
                        <input style="margin-left: 40px;" id="dob" type="date" class="form-control" name="dob">
                    </div>

                    <div class="form-group" style="padding-top: 10px;">
                        <label for="profile_picture" style="padding-left: 5px;">{{ __('Profile Picture') }}</label>
                        <input style="margin-left: 40px;" id="profile_picture" type="file" class="form-control" name="profile_picture">
                    </div>

                    <div class="form-group" style="padding-top: 10px;margin-left: 100px;" >
                        <button type="submit" class="btn btn-primary" >
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
