@extends('master.admin')

@section("content")
    <div class="d-flex justify-content-between align-items-center my-3">
        <h2>Kelola Produk Jersey</h2>
        <a href="{{route('product.index')}}" class="btn btn-primary">Kembali ke halaman utama</a>
    </div>
{{--    make form products--}}
    <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data" class="">
        @csrf
        <div class="row justify-content-center w-100 mb-3">
            <div class="row justify-content-between col-lg-9">
                <div class="mb-3 col-lg-9">
                    <label for="name" class="form-label">Nama Produk</label>
                    <input style="background-color: rgb(141,127,107); color: white;" type="text" class="form-control border-0" id="name" name="name">
                </div>
                <div class="mb-3 col-lg-2">
                    <label for="weight" class="form-label">Berat Produk</label>
                    <input style="background-color: rgb(141,127,107); color: white;" type="text" class="form-control border-0" id="weight" name="weight">
                </div>
                <div class="mb-3 col-lg-1">
                    <label for="size" class="form-label">Ukuran Produk</label>
                    <select style="background-color: rgb(141,127,107); color: white;" class="form-control border-0" id="size" name="size">
                        <option selected>Pilih Ukuran</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>
                </div>
            </div>
            <div class="row justify-content-between col-lg-9">
                <div class="col-lg-5">
                    <label for="price" class="form-label">Harga Produk</label>
                    <input style="background-color: rgb(141,127,107); color: white;" type="number" class="form-control border-0" id="price" name="price">
                </div>
                <div class="col-lg-4">
                    <label for="stock" class="form-label">Stok Produk</label>
                    <input style="background-color: rgb(141,127,107); color: white;" type="number" class="form-control border-0" id="stock" name="stock">
                </div>
                <div class="col-lg-3">
                    <label for="photo" class="form-label">Foto Produk</label>
                    <input style="background-color: rgb(141,127,107); color: white;" class="form-control border-0" type="file" id="photo" name="photo">
                </div>
            </div>
            <div class="col-lg-9">
                <label for="description" class="form-label">Deskripsi Produk</label>
                <textarea style="background-color: rgb(141,127,107); color: white;" class="form-control border-0" id="description" name="description" rows="8"></textarea>
            </div>
            <div class="col-lg-9 mr-4 mt-3">
                <button type="submit" class="btn btn-primary float-right mt-3">Submit</button>

            </div>
        </div>

    </form>
@endsection
