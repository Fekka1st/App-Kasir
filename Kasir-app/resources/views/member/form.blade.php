<div class="modal fade" id="form" tabindex="-1" aria-labelledby="formLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="post" class="form-horizontal" enctype="multipart/form-data" id="formMember">
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
                    <div class="form-group row" id="input-nama">
                        <label for="nama" class="col-lg-2 col-lg-offset-1 control-label">Nama</label>
                        <div class="col-lg-6">
                            <input type="text" name="nama" id="nama" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row" id="input-telepon">
                        <label for="telpon" class="col-lg-2 col-lg-offset-1 control-label">Telpon</label>
                        <div class="col-lg-6">
                            <input type="text" name="telepon" id="telpon" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row" id="input-alamat">
                        <label for="alamat" class="col-lg-2 col-lg-offset-1 control-label">Alamat</label>
                        <div class="col-lg-6">
                            <textarea name="alamat" id="alamat" rows="3" class="form-control"></textarea>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row" id="import-member">
                        <label for="import" class="col-lg-2 col-lg-offset-1 control-label"></label>
                        <div class="col-lg-6">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
