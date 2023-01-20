@extends('layouts.master')

@section('title')
    Daftar Akun
@endsection

@section('rute')
    @parent
    <li class="breadcrumb-item active">Daftar Akun</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header with-border">
                    <div class="btn-group">
                        <button onclick="tambah('{{ route('user.store') }}')" class="btn btn-success"><i
                                class="fa fa-plus-circle"></i> Tambah</button>

                    </div>
                </div>
                <div class="card-body table-responsive">
                    <form action="" method="post" class="form-produk">
                        @csrf
                        <table class="table table-stiped table-bordered table-user">
                            <thead>
                                <th width="5%">No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th width="15%"><i class="fas fa-cogs"></i></i></th>
                            </thead>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @includeIf('user.form')
@endsection

@push('script')
    <script>
        let table;
        $(function() {
            table = $('.table-user').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('user.data') }}',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'email'
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
                    $.post($('#form form').attr('action'), $('#form form').serialize())
                        .done((response) => {
                            $('#form').modal('hide');
                            swal("Berhasil", "Data Berhasil", "success");
                            table.ajax.reload();
                        })
                        .fail((errors) => {
                            swal("Gagal", "Data tidak bisa ditambahkan", "error");
                            return;
                        });
                }
            });
        });

        function tambah(url) {
            $('#form').modal('show');
            $('#formLabel').text('Tambah User');
            $('#form form')[0].reset();
            $('#form form').attr('action', url);
            $('#form [name=_method]').val('post');
            $('#form [name=name]').focus();

        }

        function edit(url) {
            $('#form').modal('show');
            $('#formLabel').text('Edit User');
            $('#form form')[0].reset();
            $('#form form').attr('action', url);
            $('#form [name=_method]').val('put');
            $('#form [name=name]').focus();

            $.get(url)
                .done((response) => {
                    $('#form [name=name]').val(response.name);
                    $('#form [name=email]').val(response.email);

                })
                .fail((errors) => {
                    swal("Gagal", "Data tidak bisa ditambahkan", "error");
                    return;
                });
        }

        function hapus(url) {

            swal({
                    title: "Apakah Kamu Yakin",
                    text: "Data terhapus tidak dapat kembali lagi",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Data Berhasil dihapus", {
                            icon: "success",
                        });
                        $.post(url, {
                                '_token': $('[name=csrf-token]').attr('content'),
                                '_method': 'delete'
                            })
                            .done((response) => {
                                table.ajax.reload();
                                swal("Berhasil", "Dihapus", "success");
                            })
                            .fail((errors) => {

                                return;
                            })
                    } else {
                        swal("Silahkan Pikirkan lagi");
                    }
                });
        }
    </script>
@endpush
