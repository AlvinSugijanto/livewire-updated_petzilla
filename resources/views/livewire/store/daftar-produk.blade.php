<div>

  <div class="container" style="max-width:100%">
    <div class="row">
      <div class="col-md-12">
        <button class="btn p-2" style="background-color:#A27B5C" wire:click="openAddModal">
          <h6 class="m-0" style="font-size:14px; color:#FFF9F2">Tambah Produk</h6>
        </button>
        <!-- <table class="table table-hover mt-2">
          <thead>
            <tr>
              <th width="5%">#</th>
              <th width="15%">Nama</th>
              <th width="10%">Jenis</th>
              <th width="20%">Foto</th>
              <th width="25%">Deskripsi</th>
              <th width="5%">Status</th>
              <th width="15%">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($animals as $animal)
            <tr>
              <th>{{ $loop->iteration }}</th>
              <td>{{ $animal->judul_post }}</td>
              <td>{{ $animal->jenis_hewan }}</td>
              <td><img src="{{ asset('/animal_photos/'.$animal->thumbnail) }}" style="max-height:100px"></td>
              <td>
                <div class="animal-description">{!! $animal->deskripsi !!}</div>
              </td>
              <td class="align-middle">@if($animal->status == 'Aktif') <h5 style="color:green">Aktif</h5> @endif</td>
              <td class="align-middle">
                <div class="row">
                  <button class="btn btn-primary btn-sm ml-2" wire:click="editProduk( {{$animal->id_animal}} )">Edit</button>
                  <button class="btn btn-danger btn-sm ml-1">Delete</button>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table> -->
        <table class="tableProduk mt-2">
          <thead>
            <tr>
              <th width="10%">INVOICE</th>
              <th width="15%">NAMA</th>
              <th width="15%">JENIS</th>
              <th width="20%">DESKRIPSI</th>
              <th width="15%">HARGA</th>
              <th width="15%" class="text-center">STATUS</th>
              <th width="10%">ACTION</th>

            </tr>
          </thead>
          <tbody>
            @foreach($animals as $animal)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>
                <div class="judul-post">{{$animal->judul_post}}</div>
              </td>
              <td>{{ $animal->jenis_hewan }}</td>
              <td>
                <div class="animal-description">{!! $animal->deskripsi !!}</div>
              </td>
              <td>Rp. {{ number_format($animal->harga,0,',','.') }}</td>
              <td class="px-3">
                @if($animal->status == "aktif")
                <div class="table-status d-flex justify-content-center py-1" style="background-color:#B3FFA6; color:#35B620; font-size:13px">Aktif</div>
                @else
                <div class="table-status d-flex justify-content-center py-1" style="background-color:#FFCACA; color:#CB2D2D; font-size:13px">Tidak Aktif</div>

                @endif
              </td>
              <td class="text-center">
                <a href="#" wire:click.prevent="editProduk('{{$animal->id_animal}}')"><i class="fa fa-pencil-square-o text-primary" aria-hidden="true"></i></a>

              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- Add Modal -->
  <div wire:ignore.self class="modal fade" id="addProdukModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Hewan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          </button>
        </div>
        <div class="modal-body">
          @if($currentAddModalStep == 1)

          <h5 class="transaction" style="font-weight:600"><i class="fa fa-columns" aria-hidden="true"></i> 1/2 Profil Hewan</h5>
          <div class="form-group row mt-4">
            <label for="student_id" class="col-3">Jenis Hewan <span style="color:red">*<span></label>
            <div class="col-9">
              <select class="form-control" wire:model="jenis_hewan">
                <option selected hidden>--Select Animal Type--</option>
                <option value="Anjing">Anjing</option>
                <option value="Kucing">Kucing</option>
              </select>
              @error('jenis_hewan')
              <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label for="name" class="col-3">Judul Post <span style="color:red">*<span></label>
            <div class="col-9">
              <input type="text" id="name" class="form-control" wire:model.defer="judul_post" placeholder="cth :Anjing Kintamani White 3 Bulan">
              @error('judul_post')
              <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
              @enderror
            </div>
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

          <div class="form-group row">
            <label for="phone" class="col-3">Harga <span style="color:red">*<span></label>
            <div class="col-9">
              <input type="number" id="harga" class="form-control" wire:model.defer="harga">
              @error('harga')
              <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label for="myfile" class="col-3">Thumbnail Foto <span style="color:red">*<span></label>
            <div class="col-9">
              <input type="file" class="form-control" name="myfile" wire:model="thumbnail">
              @error('thumbnail')
              <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
              @enderror
              @if($thumbnail)
              <img src="{{ $thumbnail->temporaryUrl() }}" class="mt-2 img-thumbnail" style="max-width:200px;">
              @endif

            </div>
          </div>
          <div class="form-group row">
            <label for="myfile" class="col-3">Tambahan Foto</label>
            <div class="col-9">
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
          <div class="form-group row">
            <div class="col-3">
              <p style="color:red">(*) Wajib Diisi</p>
            </div>
            <div class="col-9 text-right">
              <button type="button" class="btn btn-sm btn-primary" wire:click.prevent="nextStepAddModal">Next</button>
            </div>
          </div>
          @elseif($currentAddModalStep == 2)
          <h5 class="transaction" style="font-weight:600"><i class="fa fa-columns" aria-hidden="true"></i> 2/2 Dokumen Hewan</h5>

          <div class="form-group row">
            <label class="col-4">Surat Keterangan Sehat <span style="color:red">*<span></label>
            <div class="col-8">
              <input type="file" class="form-control" wire:model.lazy="surat_keterangan_sehat">
              <small style="color:#FF6843">file type: jpg, png, pdf (max size 2mb)</small>
              @error('surat_keterangan_sehat')
              <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label class="col-4">Sertifikat Pedigri</label>
            <div class="col-8">
              <input type="file" class="form-control" wire:model.lazy="sertifikat_pedigree">
              <small style="color:#FF6843">file type: jpg, png, pdf (max size 2mb)</small>
            </div>
          </div>

          <div class="form-group row">
            <div class="col-3">
              <p style="color:red">(*) Wajib Diisi</p>
            </div>
            <div class="col-9 text-right">
              <button type="button" class="btn btn-sm btn-primary" wire:click.prevent="previousStepAddModal">Previous</button>
              <button type="button" class="btn btn-sm btn-primary" wire:click.prevent="storeProduk">Submit</button>
            </div>
          </div>

          @endif

        </div>
      </div>
    </div>
  </div>
  <!-- Edit Modal -->
  <div wire:ignore.self class="modal fade" id="editProdukModal" id="addProdukModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Hewan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          </button>
        </div>
        @if($currentEditModalStep == 1)
        <div class="modal-body">
          <h5 class="transaction" style="font-weight:600"><i class="fa fa-columns" aria-hidden="true"></i> 1/2 Profil Hewan</h5>

          <div class="form-group row">
            <label for="student_id" class="col-3">Jenis Hewan <span style="color:red">*<span></label>
            <div class="col-9">
              <select class="form-control" wire:model="jenis_hewan">
                <option value="" selected hidden>====Select Animal Type====</option>
                <option value="Anjing">Anjing</option>
                <option value="Kucing">Kucing</option>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label for="name" class="col-3">Judul Post <span style="color:red">*<span></label>
            <div class="col-9">
              <input type="text" id="name" class="form-control" wire:model.lazy="judul_post" placeholder="cth :Anjing Kintamani White 3 Bulan">
              @error('name')
              <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label for="email" class="col-3">Deskripsi <span style="color:red">*<span></label>
            <div class="col-9">
              <textarea id="w3review" class="form-control" rows="4" cols="56" placeholder="Masukkan Deskripsi Toko..." wire:model.lazy="deskripsi"></textarea>
              @error('email')
              <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label for="phone" class="col-3">Harga <span style="color:red">*<span></label>
            <div class="col-9">
              <input type="number" id="harga" class="form-control" wire:model.lazy="harga">
              @error('harga')
              <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label for="myfile" class="col-3">Thumbnail Foto <span style="color:red">*<span></label>
            <div class="col-9">
              <input type="file" class="form-control" name="myfile" wire:model.lazy="thumbnail">
              @if($display_photo)
              <img src="{{ asset('/animal_photos/'.$display_photo) }}" class="mt-2 img-thumbnail" style="max-height:120px;">
              @endif
              @if($thumbnail)
              <img src="{{ $thumbnail->temporaryUrl() }}" class="mt-2 img-thumbnail" style="max-height:120px;">
              @endif
            </div>
          </div>
          <div class="form-group row">
            <label for="myfile" class="col-3">Tambahan Foto</label>
            <div class="col-9">
              <input type="file" class="form-control" wire:model="photos" multiple>
              <div class="row col-12">
                @if(!empty($display_photos))
                @foreach($display_photos as $photo)
                <div class="image-hover mt-2">
                  <img src="{{ asset('/animal_photos/'.$photo->photo) }}" class="ml-2 img-thumbnail img-hover" style="max-height:120px;">
                  <a wire:click="$emit('triggerDelete',{{ $photo->id_animal_photo }})" class="trash-hover"><i class="fa fa-trash" aria-hidden="true" style="color:red; font-size:35px"></i></a>
                </div>
                @endforeach
                @endif

                @if(!empty($photos))
                @foreach($photos as $photo)
                <div class="col-3">
                  <img src="{{ $photo->temporaryUrl() }}" class="mt-2" style="max-height:120px;">
                </div>
                @endforeach
                @endif
              </div>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-3">
              <p style="color:red">(*) Wajib Diisi</p>
            </div>
            <div class="col-9 text-right">
              <button type="button" class="btn btn-primary" wire:click.prevent="nextStepEditModal">Next</button>
            </div>
          </div>
        </div>
        @elseif($currentEditModalStep == 2)
        <div class="modal-body">
          <h5 class="transaction" style="font-weight:600"><i class="fa fa-columns" aria-hidden="true"></i> 2/2 Dokumen Hewan</h5>

          <div class="form-group row">
            <label class="col-4">Surat Keterangan Sehat <span style="color:red">*<span></label>
            <div class="col-8">
              <input type="file" class="form-control" wire:model.lazy="surat_keterangan_sehat">
              <small style="color:#FF6843">file type: jpg, png, pdf (max size 2mb)</small>
              @error('surat_keterangan_sehat')
              <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
              @enderror
              @if($surat_keterangan_sehat)
              <p></p>
              <img src="{{ $surat_keterangan_sehat->temporaryUrl() }}" class="mt-2 img-thumbnail" style="max-height:120px;">
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label class="col-4">Sertifikat Pedigri</label>
            <div class="col-8">
              <input type="file" class="form-control" wire:model.lazy="sertifikat_pedigree">
              <small style="color:#FF6843">file type: jpg, png, pdf (max size 2mb)</small>
              @if($sertifikat_pedigree)
              <p></p>
              <img src="{{ $sertifikat_pedigree->temporaryUrl() }}" class="img-thumbnail" style="max-height:120px;">
              @endif
            </div>
          </div>

          <div class="form-group row">
            <div class="col-3">
              <p style="color:red">(*) Wajib Diisi</p>
            </div>
            <div class="col-9 text-right">
              <button type="button" class="btn btn-primary" wire:click.prevent="previousStepEditModal">Previous</button>
              <button type="button" class="btn btn-primary" wire:click.prevent="editProdukData">Submit</button>
            </div>
          </div>
        </div>

        @endif
      </div>
    </div>
  </div>

  @push('scripts')

  <script>

    window.addEventListener('show-add-modal', event => {
      $('#addProdukModal').modal('show');
    });
    window.addEventListener('show-edit-modal', event => {
      $('#editProdukModal').modal('show');
    });
    window.addEventListener('success-notification', function() {
      Swal.fire({
        title: 'Success',
        text: 'Data hewan kamu berhasil di update !',
        icon: 'success',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Ok',

      }).then((result) => {
        if (result.isConfirmed) {
          $('#editProdukModal').modal('hide');

        }
      })
    });
    document.addEventListener('DOMContentLoaded', function() {
      @this.on('triggerDelete', id_animal_photo => {
        Swal.fire({
          title: 'Are You Sure?',
          text: 'This photo will be deleted forever',
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#aaa',
          confirmButtonText: 'Delete!'
        }).then((result) => {
          //if user clicks on delete
          if (result.value) {
            // calling destroy method to delete
            @this.call('deletePhoto', id_animal_photo)
            // success response
            Swal.fire({
              title: 'Photo deleted successfully!',
              icon: 'success'
            });
          }
        });
      });
    })
  </script>

  @endpush

</div>