<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h5 class="mb-0">Ulasan</h5>

                <div class="card mt-3 shadow-sm">
                    <div class="p-4">
                        <h5>Rata-rata rating produk</h5>

                        <h2 class="mt-3 mb-0"><i class="fa fa-star text-warning"></i> {{ round($avg_rating,1) }}<span class="text-muted" style="font-size:16px"> / 5.0</span></h2>
                    </div>
                    <div class="p-2">
                        <table class="tableProduk">
                            <thead>
                                <tr class="border-top">
                                    
                                    <th width="40%">INFO PRODUK</th>
                                    <th class="" width="20%">DARI</th>
                                    <th width="15%">RATING</th>
                                    <th width="25%">REVIEW</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rating as $data)
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <img src="{{ asset('/animal_photos/'.$data->transaction->animal->thumbnail) }}" class="card-img-top" style="height:60px; width:50px; object-fit:cover">
                                            <div class="px-2">
                                                <h6 class="mb-0">{{$data->transaction->animal->judul_post}}</h6>
                                                <small>Warna : {{$data->transaction->animal->warna}}</small>
                                                <p class="m-0"></p>
                                                <small>Umur : {{$data->transaction->animal->umur}} {{$data->transaction->animal->satuan_umur}}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $data->transaction->user->name }}</td>
                                    <td><i class="fa fa-star text-warning"></i> {{ $data->rating }}</td>
                                    <td>
                                        <div class="judul-post-text">
                                            {{ $data->review }}
                                        </div>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">{{ $rating->links() }}</div>
                </div>

            </div>
        </div>
    </div>
</div>