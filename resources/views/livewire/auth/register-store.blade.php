<div>
  <form id="regForm">
    <div class="col-md-12">
      <h4 id="bebas_neue">STORE REGISTRATION</h4>
      @if($currentStep == 1)
      <div class="step-one">
        <div class="col-md-12">
          <h6><i class="fa fa-user" aria-hidden="true"></i> Personal Information</h6>
          <hr class="mt-0">

          <div class="form-group">
            <label>Nama Toko</label>
            <input type="text" class="form-control" placeholder="Masukkan Nama Toko..." wire:model.defer="nama_toko">
            <span class="text-danger">@error('nama_toko'){{ $message }}@enderror</span>
          </div>
          <div class="form-group">
            <label>No Handphone</label>
            <input type="text" class="form-control" placeholder="Masukkan No Hp, Contoh : 0895xxx" wire:model.defer="no_hp">
            <span class="text-danger">@error('no_hp'){{ $message }}@enderror</span>
          </div>
          <div class="form-group">
            <label>Deskripsi Toko</label>
            <textarea id="w3review" class="form-control" rows="4" cols="56" placeholder="Masukkan Deskripsi Toko..." wire:model="description"></textarea>
            <span class="text-danger">@error('description'){{ $message }}@enderror</span>
          </div>
        </div>


      </div>
      @endif
      @if($currentStep == 2)
      <div class="step-two">
        <div class="col-md-12">
          <h6><i class="fa fa-address-book-o" aria-hidden="true"></i> Address</h6>
          <hr class="mt-0">
          @if($isLocationDetected == 'false')

          <div class="d-flex justify-content-between">
            <div class="alert alert-danger" role="alert">
              Mohon maaf, kami tidak bisa menemukan koordinat alamat kamu ! Untuk melanjutkan, silahkan menginput titik koordinat secara manual.
            </div>
          </div>

          @endif
          <div class="form-group">
            <label>Alamat Tinggal</label>
            <select class="form-control" wire:model="provinsi">
              <option value="" selected hidden>--Pilih Provinsi--</option>
              @foreach ($daftar_provinsi as $provinces)
              <option value="{{ $provinces['id'] }}">{{ $provinces['nama'] }}</option>
              @endforeach
            </select>
            @error('provinsi')
            <span class="text-danger" style="font-size: 13.5px;">{{ $message }}</span>
            @enderror
            <select class="form-control mt-2" wire:model="kabupaten">
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
            <select class="form-control mt-2" wire:model="kecamatan">
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

          <div class="form-group">
            <label>Alamat Lengkap</label>
            <textarea id="w3" class="form-control" rows="4" cols="61" placeholder="Tambahkan Alamat Lengkap..." wire:model.defer="alamat_lengkap"></textarea>
            @error('alamat_lengkap')
            <span class="text-danger" style="font-size: 13.5px;">{{ $message }}</span>
            @enderror
          </div>

          @if($isLocationDetected == 'false')

          <div class="form-group">
            <label>Koordinat</label>
            <input type="text" class="form-control" placeholder="Masukkan Koordinat..." wire:model.defer="koordinat">
          </div>

          @endif

        </div>
      </div>
      @endif
      @if($currentStep == 3)
      <div class="step-three">
        <div class="col-md-12">
          <h6><i class="fa fa-university" aria-hidden="true"></i> Informasi Rekening</h6>
          <hr class="mt-0">
          <div class="form-group">
            <label>Tipe Rekening</label>
            <select class="form-control" wire:model="tipe_rekening">
              <option selected hidden>--Pilih Tipe Rekening--</option>
              <option value="transfer_bank">Transfer Bank</option>
              <option value="digital_payment">Pembayaran Digital</option>
            </select>
          </div>
          <div class="form-group">
            <label>Jenis Rekening</label>
            <select class="form-control" wire:model="jenis_rekening">
              <option selected hidden>--Pilih Jenis Rekening--</option>
              @if($tipe_rekening == 'transfer_bank')
              <option value="bca">BCA</option>
              <option value="mandiri">Mandiri</option>
              <option value="bri">BRI</option>
              <option value="bni">BNI</option>
              @elseif($tipe_rekening == 'digital_payment')
              <option value="ovo">OVO</option>
              <option value="gopay">GoPay</option>
              <option value="dana">DANA</option>
              <option value="shopee_pay">Shopee Pay</option>
              @endif
            </select>
          </div>
          <div class="form-group">
            <label>Nama Rekening</label>
            <input type="text" class="form-control" placeholder="Masukkan nama rekening..." wire:model.defer="nama_rekening">


          </div>
          <div class="form-group">
            <label>No Rekening / No Virtual</label>
            <input type="text" class="form-control" placeholder="No Rekening (Bank) / No Virtual Account (E-Wallet)" wire:model.defer="nomor_rekening">
          </div>

        </div>
      </div>
      @endif
      <div style="text-align:center">
        <span class="step active"></span>
        <span class="step"></span>
        <span class="step"></span>
      </div>
      @if($currentStep == 1)
      <div class="d-flex justify-content-end px-3">
        <button class="btn btn-next" wire:click.prevent="nextStep">Next</button>
      </div>
      @endif
      @if($currentStep == 2)
      <div class="d-flex justify-content-between w-100 px-3">
        <button class="btn btn-previous" wire:click.prevent="previousStep">Previous</button>
        <button class="btn btn-next" wire:click.prevent="nextStep">Next</button>
      </div>
      @endif
      @if($currentStep == 3)
      <div class="d-flex justify-content-between w-100 px-3">
        <button class="btn btn-previous" wire:click.prevent="previousStep">Previous</button>
        <button class="btn btn-submit" wire:click.prevent="registerStore">Submit</button>
      </div>
      @endif

    </div>

  </form>


  @push('scripts')
  <script>
  </script>
  <script>
    window.addEventListener('show-modal', function() {
      Swal.fire({
        title: 'Success',
        text: 'Your Store Account Successfully Created!',
        icon: 'success',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Ok',

      }).then((result) => {
        if (result.isConfirmed) {
          window.location = "/store/profile";

        }
      })
    });
  </script>

  @endpush
</div>