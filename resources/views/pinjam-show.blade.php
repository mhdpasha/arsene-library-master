<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Arsene Library | {{ $buku->judul }}</title>

    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/arsene-lib-logo-white.png">
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body class="px-5">
    <a class="btn bg-gradient-dark w-10" href="{{ URL::previous() }}" id="back">
        v
    </a>
    <main>
        <div class="pe-5" id="frame">
            <a href="{{ $buku->image }}">
                <img src="{{ $buku->image }}" alt="cover">
            </a>
        </div>
        <div class="px-5">
            <h1><strong>{{ $buku->judul }}</strong></h1>
            <p>{{ $buku->deskripsi }}</p>
            <br>
            <h4><strong>Detail Buku</strong></h4>
                <li>Pengarang: {{ $buku->pengarang }}</li>
                <li>Penerbit: {{ $buku->penerbit }}</li>
                <li>Genre: {{ $buku->kategori->nama }}</li>
            <br><br>
            @if (auth()->user()->pustakawan)
            @else
            <h4><strong>Detail Peminjaman</strong></h4>
            <form action="{{ route('pinjam.store') }}" method="POST">
                @csrf
                <input type="hidden" value="{{ $buku->id }}" name="buku_id">
                <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                <div class="row g-3">
                    <div class="col">
                        <label>Alasan Peminjaman</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Jelaskan alasanmu" autocomplete="off" name="message">
                        </div>
                    </div>
                    <div class="col">
                        <label>Tanggal Pengembalian</label>
                        <div class="input-group mb-3">
                            <input type="date" class="form-control" placeholder="Tanggal Pengembalian" autocomplete="off" name="tanggal_kembali">
                        </div>
                    </div>
                </div>
                
                @if ($buku->kategori->status == 0)
                <button class="btn bg-gradient-secondary w-100 mt-3" disabled><strong>Buku Nonaktif</strong></button>
                @elseif($buku->stok > 0)  
                <button class="btn bg-gradient-dark w-100 mt-3" type="submit"><strong>Pinjam</strong></button>
                @else
                <button class="btn bg-gradient-secondary w-100 mt-3" disabled><strong>Stok Habis</strong></button>
                @endif
            </form>
            @endif
        </div>
    </main>
</body>

<style>
    body {
        background: #F8F9FA;
        max-width: 100%;
        height: 90vh;
        overflow: hidden;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        color: #344767;
    }
    main {
        background: #F8F9FA;
        max-width: 1200px;
        height: 90vh;
        overflow: hidden;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
    }
    li {
        list-style-type: '> ';
    }
    img:hover {
        translate: 0 -10px;
    }
    img {
        aspect-ratio: 3/4;
        width: 400px;
        object-fit: cover;
        border-radius: 20px;
        transition: cubic-bezier(.17,.91,.28,.81) 0.8s;
    }
    a {
        transition: cubic-bezier(.17,.91,.28,.81) 0.8s !important;
    }
    a:hover {
        translate: 0 -10px;
    }
    button {
        transition: cubic-bezier(.17,.91,.28,.81) 0.8s !important;
    }
    #back {
        transform: rotate(90deg)
    }

</style>

  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/fullcalendar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>

</html>