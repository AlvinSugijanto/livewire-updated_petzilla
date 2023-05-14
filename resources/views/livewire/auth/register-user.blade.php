<div>
  <form id="regForm">
    <div class="col-md-12">
      <h4 id="bebas_neue">CREATE ACCOUNT</h4>
      @if($currentStep == 1)
      <div class="step-one">
        <div class="col-md-12">
          <h6><i class="fa fa-user" aria-hidden="true"></i> Personal Information</h6>
          <hr class="mt-0">
          <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" class="form-control" placeholder="Masukkan Nama Lengkap..." wire:model.defer="name">
            <span class="text-danger">@error('name'){{ $message }}@enderror</span>
          </div>
          <div class="form-group">
            <label for="name">Alamat Email</label>
            <input type="text" class="form-control" placeholder="Masukkan Alamat Email..." wire:model.defer="email">
            <span class="text-danger">@error('email'){{ $message }}@enderror</span>
          </div>

          <div class="form-group">
            <label for="name">Password</label>
            <input type="password" class="form-control" placeholder="Masukkan Password..." wire:model.defer="password">
            <span class="text-danger">@error('password'){{ $message }}@enderror</span>
          </div>

          <div class="form-group">
            <label for="name">No Handphone</label>
            <input type="text" class="form-control" placeholder="Contoh : 089523xxx" wire:model.defer="phone_number">
            <span class="text-danger">@error('phone_number'){{ $message }}@enderror</span>
          </div>
        </div>


      </div>
      @endif
      @if($currentStep == 2)
      <div class="step-two">
        <div class="col-md-12">
          <div class="d-flex align-items-center justify-content-between">
            <h6><i class="fa fa-address-book-o" aria-hidden="true"></i> Address</h6>
            <h6 class="learn-how" wire:click.prevent="openTipsModal">Learn How <i class="fa fa-question-circle-o" aria-hidden="true"></i></h6>
          </div>
          <hr class="mt-0">

          @if($isLocationDetected == 'false')

          <div class="d-flex justify-content-between">
            <div class="alert alert-danger" role="alert">
              Mohon maaf, kami tidak bisa menemukan koordinat alamat kamu ! Untuk melanjutkan, silahkan menginput titik koordinat secara manual.
            </div>
          </div>

          @endif
          <div class="form-group">
            <label for="address">Alamat Tinggal</label>
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
            <textarea id="w3" class="form-control" rows="4" cols="61" placeholder="Tambahkan Alamat Lengkap Kamu.." wire:model.defer="alamat_lengkap"></textarea>
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
        <button class="btn btn-submit" wire:click.prevent="submit_button">Submit</button>

      </div>
      @endif
    </div>

  </form>

  <!-- Loader Modal -->

  <div wire:loading.delay.longer class="modal fade show" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="d-flex justify-content-center align-items-center">
            <div class="spinner-border" role="status">
            </div>
            <h6 class="ml-3 mb-0">Hold on.. We're sending you an email</h6>

          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Tips Modal -->

  <div wire:ignore.self class="modal fade" id="tipsModal">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <h5 class="modal-title">CARA MENAMBAHKAN KOORDINAT</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          </button>
        </div>
        <div class="modal-body">
          <div class="container">
            <p>1. Silahkan buka GoogleMaps anda melalui perangkat komputer</p>
            <p>2. Cari lokasi anda saat ini atau ketikkan lokasi alamat yang ingin didaftarkan</p>
            <p class="mb-0">3. Lihat URL anda sekarang </p>
            <img src="{{ asset('tutorial/1.png') }}" alt="" style="border:1px solid grey">
            <p class="mb-0">4. Copy pada bagian ini</p>
            <img src="{{ asset('tutorial/2.png') }}" alt="" style="border:1px solid grey">
            <p>5. Lalu paste pada form berikut</p>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" wire:click.prevent="submitOngkir">Submit</button>
        </div>
      </div>
    </div>
  </div>
  @push('scripts')
  <script>
  </script>
  <script>
    window.addEventListener('show-modal', function() {
      Swal.fire({
        title: 'Success',
        text: 'We have sent email verification to your email address. Click the link there to be able to use your email',
        icon: 'success',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Ok',

      }).then((result) => {
        if (result.isConfirmed) {
          window.location = "/login";

        }
      })
    });
    window.addEventListener('open-tips-modal', function() {
      $('#tipsModal').modal('show');
    });
  </script>

  @endpush
</div>