<div>
    <div class="container">
        <h4>Keranjang</h4>
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="w-100">
                        @foreach($carts as $cart)
                        <div class="d-flex align-items-center">
                            <div class="store-information ml-2">
                                <div class="d-flex">
                                    <input type="checkbox" style="width: 20px;" data-id="{{ $cart->id_cart }}" onclick="checkParent(this)">
                                    <div class="ml-3">
                                        <h5 class="text-title m-0">{{ $cart->store->nama_toko }}</h5>
                                        <small class="m-0"> {{ $cart->store->getKabupaten($cart->store->provinsi, $cart->store->kabupaten) }}, {{ $cart->store->getKecamatan($cart->store->kabupaten, $cart->store->kecamatan) }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach($cart->cartDetail as $cartDetail)
                        <div class="mt-4 ml-5 pr-5">
                            <div class="d-flex">
                                <div class="d-flex">
                                    <input type="checkbox" class="checkBoxChild{{ $cartDetail->cart_id }}" wire:model="checkBoxChild" value="{{ $cartDetail->id_cart_detail }}" style="width: 15px;">

                                    <img src="{{ asset('/animal_photos/'.$cartDetail->animal->thumbnail) }}" class="ml-2 card-img-top border-rounded" style="width:80px; height:80px;  object-fit:cover">
                                    <div class="ml-3">
                                        <h6 class="text-title m-0">{{ $cartDetail->animal->judul_post }}</h6>
                                        <h5 class="cloud-font-bold m-0 mt-2" style="letter-spacing: 0.4px;">Rp. {{ number_format($cartDetail->animal->harga,0,',','.') }}</h5>
                                        <small class="text-muted">Warna: {{$cartDetail->animal->warna ? $item->animal->warna : '-'}}, Umur : {{$cartDetail->animal->umur ? $cartDetail->animal->umur : '-'}}</small>
                                    </div>
                                </div>
                                <div class="ml-4 align-self-center">
                                    <a wire:click="" class="trash-hover"><i class="fa fa-solid fa-trash" aria-hidden="true" style="color:#FF5151; font-size:16px"></i></a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <hr>
                        @endforeach
                    </div>
                    <div class="ml-auto">
                        <div class="shadow p-4" style="min-width:350px;">
                            <h6>Rangkuman Belanja</h6>
                            <hr>
                            <div class="d-flex">
                                <h6 class="text-muted">Total Harga </h6>
                                <h6 class="ml-auto text-right">Rp. {{ number_format($totalHarga,0,',','.') }}</h6>
                            </div>
                            <button class="btn btn-primary w-100 mt-3 @if(empty($checkBoxChild)) disabled @endif" data-toggle="modal" data-target="#addTransactionModal">Ajukan Pengiriman</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($cartz)
    <div wire:ignore.self class="modal fade" id="addTransactionModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
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
                    <h6 class="mb-0 mt-3 mb-3">Rangkuman Pembelian</h6>
                    @foreach($cartz->cartDetail as $item)
                    <div class="d-flex justify-content-between align-items-center px-2 mt-2">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('/animal_photos/'.$item->animal->thumbnail) }}" class="card-img-top" style="height:90px; width:80px; object-fit:cover">
                            <div class="px-2">
                                <h6 class="mb-0">{{$item->animal->judul_post}}</h6>
                                <small>Warna : {{$item->animal->warna ? $item->animal->warna : '-'}} </small>
                                <small>Umur : {{$item->animal->umur}} {{$item->animal->satuan_umur}}</small>
                            </div>
                        </div>
                        <div class="mr-3">
                            <div>Harga</div>
                            <div class="font-weight-bold">Rp. {{ number_format($item->animal->harga,0,',','.') }}</div>
                        </div>
                    </div>
                    <hr>
                    @endforeach
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary" wire:click.prevent="createTransaction">Ajukan Biaya Pengiriman</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @push('scripts')

    <script>
        function checkParent(e) {
            var idparent = e.getAttribute('data-id');
            if (e.checked === true) {
                Livewire.emit('checkParent', idparent);
            } else {
                Livewire.emit('unCheckParent', idparent);

            }
        }
        window.addEventListener('success-transaction', function(e) {

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
    </script>
    @endpush
</div>