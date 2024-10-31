@extends('dashboard.layout.master')
@section('menuDataBencana', 'active')

@section('content')
    <div class="row">
        <div class="col-lg">
            <h3>Edit Data Bencana</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="margin-left: -15px">
                    <li class="breadcrumb-item"><a href="/dashboard" class="text-primary">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('data-bencana.index') }}" class="text-primary">Data
                            Bencana</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Data Bencana</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-lg">
            <form action="{{ route('data-bencana.update', $bencanas->id) }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('data-bencana.index') }}" class="btn btn-primary">
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
                                    <label>Lokasi</label>
                                    <select name="lokasi_id" class="form-control @error('lokasi_id') is-invalid @enderror"
                                        id="selectedLokasi" style="width: 100%">
                                        <option value="" selected>Pilih Lokasi</option>
                                        @foreach ($lokasis as $data)
                                            <option value="{{ $data->id }}"
                                                {{ $bencanas->lokasi_id == $data->id ? 'selected' : '' }}>
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
                                        value="{{ old('nama_bencana', $bencanas->nama_bencana ?? '-') }}" placeholder="Masukan nama bencana">
                                    @error('nama_bencana')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Tanggal</label>
                                    <input type="date" name="tanggal"
                                        class="form-control @error('tanggal') is-invalid @enderror"
                                        value="{{ old('tanggal', $bencanas->tanggal) }}">
                                    @error('tanggal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Penyebab</label>
                                    <textarea name="penyebab" class="form-control @error('penyebab') is-invalid @enderror" rows="5"
                                        placeholder="Masukan keterangan">{{ old('penyebab', $bencanas->penyebab ?? '-') }}</textarea>
                                    @error('penyebab')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Keterangan</label>
                                    <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="5"
                                        placeholder="Masukan keterangan">{{ old('keterangan', $bencanas->keterangan ?? '-') }}</textarea>
                                    @error('keterangan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Latitude</label>
                                    <input type="text" name="latitude"
                                        class="form-control @error('latitude') is-invalid @enderror"
                                        value="{{ old('latitude', $bencanas->latitude ?? '-') }}" placeholder="Masukan latitude">
                                    @error('latitude')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Longitude</label>
                                    <input type="text" name="longitude"
                                        class="form-control @error('longitude') is-invalid @enderror"
                                        value="{{ old('longitude', $bencanas->longitude ?? '-') }}" placeholder="Masukan longitude">
                                    @error('longitude')
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
@push('custom-script')
    <script>
        $(document).ready(function() {
            $('#selectedLokasi').select2({
                theme: 'bootstrap4',
            });
        });
    </script>
@endpush
