<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h5 class="mb-0">Daftar Review</h5>

                <div class="card mt-3 shadow-sm">
                    <div class="card-body py-1">
                        <table class="tableProduk">
                            <thead>
                                <tr>
                                    <th width="40%">INFO PRODUK</th>
                                    <th class="text-center" width="20%">DARI</th>
                                    <th width="15%" class="text-center">RATING</th>
                                    <th width="25%" class="text-center">REVIEW</th>

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
                                    <td class="text-center">{{ $data->transaction->user->name }}</td>
                                    <td class="text-center">{{ $data->rating }}</td>
                                    <td class="text-center">{{ $data->review }}</td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">{{ $rating->links() }}</div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>