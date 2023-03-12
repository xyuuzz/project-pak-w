@extends("master.user")

@section("content")
    <section class="header">
        <h2>Wishlist Anda</h2>
    </section>

    <div class="untuk-anda mt-5">
        <div class="produk-anda">
            @forelse($wishlists as $product)
                <div class="produk">
                    <div class="image-wrapper">
                        <img onclick="setDataModal({{$product->id}})" class="recomendation-product-photo" src="{{asset("storage/product_photo/$product->photo")}}" alt="" data-toggle="modal" data-target="#exampleModal">
                        <div class="icon" style="z-index: 100">
                            <form action="{{route("wishlist.destroy", $product->id)}}" method="post">
                                @csrf
                                @method("DELETE")
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <button style="cursor: pointer;" class="border-0 bg-transparent" type="submit"><i class="fa-solid fa-star text-warning"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="desc">
                        <span class="d-block mt-2">{{$product->name}}</span>
                        <span class="d-block mt-2">Rp. {{number_format($product->price)}}</span>
                        <span class="d-block mt-1">Ukuran Jersey: {{$product->size}}</span>
                    </div>
                </div>
            @empty
                <div class="card ml-5 mt-4">
                    <div class="card-header">
                        <h3>Wishlist anda kosong!</h3>
                    </div>
                    <div class="card-body">
                        <p>Anda belum menambahkan produk ke wishlist anda.</p>
                        <a href="{{route("user.index")}}" class="btn btn-primary">Kembali ke Beranda</a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="/asdkasl" class="btn btn-danger">Pesan Sekarang</a>
                </div>
            </div>
        </div>
    </div>

@endsection

@push("javascript")
    <script>
        const setDataModal = idProduct => {
            const url = "{{route("user.detail-product", ":id")}}".replace(":id", idProduct)

            $.ajax({
                url: url,
                type: "GET",
                data: {
                    id: idProduct
                },
                success: response => {
                    $(".modal-body").html(response)
                    $("#product_id_modal").val(idProduct)
                }
            })
        }
    </script>
@endpush
