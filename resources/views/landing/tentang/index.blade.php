@extends('landing.layout.master')
@section('menuTentangKami', 'active')
@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="mb-4">
                    <nav aria-label="breadcrumb">
                        <h1>Tentang Kami</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tentang Kami</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="mb-3 text-center">
                    <h3><b>PROFIL BPDB KAB TANAH DATAR</b></h3>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="mb-5">
                    <p>
                        Badan Penanggulangan Bencana Daerah (BPBD) adalah lembaga pemerintah non-departemen yang
                        melaksanakan tugas penanggulangan bencana di daerah baik Provinsi maupun Kabupaten/ Kota dengan
                        berpedoman pada kebijakan yang ditetapkan oleh Badan Nasional Penanggulangan Bencana. BPBD dibentuk
                        berdasarkan Peraturan Presiden Nomor 8 Tahun 2008, menggantikan Satuan Koordinasi Pelaksana
                        Penanganan Bencana (Satkorlak) di tingkat Provinsi dan Satuan Pelaksana Penanganan Bencana (Satlak
                        PB) di tingkat Kabupaten / Kota, yang keduanya dibentuk berdasarkan Peraturan Presiden Nomor 83
                        Tahun 2005.
                    </p>
                </div>
            </div>
            <div class="col-lg-12 py-5">
                <div class="mb-3 text-center">
                    <img src="{{ asset('images/struktur.png') }}" width="1200" alt="">
                </div>
            </div>
        </div>
    </div>
@endsection
