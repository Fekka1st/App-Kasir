<div class="modal fade" id="form" tabindex="-1" aria-labelledby="formLabel" aria-hidden="true">
    <div class="modal-dialog">
            <form action="" method="post" class="form-horizontal">
                @csrf
                @method('post')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="nama" class="col-md-2 col-md-offset-1 control-label">Nama</label>
                            <div class="col-md-6">
                                <input type="text" name="nama" id="nama" class="form-control" required autofocus>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="telpon" class="col-md-2 col-md-offset-1 control-label">Nomor Telepon</label>
                            <div class="col-md-6">
                                <input type="text" name="telpon" id="telpon" class="form-control" required>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-md-2 col-md-offset-1 control-label">Alamat</label>
                            <div class="col-md-6">
                                <textarea name="alamat" id="alamat" rows="3" class="form-control"></textarea>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-flat btn-secondary"><i class="fa fa-save"></i> Simpan</button>
                        <button type="button" class="btn btn-sm btn-flat btn-primary" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Batal</button>
                    </div>
            </form>
        </div>
    </div>
</div>