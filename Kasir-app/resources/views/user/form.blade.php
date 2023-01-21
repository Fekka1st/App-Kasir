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
                        <label for="name" class="col-md-4 col-md-offset-1 control-label">Nama</label>
                        <div class="col-md-6">
                            <input type="text" name="name" id="name" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-md-offset-1 control-label">Email</label>
                        <div class="col-md-6">
                            <input type="email" name="email" id="email" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-md-offset-1 control-label">password</label>
                        <div class="col-md-6">
                            <input type="password" name="password" id="password" class="form-control" required
                                autofocus minlength="8">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password_confirmation" class="col-md-4 col-md-offset-1 control-label">Konfirmasi
                            Password</label>
                        <div class="col-md-6">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control" required autofocus data-match="#password">
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
