<div class="row mb-3">
    <img src="{{asset("storage/product_photo/" . $product->photo)}}" alt="jersey" class="img-fluid col-lg-5 img-shadow">
    <div class="col-lg-7">
        <p>Nama Produk: {{$product->name}}</p>
        <p>Harga: Rp. {{number_format($product->price, 2)}}</p>
        <p>Ukuran: {{$product->size}}</p>
        <p>Stok: {{$product->stock}}</p>
    </div>
</div>
<p>Deskripsi lengkap: {{$product->description}}</p>
