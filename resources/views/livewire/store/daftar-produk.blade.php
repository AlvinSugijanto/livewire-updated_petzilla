<div>

  <div class="container" style="max-width:100%">
    <div class="row">
      <div class="col-md-12">
        <button class="btn p-2" style="background-color:#A27B5C" data-toggle="modal" data-target="#addProdukModal"><h6 class="m-0" style="font-size:14px; color:#FFF9F2">Tambah Produk</h6></button>
        <table class="table table-bordered table-hover mt-2">
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
              <td><div class="animal-description">{{ $animal->deskripsi }}</div></td>
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

          <form wire:submit.prevent="storeProduk">
            <div class="form-group row">
              <label for="student_id" class="col-3">Jenis Hewan <span style="color:red">*<span></label>
              <div class="col-9">
                <select class="form-control" wire:model="jenis_hewan">
                  <option selected hidden>--Select Animal Type--</option>
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
                        <img src="{{ $photo->temporaryUrl() }}" class="mt-2">
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
                <button type="submit" class="btn btn-sm btn-primary">Add Produk</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Edit Modal -->
  <div wire:ignore.self class="modal fade" id="editProdukModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Hewan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          </button>
        </div>
        <div class="modal-body">

          <form wire:submit.prevent="editProdukData">
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
                  <img src="{{ asset('/animal_photos/'.$display_photo) }}" class="mt-2 img-thumbnail" style="max-width:200px;">
                @endif
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
                  @if(!empty($display_photos))
                    @foreach($display_photos as $photo)
                    <div class="image-hover">
                      <img src="{{ asset('/animal_photos/'.$photo->photo) }}" class="mt-2 img-thumbnail img-hover" style="max-width:200px;">
                      <a wire:click="$emit('triggerDelete',{{ $photo->id_animal_photo }})" class="trash-hover"><i class="fa fa-trash" aria-hidden="true" style="color:red"></i></a>
                    </div>
                    @endforeach
                  @endif

                  @if(!empty($photos))
                    @foreach($photos as $photo)
                    <div class="col-3">
                      <img src="{{ $photo->temporaryUrl() }}" class="mt-2">
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
                <button type="submit" class="btn btn-sm btn-primary">Add Produk</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  @push('scripts')

  <script>
    window.addEventListener('close-modal', event => {
      $('#addProdukModal').modal('hide');

    });
    window.addEventListener('show-add-modal', event => {
      $('#addProdukModal').modal('show');
    });
    window.addEventListener('show-edit-modal', event => {
      $('#editProdukModal').modal('show');
    });
    document.addEventListener('DOMContentLoaded', function () {
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
                    @this.call('deletePhoto',id_animal_photo)
             // success response
                    Swal.fire({title: 'Photo deleted successfully!', icon: 'success'});
                } else {
                    Swal.fire({
                        title: 'Operation Cancelled!',
                        icon: 'success'
                    });
                }
            });
        });
    })
  </script>

  @endpush
  {{ $animals->links() }}

</div>