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
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body pl-4">
                            <div class="row">
                                <button class="btn btn-transaction active">Ongoing</button>
                                <button class="btn btn-transaction ml-2">Completed</button>
                            </div>
                            <hr>
                            <div class="collapse-menu">
                                <div class="d-flex align-items-center justify-content-between" data-toggle="collapse" href="#collapse1" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    <h5 class="transaction">PENGAJUAN HARGA ONGKIR ({{ $pengajuan_ongkir_count }})</h5>
                                    <i class="fa fa-arrow-circle-right mb-3 mr-2 arrow-icon" aria-hidden="true"></i>
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
                                <hr class="mt-0">
                            </div>
                            <div class="collapse-menu">
                                <div class="d-flex align-items-center justify-content-between" data-toggle="collapse" href="#collapse2" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    <h5 class="transaction">MENUNGGU PEMBAYARAN ({{ $menunggu_pembayaran_count }})</h5>
                                    <i class="fa fa-arrow-circle-right mb-3 mr-2 arrow-icon" aria-hidden="true"></i>
                                </div>
                                <div class="collapse pengajuan_ongkir" id="collapse2">
                                    @foreach($menunggu_pembayaran as $data)
                                    <div class="d-flex justify-content-between align-items-center mt-2 p-2" data-toggle="collapse" href="#collapse-ongkir-{{$loop->iteration}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <div class="transaction-item px-2">
                                            <h5 class="transaction mb-0"><i class="fa-solid fa-paw text-secondary"></i> {{ $data->animal->judul_post }}</h5>
                                        </div>
                                        <i class="fa fa-minus align-items-end" aria-hidden="true"></i>

                                    </div>
                                    <div class="collapse" id="collapse-ongkir-{{$loop->iteration}}">
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
                                <hr class="mt-0">
                            </div>
                            <div class="collapse3">
                                <div class="d-flex align-items-center justify-content-between" data-toggle="collapse" href="#collapse3" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    <h5 class="transaction">SEDANG DIPROSES (0)</h5>
                                    <i class="fa fa-arrow-circle-right mb-3 mr-2 arrow-icon" aria-hidden="true"></i>
                                </div>
                                <div class="collapse" id="collapse3">
                                    <div class="card card-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                                    </div>
                                </div>
                                <hr class="mt-0">
                            </div>
                            <div class="collapse4">
                                <div class="d-flex align-items-center justify-content-between" data-toggle="collapse" href="#collapse4" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    <h5 class="transaction">SEDANG DIKIRIM (0)</h5>
                                    <i class="fa fa-arrow-circle-right mb-3 mr-2 arrow-icon" aria-hidden="true"></i>
                                </div>
                                <div class="collapse" id="collapse4">
                                    <div class="card card-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                                    </div>
                                </div>
                                <hr class="mt-0">
                            </div>
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
                                <div class="card mr-4" onclick="toggleCardClass(this)">
                                    <div class="card-body text-center">
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
                                <div class="card mr-4" onclick="toggleCardClass(this)">
                                    <div class="card-body text-center">
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
                                <div class="card mr-4" onclick="toggleCardClass(this)">
                                    <div class="card-body text-center">
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
    </script>
    @endpush
</div>