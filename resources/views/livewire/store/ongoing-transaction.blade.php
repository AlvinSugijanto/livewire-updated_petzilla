<div>
    @foreach($completedTransaction as $transaction)

    <div class="card shadow-sm mb-3 pb-5 pt-3 px-4">
        <div class="d-flex align-items-center">
            <div class="pr-2 border-right border-secondary ">#{{ $transaction->id_transaction }}</div>
            <div class="ml-2">{{ date('d M Y', strtotime($transaction->completed_at)) }}</div>
            <div class="border rounded px-2 py-1 ml-3 font-weight-bold" style="background-color:rgb(214, 255, 222); color:rgb(3, 172, 14); font-size:0.8rem">Selesai</div>
        </div>
        <div class="mt-2">
            <h5 class="mb-0 transaction"><i class="fa fa-shopping-bag"></i> {{ $transaction->store->nama_toko }}</h5>
        </div>
        <div class="d-flex mt-3 ">
            <img src="{{ asset('/animal_photos/'.$transaction->animal->thumbnail) }}" class="card-img-top" style="height:80px; width:70px; object-fit:cover">
            <div class="d-flex flex-column ml-2" style="width:300px">
                <h5 class="mb-0">{{ $transaction->animal->judul_post }}</h5>
                <span style="color:rgba(49,53,59,0.68)">{{ $transaction->qty }} x Rp. {{ number_format($transaction->animal->harga,0,',','.') }}</span>
            </div>
            <div class="d-flex flex-column border-left" style="margin-left:50px; padding-left:50px">
                <h6 class="mb-0" style="color:rgba(49,53,59,0.68)">Total Harga</h6>
                <h6 class="mb-0 mt-1" style="font-weight:bolder">Rp. {{ number_format($transaction->grand_total,0,',','.') }}</h6>
                <i style="font-size: 12px;">*termasuk ongkir + fee</i>
            </div>
            <div class="align-self-center" style="margin-left:100px">
                <button class="btn btn-transaction py-2 px-4" style="opacity:0.9; font-size:13px" wire:click.prevent="openDetailTransaksiModal('{{ $transaction->id_transaction }}')" data-toggle="modal" data-target="#detailTransaksiModal"><i class="fa-solid fa-file-invoice"></i> Lihat Detail Transaksi</button>
            </div>
        </div>
    </div>
    @endforeach
    <div class="d-flex justify-content-center">{{ $completedTransaction->links() }}</div>
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
                        <div class="border rounded px-2 py-1 font-weight-bold d-inline-flex" style="background-color:rgb(214, 255, 222); color:rgb(3, 172, 14); font-size:1rem">Selesai</div>
                        <div class="d-flex justify-content-between align-items-center mt-1">
                            <div style="color:#6D7588">ID Transaksi</div>
                            <div style="color:#6d400ff7; font-weight:500">#{{ $selectedTransaction->id_transaction }}</div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-1">
                            <div style="color:#6D7588">Tanggal Pembelian</div>
                            <div>{{ date('d F Y, H:i \W\I\B', strtotime($selectedTransaction->created_at)) }}</div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-1">
                            <div style="color:#6D7588">Selesai Pada</div>
                            <div>{{ date('d F Y, H:i \W\I\B', strtotime($selectedTransaction->completed_at)) }}</div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center" >
                            <h5 class="modal-title mb-0">Detail Produk</h5>
                            <a href="{{ route('storePage', ['id_store' => $transaction->store->id_store]) }}" style="color:#6d400ff7; font-weight:500"><i class="fa fa-shopping-bag" aria-hidden="true"></i> {{ $selectedTransaction->store->nama_toko }} &#8594</a>
                        </div>
                        <div class="card mt-2">
                            <div class="card-body">
                                <div class="d-flex">
                                    <img src="{{ asset('/animal_photos/'.$selectedTransaction->animal->thumbnail) }}" class="card-img-top" style="height:80px; width:70px; object-fit:cover">
                                    <div class="d-flex flex-column ml-2" style="width:250px">
                                        <h5 class="mb-0">{{ $selectedTransaction->animal->judul_post }}</h5>
                                        <span style="color:rgba(49,53,59,0.68)">{{ $selectedTransaction->qty }} x Rp. {{ number_format($selectedTransaction->animal->harga,0,',','.') }}</span>
                                    </div>
                                    <div class="ml-auto text-right align-self-center">
                                        <div>Total Harga</div>
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