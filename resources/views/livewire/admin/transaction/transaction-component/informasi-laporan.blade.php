<div>
    <h5 class="mt-3">Informasi Laporan</h5>
    <div class="d-flex justify-content-between align-items-center mt-3">
        <div>ID LAPORAN</div>
        <div>{{ $transaction->complain->id }}</div>
    </div>
    <hr>
    <div class="d-flex justify-content-between align-items-center">
        <div>Laporan Dibuat Pada</div>
        <div>{{ date('d F Y, H:i \W\I\B', strtotime($transaction->complain->created_at)) }}</div>
    </div>
    <hr>
    <div class="d-flex justify-content-between align-items-center">
        <div class="w-50">Komentar</div>
        <div class="w-50 text-right">{{ $transaction->complain->komentar }}</div>
    </div>
    <hr>
    <div class="d-flex">
        <div>Foto</div>
        <div class="ml-auto w-50 text-right">

            @foreach($transaction->complain->photo as $photo)
            <img src="{{ asset('/animal_photos/'.$photo->photo) }}" id="fotoLaporan" class="card-img-top mb-2" style="height:80px; width:80px; object-fit:cover" onclick="openImage(this)">

            @endforeach
        </div>

    </div>
</div>