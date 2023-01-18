<div class="modal fade" id="produk" tabindex="-1" aria-labelledby="formLabel" aria-hidden="true">
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
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Harga Beli</th>
                            <th><i class="fa fa-cog"></i></th>
                        </thead>
                        <tbody>
                            @foreach ($produk as $key => $item)
                                <tr>
                                    <td width="5%">{{ $key + 1 }}</td>
                                    <td>
                                        <span class="badge bg-success">{{ $item->kode_produk }}</span>
                                    </td>
                                    <td>{{ $item->nama_produk }}</td>
                                    <td>{{ $item->harga_beli }}</td>
                                    <td>
                                        <a href="" class="btn btn-primary btn-xs btn-flat"
                                            onclick="pilihProduk('{{ $item->id_produk }}', '{{ $item->kode_produk }}')">
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
