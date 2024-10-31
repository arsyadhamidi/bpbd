@extends('landing.layout.master')
@section('menuGaleriBencana', 'active')
@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="mb-4">
                    <nav aria-label="breadcrumb">
                        <h1>Galeri</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Galeri</li>
                        </ol>
                    </nav>
                </div>
            </div>
            @foreach ($galeris as $data)
                <div class="col-lg-3">
                    <div class="mb-3">
                        <div class="card" style="width: 18rem;">
                            <img src="{{ asset('storage/' . $data->foto_bencana) }}" class="card-img-top"
                                style="width: 100%; height: 200px; object-fit: cover">
                            <div class="card-body">
                                <h4>
                                    {{ $data->nama_bencana ? \Illuminate\Support\Str::limit($data->nama_bencana, 50) : '-' }}
                                </h4>
                                <p class="card-text">
                                    {{ $data->keterangan ? \Illuminate\Support\Str::limit($data->keterangan, 100) : '-' }}
                                </p>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('galeri-bencana.show', $data->id) }}" class="btn btn-primary w-100">
                                    Baca Selengkapnya
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
