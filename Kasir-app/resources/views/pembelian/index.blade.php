@extends('layouts.master')

@section('title')
    Daftar Produk
@endsection

@section('rute')
    @parent
    <li class="breadcrumb-item active">Daftar Pembelian</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header with-border">
                    <div class="btn-group">
                        <button onclick="tambah()" class="btn btn-success"><i class="fa fa-plus-circle"></i> Transaksi</button>
                        {{-- @empty(!session('id_pembelian'))
                            <a href="{{ route('pembelian_detail.index') }}" class="btn btn-info "><i class="fa fa-pencil"></i>
                                Transaksi Aktif</a>
                        @endempty --}}
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
                                <th>Tanggal</th>
                                <th>Supplier</th>
                                <th>Total Item</th>
                                <th>Total Harga</th>
                                <th>Diskon</th>
                                <th>Total Bayar</th>
                                <th width="15%"><i class="fa fa-cog"></i></th>
                            </thead>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @includeIf('pembelian.supplier')
    @includeIf('pembelian.detail')
@endsection


@push('script')
    <script>
        let table;
        $(function() {
            table = $('.table').DataTable({
                processing: true,
                autoWidth: false,
                // ajax: {
                //     url: '{{ route('supplier.data') }}',
                // },
                // columns: [{
                //         data: 'DT_RowIndex',
                //         searchable: false,
                //         sortable: false
                //     },
                //     {
                //         data: 'nama'
                //     },
                //     {
                //         data: 'alamat'
                //     },
                //     {
                //         data: 'telpon'
                //     },
                //     {
                //         data: 'aksi',
                //         searchable: false,
                //         sortable: false
                //     },
                // ]
            });

            // $('#form').validator().on('submit', function(e) {
            //     if (!e.preventDefault()) {
            //         $.ajax({
            //                 url: $('#form form').attr('action'),
            //                 type: 'post',
            //                 data: $('#form form').serialize(),
            //             })
            //             .done((response) => {
            //                 $('#form').modal('hide');
            //                 swal("Berhasil", "Data Berhasil", "success");
            //                 table.ajax.reload();
            //             })
            //             .fail((errors) => {
            //                 swal("Gagal", "Data tidak bisa ditambahkan", "error");
            //                 return;
            //             })
            //     }
            // });
        });

        function tambah() {
            $('#supplier').modal('show');
        }

        function tampilDetail(url) {
            $('#detail').modal('show');
            table1.ajax.url(url);
            table1.ajax.reload();
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
