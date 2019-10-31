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
                        <span>Download Source Code</span>
                    </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <?= $this->session->flashdata('message'); ?>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Tambah Source Code</button>
                    <br /><br />
                    <table id="dataDownload" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Judul</th>
                                <th>Isi</th>
                                <th>Link Download</th>
                                <th>Image</th>
                                <th>Code</th>
                                <th>Count</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($download as $d) { ?>
                                <tr>
                                    <td width="5%"><?= $i++; ?></td>
                                    <td><?= $d['judul']; ?></td>
                                    <td>
                                        <div class="text"><?= $d['isi']; ?></div>
                                    </td>
                                    <td><?= $d['url']; ?></td>
                                    <td><?= $d['image']; ?></td>
                                    <td><span class='label label-success'><?= $d['code_gen']; ?></span></td>
                                    <td align="center"><?= $d['count']; ?></td>
                                    <td align="center" width="10%">
                                        <button class="btn-link d-edit" data-toggle="modal" data-target="#modal_edit_download_<?= $d['id']; ?>" title="Edit">
                                            <i class="fa fa-edit" style="color:green"></i>
                                        </button>
                                        &nbsp;
                                        <a title="Delete" href="<?= base_url('ngulikode/delete_download/' . $d['id'] . '/' . $d['image']); ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" type="button" class="btn-link d-delete">
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
                    <h4 class="modal-title">Source Code</h4>
                </div>
                <?php
                echo form_open_multipart('ngulikode/download');
                ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="usr">Judul :</label>
                        <input type="text" class="form-control" id="judul" name="judul" required>
                    </div>
                    <div class="form-group">
                        <label for="usr">Isi :</label>
                        <textarea id="isi_download" name="isi_download"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="usr">Link SC :</label>
                        <input type="text" class="form-control" id="url" name="url" required>
                    </div>
                    <div class="form-group">
                        <label for="usr">Attachment/ Image :</label>
                        <br />
                        <i>Maksimal file upload 2MB, dengan format .gif, .jpg, .png dan .jpeg</i>
                        <br /><br />
                        <input type="file" class="form-control-file" id="image" name="image">
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

    <?php foreach ($download as $d) { ?>
        <div id="modal_edit_download_<?= $d['id'] ?>" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit Source Code</h4>
                    </div>
                    <?php
                        echo form_open_multipart('ngulikode/edit_download');
                        ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="usr">Judul :</label>
                            <input type="hidden" name="id" id="id" value="<?= $d['id']; ?>">
                            <input type="text" class="form-control" id="judul" name="judul" value="<?= $d['judul']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="usr">Isi :</label>
                            <textarea id="isi_download_<?= $d['id'] ?>" name="isi_download_<?= $d['id'] ?>"><?= $d['isi']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="usr">Link SC :</label>
                            <input type="text" class="form-control" id="url" name="url" value="<?= $d['url']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="usr">Attachment/ Image :</label>
                            <br />
                            <i>Maksimal file upload 2MB, dengan format .gif, .jpg, .png dan .jpeg</i>
                            <br /><br />
                            <input type="file" class="form-control-file" id="image" name="image">
                            <input type="hidden" name="old_image" id="old_image" value="<?= $d['image']; ?>">
                            <br />
                            <img src="<?= base_url('assets/uploads/ngulikode/' . $d["image"]); ?>" width="300px" height="200px" />
                            <br />
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