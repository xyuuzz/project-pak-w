<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/3442f81bd6.js" crossorigin="anonymous"></script>
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset("assets/css/register/style.css")}}">
    <style>
        body {
            background-image: url({{asset("assets/images/register/bg-register.jpeg")}});
        }
    </style>
</head>
<body>
<form action="{{route("attempt-register")}}" method="post" enctype="multipart/form-data">

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @csrf
    <h1 class="header">Register</h1>
    <div class="form-group">
        <label for="name"><p>Nama</p></label>
        <input id="name" name="name" type="text" class="form-control">
    </div>
    <div class="row">
        <div class="col-md-6">

            <div class="form-group">
                <label for="email"><p class="email">Email</p></label>
                <input id="email" name="email" type="email" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="password" class="first-password"><p>Password</p></label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="photo_profile"><p>Photo Profile</p></label>
        <input type="file" name="photo_profile" id="photo_profile" class="form-control">
    </div>
    <input type="submit" class="register" value="Register">
    <a class="Login" href="{{route("login")}}">already have an account? Login!</a>
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
