@extends('layouts.master')

@section('title')
    Laporan Pendapatan
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('/AdminLTE/plugins/daterangepicker.css') }}">
@endpush

@section('breadcrumb')
    @parent
    <li class="active">Laporan</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header with-border">
                    <div class="btn-group"> <button onclick="updatePeriode()" class="btn btn-info btn-flat" type="button"><i
                                class="fas fa-plus-circle"></i>
                            Ubah Periode</button>
                        <a href="{{ route('laporan.export_pdf', [$tanggalAwal, $tanggalAkhir]) }}" target="_blank"
                            class="btn btn-success"><i class="fas fa-file-pdf"></i> Export PDF</a>
                    </div>

                </div>
                <div class="card-body table-responsive">
                    <table class="table table-stiped table-bordered ">
                        <thead>
                            <th width="5%">No</th>
                            <th>Tanggal</th>
                            <th>Penjualan</th>
                            <th>Pembelian</th>
                            <th>Pengeluaran</th>
                            <th>Pendapatan</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @includeIf('laporan.form')
@endsection

@push('script')
    <script src="{{ asset('/AdminLTE/plugins/daterangepicker.js') }}"></script>
    <script>
        let table;
        $(function() {
            table = $('.table').DataTable({
                processing: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('laporan.data', [$tanggalAwal, $tanggalAkhir]) }}',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'tanggal'
                    },
                    {
                        data: 'penjualan'
                    },
                    {
                        data: 'pembelian'
                    },
                    {
                        data: 'pengeluaran'
                    },
                    {
                        data: 'pendapatan'
                    }
                ],

                bSort: false,
                bPaginate: false,
            });

            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });
        });

        function updatePeriode() {
            $('#modal-form').modal('show');
        }
    </script>
