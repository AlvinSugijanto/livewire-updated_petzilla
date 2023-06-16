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
                                <button class="btn btn-transaction @if($type == 'ongoing') active @endif" wire:click="updateType">Ongoing</button>
                                <button class="btn btn-transaction ml-2 @if($type == 'completed') active @endif" wire:click="updateType">Completed</button>
                            </div>
                            @if($type == 'ongoing')

                            <div class="collapse-wrapper py-3">
                                <div class="collapse-menu py-3 pr-2 border-bottom">
                                    <div class="d-flex align-items-center justify-content-between" data-toggle="collapse" href="#collapse1" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <h5 class="transaction mb-0">PENGAJUAN HARGA ONGKIR ({{ $pengajuan_ongkir_count }})</h5>
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
                                        <h5 class="transaction mb-0">MENUNGGU PEMBAYARAN ({{ $menunggu_pembayaran_count }})</h5>
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
                                        <h5 class="transaction mb-0">SEDANG DIPROSES ({{ $sedang_diproses_count }})</h5>
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
                                        <h5 class="transaction mb-0">SEDANG DIKIRIM ({{ $sedang_dikirim_count }})</h5>
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
                                        <h5 class="transaction mb-0">SAMPAI TUJUAN ({{ $sampai_tujuan_count }})</h5>
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

                            @foreach($completedTransaction as $transaction)

                            <div class="card mt-3 shadow-sm pb-5 pt-3 px-4">
                                <div class="d-flex align-items-center">
                                    <div>{{ date('d M Y', strtotime($transaction->completed_at)) }}</div>
                                    <div class="border rounded px-2 py-1 ml-3 font-weight-bold" style="background-color:rgb(214, 255, 222); color:rgb(3, 172, 14); font-size:0.8rem">Selesai</div>

                                </div>
                                <div class="mt-2">
                                    <h5 class="mb-0 transaction"><i class="fa fa-shopping-bag"></i> {{ $transaction->store->nama_toko }}</h5>
                                </div>
                                <div class="d-flex mt-3 ">
                                    <img src="{{ asset('/animal_photos/'.$transaction->animal->thumbnail) }}" class="card-img-top" style="height:80px; width:70px; object-fit:cover">
                                    <div class="d-flex flex-column ml-2" style="width:250px">
                                        <h5 class="mb-0">{{ $transaction->animal->judul_post }}</h5>
                                        <span style="color:rgba(49,53,59,0.68)">{{ $transaction->qty }} x Rp. {{ number_format($transaction->animal->harga,0,',','.') }}</span>
                                    </div>
                                    <div class="d-flex flex-column border-left" style="margin-left:50px; padding-left:50px">
                                        <h6 class="mb-0" style="color:rgba(49,53,59,0.68)">Total Harga</h6>
                                        <h6 class="mb-0 mt-1" style="font-weight:bolder">Rp. {{ number_format($transaction->grand_total,0,',','.') }}</h6>
                                        <i style="font-size: 12px;">*termasuk ongkir + fee</i>
                                    </div>
                                    <div class="align-self-center" style="margin-left:50px">
                                        <button class="btn btn-transaction py-2 px-4" style=" opacity:0.9; font-size:13px"><i class="fa-solid fa-file-invoice"></i> Lihat Detail Transaksi</button>
                                    </div>
                                </div>
                            </div>

                            @endforeach

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
                <div class="modal-header">
                    <h5 class="modal-title">PEMBAYARAN TRANSAKSI</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                @if(isset($currentModalStep) && $currentModalStep == 1)
                <div class="modal-body">
                    <table>
                        <thead>
                            <tr class="text-center">
                                <td>Qty</td>
                                <td>Hewan</td>
                                <td>Subtotal</td>
                                <td>Ongkir</td>
                                <td>Total</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td width="30%">{{ $selectedTransaction->qty }}x <img src="{{ asset('/animal_photos/'.$selectedTransaction->animal->thumbnail) }}" alt="" width="100"></td>
                                <td width="20%">{{ $selectedTransaction->animal->judul_post }}</td>
                                <td width="20%">{{ number_format($selectedTransaction->sub_total,0,',','.') }}</td>
                                <td width="20%">{{ number_format($selectedTransaction->pengiriman->biaya_pengiriman,0,',','.') }}</td>
                                <td width="20%">{{ number_format($selectedTransaction->grand_total,0,',','.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <h5 style="font-weight:600"><i class="fa fa-truck" aria-hidden="true"></i> Dikirim ke : </h5>
                    <div class="col-md-12 mt-4">
                        <div class="row">
                            <div class="col-md-6 p-0">
                                <h5><span>Nama : </span>{{ $data->store->nama_toko }}</h5>
                            </div>
                            <div class="col-md-6">
                                <h5><span>No Hp : </span>{{ $data->store->no_hp }}</h5>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6 p-0">
                                <h5><span>Alamat : </span>{{ $data->store->alamat }}</h5>
                            </div>
                            <div class="col-md-6">
                                <h5><span>Alamat Lengkap : </span>{{ $data->store->alamat_lengkap }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click.prevent="nextStepModal">Next</button>
                </div>
                @elseif(isset($currentModalStep) && $currentModalStep == 2)

                <div class="modal-body">
                    <h5>Silahkan melakukan pembayaran dengan total <span style="font-weight:bolder; font-size: 15px">Rp.{{ number_format($selectedTransaction->grand_total,0,',','.') }}</span> pada salah satu rekening dibawah. Setelah itu, silahkan klik tombol Next untuk mengupload bukti pembayaran</h5>
                    <hr>
                    <div class="col-md-12">

                        <div class="payment-card mt-2">
                            <h5><i class="fa fa-money" aria-hidden="true"></i> Transfer Bank</h5>
                            <div class="d-flex align-items-center">
                                @foreach($payment_channels as $channel)
                                @if($channel['group'] == 'Virtual Account')
                                <div class="card col-md-4 mr-4" onclick="toggleCardClass(this)">
                                    <div class="card-body p-2 text-center">
                                        <h5 class="card-title mb-0" style="font-weight:bolder">{{ $channel['name'] }}</h5>
                                        <img src="{{ asset('/logo/'.$channel['code'].'.png') }}" height="70">
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>

                        <div class="payment-card mt-2">
                            <h5><i class="fa fa-university" aria-hidden="true"></i> Pembayaran Digital</h5>
                            <div class="d-flex align-items-center">
                                @foreach($payment_channels as $channel)
                                @if($channel['group'] == 'E-Wallet')
                                <div class="card col-md-4 mr-4" onclick="toggleCardClass(this)">
                                    <div class="card-body p-2 text-center">
                                        <h5 class="card-title mb-0" style="font-weight:bolder">{{ $channel['name'] }}</h5>
                                        <img src="{{ asset('/logo/'.$channel['code'].'.png') }}" height="70">
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>

                        <div class="payment-card mt-2">
                            <h5><i class="fa fa-shopping-bag" aria-hidden="true"></i> Convenience Store</h5>
                            <div class="d-flex align-items-center">
                                @foreach($payment_channels as $channel)
                                @if($channel['group'] == 'Convenience Store')
                                <div class="card col-md-4 mr-4" onclick="toggleCardClass(this)">
                                    <div class="card-body p-2 text-center">
                                        <h5 class="card-title mb-0" style="font-weight:bolder">{{ $channel['name'] }}</h5>
                                        <img src="{{ asset('/logo/'.$channel['code'].'.png') }}" height="70">
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click.prevent="create_tripay_transaction">Lanjutkan Pembayaran</button>
                </div>
                <!-- @elseif(isset($currentModalStep) && $currentModalStep == 3)
                <div class="modal-body">
                    <h5 style="font-weight:bolder">Informasi Pengirim</h5>
                    <hr>
                    <div class="form-group mt-3">
                        <label>Tipe Rekening</label>
                        <select class="form-control" wire:model="tipe_rekening">
                            <option selected hidden>--Pilih Tipe Rekening--</option>
                            <option value="transfer_bank">Transfer Bank</option>
                            <option value="digital_payment">Pembayaran Digital</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Metode Pembayaran</label>
                        <select class="form-control" wire:model="metode_pembayaran">
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
                            <option value="shopee_pay">Shopee Pay</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Rekening Pengirim</label>
                        <input type="text" class="form-control" placeholder="Masukkan nama rekening..." wire:model.lazy="nama_rekening">
                    </div>
                    <div class="form-group">
                        <label for="">No Rekening / No Virtual Pengirim</label>
                        <input type="text" name="" class="form-control" placeholder="No Rekening (Bank) / No Virtual Account (E-Wallet)" wire:model.lazy="nomor_rekening">
                    </div>
                    <div class="form-group">
                        <label for="">Foto Bukti</label>
                        <input type="file" name="" class="form-control" wire:model.lazy="foto_bukti">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Lanjutkan Pembayaran</button>
                </div> -->
                @endif

            </div>
        </div>

        <!-- LOADER -->
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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