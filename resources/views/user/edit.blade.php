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
                    <div class="ml-4 pl-3 mt-3 border-left border-warning" style="border-width: 4px !important; border-radius: 4px;">
                        <label for="province">Provinsi</label>
                        <select onchange="setCityValue(this)" required name="province" id="province" class="form-control">
                            <option value="">Pilih Provinsi</option>
                            @foreach($provinces as $province)
                                @if($user->address)
                                    <option @if($user->province[0] == $province["province_id"]) selected @endif value="{{$province["province_id"]}}:{{$province["province"]}}">{{$province["province"]}}</option>
                                @else
                                    <option value="{{$province["province_id"]}}:{{$province["province"]}}">{{$province["province"]}}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="mt-3">
                            <label for="city">Kota</label>
                            <select required name="city" id="city" class="form-control">
                                <option value="">Pilih Kota</option>
                                @foreach($cities as $city)
                                    @if($user->address)
                                        <option @if($user->city[0] == $city["city_id"]) selected @endif value="{{$city["city_id"]}}:{{$city["type"]}} {{$city["city_name"]}}">{{$city["type"]}} {{$city["city_name"]}}</option>
                                    @else
                                        <option value="{{$city["city_id"]}}:{{$city["type"]}} {{$city["city_name"]}}">{{$city["type"]}} {{$city["city_name"]}}</option>
                                    @endif
                                @endforeach
{{--                                @if($user->city)--}}
{{--                                    <option selected value="{{$user->city[0]}}:{{$user->city[1]}}">{{$user->city[1]}}</option>--}}
{{--                                @endif--}}
                            </select>
                        </div>
                    </div>
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


@push("javascript")
    <script>
        const setCityValue = el => {
            const provinceId = el.value;

        //     get city with laravel route
            fetch(`{{route("user.get-city")}}?province_id=${provinceId}`)
                .then(res => res.json())
                .then(res => {
                    $("#city").empty();
                    $("#city").append("<option value=''>Pilih Kota</option>")
                    res.forEach(city => {
                        $("#city").append("<option value='" + city.city_id + ":" + city.type + " " + city.city_name + "'>" + city.type + " " + city.city_name + "</option>")
                    })
                })
        }
    </script>
@endpush
