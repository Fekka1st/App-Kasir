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
                    <button onclick="tambah('{{ route('kategori.store') }}')"class="btn btn-success">Tambah</button>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped table-bordered ">
                        <thead>
                            <th width="5%">No</th>
                            <th>Kategori</th>
                            <th width="10$">Aksi</th>
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
        let table;
        $(function() {
            table = $('.table').DataTable({
                processing: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('kategori.data') }}',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'nama_kategori'
                    },
                    {
                        data: 'aksi',
                        searchable: false,
                        sortable: false
                    },
                ]

            });

            $('#form').validator().on('submit', function(e) {
                if (!e.preventDefault()) {
                    $.ajax({
                            url: $('#form form').attr('action'),
                            type: 'post',
                            data: $('#form form').serialize(),
                        })
                        .done((response) => {
                            $('#form').modal('hide');
                            alert('Data berhasil')
                            table.ajax.reload();
                        })
                        .fail((errors) => {
                            alert('tidak dapat menyimpan data')
                            return;
                        })
                }
            });
        });


        function tambah(url) {
            $('#form').modal('show');
            $('#formLabel').text('Tambah Kategori');
            $('#form form')[0].reset();
            $('#form form').attr('action', url);
            $('#form [name=_method]').val('post');
            $('#form [name=nama_kategori]').focus();

        }
    </script>
@endpush
