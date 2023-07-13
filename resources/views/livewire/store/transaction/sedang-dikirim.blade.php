<div>
    @foreach($transactions as $transaction)
    <div class="card mt-3 shadow-sm pb-4 pt-3 px-4">
        <div class="d-flex align-items-center">
            <div class="pr-2 border-right border-secondary ">#{{ $transaction->id_transaction }}</div>
            <div class="ml-2">{{ date('d M Y H:i', strtotime($transaction->created_at)) }}</div>
            <div class="border rounded px-2 py-1 ml-3 font-weight-bold" style="background-color:#FEE5C9; color:#6d400ff7; font-size:0.8rem">Sedang dikirim</div>

        </div>
        <div class="mt-2">
            <h5 class="mb-0 transaction"><i class="fa fa-user"></i> {{ $transaction->user->name }}</h5>
        </div>
        <div class="d-flex w-100 mt-3">
            <img src="{{ asset('/animal_photos/'.$transaction->animal->thumbnail) }}" class="card-img-top" style="height:100px; width:90px; object-fit:cover">
            <div class="ml-2">
                <h5 class="mb-0">{{ $transaction->animal->judul_post }}</h5>
                <span style="color:rgba(49,53,59,0.68)">{{ $transaction->qty }} x Rp. {{ number_format($transaction->animal->harga,0,',','.') }}</span>
            </div>

            <div class="border-left pl-4 mr-5 ml-auto">
                <h6 class="mb-0" style="color:rgba(49,53,59,0.68)">Total Belanja</h6>
                <h6 class="mb-0 mt-1" style="font-weight:bolder">Rp. {{ number_format($transaction->sub_total,0,',','.') }}</h6>
            </div>

        </div>
        <div class="d-flex justify-content-end align-items-center mt-2">
            <a href="{{ route('store-inbox', ['toUser' => $transaction->user->id_user]) }}">
                <div style="color:#6d400ff7; font-weight:bold; font-size: 0.9rem;"><i class="fa-solid fa-comment-dots"></i> Tanya Pembeli</div>
            </a>
            <button class="btn btn-transaction ml-3" style="font-size: 0.9rem;" wire:click.prevent="openDetailTransaksiModal('{{ $transaction->id_transaction }}')" data-toggle="modal" data-target="#detailTransaksiModal"><i class="fa-solid fa-file-invoice"></i> Lihat Detail Transaksi</button>

        </div>
    </div>
    @endforeach
    <div class="d-flex justify-content-center mt-3">{{ $transactions->links() }}</div>
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
                            <div class="border rounded px-2 py-1 font-weight-bold d-inline-flex" style="background-color:#FEE5C9; color:#6d400ff7; font-size:0.8rem">Sedang Dikirim</div>
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
                                <div class="d-flex">
                                    <img src="{{ asset('/animal_photos/'.$selectedTransaction->animal->thumbnail) }}" class="card-img-top" style="height:80px; width:70px; object-fit:cover">
                                    <div class="d-flex flex-column ml-2 w-50">
                                        <h5 class="mb-0">{{ $selectedTransaction->animal->judul_post }}</h5>
                                        <span style="color:rgba(49,53,59,0.68)">{{ $selectedTransaction->qty }} x Rp. {{ number_format($selectedTransaction->animal->harga,0,',','.') }}</span>

                                    </div>
                                    <div class="ml-auto text-right align-self-center">
                                        <div>Subtotal</div>
                                        <div class="font-weight-bold">Rp. {{ number_format($selectedTransaction->sub_total,0,',','.') }}</div>
                                    </div>
                                </div>
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
                                    <div style="color:#6D7588; width:20%">Alamat</div>
                                    <div style="color:#6D7588; width:5%">:</div>
                                    <div>
                                        <div class="font-weight-bold">{{ $selectedTransaction->user->name }}</div>
                                        <div>{{ $selectedTransaction->user->phone_number }}</div>
                                        <div>{{ $selectedTransaction->user->alamat_lengkap }}</div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <h5 class="modal-title mb-0 mt-2">Rincian Pembayaran</h5>
                        <div class="card mt-2">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div style="color:#6D7588">Metode Pembayaran</div>
                                    <div>{{ $selectedTransaction->pembayaran->jenis_rekening }}</div>
                                </div>
                                <div class="d-flex justify-content-between mt-1">
                                    <div style="color:#6D7588">Subtotal({{ $selectedTransaction->qty }} barang)</div>
                                    <div>Rp. {{ number_format($selectedTransaction->sub_total,0,',','.') }}</div>
                                </div>
                                <div class="d-flex justify-content-between mt-1">
                                    <div style="color:#6D7588">Biaya Pengiriman</div>
                                    <div>Rp. {{ number_format($selectedTransaction->pengiriman->biaya_pengiriman,0,',','.') }}</div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <h5 class="mb-0">Total Belanja</h5>
                                    <h5 class="mb-0">Rp. {{ number_format($selectedTransaction->grand_total,0,',','.') }}</h5>
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