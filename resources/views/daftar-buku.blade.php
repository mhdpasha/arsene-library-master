@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0"><strong>Daftar Buku</strong></h5>
                        </div>
                        <a href="#" class="btn bg-gradient-dark btn-sm mb-0" type="button" data-bs-toggle="modal" data-bs-target="#modal-form">+&nbsp; Tambah Buku</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive px-4 py-4">

                                @if ($errors->any())
                                    <div class="alert alert-primary alert-dismissible fade show mt-4" role="alert" data-dismiss="alert" style="cursor: pointer;">
                                        <h4 class="text-white"><strong>Field belum terisi sepenuhnya.</strong></h4>
                                        <ul class="text-white" style="list-style-type: '-';>">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                            @elseif (session()->has('added'))
                                    <div class="alert alert-dark alert-dismissible fade show mt-4" role="alert" data-dismiss="alert" style="cursor: pointer;">
                                        <strong class="d-flex items-center justify-content-center text-white">
                                             {{ session('added') }}
                                        </strong>
                                    </div>
                            @elseif (session()->has('saved'))
                                    <div class="alert alert-secondary alert-dismissible fade show mt-4" role="alert" data-dismiss="alert" style="cursor: pointer;">
                                        <strong class="d-flex items-center justify-content-center text-white">
                                             {{ session('saved') }}
                                        </strong>
                                    </div>
                            @elseif (session()->has('deleted'))
                                    <div class="alert alert-light alert-dismissible fade show mt-4" role="alert" data-dismiss="alert" style="cursor: pointer;">
                                        <strong class="d-flex items-center justify-content-center">
                                             {{ session('deleted') }}
                                        </strong>
                                    </div>
                            @endif
                        
                        <table id="dataTable" class="uk-table uk-table-hover uk-table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Pengarang</th>
                                    <th>Penerbit</th>
                                    <th>Kategori</th>
                                    <th>Stok Buku</th>
                                    <th>Tanggal Pengarsipan</th>
                                    <th width="120px"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $buku)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $buku->judul }}</td>
                                    <td>{{ $buku->pengarang }}</td>
                                    <td>{{ $buku->penerbit }}</td>
                                    <td>{{ $buku->kategori->nama }}</td>
                                    <td>{{ $buku->stok }}</td>
                                    <td>{{ $buku->created_at->format('d M Y') }}</td>
                                    <td>
                                        {{-- Action Button --}}
                                        <div class="d-flex justify-center align-items-center">
                                            <button class="btn btn-sm btn-dark me-2" data-bs-toggle="modal" data-bs-target="#modal-edit{{ $buku->id }}" style="padding: 0; width: 55px; height: 35px">Edit</button>
                                            <form action="{{ route('buku.destroy', $buku) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-dark me-2" style="padding: 0; width: 70px; height: 35px">Delete</button>
                                            </form>
                                        </div>

                                        {{-- Modal --}}
                                       <div class="modal fade" id="modal-edit{{ $buku->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal" role="document">
                                          <div class="modal-content">
                                            <div class="modal-body p-0">
                                              <div class="card card-plain">
                                                <div class="card-body">
                                                  <h3 class="font-weight-bolder text-dark text-gradient">Edit Detail Buku</h3>
                                                  <form action="{{ route('buku.update', $buku) }}" method="POST">
                                                      @csrf
                                                      @method('PATCH')
                                                      <div class="row g-3">
                                                        <div class="col">
                                                            <label>Judul</label>
                                                            <div class="input-group mb-3">
                                                              <input type="text" class="form-control" placeholder="Judul buku" autocomplete="off" name="judul" value="{{ $buku->judul }}">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <label>Pengarang</label>
                                                            <div class="input-group mb-3">
                                                              <input type="text" class="form-control" placeholder="Nama pengarang" autocomplete="off" name="pengarang" value="{{ $buku->pengarang }}">
                                                            </div>
                                                        </div>
                                                      </div>  
                                                      <label>Penerbit</label>
                                                      <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="Nama penerbit" autocomplete="off" name="penerbit" value="{{ $buku->penerbit }}">
                                                      </div>
                                                      <label>Kategori Genre</label>
                                                      <select class="form-select" name="kategori_id">
                                                          @foreach ($select as $kategori)
                                                            <option value="{{ $kategori->id }}" {{ ($kategori->id == $buku->kategori_id) ? 'selected' : '' }}>{{ $kategori->nama }}</option>
                                                          @endforeach
                                                      </select>
                                                      <label>Deskripsi</label>
                                                      <div class="form-floating">
                                                        <textarea class="form-control" id="floatingTextarea2" style="height: 100px" autocomplete="off" name="deskripsi">{{ $buku->deskripsi }}</textarea>
                                                      </div>
                                                      <label>Cover Buku (opsional)</label>
                                                      <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="CDN atau Link" autocomplete="off" name="image" value="{{ $buku->image }}">
                                                      </div>
                                                      <label>Stok Tersedia</label>
                                                      <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="5" autocomplete="off" name="stok" value="{{ $buku->stok }}">
                                                      </div>
                                                      <div class="text-center">
                                                        <button type="submit" class="btn btn-round bg-gradient-dark btn-lg w-100 mt-4 mb-0">Save</button>
                                                      </div>
                                                  </form>
                                                </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card card-plain">
              <div class="card-body">
                <h3 class="font-weight-bolder text-dark text-gradient">Tambah Buku</h3>
                <form action="{{ route('buku.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                      <div class="col">
                          <label>Judul</label>
                          <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Judul buku" autocomplete="off" name="judul">
                          </div>
                      </div>
                      <div class="col">
                          <label>Pengarang</label>
                          <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Nama pengarang" autocomplete="off" name="pengarang">
                          </div>
                      </div>
                    </div>  
                    <label>Penerbit</label>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" placeholder="Nama penerbit" autocomplete="off" name="penerbit">
                    </div>
                    <label>Kategori Genre</label>
                      <select class="form-select" name="kategori_id">
                          @foreach ($select as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                          @endforeach
                      </select>
                    <label>Deskripsi</label>
                    <div class="form-floating">
                      <textarea class="form-control" id="floatingTextarea2" style="height: 100px" autocomplete="off" name="deskripsi"></textarea>
                    </div>
                    <label>Cover Buku (opsional)</label>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" placeholder="CDN atau Link" autocomplete="off" name="image">
                    </div>
                    <label>Stok Tersedia (default 5)</label>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" placeholder="5" autocomplete="off" name="stok">
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-round bg-gradient-dark btn-lg w-100 mt-4 mb-0">Save</button>
                    </div>
                </form>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>




  {{-- Datatables Stylesheets --}}
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.uikit.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/css/uikit.min.css">

  {{-- Datatables --}}
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.uikit.min.js"></script>
  <script>
    $('#dataTable').DataTable({
      columnDefs: [
        { "searchable": false, "targets": 6 }
      ],
      oLanguage: {
        "sSearch": "Cari buku: "
      }
    });
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
    });
}, 1500);
  </script>

  <style>
    a:hover {
        text-decoration: none
    }

    #dataTable {
        padding: 0px 100px;
    }
  </style>


 
@endsection