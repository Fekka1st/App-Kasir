@extends('layouts.master')

@section('title')
    Daftar Member
@endsection

@section('rute')
    @parent
    <li class="breadcrumb-item active">Daftar Member</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header with-border">
                    <button onclick="tambah('{{ route('member.store') }}')" class="btn btn-success"><i
                            class="fa fa-plus-circle"></i> Tambah</button>
                            <button onclick="cetakMember('{{ route('member.cetak_member') }}')" class="btn btn-danger"><i
                            class="fa fa-id-card"></i> Cetak Member</button>
                            
                </div>
                <div class="box-body table-responsive">
                    <form action=" " method="post" class="form-member">
                        @csrf
                    <table class="table table-striped table-bordered ">
                        <thead>
                            <th width="5%">
                                    <input type="checkbox" name="select_all" id="select_all">
                            </th>
                            <th>No</th>
                            <th>Kode Member</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Telpon</th>
                            <th width="13%">Aksi</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

@includeIf('member.form')
@endsection

@push('script')
    <script>
        let table;
        $(function() {
            table = $('.table').DataTable({
                processing: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('member.data') }}',
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
                        {data: 'kode_member'},
                        {data: 'nama'},
                        {data: 'alamat'},
                        {data: 'telpon'},
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
            $('#formLabel').text('Tambah Member');
            $('#form form')[0].reset();
            $('#form form').attr('action', url);
            $('#form [name=_method]').val('post');
            $('#form [name=nama]').focus();

        }

        function edit(url) {
            $('#form').modal('show');
            $('#formLabel').text('Edit Member');
            $('#form form')[0].reset();
            $('#form form').attr('action', url);
            $('#form [name=_method]').val('put');
            $('#form [name=nama]').focus();

            $.get(url)
                .done((response) => {
                    $('#form [name=nama]').val(response.nama);
                    $('#form [name=alamat]').val(response.alamat);
                    $('#form [name=telpon]').val(response.telepon);
                })
                .fail((errors) => {
                    swal("Gagal", "Data tidak bisa ditambahkan", "error");
                    return;
                });
        }

        function hapus(url) {
            // if (confirm('Ingin hapus data ?')) {
            //    
            // }

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
        
            function cetakMember(url) {
                if ($('input:checked').length < 1) {
                        alert('Pilih data yang akan dicetak');
                        return;
                } else {
                        $('.form-member')
                        .attr('target', '._blank')
                        .attr('action', url)
                        .submit();
                }
        }
    </script>
@endpush
