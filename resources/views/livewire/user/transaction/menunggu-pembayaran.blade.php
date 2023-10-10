<div>

    @foreach($transactions as $transaction)
    <div class="card mt-3 shadow-sm pb-4 pt-3 px-4">
        <div class="d-flex align-items-center">
            <div class="pr-2 border-right border-secondary ">#{{ $transaction->id_transaction }}</div>
            <div class="ml-2">{{ date('d M Y H:i', strtotime($transaction->created_at)) }}</div>
            <div class="border rounded px-2 py-1 ml-3 font-weight-bold" style="background-color:#FEE5C9; color:#6d400ff7; font-size:0.8rem">Menunggu Pembayaran</div>
            <div class="text-danger ml-auto" role="button" onclick="cancelTransactionConfirmation('{{ $transaction->id_transaction }}')"><i class="fa fa-times"></i> Batalkan Transaksi</div>
        </div>
        <div class="mt-2">
            <h5 class="mb-0 transaction"><i class="fa fa-shopping-bag"></i> {{ $transaction->store->nama_toko }}</h5>
        </div>
        <div class="d-flex w-100 mt-3">
            <img src="{{ asset('/animal_photos/'.$transaction->detailTransaction[0]->animal->thumbnail) }}" class="card-img-top" style="height:100px; width:90px; object-fit:cover">
            <div class="ml-2">
                <h5 class="mb-0">{{ $transaction->detailTransaction[0]->animal->judul_post }}</h5>
                <div class="text-muted mt-2">+{{ count($transaction->detailTransaction)-1 }} item lainnya</div>

            </div>

            <div class="border-left pl-4 mr-5 ml-auto">
                <h6 class="mb-0" style="color:rgba(49,53,59,0.68)">Total Belanja</h6>
                <h6 class="mb-0 mt-1" style="font-weight:bolder">Rp. {{ number_format($transaction->grand_total,0,',','.') }}</h6>
            </div>

        </div>
        <div class="d-flex justify-content-end align-items-center mt-2">
            <a href="{{ route('user-inbox', ['toStore' => $transaction->store->id_store]) }}">
                <div style="color:#6d400ff7; font-weight:bold; font-size: 0.9rem;"><i class="fa-solid fa-comment-dots"></i> Tanya Penjual</div>
            </a>
            <div class="btn btn-transaction ml-3" style="font-size: 0.9rem;" wire:click.prevent="openDetailTransaksiModal('{{ $transaction->id_transaction }}')" data-toggle="modal" data-target="#detailTransaksiModal"><i class="fa-solid fa-file-invoice"></i> Lihat Detail Transaksi</div>
            <div class="btn btn-transaction ml-3 active" style="font-size: 0.9rem;" wire:click.prevent="openPembayaranModal('{{ $transaction->id_transaction }}')" data-toggle="modal" data-target="#pembayaranModal"><i class="fa-solid fa-file-invoice"></i> Bayar Sekarang</div>
        </div>
    </div>
    @endforeach
    <div class="d-flex justify-content-center mt-3">{{ $transactions->links() }}</div>
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
                    <div class="d-flex justify-content-between pr-3 mb-1">
                        <div>Jasa Pengiriman</div>
                        <h5 style="font-weight:bolder">{{ $selectedTransaction->pengiriman->jasa_pengiriman }}</h5>
                    </div>
                    <div class="d-flex justify-content-between pr-3 mb-1">
                        <div>Biaya Pengiriman</div>
                        <h5 style="font-weight:bolder">Rp. {{ number_format($selectedTransaction->pengiriman->biaya_pengiriman ,0,',','.') }}</h5>
                    </div>
                    <hr class="">
                    <h6 class="mb-2">Rangkuman Pembelian</h6>
                    <div style="max-height:300px; overflow-y:scroll">
                        @foreach($selectedTransaction->detailTransaction as $detail)
                        <div class="d-flex justify-content-between align-items-center px-1 mt-2">
                            <div class="d-flex align-items-center" style="max-width:300px">
                                <img src="{{ asset('/animal_photos/'.$detail->animal->thumbnail) }}" class="card-img-top" style="height:90px; width:80px; object-fit:cover">
                                <div class="px-2">
                                    <h6 class="mb-2">{{$detail->animal->judul_post}}</h6>
                                    <p class="mb-2">{{ $detail->qty }} x <span class="">Rp. {{ number_format($detail->animal->harga ,0,',','.') }}</span></p>
                                </div>
                            </div>
                            <div class="">
                                <div>Subtotal</div>
                                <h5 style="font-weight:bolder">Rp. {{ number_format($detail->subtotal ,0,',','.') }}</h5>
                            </div>
                        </div>
                        <hr class="mb-3">
                        @endforeach
                    </div>
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
                            <div wire:loading>
                                <div class="d-flex">
                                    <div class="spinner-border spinner-border-sm" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <p class="m-0 ml-2">Uploading...</p>
                                </div>
                            </div>
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
    <div wire:ignore.self class="modal fade" id="detailTransaksiModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modalId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header px-4">
                    <h4 class="modal-title">Detail Transaksi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times
                    </button>
                </div>
                @if($currentDetailTransaksiModal == 1)
                <div class="modal-body">
                    <div class="container">
                        <div class="d-flex justify-content-between align-items-center mt-1">
                            <div style="color:#6D7588">Status</div>
                            <div class="border rounded px-2 py-1 font-weight-bold d-inline-flex" style="background-color:#FEE5C9; color:#6d400ff7; font-size:0.8rem">Pengajuan Ongkir</div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-1">
                            <div style="color:#6D7588">ID Transaksi</div>
                            <div style="color:#6d400ff7; font-weight:500">#{{ $selectedTransaction->id_transaction }}</div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-1">
                            <div style="color:#6D7588">Tanggal Pembelian</div>
                            <div>{{ date('d F Y, H:i \W\I\B', strtotime($selectedTransaction->created_at)) }}</div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="modal-title mb-0">Detail Produk</h5>
                            <a href="{{ route('storePage', ['id_store' => $transaction->store->id_store]) }}" style="color:#6d400ff7; font-weight:500"><i class="fa fa-shopping-bag" aria-hidden="true"></i> {{ $selectedTransaction->store->nama_toko }} &#8594</a>
                        </div>
                        <div class="card mt-2">
                            <div class="card-body">
                                @foreach($selectedTransaction->detailTransaction as $detail)
                                <div class="d-flex">
                                    <img src="{{ asset('/animal_photos/'.$detail->animal->thumbnail) }}" class="card-img-top" style="height:80px; width:70px; object-fit:cover">
                                    <div class="d-flex flex-column ml-2 w-50">
                                        <h6 class="mb-0">{{ $detail->animal->judul_post }}</h6>
                                        <small class="mt-2 text-muted">Warna : {{$detail->animal->warna ? $detail->animal->warna : '-'}} Umur : {{$detail->animal->umur}} {{$detail->animal->satuan_umur}} </small>
                                    </div>
                                    <div class="ml-auto text-right align-self-center">
                                        <div>Harga</div>
                                        <div class="font-weight-bold">Rp. {{ number_format($detail->animal->harga,0,',','.') }}</div>
                                    </div>
                                </div>
                                <hr class="mb-3">
                                @endforeach
                            </div>
                        </div>
                        <h5 class="modal-title mb-0 mt-2">Info Pengiriman</h5>
                        <div class="card mt-2">
                            <div class="card-body">
                                <div class="d-flex align-items-center" style="width:100%">
                                    <div style="color:#6D7588; width:20%">Jasa Pengiriman</div>
                                    <div style="color:#6D7588; width:5%">:</div>
                                    <div>{{ $selectedTransaction->pengiriman->jasa_pengiriman }}</div>
                                </div>
                                <div class="d-flex align-items-center" style="width:100%">
                                    <div style="color:#6D7588; width:20%">Biaya Pengiriman</div>
                                    <div style="color:#6D7588; width:5%">:</div>
                                    <div>{{ number_format($selectedTransaction->pengiriman->biaya_pengiriman,0,',','.') }}</div>
                                </div>
                                <div class="d-flex" style="width:100%">
                                    <div style="color:#6D7588; width:20%">Pembeli</div>
                                    <div style="color:#6D7588; width:5%">:</div>
                                    <div>
                                        <div class="font-weight-bold">{{ $selectedTransaction->user->name }}</div>
                                    </div>
                                </div>
                                <div class="d-flex" style="width:100%">
                                    <div style="color:#6D7588; width:20%">No HP</div>
                                    <div style="color:#6D7588; width:5%">:</div>
                                    <div>
                                        <div>{{ $selectedTransaction->user->phone_number }}</div>
                                    </div>
                                </div>
                                <div class="d-flex" style="width:100%">
                                    <div style="color:#6D7588; width:20%">Alamat</div>
                                    <div style="color:#6D7588; width:5%">:</div>
                                    <div>
                                        <div>{{ $selectedTransaction->user->alamat_lengkap }}</div>
                                        <div>{{ $selectedTransaction->alamat }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>