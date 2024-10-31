@extends('landing.layout.master')
@section('menuKontakKami', 'active')
@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="mb-4">
                    <nav aria-label="breadcrumb">
                        <h1>Kontak Kami</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Kontak Kami</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="mb-4">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.6920192239295!2d100.5924106758233!3d-0.45589603528407857!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd52d6c912f19e5%3A0x4854630fa11d77a1!2sBadan%20Penanggulangan%20Bencana%20Daerah%20Kabupaten%20Tanah%20Datar!5e0!3m2!1sen!2sid!4v1730339025407!5m2!1sen!2sid"
                        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div class="col-lg-6 px-4">
                <div class="mb-4">
                    <h3><u>Telepon</u></h3>
                    <p>021-2982XXXX</p>
                </div>
                <div class="mb-4">
                    <h3><u>Fax</u></h3>
                    <p>021-2128XXXX</p>
                </div>
                <div class="mb-4">
                    <h3><u>Email</u></h3>
                    <p>XXXXXXX@bnpb.go.id</p>
                </div>
                <div class="mb-4">
                    <h3><u>Alamat</u></h3>
                    <p>
                        Jl. Raya Batusangkar No.465,
                        Limo Kaum, Kec. Lima Kaum,
                        Kabupaten Tanah Datar,
                        Sumatera Barat 27213
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
