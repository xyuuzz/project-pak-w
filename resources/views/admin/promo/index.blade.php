@extends('master.admin')

@section("content")
    <div class="d-flex justify-content-between align-items-center my-3">
        <h2>Kelola Promo</h2>
        <a href="{{route('promo.create')}}" class="btn btn-primary">Tambah Promo</a>
    </div>
{{--    make table promo--}}
    <table class="table table-striped">
        <thead>
        <tr class="text-center">
            <th scope="col">No</th>
            <th scope="col">Produk</th>
            <th scope="col">Harga Diskon</th>
            <th scope="col">Mulai</th>
            <th scope="col">Berakhir</th>
            <th scope="col">Status Promo</th>
            <th scope="col">Aksi</th>
        </tr>
        </thead>
        <tbody>
        @forelse($promos as $promo)
            <tr class="text-center">
                <th scope="row">{{$index++}}</th>
                <td>{{$promo->product->name}}</td>
                <td>{{$promo->new_price}}</td>
                <td>{{$promo->start}}</td>
                <td>{{$promo->end}}</td>
{{--                status promo: berjalan, sudah berakhir, belum dimulai,, sesuai tanggal, jam dan menit, bukan tanggal saja--}}
                <td>
                    @if(now()->diffInMinutes(\Carbon\Carbon::parse($promo->start)) < 420 && now()->diffInMinutes(\Carbon\Carbon::parse($promo->end)) > 420)
                        <span class="badge badge-success">Berjalan</span>
                    @elseif(now()->diffInMinutes(\Carbon\Carbon::parse($promo->start)) > 420)
                        <span class="badge badge-warning">Belum dimulai</span>
                    @else
                        <span class="badge badge-danger">Sudah berakhir</span>
                    @endif
                <td>
                    <a href="{{route('promo.edit', $promo->id)}}" class="btn btn-primary">Edit</a>
                    <form action="{{route('promo.destroy', $promo->id)}}" method="post" class="d-inline">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">Tidak ada Promo</td>
            </tr>
        @endforelse
        </tbody>
    </table>

{{--    paginate--}}
    <div class="d-flex justify-content-center">
        {{$promos->links()}}
    </div>
@endsection
