<div>
  <div class="container">
    <form wire:submit.prevent="register">
      <div class="brand">
        <img src="logo-brand.png" alt="" width="100">
        <img src="logo-name.png" alt="" width="130">
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="email">Name</label>
            <input type="text" placeholder="Full Name" wire:model.defer="name">
            @error('name')
            <span class="text-danger" style="font-size: 13.5px;">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" placeholder="Email" wire:model.defer="email">
            @error('email')
            <span class="text-danger" style="font-size: 13.5px;">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="email">Password</label>
            <input type="password" placeholder="Password" wire:model.defer="password">
            @error('password')
            <span class="text-danger" style="font-size: 13.5px;">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="password">Phone Number</label>
            <input type="text" placeholder="Example: 089xxx" wire:model.defer="phone_number">
            @error('phone_number')
            <span class="text-danger" style="font-size: 13.5px;">{{ $message }}</span>
            @enderror
          </div>
          <button type="submit" class="btn btn-primary">Daftar</button>
          <p class="mt-3 mb-0 text-center">Sudah punya akun? <a href="/login">Login</a></p>
        </div>
        <div class="col-md-6">
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
        </div>
      </div>
    </form>
  </div>

  <!-- Notif Modal -->
  <div wire:loading.delay.longest class="modal fade show" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="arcade-5"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  @push('scripts')

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
  </script>

  @endpush
</div>