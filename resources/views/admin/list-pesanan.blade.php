@extends("master.admin")

@section("content")
    <div class="d-flex justify-content-between align-items-center my-3">
        <h2>Pesanan aktif oleh Pengguna</h2>
    </div>

{{--    make list data with table --}}
    <div style="overflow-x: auto">
        <table class="table table-warning" style="width: calc(100vw + 500px)">
            <thead>
            <tr class="text-center">
                <th scope="col">No</th>
                <th scope="col" style="width: 200px;">Nama Pembeli</th>
                <th scope="col" style="width: 1200px;">Alamat Pembeli</th>
                <th scope="col">No. Telp</th>
                <th scope="col" style="width: 500px;">Nama Jersey</th>
                <th scope="col" style="width: 300px;">Jumlah Jersey</th>
                <th scope="col" style="width: 300px;">Total Harga</th>
{{--                <th scope="col">Bukti Pembayaran</th>--}}
                <th scope="col">Status Pembayaran</th>
                <th scope="col">Aksi</th>
            </tr>
            </thead>
            <tbody>
            @forelse($transactions as $transaction)
                <tr class="text-center">
                    <th scope="row">{{$index++}}</th>
                    <td>{{$transaction->user->name}}</td>
                    <td style="width: 1200px;">{{$transaction->user->address}} Kota: {{$transaction->user->city[1]}}, {{$transaction->user->province[1]}}</td>
                    <td>{{$transaction->user->phone_number}}</td>
                    <td>{{$transaction->product->name}}</td>
                    <td>{{$transaction->quantity}}</td>
                    <td>Rp. {{number_format($transaction->total_price, 2)}}</td>
{{--                    <td>--}}
{{--                        @if($transaction->bukti_pembayaran)--}}
{{--                            <img data-toggle="modal" data-target="#buktiPembayaran{{$transaction->id}}" class="img-thumbnail m-3" width="200px" src="{{asset("storage/bukti_pembayaran/" . $transaction->bukti_pembayaran)}}" alt="">--}}
{{--                        @else--}}
{{--                            <span class="badge badge-warning">Belum mengupload bukti pembayaran</span>--}}
{{--                        @endif--}}
{{--                    </td>--}}
                    <td>
                        @if($transaction->status == "pending")
                            <span class="badge badge-warning">Belum Dibayar</span>
                        @elseif($transaction->status == "menunggu_konfirmasi")
                            <span class="badge badge-warning">Menunggu Konfirmasi Pembayaran</span>
                            <button data-toggle="modal" data-target="#buktiPembayaran{{$transaction->id}}" class="btn btn-sm btn-primary my-2">Lihat bukti Pembayaran</button>
                        @elseif($transaction->status == "diproses")
                            <span class="badge badge-info">Diproses</span>
                        @elseif($transaction->status == "dikirim")
                            <span class="badge badge-primary">Dikirim</span>
                        @elseif($transaction->status == "selesai")
                            <span class="badge badge-success">Selesai</span>
                        @elseif($transaction->status == "batal")
                            <span class="badge badge-danger">Dibatalkan</span>
                    @endif
                    <td>
                        @if($transaction->status != "dikirim" && $transaction->status != "selesai" && $transaction->status != "batal")
                            <button data-toggle="modal" data-target="#pesananDikirim{{$transaction->id}}" class="btn btn-primary d-inline p-2">Pesanan sudah Dikirim</button>
                            <button data-toggle="modal" data-target="#batalkanPesanan{{$transaction->id}}" class="btn btn-danger d-inline p-2">Batalkan pesanan</button>
                        @else
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge badge-warning">Menunggu konfirmasi barang diterima</span>
                            </div>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    @foreach($transactions as $transaction)
        <div class="modal fade" id="buktiPembayaran{{$transaction->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Bukti Pembayaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img class="img-fluid img-shadow shadow-warning rounded" src="{{asset("storage/bukti_pembayaran/" . $transaction->bukti_pembayaran)}}" alt="">
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <form action="{{route('admin.pesanan.update-status', [$transaction->id, "diproses"])}}" method="post" class="d-inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-info">Konfirmasi pembayaran</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
{{--        modal batalkan pesanan--}}
        <div class="modal fade" id="batalkanPesanan{{$transaction->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Aksi Membatalkan Pesanan yang telah dibuat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('admin.pesanan.update-status', [$transaction->id, "batal"])}}" method="post" class="d-inline">
                        @csrf
                        @method('PUT')
                        <label class="small" for="alasan">Alasan pembatalan pesanan</label>
                        <textarea name="alasan_pembatalan" id="alasan" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-danger">Batalkan Pesanan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
{{--        modal untuk konfirmasi bahwa pesanan telah dikirim--}}
        <div class="modal fade" id="pesananDikirim{{$transaction->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi bahwa Pesanan Pengguna telah dikirim</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('admin.pesanan.update-status', [$transaction->id, "dikirim"])}}" method="post" class="d-inline p-2" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <label class="small" for="bukti-telah-kirim">Silahkan Upload bukti paket yang akan dikirim</label>
                            <input required type="file" name="bukti_telah_kirim" id="bukti-telah-kirim" class="form-control">
                            <br>
                            <label class="small" for="no_resi">No Resi Barang</label>
                            <input required type="text" name="no_resi" id="no_resi" class="form-control">
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-primary">Pesanan telah dikirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

{{--    paginate--}}
    <div class="d-flex justify-content-center">
        {{$transactions->links()}}
    </div>
@endsection
