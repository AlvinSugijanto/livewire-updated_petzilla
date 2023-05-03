<div>
  <div class="container">
    @if($is_there_store == "false")
    <h4>Kamu belum mendaftarkan tokomu, silahkan daftar toko mu dahulu <a href="/register_store" style="text-decoration : underline; color:blue">disini</a></h4>
    @else

    <!-- Personal Information -->

    <div class="card mb-3">
      <div class="card-body">
        <h6><i class="fa fa-user" aria-hidden="true"></i> Personal Information</h6>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <h6 class="mb-0 mt-2">Nama Toko</h6>
          </div>
          <div class="col-sm-9 text-secondary">
            <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="nama_toko" @if(!$edit_personal) readonly @endif>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-sm-3">
            <h6 class="mb-0 mt-2">Deskripsi Toko</h6>
          </div>
          <div class="col-sm-9 text-secondary">
            <textarea id="w3review" class="form-control" rows="4" cols="56" wire:model="description" @if(!$edit_personal) readonly @endif></textarea>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-sm-3">
            <h6 class="mb-0 mt-2">No HP</h6>
          </div>
          <div class="col-sm-9 text-secondary">
            <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="no_hp" @if(!$edit_personal) readonly @endif>
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

    <!-- Payment Information -->
    <div class="card mb-3">
      <div class="card-body">
        <h6><i class="fa fa-university" aria-hidden="true"></i> Payment Information</h6>
        <hr>
        @foreach($payment as $data)
        <div class="col-md-6">
          <div class="card">
            <div class="card-header bg-secondary text-white">
              <h6 class="mb-0"><i class="fa fa-university" aria-hidden="true"></i> {{ $data->jenis_rekening }}</h6>
              </h6>
            </div>
            <div class="card-body">
              <div class="row mt-3">
                <div class="col-sm-3">
                  <h6 class="mb-0 mt-2">Nama</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $data->nama_rekening }}" @if(!$edit_personal) readonly @endif>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-sm-3">
                  <h6 class="mb-0 mt-2">Nomor Rekening</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $data->nomor_rekening }}" @if(!$edit_personal) readonly @endif>
                </div>
              </div>
            </div>
          </div>
        </div>

        @endforeach
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
    @endif

  </div>

  @push('scripts')

  <script>
    function disableSidebarButton() {
      var collection = document.getElementById("sidebarList");
      console.log(collection);
      collection.classList.add("asdasdasd");
    }
  </script>
  @endpush
</div>