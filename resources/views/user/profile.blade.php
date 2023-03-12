@extends("master.user")

@section("content")
    <section class="header">
        <h2>Halaman Profile Pengguna</h2>
    </section>

    <div class="card mt-5 w-50">
        <div class="card-body">
            <div class="d-flex  align-items-center">
                <img src="{{$user->social_id ? $user->photo_profile : asset("storage/user_photo/$user->photo_profile")}}" alt="" class="img-fluid img-shadow rounded-circle">
                <div class="col-md-8 ml-5 mt-4">
                    <h3 class="mb-4">Nama Akun: {{$user->name}}</h3>
                    <p>Email: {{$user->email}}</p>
                    <p>Nomor Handphone aktif: {{$user->phone_number}}</p>
                    <p>Alamat: {{$user->address}}</p>
                    @if($user->social_id)
                        <p class="text-warning mb-4">Merupakan akun yang login menggunakan <span class="text-dark font-weight-bold">{{Str::upper($user->social_type)}}</span></p>
                    @endif

                    <a href="{{route("user.edit")}}" class="btn btn-primary">Edit Profile</a>

                    @if($user->social_id)
                        <a href="{{route("user.destroy", $user->id)}}" class="btn btn-danger">Hapus Akun</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
