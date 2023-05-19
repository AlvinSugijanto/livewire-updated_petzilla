<div>
    <!-- <div class="article-section">
        <img src="{{ asset('article3.png') }}" alt="" class="image-article">
        <button class="button-article">GET NOW</button>
    </div> -->
    <div class="container">
        <div class="row container">
            <div class="col-md-3">
                <div class="card" style="height:400px">
                    <div class="card-body py-3 px-4">
                        <h5 class="card-title mb-0">Filters</h5>
                        <div class="filter-categories mt-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <h6 class="mb-0">Animal Type</h6>
                                <svg class="ml-2" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                                    <g class="nc-icon-wrapper" fill="currentColor">
                                        <path d="M10.293,3.293,6,7.586,1.707,3.293A1,1,0,0,0,.293,4.707l5,5a1,1,0,0,0,1.414,0l5-5a1,1,0,1,0-1.414-1.414Z" fill="currentColor"></path>
                                    </g>
                                </svg>
                            </div>
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Cat
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                <label class="form-check-label" for="flexCheckChecked">
                                    Dog
                                </label>
                            </div>
                        </div>
                        <hr class="">
                        <div class="filter-categories mt-2">
                            <div class="d-flex align-items-center justify-content-between">
                                <h6 class="mb-0">Dokumentasi</h6>
                                <svg class="ml-2" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                                    <g class="nc-icon-wrapper" fill="currentColor">
                                        <path d="M10.293,3.293,6,7.586,1.707,3.293A1,1,0,0,0,.293,4.707l5,5a1,1,0,0,0,1.414,0l5-5a1,1,0,1,0-1.414-1.414Z" fill="currentColor"></path>
                                    </g>
                                </svg>
                            </div>
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Bersertifikat murni
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                <label class="form-check-label" for="flexCheckChecked">
                                    Memiliki surat keterangan kesehatan
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-9">
                <div class="card">
                    <div class="card-body px-5">

                        <h3><i class="fa fa-paw" aria-hidden="true"></i> Hewan</h3>
                        <!-- <small><i class="fa fa-circle" aria-hidden="true"></i>Menampilkan hewan dalam radius 50km</small> -->
                        <div class="row mt-2">
                            @foreach($animals as $animal)
                            <div class="col-md-4 col-sm-4 mt-3">
                                <a href="{{ route('detail-animal', ['id_animal' => $animal->id_animal]) }}">
                                    <div class="card product-card">
                                        <img src="{{ asset('/animal_photos/'.$animal->thumbnail) }}" class="card-img-top" style="height:200px">

                                        <div class="card-body">
                                            <div class="text-title-card" style="overflow: hidden; text-overflow: ellipsis">
                                                <h5 alt="aaa">{{ $animal->judul_post }}</h5>
                                            </div>
                                            <h5 class="card-text mt-2">Rp. {{ number_format($animal->harga,0,',','.') }}</h5>
                                            <i class="fa fa-map-marker" aria-hidden="true"></i><small class="ml-1">{{ $animal->kecamatan }}</small>
                                            <h6><i class="fa-solid fa-store"></i> {{ $animal->nama_toko }}</h6>
                                            <!-- <a href="{{ route('detail-animal', ['id_animal' => $animal->id_animal]) }}" class="btn btn-primary"><small>Lihat Detail</small></a> -->
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                            @foreach($new_animals as $animal)
                            <div class="col-md-3 ">
                                <div class="card" style="margin-top:10px">

                                    <img src="{{ asset('/animal_photos/'.$animal->thumbnail) }}" class="card-img-top" style="height:200px">

                                    <div class="card-body">
                                        <div class="text-title-card" style="overflow: hidden; text-overflow: ellipsis">
                                            <h4 alt="aaa">{{ $animal->judul_post }}</h4>
                                        </div>
                                        <h5 class="card-text mt-2">Rp. {{ number_format($animal->harga,0,',','.') }}</h5>
                                        <i class="fa fa-map-marker" aria-hidden="true"></i><small class="ml-1">{{ $animal->kecamatan }}</small>
                                        <h6>{{ $animal->nama_toko }}</h6>
                                        <a href="{{ route('detail-animal', ['id_animal' => $animal->id_animal]) }}" class="btn btn-primary"><small>Lihat Detail</small></a>
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

</div>