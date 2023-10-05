<div>
    @foreach($transactions as $transaction)
    <div class="card mt-3 shadow-sm pb-4 pt-3 px-4">
        <div class="d-flex align-items-center">
            <div class="pr-2 border-right border-secondary ">#{{ $transaction->id_transaction }}</div>
            <div class="ml-2">{{ date('d M Y H:i', strtotime($transaction->created_at)) }}</div>
            <div class="border rounded px-2 py-1 ml-3 font-weight-bold" style="background-color:#FEE5C9; color:#6d400ff7; font-size:0.8rem">Sampai Tujuan</div>

        </div>
        <div class="mt-2">
            <h5 class="mb-0 transaction"><i class="fa fa-shopping-bag"></i> {{ $transaction->store->nama_toko }}</h5>
        </div>
        <div class="d-flex w-100 mt-3">
            <img src="{{ asset('/animal_photos/'.$transaction->detailTransaction[0]->animal->thumbnail) }}" class="card-img-top" style="height:100px; width:90px; object-fit:cover">
            <div class="ml-2">
                <h5 class="mb-0">{{ $transaction->detailTransaction[0]->animal->judul_post }}</h5>
                <span style="color:rgba(49,53,59,0.68)">{{ $transaction->detailTransaction[0]->qty }} x Rp. {{ number_format($transaction->detailTransaction[0]->animal->harga,0,',','.') }}</span>
            </div>
            <div class="border-left pl-4 mr-5 ml-auto">
                <h6 class="mb-0" style="color:rgba(49,53,59,0.68)">Total Belanja</h6>
                <h6 class="mb-0 mt-1" style="font-weight:bolder">Rp. {{ number_format($transaction->grand_total,0,',','.') }}</h6>
            </div>
        </div>
        <div class="d-flex justify-content-end align-items-center mt-2">
            <button class="btn btn-outline-danger btn-sm" wire:click.prevent="reportProduct('{{ $transaction->id_transaction }}')" data-toggle="modal" data-target="#reportModal"><i class="fa-solid fa-flag"></i> Laporkan Produk</button>

            <button class="btn btn-outline-success btn-sm ml-2" wire:click.prevent="ratingProduct('{{ $transaction->id_transaction }}')" data-toggle="modal" data-target="#ratingModal"><i class="fa-solid fa-star"></i> Beri Ulasan</button>
        </div>
    </div>
    @endforeach
    <div class="d-flex justify-content-center mt-3">{{ $transactions->links() }}</div>
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
</div>