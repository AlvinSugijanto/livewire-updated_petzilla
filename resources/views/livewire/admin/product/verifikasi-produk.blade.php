<div>
    <h5 class="mb-0">Daftar Verifikasi Produk</h5>
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
                            <a href="javascript:void(0)" onclick="modalConfirmation('{{ $animal->id_animal }}')"><i class="fa fa-pencil-square-o text-primary" aria-hidden="true"></i></a>
                            <a href="{{ route('detail-product', ['id_animal' => $animal->id_animal]) }}"><i class="fa-solid fa-eye"></i></a>

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
                        window.location.href = "/admin/review_product";
                    });

                }
            })
        }
    </script>
    @endpush
</div>