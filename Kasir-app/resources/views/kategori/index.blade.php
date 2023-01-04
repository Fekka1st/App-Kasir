@extends('layouts.master')

@section('title')
    Kategori
@endsection

@section('rute')
    @parent
    <li class="breadcrumb-item active">Kategori</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header with-border">
                    <button onclick="tambah()"class="btn btn-success">Tambah</button>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped table-bordered ">
                        <thead>
                            <th width="5%">No</th>
                            <th>Kategori</th>
                            <th widht="10$">Aksi</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@includeIf('kategori.form')

@push('script')
    <script>
        let tablel;
        $(function() {
            tablel = $('.table').DataTable({
                processing: true,
                autoWidth: false,
                Ajax: {
                    url: '{{ route('kategori.data') }}',

                }
            });
        });

        function tambah() {
            $('#form').modal('show');
            $('#formLabel').text('Tambah Kategori')
        }
    </script>
@endpush
