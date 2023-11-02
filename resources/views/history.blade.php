@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0"><strong>History Peminjaman</strong></h5>
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
                        
                        <table id="dataTable" class="uk-table uk-table-hover uk-table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Buku</th>
                                    <th>Tanggal Peminjaman</th>
                                    <th>Rencana Kembali</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Status</th>
                                    <th>Denda</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $history)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $history->buku->judul?? "Buku dihapus" }} | {{ $history->buku->pengarang?? "Null" }}</td>
                                    <td>{{ date('d - M - Y', strtotime($history->tanggal_pinjam)) }}</td>
                                    <td>{{ date('d - M - Y', strtotime($history->tanggal_kembali)) }}</td>
                                    <td>{{ date('d - M - Y', strtotime($history->tanggal_setor)) }}</td>
                                    @if ($history->status == 'accepted')
                                    <td><span class="badge bg-gradient-warning">Dipinjam</span></td>
                                    @elseif ($history->status == 'rejected')
                                    <td><span class="badge bg-gradient-danger">Ditolak</span></td>
                                    @elseif ($history->status == 'returned')
                                        @if ($history->tanggal_setor <= $history->tanggal_kembali)
                                        <td><span class="badge bg-gradient-success">Selesai</span></td>
                                        @elseif ($history->tanggal_setor > $history->tanggal_kembali)
                                        <td><span class="badge bg-gradient-danger">Terlambat</span></td>
                                        @endif
                                    @else
                                    <td><span class="badge bg-gradient-secondary">Pending</span></td>
                                    @endif
                                    <td>{{ ($history->denda > 0) ? 'Rp '.number_format($history->denda, 0, '', '.') : '-' }}</td>
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



  {{-- Datatables Stylesheets --}}
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.uikit.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/css/uikit.min.css">

  {{-- Datatables --}}
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.uikit.min.js"></script>
  <script>
    $('#dataTable').DataTable();
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