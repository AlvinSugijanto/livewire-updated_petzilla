<div>
    <h5 class="mb-0">Daftar Produk</h5>
    <a href="/admin/review_product">
        <div class="d-flex align-items-center alert-warning mb-0 mt-2 alert-product">
            <i class="fa fa-shopping-bag mr-1" aria-hidden="true"></i>
            <div>There is 1 product waiting for confirmation</div>
            <div class="ml-auto">></div>
        </div>
    </a>

    <div class="card shadow-sm mt-2">
        <div class="card-body py-1">
            <table class="tableProduk">
                <thead>
                    <tr>
                        <th width="25%">INFO PRODUK</th>
                        <th width="">LISTED AT</th>
                        <th width="">LISTED BY</th>
                        <th width="">JENIS</th>
                        <th class="text-center" width="">HARGA</th>
                        <th class="text-center" width="">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($animals as $animal)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('/animal_photos/'.$animal->thumbnail) }}" class="card-img-top" style="height:60px; width:50px; object-fit:cover">
                                <div class="px-2">
                                    <div>{{$animal->judul_post}}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ date('d/m/Y H:i', strtotime($animal->created_at)) }}</td>
                        <td>{{ $animal->store->nama_toko }}</td>

                        <td>{{ ucwords($animal->jenis_hewan) }}</td>
                        <td class="text-center">Rp. {{ number_format($animal->harga,0,',','.') }}</td>
                        <td class="text-center">
                            <a href="{{ route('detail-product', ['id_animal' => $animal->id_animal]) }}"><button class="btn btn-primary btn-sm">Lihat Detail</button></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">{{ $animals->links() }}</div>
        </div>
    </div>

</div>