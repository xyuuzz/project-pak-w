@extends('master.admin')

@section("content")
    <div class="d-flex justify-content-between align-items-center my-3">
        <h2>Tambah Promo Baru</h2>
        <a href="{{route('promo.index')}}" class="btn btn-primary">Kembali ke halaman utama</a>
    </div>
    {{--    make form products--}}
    <form action="{{route('promo.store')}}" method="post" class="">
        @csrf
        <div class="row justify-content-center w-100 mb-3">
            <div class="row justify-content-between col-lg-9">
                <div class="mb-3 col-lg-8">
                    <label for="product_id" class="form-label">Produk</label>
                    <select style="background-color: rgb(141,127,107); color: white;" class="form-control border-0" id="product_id" name="product_id">
                        <option value="" selected>Pilih Produk untuk dipromokan</option>
                        @foreach($products as $product)
                            <option value="{{$product->id}}">{{$product->name}} | Harga Asli: <span class="harga-asli">{{$product->price}}</span></option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 col-lg-4">
                    <label for="new_price" class="form-label">Harga Promo: </label>
                    <input style="background-color: rgb(141,127,107); color: white;" type="number" class="form-control border-0" id="new_price" name="new_price">
                </div>
            </div>
            <div class="row justify-content-between col-lg-9">
                <div class="col-lg-6">
                    <label for="start" class="form-label">Tanggal dan waktu dimulai</label>
                    <input style="background-color: rgb(141,127,107); color: white;" type="datetime-local" class="form-control border-0" id="start" name="start">
                </div>
                <div class="col-lg-6">
                    <label for="end" class="form-label">Tanggal dan waktu berakhir</label>
                    <input style="background-color: rgb(141,127,107); color: white;" type="datetime-local" class="form-control border-0" id="end" name="end">
                </div>
                <div class="col-lg-12 mt-4">
                    <label for="description" class="form-label">Deskripsi Promo</label>
                    <textarea style="background-color: rgb(141,127,107); color: white;" class="form-control border-0" id="description" name="description" rows="8" cols="5"></textarea>
                </div>
            </div>
{{--            foreach error input--}}
            @error('produk_id')
            <div class="alert alert-danger col-lg-9 mt-3">
                {{$message}}
            </div>
            @enderror
            @error('new_price')
            <div class="alert alert-danger col-lg-9 mt-3">
                {{$message}}
            </div>
            @enderror
            @error('start')
            <div class="alert alert-danger col-lg-9 mt-3">
                {{$message}}
            </div>
            @enderror
            @error('end')
            <div class="alert alert-danger col-lg-9 mt-3">
                {{$message}}
            </div>
            @enderror
            @error('description')
            <div class="alert alert-danger col-lg-9 mt-3">
                {{$message}}
            </div>
            @enderror

            <div class="col-lg-9 mr-4 mt-3">
                <button type="submit" class="btn btn-primary float-right mt-3">Submit</button>
            </div>
        </div>
    </form>
@endsection
