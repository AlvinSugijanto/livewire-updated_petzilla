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
                  <h6 class="mb-0">Profil Saya</h5>
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                </li>
              </a>

              <a href="/user/transaction">
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                  <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                  <h6 class="mb-0">Daftar Transaksi</h5>
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
              <h6><i class="fa fa-user" aria-hidden="true"></i> Personal Information</h6>
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
                @if(!$edit_personal)
                <button wire:click="openEditPersonal" class="btn btn-primary mt-2" style="float:right">Edit Profile</button>
                @endif
              </div>
            </div>
          </div>

          <!-- Address -->
          <div class="card mb-3">
            <div class="card-body">
              <h6><i class="fa fa-address-book-o" aria-hidden="true"></i> Address</h6>
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
                @if(!$edit_address)
                <button wire:click="openEditAddress" class="btn btn-primary mt-2" style="float:right">Edit Profile</button>
                @endif
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>
</div>