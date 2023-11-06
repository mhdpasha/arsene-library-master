@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0"><strong>Daftar Genre</strong></h5>
                        </div>
                        <a href="#" class="btn bg-gradient-dark btn-sm mb-0" type="button" data-bs-toggle="modal" data-bs-target="#modal-form">+&nbsp; Tambah Genre</a>
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
                                    <th>Status</th>
                                    <th width="100px">ID Genre</th>
                                    <th>Genre</th>
                                    <th>Deskripsi</th>
                                    <th width="120px"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $genre)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }})</td>
                                        @if ($genre->status)
                                        <td><span class="badge bg-gradient-success">Aktif</span></td>
                                        @else
                                        <td><span class="badge bg-gradient-danger">Nonaktif</span></td>
                                        @endif
                                    <td>{{ $genre->genre_id }}</td>
                                    <td>{{ $genre->nama }}</td>
                                    <td>{{ $genre->deskripsi }}</td>
                                    <td>
                                        <div class="d-flex justify-center align-items-center">
                                            <button class="btn btn-sm btn-dark me-2" data-bs-toggle="modal" data-bs-target="#modal-edit{{ $genre->id }}" style="padding: 0; width: 55px; height: 35px">Edit</button>
                                            <form action="{{ route('genre.destroy', $genre) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-dark me-2" style="padding: 0; width: 70px; height: 35px">Delete</button>
                                            </form>
                                        </div>

                                       <div class="modal fade" id="modal-edit{{ $genre->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal" role="document">
                                          <div class="modal-content">
                                            <div class="modal-body p-0">
                                              <div class="card card-plain">
                                                <div class="card-body">
                                                  <h3 class="font-weight-bolder text-dark text-gradient">Edit Detail Genre</h3>
                                                  <form action="{{ route('genre.update', $genre) }}" method="POST">
                                                      @csrf
                                                      @method('PATCH')
                                                      <div class="row g-3">
                                                        <div class="col">
                                                            <label>Genre</label>
                                                            <div class="input-group mb-3">
                                                              <input type="text" class="form-control" placeholder="Nama Genre" autocomplete="off" name="nama" value="{{ $genre->nama }}">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <label>ID Genre</label>
                                                            <div class="input-group mb-3">
                                                              <input type="text" class="form-control" placeholder="ID Genre" autocomplete="off" name="genre_id" value="{{ $genre->genre_id }}">
                                                            </div>
                                                        </div>
                                                      </div>  
                                                      <label>Deskripsi</label>
                                                      <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="Deskripsi" autocomplete="off" name="deskripsi" value="{{ $genre->deskripsi }}">
                                                      </div>
                                                      <label>Status</label>
                                                      <select class="form-select" name="status">
                                                          @foreach ($select as $status)
                                                            <option value="{{ $status }}" {{ ($status == $genre->status) ? 'selected' : '' }}>{{ ($status) ? "Aktif" : "Nonaktif" }}</option>
                                                          @endforeach
                                                      </select>
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
                <h3 class="font-weight-bolder text-dark text-gradient">Tambah Genre</h3>
                <form action="{{ route('genre.store') }}" method="POST">
                  @csrf
                  <div class="row g-3">
                    <div class="col">
                        <label>Genre</label>
                        <div class="input-group mb-3">
                          <input type="text" class="form-control" placeholder="Nama Genre" autocomplete="off" name="nama">
                        </div>
                    </div>
                    <div class="col">
                        <label>ID Genre</label>
                        <div class="input-group mb-3">
                          <input type="text" class="form-control" placeholder="ID Genre" autocomplete="off" name="genre_id">
                        </div>
                    </div>
                  </div>  
                  <label>Deskripsi</label>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Deskripsi" autocomplete="off" name="deskripsi">
                  </div>
                  <label>Status</label>
                  <select class="form-select" name="status">
                      @foreach ($select as $status)
                        <option value="{{ $status }}" {{ ($status == $genre->status) ? 'selected' : '' }}>{{ ($status) ? "Aktif" : "Nonaktif" }}</option>
                      @endforeach
                  </select>
                  <div class="text-center">
                    <button type="submit" class="btn btn-round bg-gradient-dark btn-lg w-100 mt-4 mb-0">Submit</button>
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
        { "searchable": false, "targets": 3 }
      ],
      oLanguage: {
        "sSearch": "Cari genre: "
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