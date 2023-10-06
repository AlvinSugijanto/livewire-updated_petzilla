<div>
    <h5 class="mb-0">Daftar Transaksi Bermasalah</h5>
    <div class="card shadow-sm mt-2">
        <div class="card-body py-1">
            <table class="tableProduk">
                <thead>
                    <tr>
                        <th width="">TANGGAL</th>
                        <th width="">ID TRANSAKSI</th>
                        <th width="">INFO PRODUK</th>
                        <th width="">PEMBELI</th>
                        <th width="" class="text-center">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($complains as $complain)
                    <tr>
                        <td>{{ date('d/m/Y H:i', strtotime($complain->created_at)) }}</td>
                        <td>{{ $complain->transaction->id_transaction }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('/animal_photos/'.$complain->transaction->detailTransaction[0]->animal->thumbnail) }}" class="card-img-top" style="height:60px; width:50px; object-fit:cover">
                                <div class="px-2">
                                    <div>{{$complain->transaction->detailTransaction[0]->animal->judul_post}}</div>
                                    <small class="text-muted mt-2">+{{ count($complain->transaction->detailTransaction)-1 }} item lainnya</small>

                                </div>
                            </div>
                        </td>
                        <td>{{ $complain->transaction->user->name }}</td>
                        <td class="text-center">
                            <!-- <a href="#" wire:click.prevent="openDetailModal('{{ $complain->id }}')" data-toggle="modal" data-target="#detailComplainModal"><i class="fa-solid fa-eye"></i></a> -->
                            <a href="{{ route('detail-report', ['id_transaction' => $complain->transaction->id_transaction]) }}"><button class="btn btn-primary btn-sm"> <i class="fa fa-solid fa-eye"></i> Lihat Detail</button></a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">{{ $complains->links() }}</div>
        </div>
    </div>
    <!-- <div wire:ignore.self class="modal fade" id="detailComplainModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modalId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header px-4">
                    <h4 class="modal-title">Detail Laporan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times
                    </button>
                </div>
                @if($currentDetailComplainModal == 1)
                <div class="modal-body">
                    <div class="container">
                        <h5>Informasi Transaksi</h5>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>ID TRANSAKSI</div>
                            <div>{{ $selectedTransaction->transaction->id_transaction }}</div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>Tanggal Transaksi Dibuat</div>
                            <div>{{ date('d F Y, H:i \W\I\B', strtotime($selectedTransaction->transaction->created_at)) }}</div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>Nama Produk</div>
                            <div>{{ $selectedTransaction->transaction->animal->judul_post }}</div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>Jumlah Pembelian</div>
                            <div>{{ $selectedTransaction->transaction->qty }}x Rp.{{ number_format($selectedTransaction->transaction->animal->harga,0,',','.') }}</div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>Jasa Pengiriman</div>
                            <div>{{ $selectedTransaction->transaction->pengiriman->jasa_pengiriman }}</div>
                        </div>
                        <div class="d-flex justify-content-end align-items-center mt-3">
                            <div class="border rounded bg-light py-2 px-3" style="width:60%">
                                <div class="d-flex justify-content-between">
                                    <div class="gotham">Subtotal</div>
                                    <div class="font-weight-bold">Rp.{{ number_format($selectedTransaction->transaction->sub_total,0,',','.') }}</div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <div class="gotham">Biaya Pengiriman</div>
                                    <div class="font-weight-bold">Rp.{{ number_format($selectedTransaction->transaction->pengiriman->biaya_pengiriman,0,',','.') }}</div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <div class="gotham">Total Harga</div>
                                    <div class="font-weight-bold">Rp.{{ number_format($selectedTransaction->transaction->sub_total,0,',','.') }}</div>
                                </div>
                            </div>
                        </div>
                        <hr style="margin-top:15px; margin: bottom 15px; border-top : 2px solid rgba(0,0,0,.2)">
                        <h5>Informasi Laporan</h5>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>ID LAPORAN</div>
                            <div>{{ $selectedTransaction->id }}</div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>Laporan Dibuat Pada</div>
                            <div>{{ date('d F Y, H:i \W\I\B', strtotime($selectedTransaction->created_at)) }}</div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="w-50">Komentar</div>
                            <div class="w-50 text-right">{{ $selectedTransaction->komentar }}</div>
                        </div>
                        <hr>
                        <div class="d-flex">
                            <div>Foto</div>
                            <div class="ml-auto w-50 text-right">

                                @foreach($selectedTransaction->photo as $photo)
                                <img src="{{ asset('/animal_photos/'.$photo->photo) }}" id="fotoLaporan" class="card-img-top mb-2" style="height:80px; width:80px; object-fit:cover" onclick="openImage(this)">

                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>

                @endif
            </div>
        </div>
    </div> -->
    <div id="image-viewer">
        <span class="close"><i class="fa fa-xmark" data-dismiss="modal"></i></span>
        <img class="modal-content" id="full-image">
    </div>
    @push('scripts')
    <script>
        function openImage(element) {
            var src = element.src;
            $("#full-image").attr("src", src);
            $('#image-viewer').show();

            $("#image-viewer .close").click(function() {
                $('#image-viewer').hide();
            });
        }
    </script>
    @endpush
</div>