<div>
    <div class="container-fluid">
        <h5 class="ml-2"><i class="fa fa-bookmark" aria-hidden="true"></i> My Wishlist</h5>
        <div class="card">
            <div class="card-body">
                <div class="row">

                    @foreach($animals as $animal)
                    <div class="col-md-3 mt-3">
                        <a href="{{ route('detail-animal', ['id_animal' => $animal->id_animal]) }}">
                            <div class="card product-card">
                                <img src="{{ asset('/animal_photos/'.$animal->thumbnail) }}" class="card-img-top" style="height:200px; object-fit:cover">

                                <div class="card-body">
                                    <div class="text-title-card" style="overflow: hidden; text-overflow: ellipsis">
                                        <h5 alt="aaa">{{ $animal->judul_post }}</h5>
                                    </div>
                                    <h5 class="card-text mt-2">Rp. {{ number_format($animal->harga,0,',','.') }}</h5>
                                    <i class="fa fa-map-marker" aria-hidden="true"></i><small class="ml-1">{{ $animal->alamat }}</small>
                                    <h6><i class="fa fa-shopping-bag"></i> {{ $animal->store->nama_toko }}</h6>
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