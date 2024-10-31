<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GEOGRAPHIC INFORMATION SYSTEM BENCANA ALAM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <style>
        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 20px;
            /* Sesuaikan nilai ini untuk jarak yang diinginkan */
        }

        #myTable td,
        #myTable th {
            line-height: 1.8;
        }

        #myTable {
            border: 1px solid rgb(206, 206, 206);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light shadow">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" width="70">
                <div class="ms-3">
                    <h4 class="mb-0" style="color: #FF7F00;">
                        <b>GEOGRAPHIC INFORMATION SYSTEM BENCANA ALAM</b>
                    </h4>
                    <p class="mb-0" style="font-size: smaller;">
                        <b>Badan Penanggulangan Bencana Daerah Kab. Tanah Datar</b>
                    </p>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link @yield('menuBeranda')" aria-current="page" href="/">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('menuBencana')" href="{{ route('bencana.index') }}">Data Bencana</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('menuTentangKami')" href="{{ route('tentang-kami.index') }}">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('menuGaleriBencana')" href="{{ route('galeri-bencana.index') }}">Galeri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('menuKontakKami')" href="{{ route('kontak.index') }}">Kontak Kami</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    @stack('custom-script')
</body>

</html>
