<div>
    <div class="container mb-3">
        <div class="card" style="padding:10px">
            <div class="row">
                <div class="col-md-5">
                    <div class="image-class text-center">
                        <img src="{{ asset('/animal_photos/'.$animal->thumbnail) }}" class="img-thumbnail img-fluid main-preview" style="max-height: 230px;">
                    </div>
                    <div class="row">
                        <div class="col-md-3 mt-2">
                            <img src="{{ asset('/animal_photos/'.$animal->thumbnail) }}" class="other-preview img-thumbnail" style="height:120px">
                        </div>
                        @foreach($animal_photo as $photo)
                        <div class="col-md-3 mt-2">
                            <img src="{{ asset('/animal_photos/'.$photo->photo) }}" class="other-preview img-thumbnail" style="height:120px">
                        </div>
                        @endforeach
                    </div>

                </div>
                <div class="col-md-7">
                    <div class="container">
                        <h3>{{ $animal->judul_post }}</h3>
                        <div class="text-description" style="text-align: justify; text-justify: inter-word;">{{ $animal->deskripsi }}</div>
                        <ul class="mt-2">
                            <li><i class="fa fa-check-circle-o" aria-hidden="true" style="color:green"></i> Hewan dalam keadaan sehat (verified)</li>
                            <li><i class="fa fa-times-circle" aria-hidden="true" style="color:red"></i> Hewan tidak bersertifikat (verified)</li>
                        </ul>
                        <h3 class="mt-2">Rp: {{ number_format($animal->harga,0,',','.') }}</h4>
                            <h6 class="mb-0">Total Stok : {{ $animal->stok }}</h6>
                            <div class="d-flex align-items-center mt-2">
                                <div class="stok-qty border border-secondary py-2">
                                    <i class="fa fa-minus" aria-hidden="true" wire:click.prevent="$emitSelf('dec_qty')"></i>
                                    <h6 class="mb-0">{{$current_qty}}</h6>
                                    <i class="fa fa-plus" aria-hidden="true" wire:click.prevent="$emitSelf('inc_qty')"></i>
                                </div>
                                <div class="button-list ml-3">
                                    <button class="btn btn-cart" data-toggle="modal" data-target="#addTransactionModal"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Buy Now</button>
                                    <button class="btn btn-transaction ml-2" wire:click.prevent="add_to_wishlist"><i class="fa fa-bookmark" aria-hidden="true"></i> Add to wishlist</button>
                                </div>
                            </div>
                            <hr class="mb-0">
                            <div class="store-profile">
                                <div class="row">
                                    <div class="col-md-2 d-flex align-items-center text-center">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Store photo" class="rounded-circle mt-2 border" width="100%">
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <a href="{{ route('storePage', ['id_store' => $store->id_store]) }}">
                                            <h5>{{ $store->nama_toko }}</h5>
                                        </a>
                                        <span>{{ $store->kecamatan }} ,{{ $store->kabupaten }}</span>
                                        <h5><i class="fa fa-star" aria-hidden="true" style="color:green"></i> (21) total review</h5>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-center text-center">
                                        <a href="{{ route('user-inbox', ['toStore' => $to_id_user]) }}" class="btn btn-success mt-4"><i class="fa fa-commenting-o" aria-hidden="true"></i> Chat penjual</a>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="addTransactionModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">TRANSACTION</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="storeProduk">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card p-2">
                                    <h5>Alamat Pengiriman</h5>
                                    <hr class="p-0 m-0">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h6 class="mt-2">Nama</h6>
                                            <h6 class="mt-2">No Hp</h6>
                                            <h6 class="mt-2">Alamat</h6>
                                            <h6 class="mt-2">Alamat Lengkap</h6>

                                        </div>
                                        <div class="col-md-1">
                                            <h6 class="mt-2">:</h6>
                                            <h6 class="mt-2">:</h6>
                                            <h6 class="mt-2">:</h6>
                                            <h6 class="mt-2">:</h6>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="mt-2">{{ $user->name }}</h6>
                                            <h6 class="mt-2">{{ $user->phone_number }}</h6>
                                            <h6 class="mt-2">Purwokerto Selatan, Banyumas, Jawa Tengah</h6>
                                            <h6 class="mt-2">{{ $user->alamat_lengkap }}</h6>

                                        </div>
                                    </div>


                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="card p-2">
                                    <h5>Rangkuman Pembelian</h5>
                                    <hr class="p-0 mt-0">
                                    <h6 class="mb-0">{{ $store->nama_toko }}</h6>
                                    <p class="m-0" style="font-size:12px">{{ $store->kecamatan }}, {{ $store->kabupaten }}</p>
                                    <div class="row pl-4 d-flex align-items-center">
                                        <h6>1x</h6>
                                        <img src="{{ asset('/animal_photos/'.$animal->thumbnail) }}" class="mt-2 ml-2 img-thumbnail" style="max-height:100px;">
                                        <div class="items p-1">
                                            <h6>{{ $animal->judul_post }}</h6>
                                            <h6>Warna : hitam</h6>
                                            <h6> Rp. {{ number_format($animal->harga,0,',','.') }} </h6>
                                        </div>
                                    </div>
                                    <hr class="my-2">
                                    <button class="btn btn-primary col-md-6 offset-md-6" wire:click.prevent="createTransaction">Ajukan harga ongkir</button>



                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="toast" class="position-fixed top-0 right-0 m-3" style="z-index: 9999;"></div>

    @push('scripts')
    <script>
        window.addEventListener('success-modal', function() {
            Swal.fire({
                title: 'Success',
                text: 'Transaksi berhasil dibuat, silahkan menunggu toko memasukkan ongkos kirim',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok',

            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "/user/transaction";

                }
            })
        });
        window.addEventListener('success-wishlist', function(e) {

            var icons;

            if (e.detail.status == 200) {
                icons = 'success'
            } else {
                icons = 'warning'
            }

            Swal.fire({
                title: 'Success',
                text: e.detail.message,
                icon: icons,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok',

            })
        });
    </script>
    @endpush
</div>