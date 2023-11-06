@extends('layouts.user_type.auth')

@section('content')

<div>
  @if($pustakawan)
  <div class="row">
    <div class="col-12">
        <div class="card mb-4 mx-4">
            <div class="card-header pb-0">
                <div class="d-flex flex-row justify-content-between">
                    <div>
                        <h5 class="mb-0"><strong>Status Peminjaman</strong></h5>
                    </div>
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
                    
                    <table id="dataTable2" class="uk-table uk-table-hover uk-table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Anggota</th>
                                <th>Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Alasan</th>
                                <th width="80px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $pinjam)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><strong>{{ $pinjam->user->name }}{{ ($pinjam->kode_peminjaman) ? " | {$pinjam->kode_peminjaman}" : '' }}</strong></td>
                                <td><a class="text-body" href="{{ route('buku.show', $pinjam->buku->uuid) }}">{{ $pinjam->buku->judul }} | {{ $pinjam->buku->pengarang }}</a></td>
                                <td>{{ date('d M Y', strtotime($pinjam->tanggal_pinjam))}}</td>
                                <td>{{ date('d M Y', strtotime($pinjam->tanggal_kembali))}}</td>
                                <td>{{ $pinjam->message }}</td>
                                @if ($pinjam->status == 'accepted')
                                <td>
                                  <form action="{{ route('pinjam.update', $pinjam) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" value="returned" name="returned">
                                    <button type="submit" class="btn btn-sm bg-gradient-dark">Return</button>
                                  </form>
                                </td>
                                @elseif ($pinjam->status == 'rejected')
                                <td><span class="badge bg-gradient-danger">Rejected</span></td>
                                @else
                                <td class="d-flex gap-3">
                                  <form action="{{ route('pinjam.update', $pinjam) }}" method="POST" class="d-flex">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" value="accepted" name="status">
                                    <button type="submit" class="btn btn-sm bg-gradient-dark">Accept</button>
                                  </form>
                                  <form action="{{ route('pinjam.update', $pinjam) }}" method="POST" class="d-flex">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" value="rejected" name="status">
                                    <button type="submit" class="btn btn-sm bg-gradient-dark">Decline</button>
                                  </form>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
  @else
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0"><strong>Pinjam Buku</strong></h5>
                        </div>
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
                            @endif
                        
                        <table id="dataTable" class="uk-table uk-table-hover uk-table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Pengarang</th>
                                    <th>Penerbit</th>
                                    <th>Kategori</th>
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
                                    <td>{{ $buku->created_at->format('d M Y') }}</td>
                                    <td>
                                        {{-- Action Button --}}
                                        <div class="d-flex justify-center align-items-center">
                                            <button class="btn btn-sm btn-dark me-2" data-bs-toggle="modal" data-bs-target="#modal-pinjam{{ $buku->id }}" style="padding: 0; width: 100%; height: 35px">Pinjam</button>
                                        </div>
                                        <div class="modal fade" id="modal-pinjam{{ $buku->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content px-3">
                                              <div class="modal-body">
                                                <a class="mx-auto" href="{{ route('buku.show', $buku->uuid) }}">
                                                  <img class="border-radius-lg my-3" src="{{ $buku->image }}" alt="cover" height="auto" width="100%">
                                                </a>
                                                <h3 class="font-weight-bolder text-dark text-gradient my-2">{{ $buku->judul }}</h3>
                                                <p class="mb-5 text-justify">{{ $buku->deskripsi }}<p>
                                                <a class="btn bg-gradient-dark" style="width: 100%" href="{{ route('buku.show', $buku->uuid) }}">Pinjam</a>
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

            <div class="col-12 mt-4 d-flex" id="rekomendasi">
                <div class="card mb-4">
                  <div class="card-header pb-0 p-3">
                    <h2 class="mt-3 mb-1 text-center"><strong>Rekomendasi Buku</strong></h2>
                  </div>
                  <div class="row row-cols-3 row-cols-md-3 g-4 px-5 py-5">
                    @foreach ($rekomendasi as $buku)
                    <div class="col">
                      <div class="card h-100">
                        <a class="mx-auto" href="{{ route('buku.show', $buku->uuid) }}">
                          <img src="{{ $buku->image }}" class="card-img-top img-fluid img-thumbnail" alt="cover" id="cover">
                        </a>
                        <div class="card-body">
                            <h3 class="font-weight-bolder text-dark text-gradient my-2">{{ $buku->judul }}</h3>
                            <p class="card-text">{{ $buku->deskripsi }}</p>
                        </div>
                        <div class="card-footer">
                            <a class="btn bg-gradient-dark" style="width: 100%" href="{{ route('buku.show', $buku->uuid) }}">Pinjam</a>
                        </div>
                      </div>
                    </div>
                    @endforeach
                  </div>

                  <style>
                    #cover {
                      aspect-ratio: 3/4;
                      width: 400px;
                      object-fit: cover;
                      border-radius: 20px;
                      transition: cubic-bezier(.17,.91,.28,.81) 0.8s;
                    }
                    #cover:hover {
                      translate: 0 -10px;
                    }
                  </style>

                      {{-- <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                        <div class="card h-100 card-plain border">
                          <div class="card-body d-flex flex-column justify-content-center text-center">
                            <a href="javascript:;">
                              <i class="fa fa-plus text-secondary mb-3"></i>
                              <h5 class=" text-secondary"> New project </h5>
                            </a>
                          </div>
                        </div>
                      </div> --}}

                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
    @endif
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
      pageLength: 5,
      lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, 'All']],
      oLanguage: {
        "sSearch": "Cari buku: "
      }
    });
    $('#dataTable2').DataTable({
      pageLength: 10,
      lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, 'All']],
      oLanguage: {
        "sSearch": "Cari Peminjaman: "
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