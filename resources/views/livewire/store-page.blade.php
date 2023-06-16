<div>

    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="col-md-12 row justify-content-center">
                    <div class="col-md-6 row d-flex align-items-center">
                        <img src="{{ asset('store_logo_default.jpg') }}" class="default_store_logo" style="border-radius: 50%">
                        <div class="store-information px-4">
                            <h5 class="text-title">{{ $store->nama_toko }}</h5>
                            <small><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $store->kabupaten }}, {{ $store->kecamatan }}</small>
                        </div>
                        <div class="d-flex align-items-center">
                            <a href="" class="btn btn-success pt-1"><i class="fa fa-commenting-o" aria-hidden="true"></i> Chat penjual</a>
                        </div>
                    </div>
                    <div class="col-md-5 offset-md-1 justify-content-center row">
                        <div class="rating-toko d-flex align-items-center text-center">
                            <div class="rating-and-review px-5" style="border-right:1px solid grey">
                                <h5 class="text-title"><i class="fa fa-star text-warning" aria-hidden="true"></i> 21</h5>
                                <h6>Total Ulasan</h6>
                            </div>
                            <div class="produk-terjual px-5">
                                <h5 class="text-title"><i class="fa fa-paw" aria-hidden="true" style="color:#A76432"></i> {{ $produk_terjual }}</h5>
                                <h6>Produk Terjual</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container px-4">

            <div class="card mt-3 px-3">
                <div class="card-body">
                    <div class="button-type d-flex align-items-center">
                        <button class="btn btn-transaction active">Produk</button>
                        <button class="btn btn-transaction ml-2">Ulasan</button>
                    </div>
                    <h5 class="mt-3">Semua Produk</h5>
                    <div class="row">
                        @foreach($store->listAnimal as $animal)
                        <div class="col-md-3 col-sm-4 mt-3">
                            <a href="{{ route('detail-animal', ['id_animal' => $animal->id_animal]) }}" >
                                <div class="card product-card">
                                    <img src="{{ asset('/animal_photos/'.$animal->thumbnail) }}" class="card-img-top" style="height:200px; object-fit:cover">

                                    <div class="card-body">
                                        <div class="text-title-card" style="overflow: hidden; text-overflow: ellipsis">
                                            <h5 alt="aaa">{{ $animal->judul_post }}</h5>
                                        </div>
                                        <h5 class="card-text mt-2">Rp. {{ number_format($animal->harga,0,',','.') }}</h5>
                                        <h6>{{ $animal->nama_toko }}</h6>

                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>