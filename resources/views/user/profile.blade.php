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
                    <p>Nomor Handphone aktif: {!! $user->phone_number ?? '<span class="text-warning">Nomor Handphone belum diisi</span>' !!}</p>

                    @if($user->alamat)
                        <p>Alamat: {{$user->address}} | <span class="btn btn-sm btn-primary">{{$user->province[1]}}</span> | <span class="btn btn-sm btn-info">{{$user->city[1]}}</span></p>
                        @if($user->social_id)
                            <p class="text-warning mb-4">Merupakan akun yang login menggunakan <span class="text-dark font-weight-bold">{{Str::upper($user->social_type)}}</span></p>
                        @endif
                    @else
                        <p class="text-warning mb-4"><span class="text-dark">Alamat:</span> Alamat belum diisi</p>
                    @endif

                    <a href="{{route("user.edit")}}" class="btn btn-primary">Edit Profile</a>
                    <form action="{{route("user.destroy")}}" method="post" class="d-inline-block ml-3">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn-danger">Hapus Akun</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
