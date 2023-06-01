@extends('layouts.app')

@push('styles')
    <style>
        .form-control:focus {
            border-color: #4d4dff;
            box-shadow: none;
        }

        .btn-primary {
            background-color: #4d4dff;
            border-color: #4d4dff;
        }

        .btn-primary:hover {
            background-color: #2e2eb8;
            border-color: #2e2eb8;
        }

        .border {
            border: 3px solid #4d4dff;
        }
    </style>
@endpush
@section('content')
    <div class="container d-flex align-items-center justify-content-center h-100">
        <div class="border rounded p-4">
            <div class="card-header" style="margin-left: 610px;margin-top: 100px;margin-bottom: 10px;">{{ __('Login') }}</div>
            <div id='LoginForm' class="card-body" style="position: absolute; left: 500px;border: 5px solid black; margin: top 10px;">
                <form method="POST" action="{{ route('login') }}">

                    <div class="form-group row" style="margin: 10px; color :blue">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        
                            <input style="margin-left: 5px;" id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                    </div>

                    <div class="form-group row" style="margin: 10px; color :blue">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            <input style="margin-left: 45px;"  id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check" style="margin-left: 120px; margin-bottom: 10px ">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4" style="margin-left: 110px; margin-top:auto">
                            <button type="submit" class="btn btn-primary btn-lg">
                                {{ __('Login') }}
                            </button>

                            @if (Route::has('/forgot.password'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    Document.ready(function () {
        $('#LoginForm').submit(function (e){
            e.preventDefault();
            $.ajax({})
        }) 
    })
</script>