<div>
  <div class="container-fluid">
    @if($is_there_store == "false")
    <h4>Kamu belum mendaftarkan tokomu, silahkan daftar toko mu dahulu <a href="/register_store" style="text-decoration : underline; color:blue">disini</a></h4>
    @else

    <!-- Personal Information -->

    <div class="card mb-3">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <i class="fa fa-user" aria-hidden="true"></i>
          <h6 class="mb-0 ml-1">Informasi Data Diri</h6>
          <a href="#" wire:click.prevent="openEditPersonal"><i class="fa fa-pencil-square-o ml-3 text-primary" aria-hidden="true"></i></a>
        </div>
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
        </div>
      </div>
    </div>

    <!-- Address -->

    <div class="card mb-3">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <i class="fa fa-address-book-o" aria-hidden="true"></i>
          <h6 class="ml-1 mb-0">Alamat</h6>
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

    <!-- Payment Information -->
    <div class="card mb-3">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <i class="fa fa-university" aria-hidden="true"></i>
          <h6 class="mb-0 ml-2">Informasi Rekening</h6>
          <button class="btn btn-primary ml-2" style="font-size:13px; padding: 5px 12px;" data-toggle="modal" data-target="#tambahRekeningModal"><i class="fa fa-plus"></i> Tambah</button>
        </div>
        <hr class="mb-0">
        @foreach($payment as $data)
        <div class="card mt-3">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <img src="{{ asset('/logo/' . $data->jenis_rekening . '.png') }}" alt="" width="120" height="60" style="object-fit:cover">
              <div class="d-flex flex-column ml-3 mr-auto">
                <div style="color:#6D7588; font-size:0.8rem; font-family:'Open Sauce One',sans-serif">{{ strtoupper($data->jenis_rekening) }}</div>
                <div class="font-weight-bold" style="color:#212121; font-size:1.2rem; font-family:'Open Sauce One',sans-serif">{{ $data->nomor_rekening }}</div>
                <div style="color:#212121; font-size:1rem; font-family:'Open Sauce One',sans-serif">a.n {{ strtoupper($data->nama_rekening) }}</div>
              </div>
              <a href="#" data-toggle="modal" data-target="#editRekeningModal" wire:click.prevent="openEditRekeningModal('{{ $data->id }}')"> <i class="fa fa-pencil-square-o text-primary" style="font-size:20px" aria-hidden="true"></i></a>
              <a href="javascript:void(0)" onclick="deleteRekeningConfirmation('{{ $data->id }}')"><i class="fa fa-trash text-danger mx-4" style="font-size:20px"></i></a>
            </div>
          </div>
        </div>
        @endforeach
        <div class="flex-end">
          @if($edit_personal)
          <button wire:click="updatePersonal" class="btn btn-primary mt-2 ml-2" style="float:right">Submit</button>
          <button wire:click="cancelEditPersonal" class="btn btn-danger mt-2 ml-2" style="float:right">Cancel</button>
          @endif
        </div>
      </div>
    </div>
    @endif

  </div>
  <div wire:ignore.self class="modal fade" id="tambahRekeningModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modalId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header px-4">
          <h5 class="modal-title">Tambah Rekening</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times</button>
        </div>
        <div class="modal-body">
          <div class="col-md-12">
            <div class="form-group">
              <label>Tipe Rekening</label>
              <select class="form-control" wire:model="tipe_rekening">
                <option selected hidden>--Pilih Tipe Rekening--</option>
                <option value="transfer_bank">Transfer Bank</option>
                <option value="digital_payment">Pembayaran Digital</option>
              </select>
              @error('tipe_rekening') <span class="text-danger">{{ $message }}</span> @enderror
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
                <option value="shopeepay">ShopeePay</option>
                @endif
              </select>
              @error('jenis_rekening') <span class="text-danger">{{ $message }}</span> @enderror

            </div>
            <div class="form-group">
              <label>Nama Rekening</label>
              <input type="text" class="form-control" placeholder="Masukkan nama rekening..." wire:model.defer="nama_rekening">
              @error('nama_rekening') <span class="text-danger">{{ $message }}</span> @enderror


            </div>
            <div class="form-group">
              <label>No Rekening / No Virtual</label>
              <input type="text" class="form-control" placeholder="No Rekening (Bank) / No Virtual Account (E-Wallet)" wire:model.defer="nomor_rekening">
              @error('nomor_rekening') <span class="text-danger">{{ $message }}</span> @enderror

            </div>
            <div class="d-flex justify-content-end">
              <button class="btn btn-primary" wire:click.prevent="submitTambahRekening">Submit</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div wire:ignore.self class="modal fade" id="editRekeningModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modalId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header px-4">
          <h5 class="modal-title">Edit Rekening</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times</button>
        </div>
        <div class="modal-body">
          <div class="col-md-12">
            <div class="form-group">
              <label>Tipe Rekening</label>
              <select class="form-control" wire:model="tipe_rekening">
                <option selected hidden>--Pilih Tipe Rekening--</option>
                <option value="transfer_bank">Transfer Bank</option>
                <option value="digital_payment">Pembayaran Digital</option>
              </select>
              @error('tipe_rekening') <span class="text-danger">{{ $message }}</span> @enderror
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
                <option value="shopeepay">ShopeePay</option>
                @endif
              </select>
              @error('jenis_rekening') <span class="text-danger">{{ $message }}</span> @enderror

            </div>
            <div class="form-group">
              <label>Nama Rekening</label>
              <input type="text" class="form-control" placeholder="Masukkan nama rekening..." wire:model.defer="nama_rekening">
              @error('nama_rekening') <span class="text-danger">{{ $message }}</span> @enderror


            </div>
            <div class="form-group">
              <label>No Rekening / No Virtual</label>
              <input type="text" class="form-control" placeholder="No Rekening (Bank) / No Virtual Account (E-Wallet)" wire:model.defer="nomor_rekening">
              @error('nomor_rekening') <span class="text-danger">{{ $message }}</span> @enderror

            </div>
            <div class="d-flex justify-content-end">
              <button class="btn btn-primary" wire:click.prevent="submitEditRekening">Submit</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @push('scripts')

  <script>
    window.addEventListener('openEditRekeningModal', event => {
      $('#editRekeningModal').modal('show');
    });

    window.addEventListener('successTambahRekening', function() {
      Swal.fire({
        title: 'Success',
        text: 'Data Rekening berhasil ditambahkan !',
        icon: 'success',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Ok',

      }).then((result) => {
        window.location = "/store/profile";


      })
    });
    window.addEventListener('successEditRekening', function() {
      Swal.fire({
        title: 'Success',
        text: 'Data Rekening berhasil diubah !',
        icon: 'success',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Ok',

      }).then((result) => {
        window.location = "/store/profile";
      })
    });
    window.addEventListener('success-modal', event => {
      Swal.fire({
        title: 'Success',
        text: event.detail.message,
        icon: 'success',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Ok',

      }).then((result) => {
        swal.close();
      })
    });

    function deleteRekeningConfirmation(element) {
      Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Anda tidak dapat mengubah aksi ini",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Saya akan menghapus rekening ini'
      }).then((result) => {
        if (result.isConfirmed) {

          Livewire.emit('deleteConfirmed', element);

          Swal.fire(
            'Succeed!',
            'Rekening Berhasil Dihapus',
            'success'
          ).then(() => {
              window.location = "/store/profile";
          })
        }
      })
    }
  </script>
  @endpush
</div>