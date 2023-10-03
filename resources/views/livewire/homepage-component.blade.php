<div>
    <div class="container-fluid px-5">
        <div class="row">
            <div class="col-lg-2 d-lg-block d-none">
                <div class="card cardFilter" style="min-height:500px">
                    <div class="card-body py-3 px-4">
                        <h5 class="inter-font mb-0 text-center">Filters</h5>
                        <hr>
                        <div class="filter-group position-relative">
                            <h6 class="text-center">Hewan</h6>
                            <div class="d-flex align-items-center form-control shadow-sm text-center py-4" style="border: 1px solid rgb(0, 0, 0, .1);" onclick="toggleFilterDropdown(0)" role="button">
                                <div>Semua</div>
                                <i class="fa fa-angle-right ml-auto" aria-hidden="true"></i>
                            </div>
                            <div class="dropdown-filter">
                                <div class="card p-2">
                                    <div class="collapse-item d-flex justify-content-between align-items-center cloud-font p-2" wire:click="setAnimalFilter('anjing')">
                                        <div>Anjing</div>
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </div>
                                    <div class="collapse-item d-flex justify-content-between align-items-center cloud-font p-2" wire:click="setAnimalFilter('kucing')">
                                        <div>Kucing</div>
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="filter-group mt-3 position-relative">
                            <h6 class="text-center">Umur</h6>
                            <button class="d-flex align-items-center form-control shadow-sm text-center py-4" style="border: 1px solid rgb(0, 0, 0, .1);" onclick="toggleFilterDropdown(1)">
                                <div>Semua</div>
                                <i class="fa fa-angle-right ml-auto" aria-hidden="true"></i>
                            </button>
                            <div class="dropdown-filter">
                                <div class="card p-2">
                                    <div class="collapse-item d-flex justify-content-between align-items-center cloud-font p-2" wire:click="setAgeFilter('bayi')">
                                        <div>
                                            <div>Bayi</div>
                                            <span style="font-size:12px">(< 3 bulan)</span>
                                        </div>
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </div>
                                    <div class="collapse-item d-flex justify-content-between align-items-center cloud-font p-2" wire:click="setAgeFilter('remaja')">
                                        <div>
                                            <div>Remaja</div>
                                            <span style="font-size:12px">(3 Bulan - 1 Tahun)</span>
                                        </div>
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </div>
                                    <div class="collapse-item d-flex justify-content-between align-items-center cloud-font p-2" wire:click="setAgeFilter('dewasa')">
                                        <div>
                                            <div>Dewasa</div>
                                            <span style="font-size:12px">(> 1 Tahun)</span>
                                        </div>
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter-group mt-3 position-relative">
                            <h6 class="text-center">Radius</h6>
                            <button class="d-flex align-items-center form-control shadow-sm text-center py-4" style="border: 1px solid rgb(0, 0, 0, .1);" onclick="toggleFilterDropdown(2)">
                                <div>Semua</div>
                                <i class="fa fa-angle-right ml-auto" aria-hidden="true"></i>
                            </button>
   
                            <div class="dropdown-filter">
                                <div class="card p-2">
                                    <div class="collapse-item d-flex justify-content-between align-items-center cloud-font p-2" wire:click="setRadiusFilter(10)">
                                        <div> < 10 KM</div>
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </div>
                                    <div class="collapse-item d-flex justify-content-between align-items-center cloud-font p-2" wire:click="setRadiusFilter(20)">
                                        <div> < 20 KM</div>
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </div>
                                    <div class="collapse-item d-flex justify-content-between align-items-center cloud-font p-2" wire:click="setRadiusFilter(30)">
                                        <div> < 30 KM</div>
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </div>
                                    <div class="collapse-item d-flex justify-content-between align-items-center cloud-font p-2" wire:click="setRadiusFilter(40)">
                                        <div> < 40 KM</div>
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </div>
                                    <div class="collapse-item d-flex justify-content-between align-items-center cloud-font p-2" wire:click="setRadiusFilter(50)">
                                        <div> < 50 KM</div>
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-10">
                <div class="d-md-flex align-items-center">
                    <div class="filter-box d-inline-flex align-items-center" style="background-color: white; color:#6F472B; border: 2px solid #A9907E">
                        <p class="m-0">Menampilkan hasil dalam radius : {{ $radius }} km</p>
                    </div>
                    @if($hewan)
                    <div class="filter-box d-flex align-items-center ml-2">
                        <p class="m-0">{{ ucfirst($hewan) }}</p>
                        <i class="fa fa-times ml-2" wire:click="unsetAnimalFilter()" role="button"></i>
                    </div>
                    @endif
                    @if($age)
                    <div class="filter-box d-flex align-items-center ml-2">
                        <p class="m-0">{{ ucfirst($age) }}</p>
                        <i class="fa fa-times ml-2" wire:click="unsetAgeFilter()" role="button"></i>
                    </div>
                    @endif
                    @if($search)
                    <div class="filter-box d-flex align-items-center ml-2">
                        <p class="m-0">"{{ ucfirst($search) }}"</p>
                        <i class="fa fa-times ml-2" wire:click="unsetSearchFilter()" role="button"></i>
                    </div>
                    @endif
                    <div class="badge text-wrap p-2 ml-auto" style="background-color:white">
                        <i class="fa-solid fa-location-dot"></i> {{ $address }}
                    </div>
                    
                </div>
                <div class="row mt-2">
                    @if($isSetCoordinate)
                    @foreach($animals as $animal)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-3" @if ($loop->last) id="last_record" @endif>
                        <a href="{{ route('detail-animal', ['id_animal' => $animal->id_animal]) }}">
                            <div class="card product-card shadow-sm">
                                <img src="{{ asset('/animal_photos/'.$animal->thumbnail) }}" class="card-img-top" style="height:170px; width:100%;  object-fit:cover">

                                <div class="card-body">
                                    <div class="text-title-card judul-post-text">
                                        <h5 class="inter-font" style="font-size:18px">{{ $animal->judul_post }}</h5>
                                    </div>
                                    <h5 class="roboto-title">Rp. {{ number_format($animal->harga,0,',','.') }}</h5>
                                    <p class="m-0" style="font-size:14px"><i class="fa fa-map-marker" style="font-size:14px"></i> {{ $animal->kecamatan }}</p>

                                    <p class="mt-1" style="font-size:14px"><i class="fa-solid fa-store" style="font-size:11px"></i> {{ $animal->nama_toko }}</p>
                                    <!-- <a href="{{ route('detail-animal', ['id_animal' => $animal->id_animal]) }}" class="btn btn-primary"><small>Lihat Detail</small></a> -->
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>

        </div>

    </div>
    <div wire:loading.flex class="homeLoader">
        <div class="spinner-border" role="status">
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="welcomeModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modalId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="d-flex flex-column align-items-center justify-items-center">
                        <h4 class="text-center">Halo 👋, Selamat datang di PetZilla </h4>
                        <p class="m-0 mt-3 text-center">Sekarang Kamu tinggal dimana ? </p>
                        <div class="position-relative">
                            <input type="text" class="search-input" wire:model.debounce.500ms="searchCity" style="width: 600px; margin-bottom:0px; border-radius:5px" placeholder="Cari tempat tinggal mu saat ini.. cth : (Kabupaten XXX, Kecamatan XXX)">
                            @if(!empty($searchResult))
                                <div class="resultBox">
                                    @foreach($searchResult as $result)
                                        <div class="child" wire:click="handleClickedCity('{{ $result }}')">{{ $result }}</div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <p class="text-center font-weight-bold mt-2">atau</p>
                        <div class="d-flex align-items-center">
                            <button class="btn btn-outline-primary" onclick="getLocation()"><i class="fa-solid fa-location-crosshairs"></i> Gunakan Lokasi Saya Saat Ini</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        window.addEventListener('able-to-scroll',function(){
            const lastRecord = document.getElementById('last_record');
            if(lastRecord)
            {
                const options = {
                    root: null,
                    threshold: 1,
                    rootMargin: '0px'
                }
                const observer = new IntersectionObserver((entries, observer, options) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            @this.loadMore()
                        }
                    });
                });
                observer.observe(lastRecord);
            }
        });
      

    </script>
    <script>

        function toggleFilterDropdown(data) {
            const filter = document.getElementsByClassName("dropdown-filter");
            filter[data].classList.toggle('active');
        }
        window.addEventListener('close-modal',function(){
            $("#welcomeModal").modal('hide');
        });
        $(document).ready(function(){
            if(!'{!!$isSetCoordinate!!}')
            {
                $("#welcomeModal").modal('show');
            } else {
                const lastRecord = document.getElementById('last_record');
                if(lastRecord)
                {
                    const options = {
                        root: null,
                        threshold: 1,
                        rootMargin: '0px'
                    }
                    const observer = new IntersectionObserver((entries, observer, options) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                @this.loadMore()
                            }
                        });
                    });
                    observer.observe(lastRecord);
                }  
            }
        });

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(successFunction, errorFunction);
            } else { 
                console.log("Geolocation is not supported by this browser.");
            }
        }
        function successFunction(position) {
            console.log(position.coords);
            const coordinate = {
                latitude : position.coords.latitude,
                longitude : position.coords.longitude
            }
            @this.locationFounded(coordinate)
        }

        function errorFunction() {
            console.log("Unable to retrieve your location.");
        }

    </script>
    @endpush
</div>