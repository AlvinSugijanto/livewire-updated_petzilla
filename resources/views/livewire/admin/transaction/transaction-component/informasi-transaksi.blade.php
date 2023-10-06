<div>
    <h5 class="mt-4">Informasi Transaksi</h5>
    <div class="d-flex justify-content-between align-items-center mt-3">
        <div>ID TRANSAKSI</div>
        <div>{{ $transaction->id_transaction }}</div>
    </div>
    <hr>
    <div class="d-flex justify-content-between align-items-center">
        <div>Nilai Pembelian</div>
        <div class="font-weight-bold">
            Rp.{{ number_format($transaction->grand_total - $transaction->pengiriman->biaya_pengiriman, 0, ',', '.') }}
        </div>
    </div>
    <hr>
    <div class="d-flex justify-content-between align-items-center">
        <div class="w-50">Penjual</div>
        <div class="w-50 text-right">{{ $transaction->store->nama_toko }}</div>
    </div>
    <hr>
    <div class="d-flex justify-content-between align-items-center">
        <div class="w-50">Pembeli</div>
        <div class="w-50 text-right">{{ $transaction->user->name }}</div>
    </div>
    <hr>
    <div class="d-flex justify-content-between align-items-center">
        <div>Total Pembelian</div>
        <div class="font-weight-bold">Rp.{{ number_format($transaction->grand_total,0,',','.') }}</div>
    </div>
    <hr>

    <h5 class="mt-4">Informasi Pengiriman</h5>
    <div class="d-flex justify-content-between align-items-center mt-3">
        <div>Jasa Pengiriman</div>
        <div>{{ $transaction->pengiriman->jasa_pengiriman }}</div>
    </div>
    <hr>
    <div class="d-flex justify-content-between align-items-center mt-3">
        <div>Biaya Pengiriman</div>
        <div class="font-weight-bold">Rp. {{ number_format($transaction->pengiriman->biaya_pengiriman,0,',','.') }}</div>
    </div>
    <hr>
    <div class="d-flex justify-content-between align-items-center mt-3">
        <div>Bukti Pengiriman</div>
        <img src="{{ asset('animal_photos/' . $transaction->pengiriman->bukti_pengiriman) }}" id="buktiPembayaran" class="card-img-top" style="max-height:200px; width:auto" onclick="openImage(this)">
    </div>
    <hr>


    <h5 class="mt-4">Informasi Pembayaran</h5>
    <div class="d-flex justify-content-between align-items-center mt-3">
        <div>Tipe Pembayaran</div>
        <div>{{ $transaction->pembayaran->tipe_rekening }}</div>
    </div>
    <hr>
    <div class="d-flex justify-content-between align-items-center">
        <div>Jenis Rekening</div>
        <div>{{ $transaction->pembayaran->jenis_rekening }}</div>
    </div>
    <hr>
    <div class="d-flex justify-content-between align-items-center">
        <div>Nama Rekening Pengirim</div>
        <div>{{ $transaction->pembayaran->nama_rekening }}</div>
    </div>
    <hr>
    <div class="d-flex justify-content-between align-items-center">
        <div>Nomor Rekening Pengirim</div>
        <div>{{ $transaction->pembayaran->nomor_rekening }}</div>
    </div>
    <hr>
    <div class="d-flex justify-content-between">
        <div>Foto Bukti Pembayaran</div>
        <img src="{{ asset('animal_photos/' . $transaction->pembayaran->bukti_pembayaran) }}" id="buktiPembayaran" class="card-img-top" style="max-height:200px; width:auto" onclick="openImage(this)">

    </div>
</div>