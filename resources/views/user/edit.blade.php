@extends("master.user")

@section("content")
    <section class="header">
        <h2>Edit Data Pengguna</h2>
    </section>

    <div class="card mt-5 w-50">
        <div class="card-body">
            <form action="{{route("user.update")}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3 border border-primary rounded p-3">
                    <label for="name">Nama Akun</label>
                    <input required value="{{$user->name}}" type="text" name="name" id="name" class="form-control">
                    <label required for="email">Email</label>
                    <input required @if($user->social_id) readonly @endif value="{{$user->email}}" type="email" name="email" id="email" class="form-control">
                    @if($user->social_id) <small class="text-secondary d-block mb-3">Tidak bisa diubah karena akun login menggunakan {{ucwords($user->social_type)}}</small> @endif
                    <label for="phone_number">Nomor Handphone</label>
                    <input required value="{{$user->phone_number}}" type="text" name="phone_number" id="phone_number" class="form-control">
                    <label for="address">Alamat</label>
                    <input required value="{{$user->address}}" type="text" name="address" id="address" class="form-control">
                </div>
                <div class="mb-3 border border-primary rounded p-3">
                    <div class="mb-3">
                        <label for="photo_profile">Foto Profil Baru</label>
                        <input type="file" name="photo_profile" id="photo_profile" class="form-control">
                    </div>
                </div>

                <label for="password">Password Baru</label>
                <input type="password" name="password" id="password" class="form-control" minlength="8">

                <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
            </form>
        </div>
    </div>
@endsection
