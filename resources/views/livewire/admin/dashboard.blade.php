<div>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-1" style="border-left : 4px solid #4E73DF">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-uppercase mb-1 gotham" style="font-size:14px; color:#4E73DF">
                                <p class="m-0">Transaksi Berhasil</p>
                                <p class="m-0">(Bulan Ini)</p>
                            </div>
                            <div class="font-weight-bold gotham mt-2" style="color:#5A5C69">{{ $transaction_completed }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x" style="color:#dddfeb;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-1" style="border-left: 4px solid #1CC88A">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-uppercase mb-1 gotham" style="font-size:14px; color:#1CC88A">
                                <p class="m-0">Nilai Transaksi</p>
                                <p class="m-0">(Bulan Ini)</p>
                            </div>
                            <div class="font-weight-bold gotham mt-2" style="color:#5A5C69">Rp. {{ number_format($transaction_value,0,',','.') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x" style="color:#dddfeb;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-1" style="border-left : 4px solid #36B9CC">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-uppercase mb-1 gotham" style="font-size:14px; color :#36B9CC">
                                <p class="m-0">Pendapatan</p>
                                <p class="m-0">(Bulan Ini)</p>
                            </div>
                            <div class="font-weight-bold gotham mt-2" style="color:#5A5C69">$40,000</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x" style="color:#dddfeb;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-1" style="border-left: 4px solid #F6C23E">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-uppercase mb-1 gotham" style="font-size:14px; color:#F6C23E">
                                <p class="m-0">Pengguna Baru</p>
                                <p class="m-0">(Bulan Ini)</p>
                            </div>
                            <div class="font-weight-bold gotham mt-2" style="color:#5A5C69">{{ $new_users }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x" style="color:#dddfeb;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>