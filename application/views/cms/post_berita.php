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
                        <span>Berita</span>
                    </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <?= $this->session->flashdata('message'); ?>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Tambah Berita</button>
                    <br /><br />
                    <table id="dataBerita" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Judul</th>
                                <th>Isi</th>
                                <th>Ref. Link</th>
                                <th>Crated Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($mobberita as $mb) { ?>
                                <tr>
                                    <td width="5%"><?= $i++; ?></td>
                                    <td width="25%"><?= $mb['judul']; ?></td>
                                    <td>
                                        <div class="text"><?= $mb['isi']; ?></div>
                                    </td>
                                    <td width="20%">
                                        <div class="text"><?= $mb['link']; ?></div>
                                    </td>
                                    <td width="20%"><?= $mb['created_date']; ?></td>
                                    <td align="center" width="8%">
                                        <button class="btn-link d-edit" data-toggle="modal" data-target="#modal_edit_berita_<?= $mb['id']; ?>" title="Edit">
                                            <i class="fa fa-edit" style="color:green"></i>
                                        </button>
                                        &nbsp;
                                        <a title="Delete" href="<?= base_url('cms/delete_berita/' . $mb['id'] . '/' . $mb['image']); ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" type="button" class="btn-link d-delete">
                                            <i class="fontello-trash-2" style="color:red"></i>
                                        </a>
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

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Berita</h4>
                </div>
                <?php
                echo form_open_multipart('cms/berita');
                ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="usr">Judul :</label>
                        <input type="text" class="form-control" id="judul" name="judul" required>
                    </div>
                    <div class="form-group">
                        <label for="usr">Isi :</label>
                        <textarea id="isi" name="isi"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="usr">Attachment/ Image :</label>
                        <br />
                        <i>Maksimal file upload 2MB, dengan format .gif, .jpg, .png dan .jpeg</i>
                        <br /><br />
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>
                    <div class="form-group">
                        <label for="usr">Ref. Link :</label>
                        <input type="text" class="form-control" id="link" name="link" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

    <?php foreach ($mobberita as $mb) { ?>
        <div id="modal_edit_berita_<?= $mb['id'] ?>" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit Berita</h4>
                    </div>
                    <?php
                        echo form_open_multipart('cms/edit_berita');
                        ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="usr">Judul :</label>
                            <input type="text" class="form-control" id="judul" name="judul" value="<?= $mb['judul']; ?>" required>
                            <input type="hidden" class="form-control-file" id="id" name="id" value="<?= $mb['id']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="usr">Isi :</label>
                            <textarea id="isi_<?= $mb['id'] ?>" name="isi_<?= $mb['id'] ?>"><?= $mb['isi']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="usr">Attachment/ Image :</label>
                            <br />
                            <i>Maksimal file upload 2MB, dengan format .gif, .jpg, .png dan .jpeg</i>
                            <br /><br />
                            <input type="file" class="form-control-file" id="image" name="image">
                            <input type="hidden" class="form-control-file" id="old_image" name="old_image" value="<?= $mb['image']; ?>">
                            <br />
                            <img src="<?= base_url('assets/uploads/berita/' . $mb["image"]); ?>" width="300px" height="200px" />
                            <br />
                        </div>
                        <div class="form-group">
                            <label for="usr">Ref. Link :</label>
                            <input type="text" class="form-control" id="link" name="link" value="<?= $mb['link']; ?>" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    <?php } ?>

</div>
<!-- #/paper bg -->
</div>
<!-- ./wrap-sidebar-content -->

<!-- / END OF CONTENT -->