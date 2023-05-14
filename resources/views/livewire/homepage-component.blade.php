<div>

    <div class="container mt-3">
        <div id="carouselExampleIndicators" class="carousel slide mx-auto d-block border" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block" src="{{ asset('article1.png') }}" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block" src="{{ asset('article2.png') }}" alt="Second slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="row container mt-3">
            <div class="col-md-2">
                <div class="card pt-3" style="height:400px">
                    <h6 class="card-title text-center mt-2">FILTER</h6>
                    <hr class="mt-0">
                    <div class="form-check pl-5">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Cat
                        </label>
                    </div>
                    <div class="form-check pl-5">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            Dog
                        </label>
                    </div>
                </div>
            </div>

            <div class="col-md-10">
                <div class="card">
                    <div class="card-body px-5">

                        <h5><i class="fa fa-paw" aria-hidden="true"></i> Hewan</h5>
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
                                            <h6>{{ $animal->nama_toko }}</h6>
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