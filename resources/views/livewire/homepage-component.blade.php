<div>

    <div class="container-fluid px-5">
        <div class="row">
            <div class="col-md-2">
                <div class="card" style="min-height:400px">
                    <div class="card-body py-3 px-4">
                        <h5 class="inter-font mb-0 text-center">Filters</h5>
                        <hr>
                        <div class="filter-group">
                            <h6 class="text-center">Jenis Hewan</h6>
                            <button class="d-flex align-items-center form-control shadow-sm text-center" style="border: 1px solid rgb(0, 0, 0, .1);" data-toggle="collapse" href="#collapseJenis">
                                <div>Semua</div>
                                <i class="fa fa-angle-right ml-auto" aria-hidden="true"></i>
                            </button>
                            <div class="collapse collapse-filter mt-1" id="collapseJenis">
                                <div class="card p-2">
                                    <div class="collapse-item d-flex justify-content-between align-items-center cloud-font p-2">
                                        <div>Semua</div>
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </div>
                                    <div class="collapse-item d-flex justify-content-between align-items-center cloud-font p-2">
                                        <div>Anjing</div>
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </div>
                                    <div class="collapse-item d-flex justify-content-between align-items-center cloud-font p-2">
                                        <div>Kucing</div>
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="filter-group mt-3">
                            <h6 class="text-center">Ras</h6>
                            <button class="d-flex align-items-center form-control shadow-sm text-center" style="border: 1px solid rgb(0, 0, 0, .1);" data-toggle="collapse" href="#collapseRas">
                                <div>Semua</div>
                                <i class="fa fa-angle-right ml-auto" aria-hidden="true"></i>
                            </button>
                            <div class="collapse collapse-filter mt-1" id="collapseRas">
                                <div class="card p-2">
                                    <div class="collapse-item d-flex justify-content-between align-items-center cloud-font p-2">
                                        <div>Semua</div>
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </div>
                                    <div class="collapse-item d-flex justify-content-between align-items-center cloud-font p-2">
                                        <div><i class="fa-solid fa-dog"></i> Anjing</div>
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </div>
                                    <div class="collapse-item d-flex justify-content-between align-items-center cloud-font p-2">
                                        <div><i class="fa-solid fa-cat"></i> Kucing</div>
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter-group mt-3">
                            <h6 class="text-center">Umur</h6>
                            <button class="d-flex align-items-center form-control shadow-sm text-center" style="border: 1px solid rgb(0, 0, 0, .1);" data-toggle="collapse" href="#collapseUmur">
                                <div>Semua</div>
                                <i class="fa fa-angle-right ml-auto" aria-hidden="true"></i>
                            </button>
                            <div class="collapse collapse-filter mt-1" id="collapseUmur">
                                <div class="card p-2">
                                    <div class="collapse-item d-flex justify-content-between align-items-center cloud-font p-2">
                                        <div>Semua</div>
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </div>
                                    <div class="collapse-item d-flex justify-content-between align-items-center cloud-font p-2">
                                        <div> < 3 bulan</div>
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </div>
                                    <div class="collapse-item d-flex justify-content-between align-items-center cloud-font p-2">
                                        <div> < 1 tahun</div>
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </div>
                                    <div class="collapse-item d-flex justify-content-between align-items-center cloud-font p-2">
                                        <div> < 2 tahun</div>
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="filter-categories mt-4">
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
                        </div> -->
                    </div>
                </div>

            </div>

            <div class="col-md-10">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="m-0 p-0">Menampilkan hasil dengan radius < 50km</p>
                            <div class="badge text-wrap p-2" style="background-color:white">
                                <i class="fa-solid fa-truck"></i> Dikirim ke {{ $user->alamat }}
                            </div>
                </div>
                <div class="row mt-2">
                    @foreach($animals as $animal)
                    <div class="col-lg-3 col-md-4 mb-3" @if ($loop->last) id="last_record" @endif>
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
                </div>
            </div>

        </div>

    </div>

    @push('scripts')
    <script>
        const lastRecord = document.getElementById('last_record');
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
    </script>
    @endpush
</div>