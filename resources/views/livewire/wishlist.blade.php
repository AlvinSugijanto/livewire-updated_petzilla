<div>
    <div class="container-fluid">
        <h5 class="ml-2"><i class="fa fa-bookmark" aria-hidden="true"></i> Wishlist Saya</h5>
        <div class="card" style="min-height: 300px;">
            <div class="card-body">
                @if(count($animals) > 0)
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
                @else
                <div class="d-flex justify-content-center align-items-center flex-column mt-5">
                    <img src="/empty.png" alt="" width="100" height="100">
                    <div class="ml-3 mt-2 cloud-font-bold">Oops.. Wishlist Kamu Kosong</div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>