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
                        <span>Tiket Pertandingan</span>
                    </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <?= $this->session->flashdata('message'); ?>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Tambah Tiket Pertandingan</button>
                    <br /><br />
                    <table id="dataBerita" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Pertandingan</th>
                                <th>Club Bertanding</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($mobpertandingan as $mp) { ?>
                                <tr>
                                    <td width="5%"><?= $i++; ?></td>
                                    <td width="25%"><?= $mp['nama_pertandingan']; ?></td>
                                    <td>
                                        <div class="text"><?= $mp['club_name_satu']; ?> vs <?= $mp['club_name_dua']; ?></div>
                                    </td>
                                    <td width="10%"><?= $mp['tgl_tanding']; ?></td>
                                    <td width="10%"><?= $mp['jam_tanding']; ?></td>
                                    <?php if ($mp['is_active'] == 0) {
                                            echo "<td align='center'><span class='label label-danger'>Non Active</span></td>";
                                        } else if ($mp['is_active'] == 1) {
                                            echo "<td align='center'><span class='label label-success'>Active</span></td>";
                                        } else if ($mp['is_active'] == 2) {
                                            echo "<td align='center'><span class='label label-warning'>Expired</span></td>";
                                        } ?>
                                    <td align="center" width="8%">
                                        <button class="btn-link d-edit" data-toggle="modal" data-target="#modal_edit_pertandingan_<?= $mp['id']; ?>" title="Edit">
                                            <i class="fa fa-edit" style="color:green"></i>
                                        </button>
                                        &nbsp;
                                        <a title="Delete" href="<?= base_url('tiket/delete_tiket_pertandingan/' . $mp['id'] . '/' . $mp['club_logo_satu'] . '/' . $mp['club_logo_dua']); ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" type="button" class="btn-link d-delete">
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
                    <h4 class="modal-title">Tiket Pertandingan</h4>
                </div>
                <?php
                echo form_open_multipart('tiket/tiket_pertandingan');
                ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="usr">Nama Pertandingan :</label>
                        <input type="text" class="form-control" id="nama_pertandingan" name="nama_pertandingan" required>
                    </div>
                    <div class="form-group">
                        <label for="usr">Club Name :</label>
                        <input type="text" class="form-control" id="club_name_satu" name="club_name_satu" required>
                    </div>
                    <div class="form-group">
                        <label for="usr">Logo Club :</label>
                        <br />
                        <i>Maksimal file upload 2MB, dengan format .gif, .jpg, .png dan .jpeg</i>
                        <br /><br />
                        <input type="file" class="form-control-file" id="logo_club_satu" name="logo_club_satu" required>
                    </div>
                    <div class="form-group">
                        <label for="usr">Club Name :</label>
                        <input type="text" class="form-control" id="club_name_dua" name="club_name_dua" required>
                    </div>
                    <div class="form-group">
                        <label for="usr">Logo Club :</label>
                        <br />
                        <i>Maksimal file upload 2MB, dengan format .gif, .jpg, .png dan .jpeg</i>
                        <br /><br />
                        <input type="file" class="form-control-file" id="logo_club_dua" name="logo_club_dua" required>
                    </div>
                    <br />
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="usr">Tanggal Tanding :</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="tanggal_tanding" name="tanggal_tanding" required />
                                <span style="cursor:pointer;" class="input-group-addon entypo-calendar"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="usr">Waktu Tanding :</label>
                            <div class="input-group">
                                <input id="waktu_tanding" name="waktu_tanding" value="" class="form-control" readonly="" type="text" required>
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

    <?php foreach ($mobpertandingan as $mp) { ?>
        <div id="modal_edit_pertandingan_<?= $mp['id'] ?>" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Tiket Pertandingan</h4>
                    </div>
                    <?php
                        echo form_open_multipart('tiket/edit_tiket_pertandingan');
                        ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="usr">Nama Pertandingan :</label>
                            <input type="hidden" class="form-control" id="id" name="id" value="<?= $mp['id']; ?>" required>
                            <input type="text" class="form-control" id="nama_pertandingan" name="nama_pertandingan" value="<?= $mp['nama_pertandingan']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="usr">Club Name :</label>
                            <input type="text" class="form-control" id="club_name_satu" name="club_name_satu" value="<?= $mp['club_name_satu']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="usr">Logo Club :</label>
                            <br />
                            <i>Maksimal file upload 2MB, dengan format .gif, .jpg, .png dan .jpeg</i>
                            <br /><br />
                            <input type="hidden" class="form-control-file" id="old_logo_club_satu" name="old_logo_club_satu" value="<?= $mp['club_logo_satu']; ?>">
                            <input type="file" class="form-control-file" id="logo_club_satu" name="logo_club_satu">
                            <br /><br />
                            <img src="<?= base_url('assets/uploads/pertandingan/' . $mp["club_logo_dua"]); ?>" width="80px" height="80px" />
                        </div>
                        <div class="form-group">
                            <label for="usr">Club Name :</label>
                            <input type="text" class="form-control" id="club_name_dua" name="club_name_dua" value="<?= $mp['club_name_dua']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="usr">Logo Club :</label>
                            <br />
                            <i>Maksimal file upload 2MB, dengan format .gif, .jpg, .png dan .jpeg</i>
                            <br /><br />
                            <input type="hidden" class="form-control-file" id="old_logo_club_dua" name="old_logo_club_dua" value="<?= $mp['club_logo_dua']; ?>">
                            <input type="file" class="form-control-file" id="logo_club_dua" name="logo_club_dua">
                            <br /><br />
                            <img src="<?= base_url('assets/uploads/pertandingan/' . $mp["club_logo_dua"]); ?>" width="80px" height="80px" />
                        </div>
                        <br />
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="usr">Tanggal Tanding :</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="tanggal_tanding_<?= $mp['id']; ?>" name="tanggal_tanding_<?= $mp['id']; ?>" value="<?= $mp['tgl_tanding']; ?>" required />
                                    <span style="cursor:pointer;" class="input-group-addon entypo-calendar"></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="usr">Waktu Tanding :</label>
                                <div class="input-group">
                                    <input id="waktu_tanding_<?= $mp['id']; ?>" name="waktu_tanding_<?= $mp['id']; ?>" class="form-control" readonly="" value="<?= $mp['jam_tanding']; ?>" type="text" required>
                                    <span style="cursor:pointer;" id="toggle-btn-<?= $mp['id']; ?>" class="input-group-addon add-on entypo-clock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="usr">Status :</label>
                            <select name="status_id" id="status_id" class="form-control" required>
                                <option value="">Pilih Status</option>
                                <option <?php if ($mp['is_active'] == 0) {
                                                echo "selected=selected";
                                            } ?> value="0">Non Active</option>
                                <option <?php if ($mp['is_active'] == 1) {
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
        <?php } ?>

        </div>
        <!-- #/paper bg -->
</div>
<!-- ./wrap-sidebar-content -->

<!-- / END OF CONTENT -->