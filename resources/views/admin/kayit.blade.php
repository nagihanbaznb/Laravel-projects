<html lang="en"><head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet prefetch" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet prefetch" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/login.css">
</head>

<body>
    <div class="container">
        <form class="form-signin" style="padding:300px" action="{{route('admin.kayit')}}" method="POST">
       <!--  <img src="public\images\dribbble.png" class="logo">  -->
       <h3>ADMİN KAYIT</h3>
        {{csrf_field()}}
        <div class="register-main">
				<div class="col-md-6 account-left">
					<input class="{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Adınız" type="text" tabindex="1" required>
					@if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif


                    <input class="{{ $errors->has('name') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email adresiniz" type="text" tabindex="3" required>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                    <input id="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" placeholder="Şifreniz" name="password" tabindex="4" required>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif

                    <input id="password-confirm" type="password" placeholder="Şifreniz Tekrar" name="password_confirmation" required>
                    <input id="permission" class="{{ $errors->has('permission') ? ' is-invalid' : '' }}" type="text" placeholder="Permission" name="permission" tabindex="5" required>
                    @if ($errors->has('permission'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('permission') }}</strong>
                        </span>
                    @endif
                </div>
				<div class="clearfix"></div>
			</div>
            <div class="address submit">
				<input type="submit" value="Submit">
			</div>
            
            <div class="links">
                <br>
                <a href="{{route('index')}}">← Siteye Dön</a>
            </div>

        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



</body></html>
