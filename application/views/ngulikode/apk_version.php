<!-- CONTENT -->
<div class="wrap-fluid" id="paper-bg">

    <div class="row">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header">
                    <!-- tools box -->
                    <div class="pull-right box-tools">

                        <span class="box-btn" data-widget="collapse"><i class="fa fa-minus"></i>
                        </span>
                    </div>
                    <h3 class="box-title"><i class="fontello-doc"></i>
                        <span>APK Version</span>
                    </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <?= $this->session->flashdata('message'); ?>
                    <table id="dataDownload" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Version Name</th>
                                <th>Version Code</th>
                                <th>Description</th>
                                <th>Update Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($version as $ver) { ?>
                                <tr>
                                    <td width="5%"><?= $i++; ?></td>
                                    <td><?= $ver['version_name']; ?></td>
                                    <td><?= $ver['version_code']; ?></td>
                                    <td><?= $ver['description']; ?></td>
                                    <td><?= $ver['updated_date']; ?></td>
                                    <td align="center" width="10%">
                                        <button class="btn-link d-edit" data-toggle="modal" data-target="#modal_edit_version_<?= $ver['id']; ?>" title="Edit">
                                            <i class="fa fa-edit" style="color:green"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>

    <?php foreach ($version as $ver) { ?>
        <div id="modal_edit_version_<?= $ver['id'] ?>" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit Source Code</h4>
                    </div>
                    <form action="<?= base_url('ngulikode/edit_version'); ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="usr">Version Name :</label>
                                <input type="hidden" name="id" id="id" value="<?= $ver['id']; ?>">
                                <input type="text" class="form-control" id="ver_name" name="ver_name" value="<?= $ver['version_name']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="usr">Verison Code :</label>
                                <input type="text" class="form-control" id="ver_code" name="ver_code" value="<?= $ver['version_code']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="usr">Isi :</label>
                                <textarea id="isi_version_<?= $ver['id'] ?>" name="isi_version_<?= $ver['id'] ?>"><?= $ver['description']; ?></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>

</div>
<!-- #/paper bg -->
</div>
<!-- ./wrap-sidebar-content -->

<!-- / END OF CONTENT -->