<div>
    <h5 class="mb-0">Verifikasi Pembayaran</h5>

    <div class="card shadow-sm mt-2">
        <div class="card-body py-1">
            <table class="tableProduk">
                <thead>
                    <tr>
                        <th width="">ID TRANSAKSI</th>
                        <th width="">PEMBELI</th>
                        <th width="">METODE PEMBAYARAN</th>
                        <th width="">TOTAL</th>
                        <th class="text-center" width="">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id_transaction }}</td>
                        <td>{{ $transaction->user->name }}</td>
                        <td>{{ $transaction->pembayaran->jenis_rekening }}</td>
                        <td> Rp. {{ number_format($transaction->grand_total,0,',','.') }}</td>
                        <td class="text-center">
                            <a href="#" wire:click.prevent="openDetailModal('{{ $transaction->id_transaction }}')" data-toggle="modal" data-target="#detailPembayaranModal"><i class="fa-solid fa-eye"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">{{ $transactions->links() }}</div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="detailPembayaranModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modalId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header px-4">
                    <h4 class="modal-title">Detail Pembayaran</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times
                    </button>
                </div>
                @if($currentDetailPembayaranModal == 1)
                <div class="modal-body">
                    <div class="container">
                        <h5>Rincian Transaksi</h5>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>ID TRANSAKSI</div>
                            <div>{{ $selectedTransaction->id_transaction }}</div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>Tanggal Transaksi Dibuat</div>
                            <div>{{ date('d F Y, H:i \W\I\B', strtotime($selectedTransaction->created_at)) }}</div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>Nama Produk</div>
                            <div>{{ $selectedTransaction->animal->judul_post }}</div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>Jumlah Pembelian</div>
                            <div>{{ $selectedTransaction->qty }}x Rp.{{ number_format($selectedTransaction->animal->harga,0,',','.') }}</div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>Jasa Pengiriman</div>
                            <div>{{ $selectedTransaction->pengiriman->jasa_pengiriman }}</div>
                        </div>
                        <div class="d-flex justify-content-end align-items-center mt-3">
                            <div class="border rounded bg-light py-2 px-3" style="width:60%">
                                <div class="d-flex justify-content-between">
                                    <div class="gotham">Subtotal</div>
                                    <div class="font-weight-bold">Rp.{{ number_format($selectedTransaction->sub_total,0,',','.') }}</div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <div class="gotham">Biaya Pengiriman</div>
                                    <div class="font-weight-bold">Rp.{{ number_format($selectedTransaction->pengiriman->biaya_pengiriman,0,',','.') }}</div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <div class="gotham">Total Harga</div>
                                    <div class="font-weight-bold">Rp.{{ number_format($selectedTransaction->sub_total,0,',','.') }}</div>
                                </div>
                            </div>
                        </div>
                        <h5 class="mt-2">Bukti Pembayaran</h5>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>Tipe Pembayaran</div>
                            <div>{{ $selectedTransaction->pembayaran->tipe_rekening }}</div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>Jenis Rekening</div>
                            <div>{{ $selectedTransaction->pembayaran->jenis_rekening }}</div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>Nama Rekening Pengirim</div>
                            <div>{{ $selectedTransaction->pembayaran->nama_rekening }}</div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>Nomor Rekening Pengirim</div>
                            <div>{{ $selectedTransaction->pembayaran->nomor_rekening }}</div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <div>Foto Bukti Pembayaran</div>
                            <img src="{{ asset($selectedTransaction->pembayaran->bukti_pembayaran) }}" id="buktiPembayaran" class="card-img-top" style="max-height:200px; width:auto" onclick="openImage()">

                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" >Tolak Pembayaran</button>

                    <button type="button" class="btn btn-primary" onclick="modalConfirmation('{{ $selectedTransaction->id_transaction }}')">Setujui Pembayaran</button>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div id="image-viewer">
        <span class="close"><i class="fa fa-xmark" data-dismiss="modal"></i></span>
        <img class="modal-content" id="full-image">
    </div>
    @push('scripts')
    <script>
        function openImage() {
            var src = document.getElementById("buktiPembayaran").src;
            $("#full-image").attr("src", src);
            $('#image-viewer').show();

            $("#image-viewer .close").click(function() {
                $('#image-viewer').hide();
            });
        }

        function modalConfirmation(element) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Menyetujui pembayaran ini akan mengupdate status transaksi",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Saya Setuju'
            }).then((result) => {
                if (result.isConfirmed) {

                    Livewire.emit('modalConfirmed', element);

                    Swal.fire(
                        'Succeed!',
                        'Transaksi berhasil diupdate',
                        'success'
                    ).then(() => {
                        window.location.href = "/admin/verifikasi_pembayaran";
                    });
                }
            })
        }
    </script>
    @endpush
</div>