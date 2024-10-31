@extends('dashboard.layout.master')
@section('menuDataLokasi', 'active')

@section('content')
    <div class="row">
        <div class="col-lg">
            <h3>Tambah Data Lokasi</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="margin-left: -15px">
                    <li class="breadcrumb-item"><a href="/dashboard" class="text-primary">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('data-lokasi.index') }}" class="text-primary">Data
                            Lokasi</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Data Lokasi</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-lg">
            <form action="{{ route('data-lokasi.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('data-lokasi.index') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left"></i>
                            Kembali
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i>
                            Simpan Data
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label>Nama Lokasi</label>
                                    <input type="text" name="nama_lokasi"
                                        class="form-control @error('nama_lokasi') is-invalid @enderror"
                                        value="{{ old('nama_lokasi') }}" placeholder="Masukan nama lokasi">
                                    @error('nama_lokasi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
