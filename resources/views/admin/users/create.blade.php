@extends('dashboard.layout.master')
@section('menuDataUsers', 'active')

@section('content')
    <div class="row">
        <div class="col-lg">
            <h3>Tambah Data Pengguna</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="margin-left: -15px">
                    <li class="breadcrumb-item"><a href="/dashboard" class="text-primary">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('data-user.index') }}" class="text-primary">Data
                            Pengguna</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Data Pengguna</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-lg">
            <form action="{{ route('data-user.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('data-user.index') }}" class="btn btn-primary">
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
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}" placeholder="Masukan nama lengkap">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label>Username</label>
                                    <input type="text" name="username"
                                        class="form-control @error('username') is-invalid @enderror"
                                        value="{{ old('username') }}" placeholder="Masukan username">
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label>Status</label>
                                    <select name="level" class="form-control @error('level') is-invalid @enderror"
                                        id="selectedLevel" style="width: 100%">
                                        <option value="" selected>Pilih Status</option>
                                        <option value="Admin" {{ old('level') == 'Admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="User" {{ old('level') == 'User' ? 'selected' : '' }}>User</option>
                                    </select>
                                    @error('level')
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
            $('#selectedLevel').select2({
                theme: 'bootstrap4',
            });
        });
    </script>
@endpush
