<div>
    <div class="container-fluid mt-4 mb-5">
        <h5>Tambah Produk</h5>
        <div class="card">
            <div class="card-body">
                <p class="mb-1" style="color:red; font-size:14px">(*) Wajib Diisi</p>

                <h6>Informasi Produk</h6>
                <hr>
                <div class="form-group row align-items-center">
                    <label for="student_id" class="col-3">Jenis Hewan <span style="color:red">*<span></label>
                    <div class="col-9">
                        <select class="form-control" wire:model="jenis_hewan">
                            <option selected hidden>--Select Animal Type--</option>
                            <option value="anjing">Anjing</option>
                            <option value="kucing">Kucing</option>
                        </select>
                        @error('jenis_hewan')
                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row align-items-center">
                    <label for="name" class="col-3">Judul Post <span style="color:red">*<span></label>
                    <div class="col-9">
                        <input type="text" id="name" class="form-control" wire:model.defer="judul_post" placeholder="contoh : Anjing Kintamani White 3 Bulan">
                        <span style="color:grey; font-size:13px">Tips: Jenis Hewan + Breed + Umur + Keterangan Tambahan</span>
                        @error('judul_post')
                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row align-items-center">
                    <div class="d-flex justify-content-between col-3">
                        <label for="phone">Harga <span style="color:red">*<span></label>
                        <span>Rp.</span>
                    </div>

                    <div class="col-4">
                        <input type="number" id="harga" class="form-control" wire:model.defer="harga">
                        @error('harga')
                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row align-items-center">
                    <label for="phone" class="col-3">Stok <span style="color:red">*<span></label>
                    <div class="col-2">
                        <input type="number" class="form-control" wire:model.defer="stok">
                        @error('stok')
                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-2">
            <div class="card-body">
                <h6>Detail Produk</h6>
                <hr>

                <div class="form-group row">
                    <label for="phone" class="col-3">Warna</label>
                    <div class="col-6">
                        <select class="form-control" wire:model="warna">
                            <option selected hidden>-Pilih Warna-</option>
                            <option value="hitam">Hitam</option>
                            <option value="putih">Putih</option>
                            <option value="coklat">Coklat</option>
                            <option value="abu-abu">Abu-abu</option>
                            <option value="orange">Orange</option>
                            <option value="krem">Krem</option>
                            <option value="lainnya">-Lainnya-</option>
                        </select>
                        @error('warna')
                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="phone" class="col-3">Umur </label>
                    <div class="col-3">
                        <select class="form-control" wire:model.defer="umur">
                            <option selected hidden>-Pilih Group Umur-</option>
                            <option value="bayi">Bayi (Kurang dari 3 bulan)</option>
                            <option value="remaja">Remaja (3 bulan - 1 tahun)</option>
                            <option value="dewasa">Dewasa (Lebih dari 1 tahun)</option>
                        </select>
                    </div>
                    @error('umur')
                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="email" class="col-3">Deskripsi <span style="color:red">*<span></label>
                    <div class="col-9">
                        <textarea id="w3review" class="form-control" rows="4" cols="56" placeholder="Masukkan Deskripsi Hewan..." wire:model.defer="deskripsi"></textarea>
                        @error('deskripsi')
                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

            </div>
        </div>

        <div class="card mt-2">
            <div class="card-body">
                <h6>Foto Produk</h6>
                <hr class="mb-1">
                <small style="color:#FF6843" class="">file type: jpg, png (max size 2mb)</small>

                <div class="form-group row mt-2">
                    <label for="myfile" class="col-3">Thumbnail Foto <span style="color:red">*<span></label>
                    <div class="col-6">
                        <input type="file" class="form-control" name="myfile" wire:model="thumbnail">
                        @error('thumbnail')
                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                        @enderror
                        @if($thumbnail)
                        <img src="{{ $thumbnail->temporaryUrl() }}" class="mt-2 img-thumbnail" style="max-width:200px;">
                        @endif
                    </div>
                </div>
                <div class="form-group row align-items-center">
                    <label for="myfile" class="col-3">Tambahan Foto</label>
                    <div class="col-6">
                        <input type="file" class="form-control" wire:model="photos" multiple>
                        <div class="row">
                            @if(!empty($photos))
                            @foreach($photos as $photo)
                            <div class="col-3">
                                <img src="{{ $photo->temporaryUrl() }}" class="mt-2" style="max-width:120px;">
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

                <div class="form-group row mt-2">
                    <label for="myfile" class="col-3"> Surat Keterangan Sehat<span style="color:red"> *<span></label>
                    <div class="col-6">
                        <input type="file" class="form-control" name="myfile" wire:model="surat_keterangan_sehat">
                        @error('surat_keterangan_sehat')
                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mt-2">
                    <label for="myfile" class="col-3"> Sertifikat Pedigree</label>
                    <div class="col-6">
                        <input type="file" class="form-control" name="myfile" wire:model="sertifikat_pedigree">
                        @error('sertifikat_pedigree')
                        <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

            </div>
        </div>

        <div class="d-flex justify-content-end mt-2">
            <button class="btn btn-outline-danger col-md-2">Batal</button>
            <button class="btn btn-primary col-md-2 ml-3" wire:click="storeProduct">Simpan</button>
        </div>
    </div>
    <script>
        window.addEventListener('success-notification', function() {
            Swal.fire({
                title: 'Success',
                text: 'Data hewan berhasil ditambahkan !',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok',

            }).then((result) => {
                window.location = "/store/products";
            })
        });
    </script>
</div>