@extends('dashboard.layout.master')
@section('menuDashboard', 'active')
@section('content')
    <div class="row">
        <div class="col-lg">
            <h3>Dashboard</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="margin-left: -15px">
                    <li class="breadcrumb-item"><a href="/dashboard" class="text-primary">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Peta Bencana</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div id="map" sty style="width:100%; height: 800px;"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom-script')
<script>
    // Inisialisasi peta
    var map = L.map('map').setView([-0.456022, 100.595005], 12); // Koordinat awal peta (Indonesia)

    // Tambahkan tile layer dari OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Data bencana dari database
    var bencanas = @json($bencanas);

    // Looping data bencana dan tambahkan marker serta circle ke peta
    bencanas.forEach(function(bencana) {
        if (bencana.latitude && bencana.longitude) {
            // Menambahkan marker untuk bencana
            var marker = L.marker([bencana.latitude, bencana.longitude])
                .addTo(map)
                .bindPopup(
                    `<strong>${bencana.nama_bencana}</strong><br>${bencana.tanggal}<br>${bencana.keterangan}`
                );

            // Jika Anda memiliki data radius dalam meter untuk masing-masing bencana, Anda bisa menggunakan itu.
            // Misalnya, kita anggap radius diambil dari bencana.radius
            var radius = bencana.radius ? bencana.radius : 1000; // Ganti 1000 dengan nilai radius yang diinginkan (dalam meter)

            // Menambahkan circle dengan radius
            L.circle([bencana.latitude, bencana.longitude], {
                color: 'red',         // Warna lingkaran
                fillColor: '#f03',   // Warna isi
                fillOpacity: 0.5,    // Opasitas isi
                radius: radius        // Radius dalam meter
            }).addTo(map);
        }
    });
</script>
@endpush

