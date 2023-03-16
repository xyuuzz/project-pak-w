<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
    <!-- Font Awesome -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
        rel="stylesheet"
    />
    <!-- MDB -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css"
        rel="stylesheet"
    /><!-- MDB -->
    <script
        type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"
    ></script>
</head>
<body style="background-image: url('<?=asset("assets/images/login/bg.jpg")?>'); height: 100%;width: 100%; background-size: cover;";>
@include('sweetalert::alert')
<div class="card mx-auto" style="width: 30rem; margin-top: 60px; background-color:#ffd;">
    <div class="card-body">

        <h5 class="card-title text-center text-dark">Log In With</h5>
        <div style="height: 50px;"  class=" d-flex justify-content-between">
            <button class="fs-5 text-center btn btn-warning ms-2" style="width: 170px;background-color: #ffb17aff;" ><img src="<?=asset("assets/images/login/gugel.jpg")?>"height="30px" alt="gugel" srcset="" class="">
                <a class="text-white" href="{{route("google-login")}}">Google</a>
            </button>
            <button class="fs-6 text-center btn btn-warning me-2" style="width: 170px;background-color: #ffb17aff;"><img src="<?=asset("assets/images/login/efbe.png")?>" height="30px" alt="">
                <a href="{{route("facebook-login")}}" class="text-white">Facebook</a>
            </button>
        </div>
        <div class="d-flex justify-align-content">
            <hr style="width: 45%;">
            <h5 class="p-2"> or</h5>
            <hr style="width: 45%;">
        </div>

        <p class="card-text ms-0 mb-0">
        <form>
            <!-- Email input -->
            <div class="form-outline mb-4">
                <label class=" text-dark mb-0" for="form2Example1 ">Email</label>
                <input type="email" id="form2Example1" class="form-control" />
                <hr class="mt-0">
            </div>
            <!-- Password input -->
            <div class="form-outline mb-4">
                <label class="text-dark" for="form2Example2">Password</label>
                <input type="password" id="form2Example2" class="form-control" />
                <hr class="mt-0">
            </div>
            <!-- Submit button -->
            <div type="submit"  class=" ms-4 text-center text-white rounded fs-3" style="background-color:#552200;width: 90%;height: 50px;">Log In</div>
            <hr class="line-height-sm">
            <!-- Register buttons -->
            <div class="text-center text-dark">
                <a href="<?=route("register")?>" style="text-decoration: none;color: black;">Create An Account!</a>
            </div>
        </form>
        </p>
    </div>
</div>
</div>
</body>
</html>
