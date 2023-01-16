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
        let table;
        $(function() {
            table = $('.table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('pengeluaran.data') }}',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'deskripsi'
                    },
                    {
                        data: 'nominal'
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
            $('#formLabel').text('Tambah pengeluaran');
            $('#form form')[0].reset();
            $('#form form').attr('action', url);
            $('#form [name=_method]').val('post');
            $('#form [name=deskripsi]').focus();

        }

        function edit(url) {
            $('#form').modal('show');
            $('#formLabel').text('Edit Produk');
            $('#form form')[0].reset();
            $('#form form').attr('action', url);
            $('#form [name=_method]').val('put');
            $('#form [name=deskripsi]').focus();

            $.get(url)
                .done((response) => {
                    $('#form [name=deskripsi]').val(response.deskripsi);
                    $('#form [name=nominal]').val(response.nominal);

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
