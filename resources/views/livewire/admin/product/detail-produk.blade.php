<div>
    <div class="container-fluid mb-5">
        <button class="btn btn-primary btn-sm" wire:click="goBack()">&#60; Kembali</button>
        <h5 class="mt-2">Detail Produk</h5>
        <div class="card">
            <div class="card-body">
                <h6>Informasi Produk</h6>
                <hr>
                <div class="form-group row align-items-center">
                    <label for="student_id" class="col-3">Jenis Hewan</label>
                    <div class="col-9">
                        <div class="form-control">{{ $jenis_hewan }}</div>
                    </div>
                </div>

                <div class="form-group row align-items-center">
                    <label for="name" class="col-3">Judul Post <span style="color:red">*<span></label>
                    <div class="col-9">
                        <div class="form-control">{{ $judul_post }}</div>
                    </div>
                </div>

                <div class="form-group row align-items-center">
                    <label for="phone" class="col-3">Harga <span style="color:red">*<span></label>

                    <div class="col-4">
                        <div class="font-weight-bold text-secondary">Rp. {{ number_format($harga,0,',','.') }}</div>

                    </div>
                </div>

            </div>
        </div>

        <div class="card mt-2">
            <div class="card-body">
                <h6>Detail Produk</h6>
                <hr>

                <div class="form-group row">
                    <label for="warna" class="col-3">Warna</label>
                    <div class="col-6">
                        <div>{{ $warna ? $warna : '-' }}</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-3">Umur </label>
                    <div class="col-6">
                        <div>{{ $umur ? $umur : '-' }}</div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-3">Deskripsi</label>
                    <div class="col-9">
                        <textarea id="w3review" class="form-control" rows="4" cols="56">{{ $deskripsi }}</textarea>
                    </div>
                </div>

            </div>
        </div>

        <div class="card mt-2">
            <div class="card-body">
                <h6>Foto Produk</h6>
                <hr class="mb-1">

                <div class="form-group row mt-2">
                    <div class="col-3 d-flex flex-column">
                        <label class="m-0">Thumbnail Foto</label>
                    </div>
                    <div class="col-6">
                        @if($display_photo)
                        <img src="{{ asset('/animal_photos/'.$display_photo) }}" class="mt-2 img-thumbnail" style="max-height:120px;">
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-3">Tambahan Foto</label>
                    <div class="col-9">
                        <div class="row col-12">
                            @if(!empty($display_photos))
                            @foreach($display_photos as $photo)
                            <div class="image-hover mt-2 gx-2">
                                <img src="{{ asset('/animal_photos/'.$photo->photo) }}" class="img-thumbnail img-hover" style="max-height:120px;">
                            </div>
                            @endforeach
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-2">
            <div class="card-body">
                <h6>Dokumen Produk</h6>
                <hr class="mb-1">
                <small style="color:#FF6843" class="">file type: jpg, png, pdf (max size 2mb)</small>

                <div class="form-group row mt-2 align-items-center">
                    <label class="col-3"> Surat Keterangan Sehat</label>
                    <div class="col-3">
                        <div class="form-control pr-4" id="suratKeteranganSehat" readonly>{{ $surat_keterangan_sehat }}</div>
                    </div>
                    <div class="col-3">
                        <a href="#" class="surat_keterangan_file">
                            <h6 class="mb-0 ml-1 text-primary"><i class="fa fa-eye text-primary ml-2"></i> View</h6>
                        </a>
                    </div>
                </div>

                <div class="form-group row mt-2 align-items-center">
                    <div class="col-3">
                        <label>Sertifikat Pedigree</label>
                    </div>
                    <div class="col-3">
                        <div class="form-control pr-4" id="sertifikatFile" readonly>{{ $sertifikat_pedigree ? $sertifikat_pedigree : '-' }}</div>
                    </div>
                    <div class="col-3">
                        @if($sertifikat_pedigree)
                        <a href="#" class="sertifikat_file">
                            <h6 class="mb-0 ml-1 text-primary"><i class="fa fa-eye text-primary ml-2"></i> View</h6>
                        </a>
                        @endif
                    </div>

                </div>

            </div>
        </div>
        @if($animal->status != 'aktif')
        <div class="d-flex justify-content-end mt-3">
            <a href="javascript:void(0)" onclick="tolakProdukConfirmation('{{ $animal->id_animal }}')"><button class="btn btn-danger">Tolak Produk</button></a>
            <a href="javascript:void(0)" onclick="setujuiProdukConfirmation('{{ $animal->id_animal }}')"><button class="btn btn-primary ml-2">Setujui Produk</button></a>

        </div>
        @endif

    </div>
    <div id="image-viewer">
        <span class="download" onclick="downloadImage()"><i class="fa fa-download"></i></span>
        <span class="close"><i class="fa fa-xmark"></i></span>

        <img class="modal-content" id="full-image">
    </div>
    @push('scripts')
    <script>
        $(".surat_keterangan_file").click(function() {
            console.log('test');
            var surat = $('#suratKeteranganSehat').text();
            var imagePath = "{{ asset('/animal_photos/') }}" + '/' + surat;

            $("#full-image").attr("src", imagePath);
            $('#image-viewer').show();
        });
        $(".sertifikat_file").click(function() {
            var surat = $('#sertifikatFile').text();
            var imagePath = "{{ asset('/animal_photos/') }}" + '/' + surat;
            console.log(imagePath);
            $("#full-image").attr("src", imagePath);
            $('#image-viewer').show();
        });
        $("#image-viewer .close").click(function() {
            $('#image-viewer').hide();
        });

        function downloadImage() {
            var src = document.getElementById("full-image").src;
            fetch(src)
                .then(response => response.blob())
                .then(blob => {
                    const url = URL.createObjectURL(blob);
                    const link = document.createElement('a');
                    link.href = url;
                    link.download = 'image';
                    link.click();
                    URL.revokeObjectURL(url);
                });
        }
        function setujuiProdukConfirmation(element) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Update status hewan menjadi Aktif",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Saya akan setujui'
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
        function tolakProdukConfirmation(element) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Menolak listing hewan",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Saya akan tolak'
            }).then((result) => {
                if (result.isConfirmed) {

                    Livewire.emit('modalRejected', element);
                    Swal.fire(
                        'Succeed!',
                        'Hewan berhasil diupdate',
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