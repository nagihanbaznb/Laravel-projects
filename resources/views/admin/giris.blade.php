<html lang="en"><head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet prefetch" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet prefetch" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/login.css">
</head>

<body>
    <div class="container">
        <form class="form-signin" style="padding:300px" action="{{route('admin.giris')}}" method="POST">
       <!--  <img src="public\images\dribbble.png" class="logo">  -->
       <h3>ADMİN GİRİŞİ</h3>
       <br>
        {{csrf_field()}}
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif

            <label for="email" class="sr-only">Email</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Email" required="" autofocus="">
            <br>
            <label for="password" class="sr-only">Şifre</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Şifre" required>
            <!-- <div class="checkbox">
                <label>
                    <input type="checkbox" name="benihatirla" value="0" checked=""> Beni Hatırla
                </label>
            </div>  -->
            <br>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Giriş Yap</button>
            <div class="links">
                <br>
                <a href="{{route('index')}}">← Siteye Dön</a>
            </div>
            <!-- burayı neden kapattım neden???
            <br>
            <div class="links">
                <br>
                <a href="{{route('admin.kayit')}}">Ücretsiz Kayıt</a>
            </div>    -->
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



</body></html>
