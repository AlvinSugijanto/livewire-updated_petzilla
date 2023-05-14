<div>
  <div class="container mt-3">
    <div class="main-body">
      <div class="row gutters-sm">
        <div class="col-md-3 mb-3">
          <div class="card">
            <ul class="list-group list-group-flush">

              <a href="/user/profile">
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap active">
                  <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                  <h6 class="mb-0">Profil Saya</h6>
                  <i class="fa fa-angle-down" aria-hidden="true"></i>
                </li>
              </a>

              <a href="/user/transaction">
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                  <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                  <h6 class="mb-0">Daftar Transaksi</h6>
                  <i class="fa fa-angle-down" aria-hidden="true"></i>
                </li>
              </a>

              <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                <i class="fa fa-comments" aria-hidden="true"></i>
                <h6 class="mb-0">Chat</h6>
                <i class="fa fa-angle-down" aria-hidden="true"></i>
              </li>

              <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                <i class="fa fa-star" aria-hidden="true"></i>
                <h6 class="mb-0">Review</h6>
                <i class="fa fa-angle-down" aria-hidden="true"></i>
              </li>

            </ul>
          </div>
        </div>
        <div class="col-md-9">

          <!-- Personal Information -->

          <div class="card mb-3">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <i class="fa fa-user" aria-hidden="true"></i>
                <h6 class="mb-0 ml-1">Personal Information</h6>
                <a href="#" wire:click.prevent="openEditPersonal"><i class="fa fa-pencil-square-o ml-3 text-primary" aria-hidden="true"></i></a>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0 mt-2">Nama Lengkap</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name" wire:model="name" id="formName" @if(!$edit_personal) readonly @endif>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-sm-3">
                  <h6 class="mb-0 mt-2">Alamat Email</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name" wire:model="email" id="formEmail" @if(!$edit_personal) readonly @endif>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-sm-3">
                  <h6 class="mb-0 mt-2">No HP</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name" wire:model="phone_number" id="formPhone" @if(!$edit_personal) readonly @endif>
                </div>
              </div>
              <div class="flex-end">
                @if($edit_personal)
                <button wire:click="updatePersonal" class="btn btn-primary mt-2 ml-2" style="float:right">Submit</button>
                <button wire:click="cancelEditPersonal" class="btn btn-danger mt-2 ml-2" style="float:right">Cancel</button>
                @endif
              </div>
            </div>
          </div>

          <!-- Address -->
          <div class="card mb-3">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <i class="fa fa-address-book-o" aria-hidden="true"></i>
                <h6 class="mb-0 ml-1">Address</h6>
                <a href="#" wire:click.prevent="openEditAddress"><i class="fa fa-pencil-square-o ml-3 text-primary" aria-hidden="true"></i></a>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0 mt-2">Provinsi</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <select class="form-control mt-2" wire:model="provinsi" @if(!$edit_address) disabled @endif>
                    @foreach ($daftar_provinsi as $provinces)
                    <option value="{{ $provinces['id'] }}">{{ $provinces['nama'] }}
                    </option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-sm-3">
                  <h6 class="mb-0 mt-2">Kabupaten</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <select class="form-control mt-2" wire:model.lazy="kabupaten" @if(!$edit_address) disabled @endif>
                    <option selected hidden>--Pilih Kabupaten--</option>
                    @foreach ($daftar_kabupaten as $kabupaten)
                    <option value="{{ $kabupaten['id'] }}">{{ $kabupaten['nama'] }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-sm-3">
                  <h6 class="mb-0 mt-2">Kecamatan</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <select class="form-control mt-2" wire:model.lazy="kecamatan" @if(!$edit_address) disabled @endif>
                    <option selected hidden>--Pilih Kecamatan--</option>
                    @foreach ($daftar_kecamatan as $kecamatan)
                    <option value="{{ $kecamatan['id'] }}">{{ $kecamatan['nama'] }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-sm-3">
                  <h6 class="mb-0 mt-2">Alamat Lengkap</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <textarea id="w3review" class="form-control" rows="4" cols="56" wire:model="alamat_lengkap" @if(!$edit_address) readonly @endif></textarea>
                </div>
              </div>


              <div class="flex-end">
                @if($edit_address)
                <button wire:click="updateAddress" class="btn btn-primary mt-2 ml-2" style="float:right">Submit</button>
                <button wire:click="cancelEditAddress" class="btn btn-danger mt-2 ml-2" style="float:right">Cancel</button>
                @endif

              </div>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>
  @push('scripts')
  <script>
    window.addEventListener('success-notification', function() {
      Swal.fire({
        title: 'Success',
        text: 'Data kamu berhasil di update !',
        icon: 'success',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Ok',

      })
    });
  </script>
  @endpush
</div>