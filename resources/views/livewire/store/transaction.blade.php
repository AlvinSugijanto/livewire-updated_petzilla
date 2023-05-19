<div>
    <div class="container">
        <h5>Daftar Transaksi</h5>
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
                        <i class="fa fa-arrow-circle-right mb-3 mr-2" aria-hidden="true"></i>
                    </div>
                    <div class="collapse pengajuan_ongkir" id="collapse1">
                        @foreach($pengajuan_ongkir as $data)
                        <div class="d-flex align-items-center justify-content-between mt-2 pl-3" data-toggle="collapse" href="#collapse-ongkir-{{$loop->iteration}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <h5 class="transaction">{{ $data->animal->judul_post }}</h5>
                            <i class="fa fa-minus mb-3 mr-2" aria-hidden="true"></i>
                        </div>
                        <div class="collapse" id="collapse-ongkir-{{$loop->iteration}}">
                            <div class="card card-body mt-3">
                                <div class="alert alert-warning text-center">Transaksi akan otomatis dibatalkan jika pesanan tidak diproses dalam 24 jam. Pada pukul 23:04</div>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td width="10%">{{ $data->qty }}x</td>
                                            <td width="30%"><img src="{{ asset('/animal_photos/'.$data->animal->thumbnail) }}" alt="" width="100"></td>
                                            <td width="20%">{{ $data->animal->judul_post }}</td>
                                            <td width="20%">{{ number_format($data->animal->harga,0,',','.') }}</td>
                                            <td width="20%">
                                                <button class="btn btn-primary btn-sm" wire:click.prevent="openModal('{{ $data->id_transaction }}')" data-toggle="modal" data-target="#tambahOngkirModal"><i class="fa fa-pencil" aria-hidden="true"></i> Tambah ongkir</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr class="">
                                <div class="d-flex inline align-items-center">
                                    <h6 class="mb-0">Biodata Pembeli</h6>
                                    <div class="btn btn-success btn-sm ml-3"><i class="fa fa-comments" aria-hidden="true" style="color:#DFFFE1"></i> Chat Pembeli</div>
                                </div>

                                <div class="col-md-12 mt-4">
                                    <div class="row">
                                        <div class="col-md-6 p-0">
                                            <h5><span>Nama : </span>{{ $data->user->name }}</h5>
                                        </div>
                                        <div class="col-md-6">
                                            <h5><span>No Hp : </span>{{ $data->user->phone_number }}</h5>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6 p-0">
                                            <h5><span>Alamat : </span>{{ $data->user->alamat }}</h5>
                                        </div>
                                        <div class="col-md-6">
                                            <h5><span>Alamat Lengkap : </span>{{ $data->user->alamat_lengkap }}</h5>
                                        </div>
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
                        <i class="fa fa-arrow-circle-right mb-3 mr-2" aria-hidden="true"></i>
                    </div>
                    <div class="collapse pengajuan_ongkir" id="collapse2">
                        @foreach($menunggu_pembayaran as $data)
                        <div class="d-flex align-items-center justify-content-between mt-2 pl-3" data-toggle="collapse" href="#collapse-menunggu-{{$loop->iteration}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <h5 class="transaction">{{ $data->animal->judul_post }}</h5>
                            <i class="fa fa-minus mb-3 mr-2" aria-hidden="true"></i>
                        </div>
                        <div class="collapse" id="collapse-menunggu-{{$loop->iteration}}">
                            <div class="card card-body mt-3">
                                <table>
                                    <thead>
                                        <tr class="border-bottom text-center">
                                            <td>Qty</td>
                                            <td>Hewan</td>
                                            <td>Subtotal</td>
                                            <td>Ongkir</td>
                                            <td>Total</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center">
                                            <td width="20%">{{ $data->qty }}x <img src="{{ asset('/animal_photos/'.$data->animal->thumbnail) }}" alt="" width="100"></td>
                                            <td width="20%">{{ $data->animal->judul_post }}</td>
                                            <td width="15%">{{ number_format($data->animal->harga,0,',','.') }}</td>
                                            <td width="15%">{{ number_format($data->pengiriman->biaya_pengiriman,0,',','.') }}</td>
                                            <td width="15%">{{ number_format($data->grand_total,0,',','.') }}</td>

                                            <td width="15%">
                                                <button class="btn btn-primary btn-sm"> Bayar sekarang</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr class="">
                                <div class="d-flex inline align-items-center">
                                    <h6 class="mb-0">Biodata Pembeli</h6>
                                    <div class="btn btn-success btn-sm ml-3"><i class="fa fa-comments" aria-hidden="true" style="color:#DFFFE1"></i> Chat Pembeli</div>
                                </div>

                                <div class="col-md-12 mt-4">
                                    <div class="row">
                                        <div class="col-md-6 p-0">
                                            <h5><span>Nama : </span>{{ $data->user->name }}</h5>
                                        </div>
                                        <div class="col-md-6">
                                            <h5><span>No Hp : </span>{{ $data->user->phone_number }}</h5>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6 p-0">
                                            <h5><span>Alamat : </span>{{ $data->user->alamat }}</h5>
                                        </div>
                                        <div class="col-md-6">
                                            <h5><span>Alamat Lengkap : </span>{{ $data->user->alamat_lengkap }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <hr class="mt-0">
                </div>
                <div class="collapse-menu">
                    <div class="d-flex align-items-center justify-content-between" data-toggle="collapse" href="#collapse3" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <h5 class="transaction">SEDANG DIPROSES ({{ $sedang_diproses_count }})</h5>
                        <i class="fa fa-arrow-circle-right mb-3 mr-2" aria-hidden="true"></i>
                    </div>
                    <div class="collapse pengajuan_ongkir" id="collapse3">
                        @foreach($sedang_diproses as $data)
                        <div class="d-flex align-items-center justify-content-between mt-2 pl-3" data-toggle="collapse" href="#collapse-dikirim-{{$loop->iteration}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <h5 class="transaction">{{ $data->animal->judul_post }}</h5>
                            <i class="fa fa-minus mb-3 mr-2" aria-hidden="true"></i>
                        </div>
                        <div class="collapse" id="collapse-dikirim-{{$loop->iteration}}">
                            <div class="card card-body mt-3">
                                <table>
                                    <thead>
                                        <tr class="border-bottom text-center">
                                            <td>Qty</td>
                                            <td>Hewan</td>
                                            <td>Subtotal</td>
                                            <td>Ongkir</td>
                                            <td>Total</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center">
                                            <td width="20%"><div class="d-flex justify-content-center align-items-center pt-2">{{ $data->qty }}x&nbsp<img src="{{ asset('/animal_photos/'.$data->animal->thumbnail) }}" alt="" width="120" height="60"></div></td>
                                            <td width="20%">{{ $data->animal->judul_post }}</td>
                                            <td width="15%">{{ number_format($data->animal->harga,0,',','.') }}</td>
                                            <td width="15%">{{ number_format($data->grand_total,0,',','.') }}</td>

                                            <td width="15%">
                                                <button class="btn btn-primary btn-sm"> KIRIM SEKARANG</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr class="">
                                <div class="d-flex inline align-items-center">
                                    <h6 class="mb-0">Biodata Pembeli</h6>
                                    <div class="btn btn-success btn-sm ml-3"><i class="fa fa-comments" aria-hidden="true" style="color:#DFFFE1"></i> Chat Pembeli</div>
                                </div>

                                <div class="col-md-12 mt-4">
                                    <div class="row">
                                        <div class="col-md-6 p-0">
                                            <h5><span>Nama : </span>{{ $data->user->name }}</h5>
                                        </div>
                                        <div class="col-md-6">
                                            <h5><span>No Hp : </span>{{ $data->user->phone_number }}</h5>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6 p-0">
                                            <h5><span>Alamat : </span>{{ $data->user->alamat }}</h5>
                                        </div>
                                        <div class="col-md-6">
                                            <h5><span>Alamat Lengkap : </span>{{ $data->user->alamat_lengkap }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <hr class="mt-0">
                </div>
                <div class="collapse-menu">
                    <div class="d-flex align-items-center justify-content-between" data-toggle="collapse" href="#collapse4" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <h5 class="transaction">SEDANG DIKIRIM (0)</h5>
                        <i class="fa fa-arrow-circle-right mb-3 mr-2" aria-hidden="true"></i>
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
    @push('scripts')
    <script>
        var coll = document.getElementsByClassName("collapse");

        // Loop through all the elements with the class "collapse"
        for (var i = 0; i < coll.length; i++) {
            // Add an event listener to the "data-toggle" element
            coll[i].previousElementSibling.addEventListener("click", function() {
                // Toggle the class of the "i" element
                this.querySelector("i").classList.toggle("fa-arrow-circle-right");
                this.querySelector("i").classList.toggle("fa-arrow-circle-down");
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