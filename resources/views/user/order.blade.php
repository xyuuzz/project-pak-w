@extends("master.user")

@section("content")
    <h2>Halaman Transaksi yang telah dilakukan</h2>

    <div class="row">
        <div class="col-lg-9">
            @forelse($transactions as $transaction)
                <div class="card">
                    <div class="card-header">
                        <h4 class="h4">
                            Total Transaksi: Rp. {{number_format($transaction->total_price, 2)}} <br>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="d-flex justify-content-between">
                                    <div class="">
                                        <h6 class="h6 mb-3">Nama atau Jenis Jersey</h6>
                                        <h6 class="h6 mb-3">Jumlah</h6>
                                        <h6 class="h6 mb-3">Ukuran Jersey</h6>
                                        <hr>
                                        <h6 class="h6 mb-3">Tanggal dilakukannya transaksi</h6>
                                        <h6 class="h6 mb-3">Metode pembayaran</h6>
                                        <h6 class="h6 mb-3">Dikirim menggunakan</h6>
                                    </div>
                                    <div class="position-relative">
                                        <h6 class="h6 mb-3">: {{$transaction->product->name}}</h6>
                                        <h6 class="h6 mb-3">: {{$transaction->quantity}}</h6>
                                        <h6 class="h6 mb-3">: {{$transaction->product->size}}</h6>
                                        <hr>
                                        <h6 class="h6 mb-3">: {{\Carbon\Carbon::parse($transaction->created_at)->format("d F Y H:i")}}</h6>
                                        <h6 class="h6 mb-3">: {{$transaction->payment_method}}</h6>
                                        <h6 class="h6 mb-3">: JNE | {{$transaction->shipping_method}}</h6>
                                    </div>
                                </div>
                                <small class="text-primary">Alamat Tujuan: <span class="pl-3 pt-5" style="font-size: 16px">{{auth()->user()->address}}, {{auth()->user()->city[1]}}, {{auth()->user()->province[1]}}</span></small>
                            </div>
                            <div class="col-lg-6 border-left border-warning">
                                @if($transaction->status == "pending" && $transaction->bukti_pembayaran == null)
                                {{--                                pembayaran menggunakan upload file --}}
                                <h4 class="h4 text-warning">Menunggu Pembayaran</h4>
                                <p>Anda saat ini belum melakukan pembayaran terhadap pesanan ini</p>
                                <p>Silahkan lakukan pembayaran secepatnya dan upload bukti pembayaran dibawah!</p>
                                <form class="card card-body shadow-warning w-50" action="{{route("user.transaction.upload-bukti-pembayaran")}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <label for="bukti_pembayaran">Upload Bukti pembayaran</label>
                                    <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="form-control">
                                    <input type="hidden" name="transaction_id" value="{{$transaction->id}}">
                                    <button type="submit" class="btn btn-primary mt-3">Upload</button>
                                </form>
                                @elseif($transaction->status == "menunggu_konfirmasi")
                                    <div class="text-dark" style="font-size: 16px">Bukti pembayaran berhasil diupload!</div>
                                    <hr>
                                    <div class="text-dark" style="font-size: 16px">Tunggu admin untuk mengkonfirmasi pembayaranmu!</div>
                                    <div class="text-dark" style="font-size: 16px">Berikut adalah bukti pembayaran yang telah anda upload: </div>
                                    <img src="{{asset("storage/bukti_pembayaran/$transaction->bukti_pembayaran")}}" alt="bukti pembayaran" class="img-fluid mt-3 img-shadow shadow-primary rounded">
                                @elseif($transaction->status == "diproses")
                                    <h4 class="h4 text-success">Pembayaran terkonfirmasi!</h4>
                                    <p>Terima kasih telah melakukan pembayaran, pesanan anda akan segera diproses oleh admin</p>
                                    <p>Berikut adalah bukti pembayaran yang telah anda upload: </p>
                                    <img src="{{asset("storage/bukti_pembayaran/$transaction->bukti_pembayaran")}}" alt="bukti pembayaran" class="img-fluid">
                                @elseif($transaction->status == "dikirim")
                                    <div class="d-lg-flex justify-content-between">
                                        <div class="">
                                            <h4 class="h4 text-success">Pesanan telah dikirim!</h4>
                                            <p>Pesanan anda dalam perjalanan</p>
                                            <p>No Resi: {{$transaction->no_resi}}</p>
                                            <hr>
                                            <p>Bukti Pengiriman: </p>
                                        </div>
                                        <div class="">
                                            <form action="{{route("user.transaction.pesanan-telah-diterima", $transaction->id)}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-primary">Pesanan telah diterima</button>
                                            </form>
                                        </div>
                                    </div>
                                    <img src="{{asset("storage/bukti_pengiriman_jersey/" . $transaction->bukti_telah_dikirim)}}" alt="bukti pengiriman" class="img-fluid">
                                @elseif($transaction->status == "batal")
                                    <h4 class="h4 text-danger">Pesanan dibatalkan!</h4>
                                    <p>Pesanan anda telah dibatalkan oleh admin</p>
                                    <p>Alasan pembatalan: {{$transaction->alasan_pembatalan}}</p>
                                    <hr>
                                    <p>Silahkan bisa chat admin untuk melakukan proses pengembalian dana</p>
                                @elseif($transaction->status == "selesai")
                                    <h4 class="h4 text-success">Pesanan telah selesai!</h4>
                                    <hr>
                                    <p>No Resi Barang: <span class="text-secondary">{{$transaction->no_resi}}</span></p>
                                    <p>Tanggal Menerima Barang: <span class="text-warning">{{\Carbon\Carbon::parse($transaction->updated_at)->format("d-m-Y H:i")}}</span></p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="card">
                    <div class="card-header">
                        Belum melakukan transaksi apapun
                    </div>
                </div>
            @endforelse
        </div>
    </div>

@endsection
