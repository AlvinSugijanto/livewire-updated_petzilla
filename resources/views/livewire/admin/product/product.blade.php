<div>
    <h5 class="mb-0">Daftar Produk</h5>
    <!-- <a href="/admin/review_product">
        <div class="d-flex align-items-center alert-warning mb-0 mt-2 alert-product">
            <i class="fa fa-shopping-bag mr-1" aria-hidden="true"></i>
            <div>There is 1 product waiting for confirmation</div>
            <div class="ml-auto">></div>
        </div>
    </a> -->
    <div class="d-flex daftar_produk mt-3">
        <button class="btn btn-outline-primary @if($type == 'aktif') active @endif" wire:click="updateType('aktif')">Active</button>
        <button class="btn btn-outline-primary ml-2 @if($type == 'dalam_persetujuan') active @endif" wire:click="updateType('dalam_persetujuan')">Waiting For Confirmation</button>
        <input type="text" placeholder="Search here..." class="w-25 border rounded p-2 ml-auto" wire:model.debounce.500ms="searchTerm">
    </div>
    <div class="card shadow-sm mt-2">
        <div class="card-body py-1">
            <table class="tableProduk">
                <thead>
                    <tr>
                        <th width="25%">INFO PRODUK</th>
                        <th width="">LISTED AT</th>
                        <th width="">LISTED BY</th>
                        <th width="">JENIS</th>
                        <th class="text-center">STATUS</th>
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
                        <td>
                            @if($animal->status == 'aktif')
                            <div class="border rounded p-2 text-center" style="font-size:12px; background-color: rgb(214, 255, 222); color : rgb(3, 172, 14)">Aktif</div>
                            @elseif ($animal->status == 'dalam_persetujuan')
                            <div class="border rounded p-2 text-center" style="font-size:12px; background-color: #FEEAB7; color : grey">Menunggu Konfirmasi</div>

                            @endif
                        </td>
                        <td class="text-center">Rp. {{ number_format($animal->harga,0,',','.') }}</td>
                        <td class="text-center">
                            @if($type == 'aktif')
                            <a href="{{ route('detail-product', ['id_animal' => $animal->id_animal]) }}"><button class="btn btn-primary btn-sm"> <i class="fa fa-solid fa-eye"></i> Lihat Detail</button></a>
                            @endif
                            @if($type == 'dalam_persetujuan')
                            <a href="{{ route('detail-product', ['id_animal' => $animal->id_animal]) }}"><i class="fa fa-solid fa-eye"></i></a>
                            <a href="javascript:void(0)" onclick="modalConfirmation('{{ $animal->id_animal }}')"><i class="fa fa-pencil-square-o text-primary" aria-hidden="true"></i></a>

                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">{{ $animals->links() }}</div>
        </div>
    </div>
    @push('scripts')
    <script>
        function modalConfirmation(element) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Update status hewan menjadi Aktif",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Saya akan update'
            }).then((result) => {
                if (result.isConfirmed) {

                    Livewire.emit('modalConfirmed', element);
                    Swal.fire(
                        'Succeed!',
                        'Transaksi berhasil diupdate',
                        'success'
                    ).then(() => {
                        window.location.href = "/admin/product";
                    });

                }
            })
        }
    </script>
    @endpush
</div>