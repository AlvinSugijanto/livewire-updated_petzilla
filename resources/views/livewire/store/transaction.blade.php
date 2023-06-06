<div>
    <div class="container">
        <h5>Daftar Transaksi</h5>
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-start align-items-start">
                    <button class="btn btn-transaction active">Ongoing</button>
                    <button class="btn btn-transaction ml-2">Completed</button>
                </div>
                <div class="collapse-wrapper py-3">
                    <div class="collapse-menu py-3 pr-2 border-bottom">
                        <div class="d-flex align-items-center justify-content-between" data-toggle="collapse" href="#collapse1" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <h5 class="transaction mb-0">PENGAJUAN HARGA ONGKIR ({{ $pengajuan_ongkir_count }})</h5>
                            <i class="fa fa-arrow-circle-right arrow-icon" aria-hidden="true"></i>
                        </div>
                        <div class="collapse pengajuan_ongkir" id="collapse1">
                            @foreach($pengajuan_ongkir as $data)
                            <div class="d-flex justify-content-between align-items-center mt-2 py-2" data-toggle="collapse" href="#collapse-ongkir-{{$loop->iteration}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <div class="transaction-item">
                                    <h5 class="transaction mb-0"><i class="fa-solid fa-paw text-secondary"></i> {{ $data->animal->judul_post }}</h5>
                                </div>
                                <i class="fa fa-minus" aria-hidden="true"></i>

                            </div>
                            <div class="collapse" id="collapse-ongkir-{{$loop->iteration}}">
                                <div class="container border p-2">
                                    <div class="alert alert-warning text-center">Transaksi akan otomatis dibatalkan jika pesanan tidak diproses dalam 24 jam. Pada pukul 23:04</div>

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
                                            <h5 class="cloud-font" style="font-size:larger">Informasi Pembeli</h5>
                                            <h5 class="transaction mt-3" style="font-size:smaller"><i class="fa fa-user"></i> {{ $data->user->name }}</h5>
                                            <h5 class="transaction" style="font-size:smaller"><i class="fa-solid fa-phone"></i> {{ $data->user->phone_number }}</h5>
                                            <h5 class="transaction" style="font-size:smaller; text-align:justify; text-justify: inter-word;"><i class="fa fa-address-book"></i> {{ $data->user->alamat_lengkap }} ({{ $data->user->alamat }})</h5>

                                        </div>
                                        <div class="col-md-4">
                                            <h5 class="cloud-font" style="font-size:larger">Informasi Pengiriman</h5>

                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end align-items-center rounded bg-light p-2">
                                        <button class="btn btn-outline-success btn-sm"><i class="fa fa-comments" aria-hidden="true"></i> Chat pembeli </button>
                                        <button class="btn btn-primary btn-sm ml-3" wire:click.prevent="openModal('{{ $data->id_transaction }}')" data-toggle="modal" data-target="#tambahOngkirModal"><i class="fa fa-pencil" aria-hidden="true"></i> Tambah pengiriman</button>

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
                            <div class="d-flex justify-content-between align-items-center mt-2 py-2" data-toggle="collapse" href="#collapse-pembayaran-{{$loop->iteration}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <div class="transaction-item">
                                    <h5 class="transaction mb-0"><i class="fa-solid fa-paw text-secondary"></i> {{ $data->animal->judul_post }}</h5>
                                </div>
                                <i class="fa fa-minus" aria-hidden="true"></i>

                            </div>
                            <div class="collapse" id="collapse-pembayaran-{{$loop->iteration}}">
                                <div class="container border p-2">
                                    <div class="alert alert-primary">Pada tahap ini anda toko menunggu pembeli melakukan pembayaran. Silahkan hubungi pembeli via chat jika dibutuhkan. Jika dalam 24 jam pembeli tidak melakukan pembayaran maka transaksi akan dibatalkan</div>

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
                                            <h5 class="cloud-font mb-0" style="font-size:larger">Informasi Pembeli <button class="btn btn-outline-success btn-sm"><i class="fa fa-comments" aria-hidden="true"></i> Tanya</button></h5>
                                            <h5 class="transaction mt-3" style="font-size:smaller"><i class="fa fa-user"></i> {{ $data->user->name }}</h5>
                                            <h5 class="transaction" style="font-size:smaller"><i class="fa-solid fa-phone"></i> {{ $data->user->phone_number }}</h5>
                                            <h5 class="transaction mb-0" style="font-size:smaller; text-align:justify; text-justify: inter-word;"><i class="fa fa-address-book"></i> {{ $data->user->alamat_lengkap }}</h5>
                                            <small class="text-center">{{ $data->user->alamat }}</small>
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
                                            <h6 class="mb-0">Rp. {{ number_format($data->animal->harga,0,',','.') }}</h6>
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
                            <div class="d-flex justify-content-between align-items-center mt-2 py-2" data-toggle="collapse" href="#collapse-diproses-{{$loop->iteration}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <div class="transaction-item">
                                    <h5 class="transaction mb-0"><i class="fa-solid fa-paw text-secondary"></i> {{ $data->animal->judul_post }}</h5>
                                </div>
                                <i class="fa fa-minus" aria-hidden="true"></i>

                            </div>
                            <div class="collapse" id="collapse-diproses-{{$loop->iteration}}">
                                <div class="container border p-2">
                                    <div class="alert alert-primary text-center">Silahkan memproses transaksi, lalu mengupload bukti pengiriman</div>

                                    <div class="row">
                                        <div class="col-md-4 border-right">
                                            <h5 class="cloud-font" style="font-size:larger">Informasi Hewan</h5>
                                            <div class="d-flex align-items-start mt-3 pb-2">
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
                                            <h5 class="cloud-font" style="font-size:larger">Informasi Pembeli</h5>
                                            <h5 class="transaction mt-3" style="font-size:smaller"><i class="fa fa-user"></i> {{ $data->user->name }}</h5>
                                            <h5 class="transaction" style="font-size:smaller"><i class="fa-solid fa-phone"></i> {{ $data->user->phone_number }}</h5>
                                            <h5 class="transaction" style="font-size:smaller; text-align:justify; text-justify: inter-word;"><i class="fa fa-address-book"></i> {{ $data->user->alamat_lengkap }} ({{ $data->user->alamat }})</h5>

                                        </div>
                                        <div class="col-md-4">
                                            <h5 class="cloud-font" style="font-size:larger">Informasi Pengiriman</h5>
                                            <h5 class="transaction mt-3" style="font-size:smaller"><i class="fa-solid fa-truck"></i> {{ $data->pengiriman->jasa_pengiriman }}</h5>
                                            <h5 class="transaction" style="font-size:smaller"><i class="fa-solid fa-money-check-dollar"></i> Rp. {{ number_format($data->pengiriman->biaya_pengiriman,0,',','.') }}</h5>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end align-items-center rounded bg-light p-2">
                                        <button class="btn btn-outline-success btn-sm"><i class="fa fa-comments" aria-hidden="true"></i> Chat pembeli </button>
                                        <button class="btn btn-primary btn-sm ml-3" wire:click.prevent="openModal('{{ $data->id_transaction }}')" data-toggle="modal" data-target="#prosesTransaksiModal"><i class="fa fa-pencil" aria-hidden="true"></i> Proses sekarang</button>

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
                            <div class="d-flex justify-content-between align-items-center mt-2 py-2" data-toggle="collapse" href="#collapse-dikirim-{{$loop->iteration}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <div class="transaction-item">
                                    <h5 class="transaction"><i class="fa-solid fa-paw text-secondary"></i> {{ $data->animal->judul_post }}</h5>
                                </div>
                                <i class="fa fa-minus" aria-hidden="true"></i>

                            </div>
                            <div class="collapse" id="collapse-dikirim-{{$loop->iteration}}">
                                <div class="container border p-2">
                                    <div class="alert alert-primary text-center">Silahkan memproses transaksi, lalu mengupload bukti pengiriman</div>

                                    <div class="row">
                                        <div class="col-md-4 border-right">
                                            <h5 class="cloud-font" style="font-size:larger">Informasi Hewan</h5>
                                            <div class="d-flex align-items-start mt-3 pb-2">
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
                                            <h5 class="cloud-font" style="font-size:larger">Informasi Pembeli</h5>
                                            <h5 class="transaction mt-3" style="font-size:smaller"><i class="fa fa-user"></i> {{ $data->user->name }}</h5>
                                            <h5 class="transaction" style="font-size:smaller"><i class="fa-solid fa-phone"></i> {{ $data->user->phone_number }}</h5>
                                            <h5 class="transaction" style="font-size:smaller; text-align:justify; text-justify: inter-word;"><i class="fa fa-address-book"></i> {{ $data->user->alamat_lengkap }} ({{ $data->user->alamat }})</h5>

                                        </div>
                                        <div class="col-md-4">
                                            <h5 class="cloud-font" style="font-size:larger">Informasi Pengiriman</h5>
                                            <h5 class="transaction mt-3" style="font-size:smaller"><i class="fa-solid fa-truck"></i> {{ $data->pengiriman->jasa_pengiriman }}</h5>
                                            <h5 class="transaction" style="font-size:smaller"><i class="fa-solid fa-money-check-dollar"></i> Rp. {{ number_format($data->pengiriman->biaya_pengiriman,0,',','.') }}</h5>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end align-items-center rounded bg-light p-2">
                                        <button class="btn btn-outline-success btn-sm"><i class="fa fa-comments" aria-hidden="true"></i> Chat pembeli </button>
                                        <button class="btn btn-primary btn-sm ml-3" wire:click.prevent="openModal('{{ $data->id_transaction }}')" data-toggle="modal" data-target="#prosesTransaksiModal"><i class="fa fa-pencil" aria-hidden="true"></i> Proses sekarang</button>

                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="tambahOngkirModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">TAMBAH ONGKIR</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="form-group">
                            <label>Nama Jasa Pengiriman</label>
                            <input type="text" class="form-control" placeholder="Masukkan nama jasa pengiriman..." wire:model.defer="jasa_pengiriman">
                        </div>
                        <div class="form-group">
                            <label>Biaya Pengiriman</label>
                            <input type="text" class="form-control" placeholder="Masukkan biaya pengiriman..." wire:model.defer="biaya_pengiriman">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click.prevent="submitOngkir">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="prosesTransaksiModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Bukti Pengiriman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="form-group">
                            <label>Upload Foto</label>
                            <input type="file" class="form-control" wire:model.defer="bukti_pengiriman">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click.prevent="submitBuktiPengiriman">Submit</button>
                </div>
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
                // Toggle the class of the "i" element within the clicked collapsible element
                var icon = this.querySelector(".arrow-icon");
                icon.classList.toggle("fa-arrow-circle-down");
                icon.classList.toggle("fa-arrow-circle-right");
            });
        }
        window.addEventListener('success-notification', function() {
            Swal.fire({
                title: 'Success',
                text: 'Ongkos kirim berhasil ditambahkan, silahkan menunggu pembeli melakukan pembayaran',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok',

            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "/store/transaction";

                }
            })
        });
    </script>
    @endpush
</div>