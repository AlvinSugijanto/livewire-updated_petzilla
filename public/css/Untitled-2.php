<section class="" style="background-color: #eee; padding:20px;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-7 order-2 order-lg-1">
              <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4">SIGN UP</p>

                <form class="mx-1 mx-md-4" wire:submit.prevent="registerStore">

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fa fa-shopping-bag fa-lg mr-3" aria-hidden="true"></i>
                    <div class="form-outline flex-fill mb-0">
                      <!-- <label class="form-label" for="form3Example4c">Nama Toko</label> -->
                      <input type="text" class="form-control" placeholder="Nama Toko" wire:model="nama_toko"/>
                        @error('nama_toko')
                          <span class="text-danger" style="font-size: 13.5px;">{{ $message }}</span>
                        @enderror
                    </div>
                  </div>
                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fa fa-comments fa-lg mr-3" aria-hidden="true"></i>
                    <div class="form-outline flex-fill mb-0">
                      <textarea id="w3review" class="form-control" rows="4" cols="56" placeholder="Masukkan Deskripsi Toko..." wire:model="description"></textarea>
                       @error('description')
                          <span class="text-danger" style="font-size: 13.5px;">{{ $message }}</span>
                        @enderror
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fa fa-phone fa-lg mr-3" aria-hidden="true"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="number" class="form-control" placeholder="No Hp, Ex: 0821" wire:model="no_hp"/>
                      @error('no_hp')
                          <span class="text-danger" style="font-size: 13.5px;">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <b>Alamat Toko</b>
                  <div class="flex-row align-items-center mb-4 mt-2">
                    <select class="form-control" wire:model.lazy="provinsi">
                      <option value="" selected hidden>--Pilih Provinsi--</option>
                      @foreach ($daftar_provinsi as $provinces)
                        <option value="{{ $provinces['id'] }}">{{ $provinces['nama'] }}</option>
                      @endforeach
                    </select>
                    @error('provinsi')
                      <span class="text-danger" style="font-size: 13.5px;">{{ $message }}</span>
                    @enderror
                    <select class="form-control mt-2" wire:model.lazy="kabupaten">
                      <option selected hidden>--Pilih Kabupaten--</option>
                      @if(count($daftar_kabupaten) > 0)
                        @foreach ($daftar_kabupaten as $kabupaten)
                          <option value="{{ $kabupaten['id'] }}">{{ $kabupaten['nama'] }}</option>
                        @endforeach
                      @endif
                    </select>
                    @error('kabupaten')
                      <span class="text-danger" style="font-size: 13.5px;">{{ $message }}</span>
                    @enderror
                    <select class="form-control mt-2" wire:model.lazy="kecamatan">
                      <option selected hidden>--Pilih Kecamatan--</option>
                      @if(count($daftar_kecamatan) > 0)
                        @foreach ($daftar_kecamatan as $kecamatan)
                          <option value="{{ $kecamatan['id'] }}">{{ $kecamatan['nama'] }}</option>
                        @endforeach
                      @endif
                    </select>
                    @error('kecamatan')
                      <span class="text-danger" style="font-size: 13.5px;">{{ $message }}</span>
                    @enderror
                  </div>

                  <b>Alamat Lengkap</b>
                  <div class="d-flex flex-row align-items-center mb-4 mt-2">
                    <div class="form-outline flex-fill mb-0">
                      <textarea id="w3" class="form-control" rows="4" cols="61" placeholder="Tambahkan Alamat Lengkap Kamu.." wire:model="alamat_lengkap"></textarea>
                      @error('alamat_lengkap')
                          <span class="text-danger" style="font-size: 13.5px;">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" class="btn btn-primary btn-lg">Register</button>
                  </div>

                </form>

              </div>
              <div class="col-md-5 order-1 order-lg-2">
                  <div class="logo_name d-flex justify-content-center" style="margin-top:80px">
                    <img src="{{ asset('logo-name.png') }}" alt="" width="300" >
                  </div>
                  <div class="brand_name d-flex justify-content-center" style="margin-top:50px">
                    <img src="{{ asset('logo-brand.png') }}" alt="" width="250" >
                  </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@push('scripts')

<script>
    window.addEventListener('show-modal',function(){
      Swal.fire({
            title: 'Success',
            text: 'Store Registration Success!',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok',
            
          }).then((result)=>{
            if(result.isConfirmed){
              window.location = "/mystore";

            }
          })        
      });

</script>

@endpush