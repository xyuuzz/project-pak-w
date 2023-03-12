@extends('master.admin')

@section("content")
    <div class="d-flex justify-content-between align-items-center my-3">
        <h2>Kelola Produk Jersey</h2>
        <a href="{{route('product.create')}}" class="btn btn-primary">Tambah Produk</a>
    </div>
{{--    make table product--}}
    <table class="table table-striped">
        <thead>
        <tr class="text-center">
            <th scope="col">No</th>
            <th scope="col">Foto Produk</th>
            <th scope="col">Nama</th>
            <th scope="col">Harga</th>
            <th scope="col">Stok</th>
            <th scope="col">Aksi</th>
        </tr>
        </thead>
        <tbody>
        @forelse($products as $product)
            <tr class="text-center">
                <th scope="row">{{$index++}}</th>
                <td>
                    <img class="img-thumbnail m-3" width="200px" src="{{asset("storage/product_photo/" . $product->photo)}}" alt="">
                </td>
                <td>{{$product->name}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->stock}}</td>
                <td>
                    <a href="{{route('product.edit', $product->id)}}" class="btn btn-primary">Edit</a>
                    <form action="{{route('product.destroy', $product->id)}}" method="post" class="d-inline">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada data</td>
            </tr>
        @endforelse
        </tbody>
    </table>

{{--    paginate--}}
    <div class="d-flex justify-content-center">
        {{$products->links()}}
    </div>
@endsection
