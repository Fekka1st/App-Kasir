@extends('layouts.master')

@section('title')
    Daftar Pengeluaran
@endsection

@section('rute')
    @parent
    <li class="breadcrumb-item active">Transaksi Penjualan</li>
@endsection
@push('css')
    <style>
        .tampil-bayar {
            font-size: 5em;
            text-align: center;
            height: 100px;
        }

        .tampil-terbilang {
            padding: 10px;
            background: #f0f0f0;
        }

        .table-penjualan tbody tr:last-child {
            display: none;
        }

        @media(max-width: 768px) {
            .tampil-bayar {
                font-size: 3em;
                height: 70px;
                padding-top: 5px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <form class="form-produk">
                        @csrf
                        <div class="form-group row">
                            <label for="kode_produk" class="col-lg-2">Kode Produk</label>
                            <div class="col-lg-5">
                                <div class="input-group">
                                    <input type="hidden" name="id_penjualan" id="id_penjualan" value="{{ $id_penjualan }}">
                                    <input type="hidden" name="id_produk" id="id_produk">
                                    <input type="text" class="form-control" name="kode_produk" id="kode_produk">
                                    <span class="input-group-btn">
                                        <button onclick="tampilProduk()" class="btn btn-info btn-flat" type="button"><i
                                                class="fa fa-arrow-right"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>

                    <table class="table table-stiped table-bordered table-penjualan">
                        <thead>
                            <th width="5%">No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th width="15%">Jumlah</th>
                            <th>Diskon</th>
                            <th>Subtotal</th>
                            <th width="15%"><i class="fa fa-cog"></i></th>
                        </thead>
                        <tbody>
                            @foreach ($transaksi as $no => $item)
                                <tr data-id="{{ $item->id_produk }}">
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $item->produk->kode_produk }}</td>
                                    <td>{{ $item->produk->nama_produk }}</td>
                                    <td>{{ $item->harga_jual }}</td>
                                    <td>
                                        <input type="hidden" name="id" value="{{ $item->id_produk }}" id="">
                                        <input type="number" class="jumlah" value="{{ $item->jumlah }}" name="jumlah"
                                            id="">

                                    </td>
                                    <td>{{ $item->diskon }}</td>
                                    <td>{{ $item->subtotal }}</td>
                            @endforeach
                            <tr />

                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="tampil-bayar bg-primary">Rp{{ format_uang($total) }}</div>
                            <div class="tampil-terbilang"></div>
                        </div>
                        <div class="col-lg-4">
                            <form action="{{ route('transaksi.simpan') }}" class="form-penjualan" method="post">
                                @csrf
                                <input type="hidden" name="id_penjualan" value="{{ $id_penjualan }}">
                                <input type="hidden" name="total" id="total">
                                <input type="hidden" name="total_item" id="total_item">
                                <input type="hidden" name="bayar" id="bayar">
                                <input type="hidden" name="id_member" id="id_member"
                                    value="{{ $memberSelected->id_member }}">

                                <div class="form-group row">
                                    <label for="totalrp" class="col-lg-2 control-label">Total</label>
                                    <div class="col-lg-8">
                                        <input type="text" value="{{ $total }}" id="totalrp"
                                            class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="kode_member" class="col-lg-2 control-label">Member</label>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="kode_member"
                                                value="{{ $memberSelected->kode_member }}">
                                            <span class="input-group-btn">
                                                <button onclick="tampilMember()" class="btn btn-info btn-flat"
                                                    type="button"><i class="fa fa-arrow-right"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="diskon" class="col-lg-2 control-label">Diskon</label>
                                    <div class="col-lg-8">
                                        <input type="number" name="diskon" id="diskon" class="form-control"
                                            value="" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="bayar" class="col-lg-2 control-label">Bayar</label>
                                    @if (session('cart'))
                                        <div class="col-lg-8">
                                            <input type="text" value="{{ session()->get('cart', ['bayar']) }}"
                                                id="bayarrp" class="bayar form-control">
                                        </div>
                                    @else
                                        <div class="col-lg-8">
                                            <input type="text" class="bayar" name="bayar" id="bayarrp"
                                                class="form-control">
                                        </div>
                                    @endif
                                </div>
                                <label for="kembali" class="col-lg-4 control-label">Kembalian</label>
                                <div class="form-group row">
                                    @if (session('cart'))
                                        <div class="col-lg-10">
                                            <input type="text"
                                                value="{{ session()->get('cart', ['bayar']) - $total }} " id="bayarrp"
                                                class="bayar form-control">
                                        </div>
                                    @else
                                        <div class="col-lg-8">
                                            <input type="text" id="bayarrp" class="bayar form-control">
                                        </div>
                                    @endif
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <form action="{{ route('simpanTransaksi') }}" method="post" id="simpanPenjualan">
                    @csrf
                    <input type="hidden" name="total_item" value="{{ $totalItem }}">
                    <input type="hidden" name="id_member" id="">
                    <input type="hidden" name="total_harga" value="{{ $total }}" id="">
                    <input type="hidden" name="diskon" value="0" id="">
                    @if (session('cart'))
                        <input type="hidden" name="bayar" value="{{ session()->get('cart', ['bayar']) }}"
                            id="">
                        <input type="hidden" name="diterima" value="{{ session()->get('cart', ['bayar']) - $total }} "
                            id="">
                    @endif
                    <input type="hidden" value="{{ Auth::user()->id }}" name="id_user" id="">
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm btn-flat pull-right btn-simpan"><i
                                class="fa fa-floppy-o"></i> Simpan Transaksi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @includeIf('penjualan_detail.produk')
    @includeIf('penjualan_detail.member')
@endsection

@push('script')
    <script>
        function tampilProduk() {
            $('#modal-produk').modal('show');
        }

        function hideProduk() {
            $('#modal-produk').modal('hide');
        }

        function pilihProduk(id, kode) {
            $('#id_produk').val(id);
            $('#kode_produk').val(kode);
            hideProduk();
            tambahProduk();
        }

        function tampilMember() {
            $('#modal-member').modal('show');
        }

        function pilihMember(id, kode) {
            $('#id_member').val(id);
            $('#kode_member').val(kode);
            $('#diskon').val('');
            loadForm($('#diskon').val());
            $('#diterima').val(0).focus().select();
            hideMember();
        }

        function hideMember() {
            $('#modal-member').modal('hide');
        }
        $(".jumlah").change(function(e) {
            e.preventDefault();

            var ele = $(this);

            $.ajax({
                url: '{{ route('tambah') }}',
                method: "post",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("data-id"),
                    jumlah: ele.parents("tr").find(".jumlah").val()
                },
                success: function(response) {
                    // $('#cart').load(document.URL + ' #cart');
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                }
            });
        });
        $(".bayar").change(function(e) {
            e.preventDefault();
            var ele = $(this);

            $.ajax({
                url: '{{ route('pembayaran') }}',
                method: "post",
                data: {
                    _token: '{{ csrf_token() }}',
                    bayar: ele.parents().find(".bayar").val()
                },
                success: function(response) {
                    // $('#cart').load(document.URL + ' #cart');
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                }
            });
        });
        // $(".jumlah").change(function (e) {
        //     e.preventDefault();
        //     $('#jumlah').submit();
        // });
    </script>
@endpush
