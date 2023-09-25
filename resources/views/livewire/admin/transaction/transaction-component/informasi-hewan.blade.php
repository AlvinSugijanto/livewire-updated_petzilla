<div>
    <h5 class="mt-4">Informasi Hewan</h5>
    <div class="d-flex justify-content-between align-items-center mt-3">
        <div>ID HEWAN</div>
        <div>{{ $transaction->animal->id_animal }}</div>
    </div>
    <hr>
    <div class="d-flex justify-content-between align-items-center">
        <div>Judul Post</div>
        <div>{{ $transaction->animal->judul_post }}</div>
    </div>
    <hr>
    <div class="d-flex justify-content-between align-items-center">
        <div>Harga</div>
        <div>Rp. {{ number_format($transaction->animal->harga ,0,',','.') }} </div>
    </div>
    <hr>
    <div class="d-flex justify-content-between align-items-center">
        <div>Warna</div>
        <div>{{ $transaction->animal->warna ? $transaction->animal->warna : '-' }}</div>
    </div>
    <hr>
    <div class="d-flex justify-content-between align-items-center">
        <div>Umur</div>
        <div>{{ $transaction->animal->umur }}</div>
    </div>
    <hr>
    <div class="d-flex justify-content-between align-items-center">
        <div>Thumbnail Foto</div>
        <img src="{{ asset('/animal_photos/'.$transaction->animal->thumbnail) }}" id="fotoLaporan" class="card-img-top mb-2" style="height:80px; width:80px; object-fit:cover" onclick="openImage(this)">
    </div>
    <hr>
    <div class="d-flex">
        <div>Tambahan Foto</div>
        <div class="ml-auto w-50 text-right">
            @foreach($transaction->animal->animal_photo as $photo)
            <img src="{{ asset('/animal_photos/'.$photo->photo) }}" id="fotoLaporan" class="card-img-top mb-2" style="height:80px; width:80px; object-fit:cover" onclick="openImage(this)">
            @endforeach
        </div>
    </div>
    <hr>
    <div class="d-flex align-items-center">
        <div>Surat Keterangan Sehat</div>
        <div class="form-control pr-4 ml-5" id="suratKeteranganSehat" style="width: 500px;" readonly>{{ $transaction->animal->surat_keterangan_sehat }}</div>
        <a href="#" class="ml-auto" onclick="openSuratKeteranganSehat()">
            <h6 class="text-primary"><i class="fa fa-eye text-primary ml-2"></i> View</h6>
        </a>
    </div>
    <hr>
    <div class="d-flex align-items-center">
        <div>Sertifikat Pedigree</div>
        <div class="form-control pr-4 ml-5" id="sertifikatPedigree" style="width: 500px;" readonly>{{ $transaction->animal->sertifikat_pedigree ? $transaction->animal->sertifikat_pedigree : '-' }}</div>
        <a href="#" class="ml-auto" onclick="openSertifikatPedigree()">
            <h6 class="text-primary"><i class="fa fa-eye text-primary ml-2"></i> View</h6>
        </a>
    </div>
</div>