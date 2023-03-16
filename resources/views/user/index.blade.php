@extends('master.user')

@section('content')
    <section class="header">
        <h2>Rekomendasi</h2>
        <div id="carouselExampleCaptions" class="carousel slide my-3" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                @foreach($products as $product)
                    <div class="carousel-item {{$loop->iteration == 1 ? "active" : ""}}">
                        <img style="cursor: pointer; width:90%; height: 400px;" src="{{asset("storage/product_photo/$product->photo")}}" class="d-block w-100" data-toggle="modal" data-target="#exampleModal" onclick="setDataModal({{$product->id}})">
                        <div class="carousel-caption d-none d-md-block font-weight-bold">
                            <h5>{{$product->name}}</h5>
                            <p>
                                {{Str::limit($product->description, 50)}}
                            </p>
                        </div>
                    </div>
                @endforeach

            </div>
            <button class="carousel-control-prev" type="button" data-target="#carouselExampleCaptions" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-target="#carouselExampleCaptions" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </button>
        </div>
    </section>
    <div class="untuk-anda">
        <h4>Untuk Anda</h4>
        <div class="produk-anda">
            @foreach($products as $product)
                <div class="produk">
                    <div class="image-wrapper">
                        <img class="recomendation-product-photo" src="{{asset("storage/product_photo/$product->photo")}}" alt="Foto rekomendasi produk" data-toggle="modal" data-target="#exampleModal" onclick="setDataModal({{$product->id}})">
                        <div class="icon" style="z-index: 100">
                            <form action="{{route("wishlist.store")}}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <button style="cursor: pointer;" class="border-0 bg-transparent" type="submit"><i class="fa-solid fa-star @if(auth()->user()->wishlist->contains('product_id', $product->id)) text-warning @else text-secondary @endif"></i></button>
                            </form>
                            {{--                                            <i class="fa-solid fa-ellipsis-vertical"></i>--}}
                        </div>
                    </div>
                    <div class="desc">
                        <span class="d-block mt-2">{{$product->name}}</span>
                        <span class="d-block mt-2">Rp. {{number_format($product->price)}}</span>
                        <span class="d-block mt-1">Ukuran Jersey: {{$product->size}}</span>
                    </div>
                </div>
            @endforeach
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
                    <div class="d-flex">
                        <form action="{{route("wishlist.store")}}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" id="product_id_modal" value="">
                            <button style="cursor: pointer;" class="btn btn-info" type="submit">Tambahkan ke Wishlist</button>
                        </form>
                    </div>
                    <div class="">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a href="#" class="btn btn-danger checkout-btn">Pesan Sekarang</a>
                    </div>
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

                    const urlCheckout = "{{route("user.checkout", ":id")}}".replace(":id", idProduct)
                    $(".checkout-btn").attr("href", urlCheckout)
                }
            })
        }
    </script>
@endpush
