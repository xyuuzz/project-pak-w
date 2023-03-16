@extends('master.user')

@section("content")
    <h2>Halaman Checkout</h2>

    <div class="card mt-5 shadow-warning">
        <div class="card-body">
            <div class="d-flex justify-content-between ">
                <h5 class="h5">Berikut adalah barang yang akan anda beli:</h5>
            </div>
            <hr>
            <div class="mt-3 d-flex">
                <div class="d-flex justify-content-between w-25">
                    <div class="">
                        <h6 class="h6 mb-3">Nama atau Jenis Jersey</h6>
                        <h6 class="h6 mb-3">Harga Pokok Jersey</h6>
                        <h6 class="h6 mb-3">Ukuran Jersey</h6>
                        <h6 class="h6 mb-3">Termasuk ke dalam wishlist: </h6>
{{--                        <h6 class="h6 mb-3">Membeli sebanyak: </h6>--}}
                    </div>
                    <div class="position-relative">
                        <h6 class="h6 mb-3">: {{$product->name}}</h6>
                        <h6 class="h6 mb-3">: Rp. {{number_format($product->price, 2)}}</h6>
                        <h6 class="h6 mb-3">: {{$product->size}}</h6>
                        <h6 class="h6 mb-3">: @if(auth()->user()->wishlist->contains("product_id", $product->id)) Ya @else Tidak @endif</h6>
{{--                        <h6 class="h6 mb-3">: <input style="top: 105px; left: 25px;" type="number" name="quantity" id="quantity" class="position-absolute form-control w-100" value="1"> </h6>--}}
                    </div>
                </div>
                <div class="w-25" style="margin-left: 500px;">
                    <h6 class="h6">Preview Jersey: </h6>
                    <div class="d-flex justify-content-between">
                        <img src="{{asset("storage/product_photo/$product->photo")}}" alt="Foto rekomendasi produk" class="img-fluid w-50 img-shadow">
                    </div>
                </div>
            </div>
            <hr>
            <div class="mt-5 w-50">
                <h5 class="h5 mb-3 position-relative">Total Harga Barang saat ini:
                    <span class="total-harga @if($product->discountProduct) text-secondary @else text-primary @endif" @if($product->discountProduct) style="text-decoration: line-through" @endif>
{{--                        @if($product->discountProduct)--}}
{{--                            Rp. {{number_format($product->price, 2)}}--}}
{{--                        @else--}}
{{--                            Rp. {{number_format($product->price, 2)}}--}}
{{--                        @endif--}}
                            Rp. {{number_format($product->price, 2)}}
                    </span>
                    @if($product->discountProduct)
                        <p style="font-size: 10px">Selamat, anda mendapatkan harga promo untuk jersey tersebut!</p>
                        <span style="top: -20px; left: 280px;" class="position-absolute w-100 text-danger small total-harga-diskon font-weight-bold">
                            Rp. {{number_format($product->discountProduct->new_price, 2)}}
                        </span>
                    @endif
                </h5>
                <form action="{{route("user.create-transaction", $product->id)}}" method="post">
                    @csrf
                    <label for="quantity" class="small font-weight-bold">Jumlah pesanan jersey</label>
                    <input oninput="updateTotalPrice()" class="form-control mb-3" type="number" name="quantity" id="quantity" value="1" min="1">
{{--                    <label for="promo" class="small font-weight-bold">Terapkan Kupon Barang: </label>--}}
{{--                    <input class="form-control mb-3" type="text" name="promo" id="promo" value="1">--}}
                    <div class="mb-4">
                        <div class="d-flex justify-content-between">
                            <label for="shipping-method">Pilih Ongkir</label>
                            <span class="text-warning font-weight-bold">Saat ini hanya tersedia kurir JNE</span>
                        </div>
                        <select onchange="updateTotalPrice()" required class="form-control mt-2" name="shipping_method" id="shipping-method">
                            <option value="">Pilih Ongkir</option>
                            @foreach($arr_ongkir as $item)
                                <option value="{{$item["description"]}}:{{$item["cost"][0]["value"]}}">{{$item["description"]}} ({{$item["service"]}}) -> Rp. {{number_format($item["cost"][0]["value"], 2)}} ==> Estimasi {{$item["cost"][0]["etd"]}} Hari</option>
                            @endforeach
                        </select>
                        <small>Dari Semarang, Jawa Tengah <span class="text-primary font-weight-bold">dengan tujuan Ke</span> {{auth()->user()->city[1]}}, {{auth()->user()->province[1]}}</small>
                    </div>

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mb-4">
                                <label for="total-harga-final">Total Harga</label>
                                <input type="number" class="form-control" name="total_price" id="total-harga-final" value="@if($product->discountProduct){{$product->discountProduct->new_price}}@else{{$product->price}}@endif" readonly>
                            </div>
                        </div>
                        <div class="col-lg-8">
{{--                            add payment method input--}}
                            <label for="payment-method">Pembayaran:</label>
                            <select required name="payment_method" id="payment-method" class="form-control">
                                <option selected value="bank_transfer">Bank Transfer: Transfer ke: BRI | XXX0909 => AN. Maulana</option>
                                <option value="gopay">Gopay: Transfer ke 083149372243</option>
                            </select>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-warning btn-block">Checkout</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push("javascript")
    <script>
        const updateTotalPrice = () => {
            const quantity = document.querySelector("#quantity").value;
            const totalHargaFinal = document.querySelector("#total-harga-final");
            let ongkir = document.querySelector("#shipping-method").value ;

            if(ongkir) {
                ongkir = ongkir.split(":")[1];
            } else {
                ongkir = 0;
            }

            if(quantity >= 1) {
                if(quantity > {{$product->stock}}) {
                    alert("Maaf, stok barang tidak mencukupi");
                    el.value = {{$product->stock}};
                    return;
                }

                const harga = {{$product->price}};
                const totalHarga = quantity * harga;
                const totalHargaEl = document.querySelector(".total-harga");
                totalHargaEl.innerHTML = `Rp. ${totalHarga.toLocaleString()}`;

                // if barang ada diskon, data dari database
                @if($product->discountProduct)
                    const totalHargaDiskon = quantity * {{$product->discountProduct->new_price}};
                    const totalHargaDiskonEl = document.querySelector(".total-harga-diskon");
                    totalHargaDiskonEl.innerHTML = `Rp. ${totalHargaDiskon.toLocaleString()}`;

                    totalHargaFinal.value = totalHargaDiskon + parseInt(ongkir);
                    return
                @endif

                totalHargaFinal.value = totalHarga + parseInt(ongkir);
            }
        }
    </script>
@endpush
