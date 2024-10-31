@extends('dashboard.layout.master')
@section('menuDataGaleriBencana', 'active')

@section('content')
    <div class="row">
        <div class="col-lg">
            <h3>Edit Data Galeri</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="margin-left: -15px">
                    <li class="breadcrumb-item"><a href="/dashboard" class="text-primary">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('data-galeri.index') }}" class="text-primary">Data
                            Galeri</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Data Galeri</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-lg">
            <form action="{{ route('data-galeri.update', $galeris->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('data-galeri.index') }}" class="btn btn-primary">
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
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Lokasi</label>
                                    <select name="lokasi_id" class="form-control @error('lokasi_id') is-invalid @enderror"
                                        id="selectedLokasi" style="width: 100%">
                                        <option value="" selected>Pilih Lokasi</option>
                                        @foreach ($lokasis as $data)
                                            <option value="{{ $data->id }}"
                                                {{ $galeris->lokasi_id == $data->id ? 'selected' : '' }}>
                                                {{ $data->nama_lokasi ?? '-' }}</option>
                                        @endforeach
                                    </select>
                                    @error('lokasi_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Nama Bencana</label>
                                    <input type="text" name="nama_bencana"
                                        class="form-control @error('nama_bencana') is-invalid @enderror"
                                        value="{{ old('nama_bencana', $galeris->nama_bencana ?? '-') }}" placeholder="Masukan nama bencana">
                                    @error('nama_bencana')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label>Keterangan</label>
                                    <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="5"
                                        placeholder="Masukan keterangan">{{ old('keterangan', $galeris->keterangan ?? '-') }}</textarea>
                                    @error('keterangan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label>Upload Foto Bencana</label>
                                    <input type="file" name="foto_bencana" class="file-upload-default" hidden>
                                    <div class="input-group col-xs-12">
                                        <input type="text"
                                            class="form-control file-upload-info @error('foto_bencana') is-invalid @enderror"
                                            disabled placeholder="Upload Image">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-success"
                                                type="button">Upload</button>
                                        </span>
                                        @error('foto_bencana')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('custom-script')
    <script>
        $(document).ready(function() {
            $('#selectedLokasi').select2({
                theme: 'bootstrap4',
            });
        });
    </script>
@endpush
