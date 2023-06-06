<div>

    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            Silahkan melakukan pembayaran terakhir pada, 24/12 2:00 PM. Jika anda tidak melakukan pembayaran dalam sebelum waktu tersebut, transaksi akan dibatalkan secara otomatis.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-md-8 gap-2">
                                <h5 class="roboto-title">DETAIL PEMBAYARAN</h5>
                                <hr>
                                <div class="d-flex justify-content-between px-4 mt-4">
                                    <h5 class="transaction">ID TRANSAKSI</h5>
                                    <h5 class="cloud-font">#{{ $invoice['reference'] }}</h5>
                                </div>
                                <div class="d-flex justify-content-between px-4 mt-2">
                                    <h5 class="transaction">Status</h5>
                                    <div class="border px-3 py-1" style="background-color:#FFD813; color:#505050; border-radius:15px; font-size:12px"><h5 class="cloud-font mb-0">{{ $invoice['status'] }}</h5></div>
                                </div>
                                <div class="d-flex justify-content-between px-4 mt-2">
                                    <h5 class="transaction">Metode Pembayaran</h5>
                                    <h5 class="cloud-font">{{ $invoice['payment_name'] }}</h5>
                                </div>
                                <div class="d-flex justify-content-between px-4 mt-2">
                                    <h5 class="transaction">Nomor Pembayaran</h5>
                                    <h5 class="cloud-font-bold">{{ $invoice['pay_code'] }}</h5>
                                </div>
                                <div class="d-flex justify-content-between px-4 mt-2">
                                    <h5 class="transaction">Jasa Pengiriman</h5>
                                    <h5 class="cloud-font">{{ $transaction->pengiriman->jasa_pengiriman }}</h5>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between px-4">
                                    <h5 class="transaction">Subtotal</h5>
                                    <h5 class="cloud-font-bold">{{ number_format($transaction->sub_total,0,',','.') }}</h5>
                                </div>
                                <div class="d-flex justify-content-between px-4">
                                    <h5 class="transaction">Ongkir</h5>
                                    <h5 class="cloud-font-bold">{{ number_format($transaction->pengiriman->biaya_pengiriman,0,',','.') }}</h5>
                                </div>
                                <div class="d-flex justify-content-end align-items-center px-4 py-2 col-md-6 offset-md-6 border">
                                    <h5 class="cloud-font-bold mb-0">Total : Rp. {{ number_format($transaction->grand_total,0,',','.') }}</h5>
                                </div>


                                <h5 class="mt-3 roboto-title">INFORMASI PEMBELI</h5>
                                <hr>
                                <div class="d-flex justify-content-between px-4">
                                    <h5 class="transaction">Nama</h5>
                                    <h5 class="cloud-font">{{ $transaction->user->name }}</h5>
                                </div>
                                <div class="d-flex justify-content-between px-4">
                                    <h5 class="transaction">Email</h5>
                                    <h5 class="cloud-font">{{ $transaction->user->email }}</h5>
                                </div>
                                <div class="d-flex justify-content-between px-4">
                                    <h5 class="transaction">No Handphone</h5>
                                    <h5 class="cloud-font">{{ $transaction->user->phone_number }}</h5>
                                </div>
                                <div class="d-flex justify-content-between px-4">
                                    <div class="col-md-6 px-0">
                                        <h5 class="transaction">Alamat</h5>
                                    </div>
                                    <div class="col-md-6 text-right px-0">
                                        <h5 class="cloud-font">{{ $transaction->user->alamat_lengkap }}</h5>
                                    </div>
                                </div>


                                <h5 class="mt-3 roboto-title">INFORMASI HEWAN</h5>
                                <hr>
                                <div class="d-flex justify-content-between px-4">
                                    <h5 class="transaction">Jenis</h5>
                                    <h5 class="cloud-font">{{ $transaction->animal->jenis_hewan }}</h5>
                                </div>
                                <div class="d-flex justify-content-between px-4">
                                    <h5 class="transaction">Nama</h5>
                                    <h5 class="cloud-font">{{ $transaction->animal->judul_post }}</h5>
                                </div>
                                <div class="d-flex justify-content-between px-4">
                                    <h5 class="transaction">Warna</h5>
                                    <h5 class="cloud-font">-</h5>
                                </div>
                                <div class="d-flex justify-content-between px-4">
                                    <h5 class="transaction">Umur</h5>
                                    <h5 class="cloud-font">-</h5>
                                </div>
                                <div class="d-flex justify-content-between px-4">
                                    <h5 class="transaction">Memiliki surat kesehatan (?)</h5>
                                    <h5 class="cloud-font">-</h5>
                                </div>
                                <div class="d-flex justify-content-between px-4">
                                    <h5 class="transaction">Bersertifikat (?)</h5>
                                    <h5 class="cloud-font">-</h5>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-title text-center" style="font-size:18px">INSTRUKSI PEMBAYARAN</h5>
                                        @foreach($invoice['instructions'] as $instruction)
                                        <hr>
                                        <div class="d-flex justify-content-between align-items-center" data-toggle="collapse" href="#collapse-{{$loop->iteration}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            <h5 class="cloud-font-bold mb-0" style="font-weight:lighter">{{ $instruction->title }}</h5>
                                            <i class="fa fa-minus text-secondary" aria-hidden="true"></i>
                                        </div>
                                        <div class="collapse" id="collapse-{{$loop->iteration}}">
                                            @foreach($instruction->steps as $steps)
                                            <p class="mt-3 mb-0">{{ $loop->iteration }}. {!! $steps !!}</p>
                                            @endforeach
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



</div>