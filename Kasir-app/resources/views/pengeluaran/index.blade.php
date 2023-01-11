@extends('layouts.master')

@section('title')
    Daftar Pengeluaran
@endsection

@section('rute')
    @parent
    <li class="breadcrumb-item active">Daftar Pengeluaran</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header with-border">
                    <div class="btn-group">
                        <button onclick="tambah('{{ route('pengeluaran.store') }}')" class="btn btn-success"><i
                                class="fa fa-plus-circle"></i> Tambah</button>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <form action="" method="post" class="form-produk">
                        @csrf
                        <table class="table table-stiped table-bordered">
                            <thead>
                                <th width="5%">No</th>
                                <th>Tanggal</th>
                                <th>Deskripsi</th>
                                <th>Nominal</th>
                                <th width="15%"><i class="fa fa-cog"></i></th>
                            </thead>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @includeIf('pengeluaran.form')
@endsection

@push('script')
    <script>
        function tambah(url) {
            $('#form').modal('show');
            $('#formLabel').text('Tambah Produk');
            $('#form form')[0].reset();
            $('#form form').attr('action', url);
            $('#form [name=_method]').val('post');
            $('#form [name=nama_produk]').focus();

        }
    </script>
@endpush
