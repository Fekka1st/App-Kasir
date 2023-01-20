@extends('layouts.master')

@section('title')
    Supplier
@endsection

@section('rute')
    @parent
    <li class="breadcrumb-item active">Supplier</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header with-border">
                    <button onclick="tambah('{{ route('supplier.store') }}')" class="btn btn-success"><i
                            class="fa fa-plus-circle"></i> </button>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped table-bordered ">
                        <thead>
                            <th width="5%">No</th>
                            <th>Nama Supplier</th>
                            <th>Alamat</th>
                            <th>Nomor Telepon</th>
                            <th width="10$"><i class="fas fa-cogs"></i></th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>


    @includeIf('supplier.form')
@endsection

@push('script')
    <script>
        let table;
        $(function() {
            table = $('.table').DataTable({
                processing: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('supplier.data') }}',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'nama'
                    },
                    {
                        data: 'alamat'
                    },
                    {
                        data: 'telpon'
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
                            swal("Berhasil", "Data Berhasil", "success");
                            table.ajax.reload();
                        })
                        .fail((errors) => {
                            swal("Gagal", "Data tidak bisa ditambahkan", "error");
                            return;
                        })
                }
            });
        });

        function tambah(url) {
            $('#form').modal('show');
            $('#formLabel').text('Tambah Supplier');
            $('#form form')[0].reset();
            $('#form form').attr('action', url);
            $('#form [name=_method]').val('post');
            $('#form [name=nama]').focus();
        }

        function editForm(url) {
            $('#form').modal('show');
            $('#formLabel').text('Edit Supplier');
            $('#form form')[0].reset();
            $('#form form').attr('action', url);
            $('#form [name=_method]').val('put');
            $('#form [name=nama]').focus();
            $.get(url)
                .done((response) => {
                    $('#form [name=nama]').val(response.nama);
                    $('#form [name=telpon]').val(response.telpon);
                    $('#form [name=alamat]').val(response.alamat);
                })
                .fail((errors) => {
                    alert('Tidak dapat menampilkan data');
                    return;
                });
        }

        function deleteData(url) {
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
                                swal("Gagal", "Data tidak bisa ditambahkan", "error");
                                return;
                            })
                    } else {
                        swal("Silahkan Pikirkan lagi");
                    }
                });
        }
    </script>
@endpush
