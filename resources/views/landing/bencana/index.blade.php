@extends('landing.layout.master')
@section('menuBencana', 'active')
@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="mb-4">
                    <nav aria-label="breadcrumb">
                        <h1>Data Bencana</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Bencana</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="mb-4">
                    <select name="lokasi_id" class="form-control" id="selectedLokasi">
                        <option value="" selected>Pilih Lokasi</option>
                        @foreach ($lokasis as $data)
                            <option value="{{ $data->id }}" {{ request('lokasi_id') == $data->id ? 'selected' : '' }}>
                                {{ $data->nama_lokasi ?? '-' }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="mb-4">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fa fa-calendar-alt"></i>
                        </span>
                        <input type="text" class="form-control form-control-xl" id="searchByDate" style="height: 48px">
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="mb-4">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered table-striped" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Lokasi</th>
                                        <th>Bencana</th>
                                        <th>Tanggal</th>
                                        <th>Penyebab</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
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
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#searchByDate').daterangepicker({
                startDate: moment().startOf('year'),
                endDate: moment().endOf('year'),
                locale: {
                    format: 'YYYY-MM-DD'
                },
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                }
            }, function(start_date, end_date) {
                myTable.draw();
            });

            // Tampilkan Data
            let myTable = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                paging: true,
                pageLength: 10,
                lengthMenu: [
                    [10, 25, 50, 100, 250],
                    [10, 25, 50, 100, 250]
                ],
                language: {
                    paginate: {
                        previous: 'Sebelumnya',
                        next: 'Selanjutnya'
                    }
                },
                ajax: {
                    url: "{{ route('bencana.index') }}",
                    data: function(data) {
                        data.page = Math.ceil((data.start || 0) / (data.length || 10)) + 1;
                        data.search = $('#myTable_filter input').val();
                        data.lokasi_id = $('#selectedLokasi').val();
                        var startDate = $('#searchByDate').data('daterangepicker').startDate.format(
                            'YYYY-MM-DD');
                        var endDate = $('#searchByDate').data('daterangepicker').endDate.format(
                            'YYYY-MM-DD');
                        data.start_date = startDate;
                        data.end_date = endDate;
                    }
                },
                columns: [{
                        data: 'lokasi.nama_lokasi',
                        name: 'lokasi.nama_lokasi'
                    },
                    {
                        data: 'nama_bencana',
                        name: 'nama_bencana',
                        defaultContent: '-'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal',
                        defaultContent: '-'
                    },
                    {
                        data: 'penyebab',
                        name: 'penyebab',
                        defaultContent: '-'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan',
                        defaultContent: '-'
                    },
                ],
                order: [
                    [1, 'desc']
                ]
            });

            $('#selectedLokasi').on('change', function() {
                myTable.ajax.reload();
            });

            @if (Session::has('success'))
                toastr.success("{{ Session::get('success') }}");
            @endif

            @if (Session::has('error'))
                toastr.error("{{ Session::get('error') }}");
            @endif
        });
    </script>
@endpush
