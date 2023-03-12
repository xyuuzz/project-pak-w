@extends('master.admin')

@section("content")
    <h2>Dashboard</h2>
    <br>
    <div class="d-lg-flex justify-content-between">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Penjualan | Bulan ini</h5>
                <div class="d-lg-flex justify-content-start">
                    <i class="fas fa-solid fa-shirt" style="font-size: 70px;color: #552201;"></i>
                    <div class="d-flex flex-column bd-highlight ms-2">
                        <div class="p-1 bd-highlight">XX</div>
                        <div class="p-1 bd-highlight" style="color: #b4feb5;">xxx%</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Penjualan | Bulan ini</h5>
                <div class="d-lg-flex justify-content-start">
                    <i class="fas fa-duotone fa-dollar-sign" style="font-size: 70px;color: #552201;"></i>
                    <div class="d-flex flex-column bd-highlight ms-2">
                        <div class="p-1 bd-highlight">Rp.XXX.XXX.XXX</div>
                        <div class="p-1 bd-highlight" style="color: #b4feb5;">xxx%</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Pendapatan | Bulan ini</h5>
                <div class="d-lg-flex justify-content-start">
                    <i class="fas fa-duotone fa-dollar-sign" style="font-size: 70px;color: #552201;"></i>
                    <div class="d-flex flex-column bd-highlight ms-2">
                        <div class="p-1 bd-highlight">Rp.XXX.XXX.XXX</div>
                        <div class="p-1 bd-highlight" style="color: #b4feb5;">xxx%</div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
@endsection
