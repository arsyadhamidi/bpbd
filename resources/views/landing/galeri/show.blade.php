@extends('landing.layout.master')
@section('menuGaleriBencana', 'active')
@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="mb-4">
                    <nav aria-label="breadcrumb">
                        <h1>Selengkapnya Galeri</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('galeri-bencana.index') }}">Galeri</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Selengkapnya Galeri</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $galeris->foto_bencana) }}"
                        style="width: 100%; height: 500px; object-fit: cover" class="img-fluid" alt="">
                </div>
            </div>
            <div class="col-lg-12">
                <div class="mb-3">
                    <h1>{{ $galeris->nama_bencana ?? '-' }}</h1>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="mb-3">
                    <p>{{ $galeris->keterangan ?? '-' }}</p>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="mb-3">
                    <a href="{{ route('galeri-bencana.index') }}" class="btn btn-primary">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
