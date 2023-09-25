<div>
    <div class="container mb-3">
        <div class="card" style="padding:10px">
            <div class="row">
                <div class="col-md-5">
                    <div class="image-class text-center">
                        <img src="{{ asset('/animal_photos/'.$animal->thumbnail) }}" class="img-thumbnail img-fluid main-preview" style="max-height: 230px;">
                    </div>
                    <div class="row px-3">
                        <div class="col-md-4 mt-2 p-1">
                            <img src="{{ asset('/animal_photos/'.$animal->thumbnail) }}" class="other-preview img-thumbnail" style="width:100%; height:120px; object-fit:cover">
                        </div>
                        @foreach($animal->animal_photo as $photo)
                        <div class="col-md-4 mt-2 p-1">
                            <img src="{{ asset('/animal_photos/'.$photo->photo) }}" class="other-preview img-thumbnail" style="width:100%; height:120px; object-fit:cover">
                        </div>
                        @endforeach
                    </div>

                </div>
                <div class="col-md-7">
                    <div class="container">
                        <h3>{{ $animal->judul_post }}</h3>
                        <div class="text-description mt-3" style="text-align: justify; text-justify: inter-word;">{!! nl2br($animal->deskripsi) !!}</div>
                        <div class="d-flex flex-column">
                            <h6 class="mb-0 mt-2"><i class="fa fa-check-circle-o" aria-hidden="true" style="color:green"></i> Hewan dalam keadaan sehat</h6>
                            @if($animal->sertifikat_pedigree)
                            <h6 class="mb-0 mt-2"><i class="fa fa-check-circle-0" aria-hidden="true" style="color:green"></i> Hewan bersertifikat asli</h6>
                            @else
                            <h6 class="mb-0 mt-2"><i class="fa fa-times-circle" aria-hidden="true" style="color:red"></i> Hewan tidak bersertifikat</h6>
                            @endif
                        </div>
                        <h6 class="mb-0 mt-3 font-weight-normal font-italic">Warna : @if($animal->warna == 'lainnya' || $animal->warna == NULL) - @else {{$animal->warna}} @endif</h6>
                        <h6 class="mb-0 font-weight-normal font-italic">Umur : @if($animal->umur){{$animal->umur}} {{ $animal->satuan_umur }} @else - @endif</h6>

                        <h3 class="mt-3">Rp: {{ number_format($animal->harga,0,',','.') }}</h4>

                            
                            <h6 class="mb-0 mt-3">Total Stok : {{ $animal->stok }}</h6>
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
                            <div class="store-profile my-3">
                                <div class="d-flex align-items-center py-2">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Store photo" class="rounded-circle border" width="80px">
                                    <div class="d-flex flex-column px-4">
                                        <a href="{{ route('storePage', ['id_store' => $store->id_store]) }}">
                                            <h5 class="mb-0">{{ $store->nama_toko }}</h5>
                                        </a>
                                        <span>{{ $store->kecamatan }} ,{{ $store->kabupaten }}</span>
                                        <h5 class="mb-0"><i class="fa fa-star" aria-hidden="true" style="color:green"></i> (21) total review</h5>
                                    </div>
                                    <a href="{{ route('user-inbox', ['toStore' => $store->id_store]) }}" class="btn btn-success"><i class="fa fa-commenting-o" aria-hidden="true"></i> Chat penjual</a>
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
                <div class="modal-body mb-4">

                    <div class="d-flex justify-content-between">
                        <h6 class="mb-0">Informasi Pembeli</h6>
                        <button type="button" class="close mr-2" data-dismiss="modal" aria-label="Close">&times</button>
                    </div>
                    <div class="d-flex align-items-center justify-content-between pr-3 mb-1 mt-2">
                        <div>Nama</div>
                        <div>{{ $user->name }}</div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between pr-3 mb-1">
                        <div>No Handphone</div>
                        <div>{{ $user->phone_number }}</div>
                    </div>
                    <div class="d-flex justify-content-between pr-3 mb-1">
                        <div>Alamat</div>
                        <div class="text-right">{{ $user->alamat }}</div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between pr-3 mb-1">
                        <div>Alamat Lengkap</div>
                        <div class="text-right">{{ $user->alamat_lengkap }}</div>
                    </div>
                    <hr>
                    <h6 class="mb-0 mt-3">Rangkuman Pembelian</h6>
                    <div class="d-flex justify-content-between align-items-center px-3 mt-2">
                        <div class="d-flex align-items-center">
                            <span class="font-weight-bold">{{ $current_qty }}x</span>
                            <img src="{{ asset('/animal_photos/'.$animal->thumbnail) }}" class="card-img-top ml-3" style="height:90px; width:80px; object-fit:cover">
                            <div class="px-2">
                                <h6 class="mb-0">{{$animal->judul_post}}</h6>
                                <small>Warna : {{$animal->warna}}</small>
                                <p class="m-0"></p>
                                <small>Umur : {{$animal->umur}} {{$animal->satuan_umur}}</small>
                            </div>
                        </div>
                        <div class="mr-3">
                            <div>Total</div>
                            <h5>Rp: {{ number_format($animal->harga * $current_qty ,0,',','.') }}</h5>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary" wire:click.prevent="createTransaction">Ajukan Biaya Pengiriman</button>
                    </div>
                </div>
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