<div>
    @foreach($transactions as $transaction)
    <div class="card mt-3 shadow-sm pb-4 pt-3 px-4">
        <div class="d-flex align-items-center">
            <div class="pr-2 border-right border-secondary ">#{{ $transaction->id_transaction }}</div>
            <div class="ml-2">{{ date('d M Y H:i', strtotime($transaction->created_at)) }}</div>
            <div class="border rounded px-2 py-1 ml-3 font-weight-bold" style="background-color:#FEE5C9; color:#6d400ff7; font-size:0.8rem">Pengajuan Ongkir</div>
            <div class="text-danger ml-auto" role="button" onclick="cancelTransactionConfirmation('{{ $transaction->id_transaction }}')"><i class="fa fa-times"></i> Batalkan Transaksi</div>

        </div>
        <div class="mt-2">
            <h5 class="mb-0 transaction"><i class="fa fa-user"></i> {{ $transaction->user->name }}</h5>
        </div>
        <div class="d-flex w-100 mt-3">
            <img src="{{ asset('/animal_photos/'.$transaction->detailTransaction[0]->animal->thumbnail) }}" class="card-img-top" style="height:100px; width:90px; object-fit:cover">
            <div class="ml-2">
                <h5 class="mb-0">{{ $transaction->detailTransaction[0]->animal->judul_post }}</h5>
                <span style="color:rgba(49,53,59,0.68)">{{ $transaction->detailTransaction[0]->qty }} x Rp. {{ number_format($transaction->detailTransaction[0]->animal->harga,0,',','.') }}</span>
                <div class="text-muted mt-2">+{{ count($transaction->detailTransaction)-1 }} item lainnya</div>

            </div>
            <div class="border-left pl-4 mr-5 ml-auto">
                <h6 class="mb-0" style="color:rgba(49,53,59,0.68)">Total Belanja</h6>
                <h6 class="mb-0 mt-1" style="font-weight:bolder">Rp. {{ number_format($transaction->grand_total,0,',','.') }}</h6>
            </div>
        </div>
        <div class="d-flex justify-content-end align-items-center mt-2">
            <a href="{{ route('store-inbox', ['toUser' => $transaction->user->id_user]) }}">
                <div style="color:#6d400ff7; font-weight:bold; font-size: 0.9rem;"><i class="fa-solid fa-comment-dots"></i> Tanya Pembeli</div>
            </a>
            <button class="btn btn-transaction ml-3" style="font-size: 0.9rem;" wire:click.prevent="openDetailTransaksiModal('{{ $transaction->id_transaction }}')" data-toggle="modal" data-target="#detailTransaksiModal"><i class="fa-solid fa-file-invoice"></i> Lihat Detail Transaksi</button>
            <button class="btn btn-transaction ml-3 active" style="font-size: 0.9rem;" wire:click.prevent="openOngkirModal('{{ $transaction->id_transaction }}')" data-toggle="modal" data-target="#tambahOngkirModal"><i class="fa-solid fa-file-invoice"></i> Tambah Ongkir</button>

        </div>
    </div>
    @endforeach
    <div class="d-flex justify-content-center mt-3">{{ $transactions->links() }}</div>
    <div wire:ignore.self class="modal fade" id="tambahOngkirModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                @if($currentOngkirModal == 1)
                <div class="modal-header">
                    <h5 class="modal-title">TAMBAH ONGKIR</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Jasa Pengiriman</label>
                        <input type="text" class="form-control" placeholder="Masukkan nama jasa pengiriman..." wire:model.defer="jasa_pengiriman">
                    </div>
                    <div class="form-group">
                        <label>Biaya Pengiriman</label>
                        <input type="text" class="form-control" placeholder="Masukkan biaya pengiriman..." wire:model.defer="biaya_pengiriman">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click.prevent="submitOngkir">Submit</button>
                </div>
                @endif
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
                                        <h6 class="cloud-font-bold m-0 mt-2" style="letter-spacing: 0.4px;">{{ $detail->qty }} x Rp. {{ number_format($detail->animal->harga,0,',','.') }}</h6>
                                        <small class="mt-2 text-muted">Warna : {{$detail->animal->warna ? $detail->animal->warna : '-'}} Umur : {{$detail->animal->umur}} {{$detail->animal->satuan_umur}} </small>
                                    </div>
                                    <div class="ml-auto text-right align-self-center">
                                        <div>Subtotal</div>
                                        <div class="font-weight-bold">Rp. {{ number_format($detail->subtotal,0,',','.') }}</div>
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