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
                        <span>Tiket Event</span>
                    </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <?= $this->session->flashdata('message'); ?>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Tambah Tiket Event</button>
                    <br /><br />
                    <table id="dataBerita" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Event</th>
                                <th>Deskripsi</th>
                                <th>Start Event</th>
                                <th>End Event</th>
                                <th>Tanggal Event</th>
                                <th>Jam Event</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($mobevent as $me) { ?>
                                <tr>
                                    <td width="5%"><?= $i++; ?></td>
                                    <td width="25%"><?= $me['nama_event']; ?></td>
                                    <td>
                                        <div class="text"><?= $me['description']; ?></div>
                                    </td>
                                    <td width="10%"><?= $me['start_date']; ?></td>
                                    <td width="10%"><?= $me['end_date']; ?></td>
                                    <td width="10%"><?= $me['tanggal_event']; ?></td>
                                    <td width="10%"><?= $me['waktu_event']; ?></td>
                                    <?php if ($me['is_active'] == 0) {
                                        echo "<td align='center'><span class='label label-danger'>Non Active</span></td>";
                                    } else if ($me['is_active'] == 1) {
                                        echo "<td align='center'><span class='label label-success'>Active</span></td>";
                                    } else if ($me['is_active'] == 2) {
                                        echo "<td align='center'><span class='label label-warning'>Expired</span></td>";
                                    } ?>
                                    <td align="center" width="8%">
                                        <button class="btn-link d-edit" data-toggle="modal" data-target="#modal_edit_event_<?= $me['id']; ?>" title="Edit">
                                            <i class="fa fa-edit" style="color:green"></i>
                                        </button>
                                        &nbsp;
                                        <a title="Delete" href="<?= base_url('tiket/delete_tiket_event/' . $me['id'] . '/' . $me['image']); ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" type="button" class="btn-link d-delete">
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
                    <h4 class="modal-title">Tiket Event</h4>
                </div>
                <?php
                echo form_open_multipart('tiket/tiket_event');
                ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="usr">Nama Event :</label>
                        <input type="text" class="form-control" id="nama_event" name="nama_event" required>
                    </div>
                    <div class="form-group">
                        <label for="usr">Deskripsi Event :</label>
                        <textarea id="isi_event" name="isi_event" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="usr">Attachment/ Image :</label>
                        <br />
                        <i>Maksimal file upload 2MB, dengan format .gif, .jpg, .png dan .jpeg</i>
                        <br /><br />
                        <input type="file" class="form-control-file" id="image" name="image" required>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="usr">Start Event :</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="start_event" name="start_event" required />
                                <span style="cursor:pointer;" class="input-group-addon entypo-calendar"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="usr">End Event :</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="end_event" name="end_event" required />
                                <span style="cursor:pointer;" class="input-group-addon entypo-calendar"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="usr">Tanggal Event :</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="tanggal_event" name="tanggal_event" required />
                                <span style="cursor:pointer;" class="input-group-addon entypo-calendar"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="usr">Waktu Event :</label>
                            <div class="input-group">
                                <input id="waktu_event" name="waktu_event" value="" class="form-control" readonly="" type="text" required>
                                <span style="cursor:pointer;" id="toggle-btn" class="input-group-addon add-on entypo-clock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="usr">Status :</label>
                        <select name="status_id" id="status_id" class="form-control" required>
                            <option value="">Pilih Status</option>
                            <option value="0">Non Active</option>
                            <option value="1">Active</option>
                        </select>
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

    <?php foreach ($mobevent as $me) { ?>
        <div id="modal_edit_event_<?= $me['id'] ?>" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit Tiket Event</h4>
                    </div>
                    <?php
                    echo form_open_multipart('tiket/edit_tiket_event');
                    ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="usr">Nama Event :</label>
                            <input type="hidden" class="form-control" id="id" name="id" value="<?= $me['id']; ?>" required>
                            <input type="text" class="form-control" id="nama_event" name="nama_event" value="<?= $me['nama_event']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="usr">Deskripsi Event :</label>
                            <textarea id="isi_event_<?= $me['id'] ?>" name="isi_event_<?= $me['id'] ?>" required><?= $me['description']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="usr">Attachment/ Image :</label>
                            <br />
                            <i>Maksimal file upload 2MB, dengan format .gif, .jpg, .png dan .jpeg</i>
                            <br /><br />
                            <input type="file" class="form-control-file" id="image" name="image">
                            <input type="hidden" class="form-control-file" id="old_image" name="old_image" value="<?= $me['image']; ?>">
                            <br />
                            <img src="<?= base_url('assets/uploads/event/' . $me["image"]); ?>" width="300px" height="200px" />
                            <br />
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="usr">Start Event :</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="start_event_<?= $me['id'] ?>" name="start_event_<?= $me['id'] ?>" value="<?= $me['start_date']; ?>" required />
                                    <span style="cursor:pointer;" class="input-group-addon entypo-calendar"></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="usr">End Event :</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="end_event_<?= $me['id'] ?>" name="end_event_<?= $me['id'] ?>" value="<?= $me['end_date']; ?>" required />
                                    <span style="cursor:pointer;" class="input-group-addon entypo-calendar"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="usr">Tanggal Event :</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="tanggal_event_<?= $me['id'] ?>" name="tanggal_event_<?= $me['id'] ?>" value="<?= $me['tanggal_event']; ?>" required />
                                    <span style="cursor:pointer;" class="input-group-addon entypo-calendar"></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="usr">Waktu Event :</label>
                                <div class="input-group">
                                    <input id="waktu_event_<?= $me['id'] ?>" name="waktu_event_<?= $me['id'] ?>" value="<?= $me['waktu_event']; ?>" class="form-control" readonly="" type="text" required>
                                    <span style="cursor:pointer;" id="toggle-btn_<?= $me['id'] ?>" class="input-group-addon add-on entypo-clock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="usr">Status :</label>
                            <select name="status_id" id="status_id" class="form-control" required>
                                <option value="">Pilih Status</option>
                                <option <?php if ($me['is_active'] == 0) {
                                            echo "selected=selected";
                                        } ?> value="0">Non Active</option>
                                <option <?php if ($me['is_active'] == 1) {
                                            echo "selected=selected";
                                        } ?> value="1">Active</option>
                            </select>
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
    <!-- #/paper bg -->
</div>
<!-- ./wrap-sidebar-content -->

<!-- / END OF CONTENT -->