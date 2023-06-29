<div>

    <div class="container">
        <div class="main-body">
            <div class="row gutters-sm">
                <div class="col-md-3">
                    <div class="card">
                        <ul class="list-group list-group-flush">

                            <a href="/user/profile">
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                    <h6 class="mb-0">Profil Saya</h5>
                                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                                </li>
                            </a>

                            <a href="/user/transaction">
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap active">
                                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                    <h6 class="mb-0">Daftar Transaksi</h5>
                                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                                </li>
                            </a>

                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <i class="fa fa-comments" aria-hidden="true"></i>
                                <h6 class="mb-0">Chat</h6>
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </li>

                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <h6 class="mb-0">Review</h6>
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-md-9 pb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-start align-items-start">
                                <button class="btn btn-transaction @if($type == 'ongoing') active @endif" wire:click="updateType('ongoing')">Ongoing</button>
                                <button class="btn btn-transaction ml-2 @if($type == 'completed') active @endif" wire:click="updateType('completed')">Completed</button>
                            </div>
                            @if($type == 'ongoing')

                            <div class="collapse-wrapper py-3">
                                <div class="collapse-menu py-3 pr-2 border-bottom">
                                    <div class="d-flex align-items-center justify-content-between" data-toggle="collapse" href="#collapse1" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <h5 class="transaction mb-0">PENGAJUAN HARGA ONGKIR ({{ $pengajuan_ongkir->count() }})</h5>
                                        <i class="fa fa-arrow-circle-right arrow-icon" aria-hidden="true"></i>
                                    </div>
                                    <div class="collapse pengajuan_ongkir" id="collapse1">
                                        @foreach($pengajuan_ongkir as $data)
                                        <div class="d-flex justify-content-between align-items-center mt-2 p-2" data-toggle="collapse" href="#collapse-ongkir-{{$loop->iteration}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            <div class="transaction-item px-2">
                                                <h5 class="transaction mb-0"><i class="fa-solid fa-paw text-secondary"></i> {{ $data->animal->judul_post }}</h5>
                                            </div>
                                            <i class="fa fa-minus align-items-end" aria-hidden="true"></i>

                                        </div>
                                        <div class="collapse" id="collapse-ongkir-{{$loop->iteration}}">
                                            <div class="container border p-2">
                                                <div class="alert alert-primary">Silahkan menunggu toko menambahkan informasi pengiriman, jika toko tidak mem-proses dalam 24 jam maka transaksi akan dibatalkan</div>

                                                <div class="row">
                                                    <div class="col-md-4 border-right">
                                                        <h5 class="cloud-font" style="font-size:larger">Informasi Hewan</h5>
                                                        <div class="d-flex align-items-start mt-3">
                                                            <div class="img-wrapper">
                                                                <img src="{{ asset('/animal_photos/'.$data->animal->thumbnail) }}" alt="" width="120">
                                                            </div>
                                                            <div class="product-wrapper ml-2">
                                                                <h5 class="transaction mb-0" style="font-size:smaller"> {{ $data->animal->judul_post }}</h5>
                                                                <p style="font-size: small;">{{ $data->qty }} x Rp. {{ number_format($data->animal->harga,0,',','.') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 border-right">
                                                        <h5 class="cloud-font" style="font-size:larger">Informasi Penjual <button class="btn btn-outline-success btn-sm"><i class="fa fa-comments" aria-hidden="true"></i> Tanya</button></h5>
                                                        <h5 class="transaction mt-3" style="font-size:smaller"><i class="fa fa-user"></i> {{ $data->store->nama_toko }}</h5>
                                                        <h5 class="transaction" style="font-size:smaller"><i class="fa-solid fa-phone"></i> {{ $data->store->no_hp }}</h5>
                                                        <h5 class="transaction mb-0" style="font-size:smaller; text-align:justify; text-justify: inter-word;"><i class="fa fa-address-book"></i> {{ $data->store->alamat_lengkap }}</h5>
                                                        <small>{{ $data->store->alamat }}</small>

                                                    </div>
                                                    <div class="col-md-4">
                                                        <h5 class="cloud-font" style="font-size:larger">Informasi Pengiriman</h5>

                                                    </div>
                                                </div>
                                                <div class="rounded bg-light py-2 px-4">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h6 class="mb-0">Subtotal</h6>
                                                        <h6 class="mb-0">Rp. {{ number_format($data->sub_total,0,',','.') }}</h6>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="collapse-menu py-3 pr-2 border-bottom">
                                    <div class="d-flex align-items-center justify-content-between" data-toggle="collapse" href="#collapse2" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <h5 class="transaction mb-0">MENUNGGU PEMBAYARAN ({{ $menunggu_pembayaran->count() }})</h5>
                                        <i class="fa fa-arrow-circle-right arrow-icon" aria-hidden="true"></i>
                                    </div>
                                    <div class="collapse pengajuan_ongkir" id="collapse2">
                                        @foreach($menunggu_pembayaran as $data)
                                        <div class="d-flex justify-content-between align-items-center mt-2 p-2" data-toggle="collapse" href="#collapse-pembayaran-{{$loop->iteration}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            <div class="transaction-item px-2">
                                                <h5 class="transaction mb-0"><i class="fa-solid fa-paw text-secondary"></i> {{ $data->animal->judul_post }}</h5>
                                            </div>
                                            <i class="fa fa-minus align-items-end" aria-hidden="true"></i>

                                        </div>
                                        <div class="collapse" id="collapse-pembayaran-{{$loop->iteration}}">
                                            <div class="container border p-2">
                                                <div class="alert alert-warning">Silahkan melakukan pembayaran dalam waktu 24 jam, jika tidak memproses maka transaksi akan dibatalkan. Waktu tenggat : </div>

                                                <div class="row">
                                                    <div class="col-md-4 border-right">
                                                        <h5 class="cloud-font" style="font-size:larger">Informasi Hewan</h5>
                                                        <div class="d-flex align-items-start mt-3">
                                                            <div class="img-wrapper">
                                                                <img src="{{ asset('/animal_photos/'.$data->animal->thumbnail) }}" alt="" width="120">
                                                            </div>
                                                            <div class="product-wrapper ml-2">
                                                                <h5 class="transaction mb-0" style="font-size:smaller"> {{ $data->animal->judul_post }}</h5>
                                                                <p style="font-size: small;">{{ $data->qty }} x Rp. {{ number_format($data->animal->harga,0,',','.') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 border-right">
                                                        <h5 class="cloud-font" style="font-size:larger">Informasi Penjual <button class="btn btn-outline-success btn-sm"><i class="fa fa-comments" aria-hidden="true"></i> Tanya</button></h5>
                                                        <h5 class="transaction mt-3" style="font-size:smaller"><i class="fa fa-user"></i> {{ $data->store->nama_toko }}</h5>
                                                        <h5 class="transaction" style="font-size:smaller"><i class="fa-solid fa-phone"></i> {{ $data->store->no_hp }}</h5>
                                                        <h5 class="transaction mb-0" style="font-size:smaller; text-align:justify; text-justify: inter-word;"><i class="fa fa-address-book"></i> {{ $data->store->alamat_lengkap }}</h5>
                                                        <small>{{ $data->store->alamat }}</small>

                                                    </div>
                                                    <div class="col-md-4">
                                                        <h5 class="cloud-font" style="font-size:larger">Informasi Pengiriman</h5>
                                                        <h5 class="transaction mt-3" style="font-size:smaller"><i class="fa-solid fa-truck"></i> {{ $data->pengiriman->jasa_pengiriman }}</h5>
                                                        <h5 class="transaction" style="font-size:smaller"><i class="fa-solid fa-money-check-dollar"></i> Rp. {{ number_format($data->pengiriman->biaya_pengiriman,0,',','.') }}</h5>
                                                    </div>
                                                </div>
                                                <div class="rounded bg-light py-2 px-4">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h6 class="mb-0">Subtotal</h6>
                                                        <h6 class="mb-0">Rp. {{ number_format($data->sub_total,0,',','.') }}</h6>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                                        <h6 class="mb-0">Biaya pengiriman</h6>
                                                        <h6 class="mb-0">Rp. {{ number_format($data->pengiriman->biaya_pengiriman,0,',','.') }}</h6>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center mt-2 border-top py-2">
                                                        <h6 class="mb-0">Harga Total</h6>
                                                        <h6 class="mb-0">Rp. {{ number_format($data->grand_total,0,',','.') }}</h6>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    @if($data->payment_reference == NULL)
                                                    <button class="btn btn-primary btn-sm mt-2" wire:click.prevent="openPembayaranModal('{{ $data->id_transaction }}')" data-toggle="modal" data-target="#pembayaranModal"> Bayar sekarang</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="collapse-menu py-3 pr-2 border-bottom">
                                    <div class="d-flex align-items-center justify-content-between" data-toggle="collapse" href="#collapse3" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <h5 class="transaction mb-0">SEDANG DIPROSES ({{ $sedang_diproses->count() }})</h5>
                                        <i class="fa fa-arrow-circle-right arrow-icon" aria-hidden="true"></i>
                                    </div>
                                    <div class="collapse pengajuan_ongkir" id="collapse3">
                                        @foreach($sedang_diproses as $data)
                                        <div class="d-flex justify-content-between align-items-center mt-2 p-2" data-toggle="collapse" href="#collapse-diproses-{{$loop->iteration}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            <div class="transaction-item px-2">
                                                <h5 class="transaction mb-0"><i class="fa-solid fa-paw text-secondary"></i> {{ $data->animal->judul_post }}</h5>
                                            </div>
                                            <i class="fa fa-minus align-items-end" aria-hidden="true"></i>

                                        </div>
                                        <div class="collapse" id="collapse-diproses-{{$loop->iteration}}">
                                            <div class="container border p-2">
                                                <div class="alert alert-warning">Silahkan melakukan pembayaran dalam waktu 24 jam, jika tidak memproses maka transaksi akan dibatalkan. Waktu tenggat : </div>

                                                <div class="row">
                                                    <div class="col-md-4 border-right">
                                                        <h5 class="cloud-font" style="font-size:larger">Informasi Hewan</h5>
                                                        <div class="d-flex align-items-start mt-3">
                                                            <div class="img-wrapper">
                                                                <img src="{{ asset('/animal_photos/'.$data->animal->thumbnail) }}" alt="" width="120">
                                                            </div>
                                                            <div class="product-wrapper ml-2">
                                                                <h5 class="transaction mb-0" style="font-size:smaller"> {{ $data->animal->judul_post }}</h5>
                                                                <p style="font-size: small;">{{ $data->qty }} x Rp. {{ number_format($data->animal->harga,0,',','.') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 border-right">
                                                        <h5 class="cloud-font" style="font-size:larger">Informasi Penjual <button class="btn btn-outline-success btn-sm"><i class="fa fa-comments" aria-hidden="true"></i> Tanya</button></h5>
                                                        <h5 class="transaction mt-3" style="font-size:smaller"><i class="fa fa-user"></i> {{ $data->store->nama_toko }}</h5>
                                                        <h5 class="transaction" style="font-size:smaller"><i class="fa-solid fa-phone"></i> {{ $data->store->no_hp }}</h5>
                                                        <h5 class="transaction mb-0" style="font-size:smaller; text-align:justify; text-justify: inter-word;"><i class="fa fa-address-book"></i> {{ $data->store->alamat_lengkap }}</h5>
                                                        <small>{{ $data->store->alamat }}</small>

                                                    </div>
                                                    <div class="col-md-4">
                                                        <h5 class="cloud-font" style="font-size:larger">Informasi Pengiriman</h5>
                                                        <h5 class="transaction mt-3" style="font-size:smaller"><i class="fa-solid fa-truck"></i> {{ $data->pengiriman->jasa_pengiriman }}</h5>
                                                        <h5 class="transaction" style="font-size:smaller"><i class="fa-solid fa-money-check-dollar"></i> Rp. {{ number_format($data->pengiriman->biaya_pengiriman,0,',','.') }}</h5>
                                                    </div>
                                                </div>
                                                <div class="rounded bg-light py-2 px-4">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h6 class="mb-0">Subtotal</h6>
                                                        <h6 class="mb-0">Rp. {{ number_format($data->sub_total,0,',','.') }}</h6>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                                        <h6 class="mb-0">Biaya pengiriman</h6>
                                                        <h6 class="mb-0">Rp. {{ number_format($data->pengiriman->biaya_pengiriman,0,',','.') }}</h6>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center mt-2 border-top py-2">
                                                        <h6 class="mb-0">Harga Total</h6>
                                                        <h6 class="mb-0">Rp. {{ number_format($data->grand_total,0,',','.') }}</h6>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-end">

                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="collapse-menu py-3 pr-2 border-bottom">
                                    <div class="d-flex align-items-center justify-content-between" data-toggle="collapse" href="#collapse4" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <h5 class="transaction mb-0">SEDANG DIKIRIM ({{ $sedang_dikirim->count() }})</h5>
                                        <i class="fa fa-arrow-circle-right arrow-icon" aria-hidden="true"></i>
                                    </div>
                                    <div class="collapse pengajuan_ongkir" id="collapse4">
                                        @foreach($sedang_dikirim as $data)
                                        <div class="d-flex justify-content-between align-items-center mt-2 p-2" data-toggle="collapse" href="#collapse-dikirim-{{$loop->iteration}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            <div class="transaction-item px-2">
                                                <h5 class="transaction mb-0"><i class="fa-solid fa-paw text-secondary"></i> {{ $data->animal->judul_post }}</h5>
                                            </div>
                                            <i class="fa fa-minus align-items-end" aria-hidden="true"></i>

                                        </div>
                                        <div class="collapse" id="collapse-dikirim-{{$loop->iteration}}">
                                            <div class="container border p-2">
                                                <div class="alert alert-warning">Silahkan menunggu hingga hewan datang. Jika hewan sudah datang, bisa melakukan aksi update</div>

                                                <div class="row">
                                                    <div class="col-md-4 border-right">
                                                        <h5 class="cloud-font" style="font-size:larger">Informasi Hewan</h5>
                                                        <div class="d-flex align-items-start mt-3">
                                                            <div class="img-wrapper">
                                                                <img src="{{ asset('/animal_photos/'.$data->animal->thumbnail) }}" alt="" width="120">
                                                            </div>
                                                            <div class="product-wrapper ml-2">
                                                                <h5 class="transaction mb-0" style="font-size:smaller"> {{ $data->animal->judul_post }}</h5>
                                                                <p style="font-size: small;">{{ $data->qty }} x Rp. {{ number_format($data->animal->harga,0,',','.') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 border-right">
                                                        <h5 class="cloud-font" style="font-size:larger">Informasi Penjual <button class="btn btn-outline-success btn-sm"><i class="fa fa-comments" aria-hidden="true"></i> Tanya</button></h5>
                                                        <h5 class="transaction mt-3" style="font-size:smaller"><i class="fa fa-user"></i> {{ $data->store->nama_toko }}</h5>
                                                        <h5 class="transaction" style="font-size:smaller"><i class="fa-solid fa-phone"></i> {{ $data->store->no_hp }}</h5>
                                                        <h5 class="transaction mb-0" style="font-size:smaller; text-align:justify; text-justify: inter-word;"><i class="fa fa-address-book"></i> {{ $data->store->alamat_lengkap }}</h5>
                                                        <small>{{ $data->store->alamat }}</small>

                                                    </div>
                                                    <div class="col-md-4">
                                                        <h5 class="cloud-font" style="font-size:larger">Informasi Pengiriman</h5>
                                                        <h5 class="transaction mt-3" style="font-size:smaller"><i class="fa-solid fa-truck"></i> {{ $data->pengiriman->jasa_pengiriman }}</h5>
                                                        <h5 class="transaction" style="font-size:smaller"><i class="fa-solid fa-money-check-dollar"></i> Rp. {{ number_format($data->pengiriman->biaya_pengiriman,0,',','.') }}</h5>
                                                    </div>
                                                </div>
                                                <div class="rounded bg-light py-2 px-4 mt-2">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h6 class="mb-0">Subtotal</h6>
                                                        <h6 class="mb-0">Rp. {{ number_format($data->sub_total,0,',','.') }}</h6>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                                        <h6 class="mb-0">Biaya pengiriman</h6>
                                                        <h6 class="mb-0">Rp. {{ number_format($data->pengiriman->biaya_pengiriman,0,',','.') }}</h6>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center mt-2 border-top py-2">
                                                        <h6 class="mb-0">Harga Total</h6>
                                                        <h6 class="mb-0">Rp. {{ number_format($data->grand_total,0,',','.') }}</h6>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-end mt-2">
                                                    <div class="btn btn-primary btn-sm" onclick="modalConfirmation('{{ $data->id_transaction }}')">Hewan Sudah Datang !</div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="collapse-menu py-3 pr-2 border-bottom">
                                    <div class="d-flex align-items-center justify-content-between" data-toggle="collapse" href="#collapse5" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <h5 class="transaction mb-0">SAMPAI TUJUAN ({{ $sampai_tujuan->count() }})</h5>
                                        <i class="fa fa-arrow-circle-right arrow-icon" aria-hidden="true"></i>
                                    </div>
                                    <div class="collapse pengajuan_ongkir" id="collapse5">
                                        @foreach($sampai_tujuan as $data)
                                        <div class="d-flex justify-content-between align-items-center mt-2 p-2" data-toggle="collapse" href="#collapse-sampai-{{$loop->iteration}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            <div class="transaction-item px-2">
                                                <h5 class="transaction mb-0"><i class="fa-solid fa-paw text-secondary"></i> {{ $data->animal->judul_post }}</h5>
                                            </div>
                                            <i class="fa fa-minus align-items-end" aria-hidden="true"></i>

                                        </div>
                                        <div class="collapse" id="collapse-sampai-{{$loop->iteration}}">
                                            <div class="container border p-2">
                                                <div class="alert alert-primary">Silahkan melakukan pemeriksaan pada hewan dalam kurun waktu 24 jam, jika terdapat masalah bisa laporkan</div>

                                                <div class="row">
                                                    <div class="col-md-4 border-right">
                                                        <h5 class="cloud-font" style="font-size:larger">Informasi Hewan</h5>
                                                        <div class="d-flex align-items-start mt-3">
                                                            <div class="img-wrapper">
                                                                <img src="{{ asset('/animal_photos/'.$data->animal->thumbnail) }}" alt="" width="120">
                                                            </div>
                                                            <div class="product-wrapper ml-2">
                                                                <h5 class="transaction mb-0" style="font-size:smaller"> {{ $data->animal->judul_post }}</h5>
                                                                <p style="font-size: small;">{{ $data->qty }} x Rp. {{ number_format($data->animal->harga,0,',','.') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 border-right">
                                                        <h5 class="cloud-font" style="font-size:larger">Informasi Penjual <button class="btn btn-outline-success btn-sm"><i class="fa fa-comments" aria-hidden="true"></i> Tanya</button></h5>
                                                        <h5 class="transaction mt-3" style="font-size:smaller"><i class="fa fa-user"></i> {{ $data->store->nama_toko }}</h5>
                                                        <h5 class="transaction" style="font-size:smaller"><i class="fa-solid fa-phone"></i> {{ $data->store->no_hp }}</h5>
                                                        <h5 class="transaction mb-0" style="font-size:smaller; text-align:justify; text-justify: inter-word;"><i class="fa fa-address-book"></i> {{ $data->store->alamat_lengkap }}</h5>
                                                        <small>{{ $data->store->alamat }}</small>

                                                    </div>
                                                    <div class="col-md-4">
                                                        <h5 class="cloud-font" style="font-size:larger">Informasi Pengiriman</h5>
                                                        <h5 class="transaction mt-3" style="font-size:smaller"><i class="fa-solid fa-truck"></i> {{ $data->pengiriman->jasa_pengiriman }}</h5>
                                                        <h5 class="transaction" style="font-size:smaller"><i class="fa-solid fa-money-check-dollar"></i> Rp. {{ number_format($data->pengiriman->biaya_pengiriman,0,',','.') }}</h5>
                                                    </div>
                                                </div>
                                                <div class="rounded bg-light py-2 px-4 mt-2">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h6 class="mb-0">Subtotal</h6>
                                                        <h6 class="mb-0">Rp. {{ number_format($data->sub_total,0,',','.') }}</h6>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                                        <h6 class="mb-0">Biaya pengiriman</h6>
                                                        <h6 class="mb-0">Rp. {{ number_format($data->pengiriman->biaya_pengiriman,0,',','.') }}</h6>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center mt-2 border-top py-2">
                                                        <h6 class="mb-0">Harga Total</h6>
                                                        <h6 class="mb-0">Rp. {{ number_format($data->grand_total,0,',','.') }}</h6>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-end mt-2">
                                                    <button class="btn btn-outline-danger btn-sm" wire:click.prevent="reportProduct('{{ $data->id_transaction }}')" data-toggle="modal" data-target="#reportModal"><i class="fa-solid fa-flag"></i> Report Product</button>

                                                    <button class="btn btn-outline-success btn-sm ml-2" wire:click.prevent="ratingProduct('{{ $data->id_transaction }}')" data-toggle="modal" data-target="#ratingModal"><i class="fa-solid fa-star"></i> Rating & Review</button>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            @elseif($type == 'completed')

                            <div class="mt-3">
                                <livewire:user.ongoing-transaction />
                            </div>



                            @endif
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="pembayaranModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body px-4">
                    @if(isset($currentModalStep) && $currentModalStep == 1)

                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Informasi Pembeli</h6>
                        <button type="button" class="close mr-2" data-dismiss="modal" aria-label="Close">&times</button>
                    </div>
                    <div class="d-flex align-items-center justify-content-between pr-3 mb-1 mt-2">
                        <div>Nama</div>
                        <h5 class="mb-0">{{ $currentUser->name }}</h5>
                    </div>
                    <div class="d-flex align-items-center justify-content-between pr-3 mb-1">
                        <div>No Handphone</div>
                        <h5 class="mb-0">{{ $currentUser->phone_number }}</h5>
                    </div>
                    <div class="d-flex justify-content-between pr-3 mb-1">
                        <div>Alamat</div>
                        <h5 class="text-right mb-0">{{ $currentUser->alamat }}</h5>
                    </div>
                    <div class="d-flex justify-content-between pr-3 mb-1">
                        <div>Alamat Lengkap</div>
                        <h5 class="text-right mb-0" style="max-width:300px">{{ $currentUser->alamat_lengkap }}</h5>
                    </div>
                    <hr class="">
                    <h6 class="mb-0">Rangkuman Pembelian</h6>
                    <div class="d-flex justify-content-between align-items-center px-1 mt-2">
                        <div class="d-flex align-items-center" style="max-width:300px">
                            <img src="{{ asset('/animal_photos/'.$selectedTransaction->animal->thumbnail) }}" class="card-img-top" style="height:90px; width:80px; object-fit:cover">
                            <div class="px-2">
                                <h6 class="mb-2">{{$selectedTransaction->animal->judul_post}}</h6>
                                <p class="mb-2">{{ $selectedTransaction->qty }} x <span class="">Rp. {{ number_format($selectedTransaction->animal->harga ,0,',','.') }}</span></p>

                            </div>
                        </div>
                        <div class="">
                            <div>Subtotal</div>
                            <h5 style="font-weight:bolder">Rp. {{ number_format($selectedTransaction->sub_total ,0,',','.') }}</h5>
                        </div>
                        <div class="">
                            <div>Biaya Pengiriman</div>
                            <h5 style="font-weight:bolder">Rp. {{ number_format($selectedTransaction->pengiriman->biaya_pengiriman ,0,',','.') }}</h5>
                        </div>
                        <div class="">
                            <div>Total</div>
                            <h5 style="font-weight:bolder">Rp. {{ number_format($selectedTransaction->grand_total ,0,',','.') }}</h5>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary btn-sm mr-2 mt-2" wire:click.prevent="nextStepModal">Next &raquo;</button>
                    </div>
                    @elseif(isset($currentModalStep) && $currentModalStep == 2)
                    <div>Silahkan Melakukan Pembayaran dengan nominal <span class="font-weight-bold">Rp. {{ number_format($selectedTransaction->grand_total,0,',','.') }}</span> Pada Salah Satu Rekening Dibawah :</div>
                    <div class="d-flex align-items-center justify-content-between mt-5" style="width: 100%;">
                        <div class="d-flex align-items-center" style="width:50%">
                            <img src="{{ asset('/logo/bca.png') }}" alt="" width="120" height="60" style="object-fit:cover">
                            <div class="d-flex flex-column ml-2">
                                <div style="color:#6D7588; font-size:0.8rem; font-family:'Open Sauce One',sans-serif">BCA (PT Bank Central Asia Tbk)</div>
                                <div class="font-weight-bold" style="color:#212121; font-size:1.2rem; font-family:'Open Sauce One',sans-serif">3580666352</div>
                                <div style="color:#212121; font-size:1rem; font-family:'Open Sauce One',sans-serif">a.n Alvin Sugijanto</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center" style="width:50%">
                            <img src="{{ asset('/logo/mandiri.png') }}" alt="" width="120" height="60" style="object-fit:cover">
                            <div class="d-flex flex-column ml-2">
                                <div style="color:#6D7588; font-size:0.8rem; font-family:'Open Sauce One',sans-serif">Mandiri (PT Bank Mandiri Tbk)</div>
                                <div class="font-weight-bold" style="color:#212121; font-size:1.2rem; font-family:'Open Sauce One',sans-serif">3580666352</div>
                                <div style="color:#212121; font-size:1rem; font-family:'Open Sauce One',sans-serif">a.n Alvin Sugijanto</div>
                            </div>
                        </div>

                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-5">
                        <div class="d-flex align-items-center" style="width:50%">
                            <img src="{{ asset('/logo/bni.png') }}" alt="" width="120" height="60" style="object-fit:cover">
                            <div class="d-flex flex-column ml-2">
                                <div style="color:#6D7588; font-size:0.8rem; font-family:'Open Sauce One',sans-serif">BNI (PT Bank Negara Indonesia Tbk)</div>
                                <div class="font-weight-bold" style="color:#212121; font-size:1.2rem; font-family:'Open Sauce One',sans-serif">3580666352</div>
                                <div style="color:#212121; font-size:1rem; font-family:'Open Sauce One',sans-serif">a.n Alvin Sugijanto</div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center" style="width:50%">
                            <img src="{{ asset('/logo/bri.png') }}" alt="" width="120" height="60" style="object-fit:cover">
                            <div class="d-flex flex-column ml-2">
                                <div style="color:#6D7588; font-size:0.8rem; font-family:'Open Sauce One',sans-serif">BRI (PT Bank Rakyat Indonesia Tbk)</div>
                                <div class="font-weight-bold" style="color:#212121; font-size:1.2rem; font-family:'Open Sauce One',sans-serif">3580666352</div>
                                <div style="color:#212121; font-size:1rem; font-family:'Open Sauce One',sans-serif">a.n Alvin Sugijanto</div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mt-3 mr-2">
                        <button class="btn btn-primary btn-sm" wire:click.prevent="previousStepModal">&laquo; Previous</button>

                        <button class="btn btn-primary btn-sm" wire:click.prevent="nextStepModal">Next &raquo;</button>
                    </div>
                    @elseif(isset($currentModalStep) && $currentModalStep == 3)
                    <div class="py-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="font-weight-bold"><i class="fa fa-user"></i> Informasi Pengirim</h5>
                            <button type="button" class="close mr-2" data-dismiss="modal" aria-label="Close">&times</button>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="tipe_rekening">Tipe Rekening</label>
                            <select class="form-control" wire:model="tipe_rekening">
                                <option selected hidden>--Pilih Tipe--</option>
                                <option value="transfer_bank">Transfer Bank</option>
                                <option value="digital_payment">Pembayaran Digital</option>
                            </select>
                            <span class="text-danger">@error('tipe_rekening'){{ $message }}@enderror</span>

                        </div>
                        <div class="form-group">
                            <label>Jenis Rekening</label>
                            <select class="form-control" wire:model="jenis_rekening">
                                <option selected hidden>--Pilih Jenis Rekening--</option>
                                @if($tipe_rekening == 'transfer_bank')
                                <option value="bca">BCA</option>
                                <option value="mandiri">Mandiri</option>
                                <option value="bri">BRI</option>
                                <option value="bni">BNI</option>
                                @elseif($tipe_rekening == 'digital_payment')
                                <option value="ovo">OVO</option>
                                <option value="gopay">GoPay</option>
                                <option value="dana">DANA</option>
                                <option value="shopee_pay">ShopeePay</option>
                                @endif
                            </select>
                            <span class="text-danger">@error('jenis_rekening'){{ $message }}@enderror</span>

                        </div>
                        <div class="form-group">
                            <label for="">Nama Rekening Pengirim</label>
                            <input type="text" class="form-control" placeholder="Masukkan nama rekening..." wire:model.defer="nama_rekening">
                            <span class="text-danger">@error('nama_rekening'){{ $message }}@enderror</span>

                        </div>
                        <div class="form-group">
                            <label for="">Nomor Rekening / Nomor Virtual</label>
                            <input type="number" class="form-control" placeholder="Masukkan nomor rekening..." wire:model.defer="nomor_rekening">
                            <span class="text-danger">@error('nomor_rekening'){{ $message }}@enderror</span>

                        </div>
                        <div class="form-group">
                            <label for="">Upload Bukti Pembayaran</label>
                            <input type="file" class="form-control" wire:model.defer="bukti_pembayaran">
                            <span class="text-danger">@error('bukti_pembayaran'){{ $message }}@enderror</span>

                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mt-3 mr-2">
                            <button class="btn btn-primary btn-sm" wire:click.prevent="previousStepModal">&laquo; Previous</button>
                            <button class="btn btn-primary btn-sm" wire:click.prevent="submitPembayaran">Submit</button>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="reportModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modalId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header px-4">
                    <h5 class="modal-title"><i class="fa-solid fa-flag" style="color:#FF0000"></i> LAPORAN PRODUK</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                @if($currentReportModal == 1)
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-wrap justify-content-between align-items-center p-2 border-bottom">
                                <h5 class="transaction mb-0">ID Transaksi</h5>
                                <h5 class="cloud-font-bold mb-0">{{ $selectedTransaction->id_transaction }}</h5>
                            </div>
                            <div class="d-flex justify-content-between align-items-center p-2 border-bottom">
                                <h5 class="transaction mb-0">Nama Produk</h5>
                                <h5 class="cloud-font-bold mb-0">{{ $selectedTransaction->animal->judul_post }}</h5>
                            </div>
                            <div class="d-flex justify-content-between align-items-center p-2 border-bottom">
                                <h5 class="transaction mb-0">Metode Pengiriman</h5>
                                <h5 class="cloud-font-bold mb-0">{{ $selectedTransaction->pengiriman->jasa_pengiriman }}</h5>
                            </div>
                            <div class="d-flex justify-content-between align-items-center p-2 border-bottom">
                                <h5 class="transaction mb-0">Total Harga <small style="letter-spacing:1px">(termasuk ongkir+fee)</small></h5>

                                <h5 class="cloud-font-bold mb-0">Rp. {{ number_format($selectedTransaction->grand_total,0,',','.') }}</h5>
                            </div>
                            <div class="form-group px-2 mt-3">
                                <label>Keluhan</label>
                                <textarea id="w3review" class="form-control" rows="4" cols="56" placeholder="Masukkan Keluhan..." wire:model.defer="komentar"></textarea>
                                <span class="text-danger">@error('komentar'){{ $message }}@enderror</span>
                            </div>
                            <div class="form-group px-2 mt-2">
                                <label for="myfile">Foto Bukti</label>
                                <input type="file" class="form-control" name="myfile" wire:model="complain_photo" multiple>
                                <span class="text-danger">@error('complain_photo'){{ $message }}@enderror</span>

                            </div>
                            <div class="d-flex px-2 justify-content-end">
                                <button class="btn btn-primary btn-sm" wire:click="submitReport">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="ratingModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modalId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header px-4">
                    <h5 class="modal-title"><i class="fa-solid fa-star" style="color:green"></i> Rating & Review Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times
                    </button>
                </div>
                @if($currentRatingModal == 1)
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-product border rounded">
                                <div class="d-flex align-items-center justify-content-between card-top px-3 py-1 border-bottom" style="background-color:#F5F5F5">
                                    <p class="m-0">Penjual : {{ $selectedTransaction->store->nama_toko }}</p>
                                </div>
                                <div class="card-bdy p-2 d-flex align-items-center">
                                    <img src="{{ asset('/animal_photos/'.$selectedTransaction->animal->thumbnail) }}" class="card-img-top" style="height:100px; width:80px;  object-fit:cover">
                                    <div class="ml-2">
                                        <h5 class="cloud-font-bold">{{ $selectedTransaction->animal->judul_post }}</h5>
                                        <h6 class="mb-0 mt-3 font-weight-normal">Rp: {{ number_format($selectedTransaction->animal->harga,0,',','.') }}</h6>

                                    </div>
                                </div>
                            </div>
                            <div class="mt-2">Bagaimana Kualitas Hewan ini?</div>
                            <div class="form-group mt-1">
                                <p class="m-0 font-weight-normal">Rating</p>
                                <div class="rate">
                                    <input type="radio" id="star5" value="5" wire:model.defer="rating" />
                                    <label for="star5" title="Sangat Baik">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" wire:model.defer="rating" />
                                    <label for="star4" title="Baik">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" wire:model.defer="rating" />
                                    <label for="star3" title="Cukup">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" wire:model.defer="rating" />
                                    <label for="star2" title="Buruk">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" wire:model.defer="rating" />
                                    <label for="star1" title="Sangat Buruk">1 star</label>
                                </div>

                            </div>
                            <div class="form-group mt-3">
                                <!-- <p class="m-0">Review</p> -->
                                <textarea id="w3review" class="form-control" rows="4" cols="56" placeholder="Masukkan Review(opsional)..." wire:model.defer="review"></textarea>
                                <span class="text-danger">@error('review'){{ $message }}@enderror</span>
                            </div>
                            <div class="d-flex px-2 justify-content-end">
                                <button class="btn btn-primary btn-sm" wire:click="submitRating">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div wire:loading.delay class="loader-wrapper">
        <div class="text-center">
            <div class="la-ball-spin la-2x">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>

    </div>
    @push('scripts')
    <script>
        var coll = document.getElementsByClassName("collapse");

        // Loop through all the elements with the class "collapse"
        for (var i = 0; i < coll.length; i++) {
            // Add an event listener to the "data-toggle" element
            coll[i].previousElementSibling.addEventListener("click", function() {
                // Toggle the class of the "i" element
                this.querySelector(".arrow-icon").classList.toggle("fa-arrow-circle-right");
                this.querySelector(".arrow-icon").classList.toggle("fa-arrow-circle-down");
            });
        }

        function toggleCardClass(element) {
            var cards = document.querySelectorAll('.payment-card .card');

            cards.forEach(function(card) {
                card.classList.remove('active');
            });

            element.classList.add('active');
        }

        window.addEventListener('open-modal-pembayaran', event => {
            $('#pembayaranModal').modal('show');
        });
        window.addEventListener('close-modal-pembayaran', event => {
            $('#pembayaranModal').modal('hide');
        });
        window.addEventListener('open-modal-report', event => {
            $('#reportModal').modal('show');
        });
        window.addEventListener('close-modal-report', event => {
            $('#reportModal').modal('hide');
        });
        window.addEventListener('submitted-report', event => {
            Swal.fire({
                title: 'Success',
                text: 'Hewan kamu sudah masuk terdaftar dalam laporan. Silahkan menunggu untuk dihubungi oleh tim kami !',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok',
            }).then((result) => {
                window.location = "/user/transaction";
            })
        });

        window.addEventListener('submitted-rating', event => {
            Swal.fire({
                title: 'Success',
                text: 'Terima kasih telah melakukan rating dan review !',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok',
            }).then((result) => {
                window.location = "/user/transaction";
            })
        });

        window.addEventListener('success-modal', event => {
            Swal.fire({
                title: 'Success',
                text: 'Form Pembayaran Berhasil Dikirim ! Silahkan menunggu admin meninjau pembayaran',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok',
            }).then((result) => {
                window.location = "/user/transaction";
            })
        });

        function modalConfirmation(element) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Anda tidak dapat mengubah aksi ini",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hewan saya sudah datang'
            }).then((result) => {
                if (result.isConfirmed) {

                    Livewire.emit('modalConfirmed', element);

                    Swal.fire(
                        'Succeed!',
                        'Transaksi berhasil diupdate',
                        'success'
                    )
                }
            })
        }
    </script>
    @endpush
</div>