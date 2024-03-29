@extends('layouts.master')

@section('title')
    Daftar Produk
@endsection

@section('rute')
    @parent
    <li class="breadcrumb-item active">Daftar Produk</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header with-border">
                    <div class="btn-group">
                        <button onclick="tambah('{{ route('produk.store') }}')" class="btn btn-success"><i
                                class="fa fa-plus-circle"></i> Tambah</button>
                        <button onclick="deleteselected('{{ route('produk.delete_selected') }}')" class="btn btn-danger"><i
                                class="fas fa-trash"></i> Hapus Item</button>
                        <button onclick="cetak('{{ route('produk.cetak_barcode') }}')" class="btn btn-info"><i
                                class="fas fa-print"></i> Cetak Barcode</button>
                        <button onclick="request('{{ route('permintaan.barang') }}')" class="btn btn-light"><i
                                class="fas fa-inbox"></i> Permintaan Barang </button>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <form action="" method="post" class="form-produk">
                        @csrf
                        <table class="table table-stiped table-bordered">
                            <thead>
                                <th width="5%">
                                    <input type="checkbox" name="select_all" id="select_all">
                                </th>
                                <th width="5%">No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Merk</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Diskon</th>
                                <th>Stok</th>
                                <th width="15%"><i class="fas fa-cogs"></i></th>
                            </thead>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @includeIf('produk.form')
@endsection

@push('script')
    <script>
        let table;
        $(function() {
            table = $('.table').DataTable({
                processing: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('produk.data') }}'
                },
                columns: [{
                        data: 'select_all',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'kode_produk'
                    },
                    {
                        data: 'nama_produk'
                    },
                    {
                        data: 'nama_kategori'
                    },
                    {
                        data: 'merk'
                    },
                    {
                        data: 'harga_beli'
                    },
                    {
                        data: 'harga_jual'
                    },
                    {
                        data: 'diskon'
                    },
                    {
                        data: 'stok'
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
                            swal("Berhasil", "Data Ditambahkan", "success");
                            table.ajax.reload();
                        })
                        .fail((errors) => {
                            swal("Gagal", "Data tidak bisa ditambahkan", "error");
                            return;
                        })
                }
            });
            $('[name=select_all]').on('click', function() {
                $(':checkbox').prop('checked', this.checked);
            })

        });


        function tambah(url) {
            $('#form').modal('show');
            $('#formLabel').text('Tambah Produk');

            $('#form form').attr('action', url);
            $('#form [name=_method]').val('post');
            $('#form [name=nama_produk]').focus();

        }

        function edit(url) {
            $('#form').modal('show');
            $('#formLabel').text('Edit Produk');
            $('#form form')[0].reset();
            $('#form form').attr('action', url);
            $('#form [name=_method]').val('put');
            $('#form [name=nama_produk]').focus();

            $.get(url)
                .done((response) => {
                    $('#form [name=nama_produk]').val(response.nama_produk);
                    $('#form [name=id_kategori]').val(response.id_kategori);
                    $('#form [name=merk]').val(response.merk);
                    $('#form [name=harga_beli]').val(response.harga_beli);
                    $('#form [name=harga_jual]').val(response.harga_jual);
                    $('#form [name=diskon]').val(response.diskon);
                    $('#form [name=stok]').val(response.stok);
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

        function deleteselected(url) {
            if ($('input:checked').length > 1) {
                swal({
                        title: "Apakah Kamu Yakin",
                        text: "Data terhapus tidak dapat kembali lagi",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.post(url, $('.form-produk').serialize())
                                .done((response) => {
                                    table.ajax.reload();
                                    swal("Berhasil", "Dihapus", "success");
                                })
                                .fail((errors) => {
                                    swal("error", "Data tidak dapat dihapus", "error");
                                    return;
                                });
                        }
                    });
            } else {
                swal("Informasi", "Pilih Data yang akan dihapus", "info");
                return;
            }
        }

        function cetak(url) {
            if ($('input:checked').length < 1) {
                swal("Informasi", "Pilih Data yang akan dicetak", "info");
                return;
            } else if ($('input:checked').length < 3) {
                swal("Informasi", "Minimal 3 data agar bisa dicetak", "error");
                return;
            } else {
                $('.form-produk')
                    .attr('target', '_blank')
                    .attr('action', url)
                    .submit();
            }
        }

        function request(url) {
            $.get(url)
                .done((response) => {
                    swal("Informasi", "Permintaan sudah terkirim melalui Email", "info");
                    return;
                });
        }
    </script>
@endpush
