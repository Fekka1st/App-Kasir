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
                        @empty(!session('id_pembelian'))
                            <a href="{{ route('pembelian_detail.index') }}" class="btn btn-info"><i class="fas fa-star"></i>
                                Transaksi Aktif</a>
                        @endempty
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <form action="" method="post" class="form-produk">
                        @csrf
                        <table class="table table-stiped table-bordered table-pembelian">
                            <thead>
                                <th width="5%">No</th>
                                <th>Tanggal</th>
                                <th>Supplier</th>
                                <th>Total Item</th>
                                <th>Total Harga</th>
                                <th>Diskon</th>
                                <th>Total Bayar</th>
                                <th width="15%"><i class="fas fa-cogs"></i></i></th>
                            </thead>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>


    

    <div class="modal fade" id="supplier" tabindex="-1" aria-labelledby="formLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="" method="post" class="form-horizontal">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formLabel">Supplier</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped table-bordered table-supplier">
                            <thead>
                                <th width="5%">No</th>
                                <th>Nama</th>
                                <th>Telepon</th>
                                <th>Alamat</th>
                                <th><i class="fa fa-cog"></i></th>
                            </thead>
                            <tbody>
                                @foreach ($supplier as $key => $item)
                                    <tr>
                                        <td width="5%">{{ $key + 1 }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->telpon }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>
                                            <a href="{{ route('pembelian.create', $item->id_supplier) }}"
                                                class="btn btn-primary btn-xs btn-flat">
                                                <i class="fa fa-check-circle"></i>
                                                Pilih
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            </form>
        </div>
    </div>

    {{-- detail modal detail --}}
    <div class="modal fade" id="table-detail" tabindex="-1" aria-labelledby="formLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="" method="post" class="form-horizontal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formLabel">Detail Pembelian</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped table-bordered table-detail">
                            <thead>
                                <th width="5%">No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                            </thead>
                        </table>
                    </div>
            </form>
        </div>
    </div> 
    

@endsection


@push('script')
    <script>
        let table, table1;
        $(function() {
            table = $('.table-pembelian').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('pembelian.data') }}',
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
                        data: 'supplier'
                    },
                    {
                        data: 'total_item'
                    },
                    {
                        data: 'total_harga'
                    },
                    {
                        data: 'diskon'
                    },
                    {
                        data: 'bayar'
                    },
                    {
                        data: 'aksi',
                        searchable: false,
                        sortable: false
                    },
                ]
            });
            $('.table-supplier').DataTable();

            table1 = $('.table-detail').DataTable({
                processing: true,
                bSort: false,
                columns: [{
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
                        data: 'harga_beli'
                    },
                    {
                        data: 'jumlah'
                    },
                    {
                        data: 'subtotal'
                    },
                ]
            });
        });

        
        function tambah() {
            $('#supplier').modal('show');
           

        }

        function showDetail(url) {
            $('#table-detail').modal('show');
            table1.ajax.url(url);
            table1.ajax.reload;
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
