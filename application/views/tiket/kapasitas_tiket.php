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
                        <span>Kapasitas & Harga Tiket</span>
                    </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <?= $this->session->flashdata('message'); ?>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Tambah Kapasitas & Harga Tiket</button>
                    <br /><br />
                    <table id="dataBerita" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Jenis Tiket</th>
                                <th>Kegiatan</th>
                                <th>Tipe Tiket</th>
                                <th>Banyak Tiket</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($kapasitas as $k) { ?>
                                <tr>
                                    <td width="5%"><?= $i++; ?></td>
                                    <td width="15%"><?= $k['jenis_tiket_name']; ?></td>
                                    <td width="15%"><?= $k['id_tiket']; ?></td>
                                    <td width="10%"><?= $k['tipe_tiket']; ?></td>
                                    <td width="10%"><?= $k['kapasitas']; ?></td>
                                    <td width="10%"><?= $k['harga']; ?></td>
                                    <?php if ($k['is_active'] == 0) {
                                            echo "<td align='center' width='5%'><span class='label label-danger'>Non Active</span></td>";
                                        } else if ($k['is_active'] == 1) {
                                            echo "<td align='center' width='5%'><span class='label label-success'>Active</span></td>";
                                        } ?>
                                    <td align="center" width="8%">
                                        <button class="btn-link d-edit" data-toggle="modal" data-target="#modal_edit_kapasitas_<?= $k['id']; ?>" title="Edit">
                                            <i class="fa fa-edit" style="color:green"></i>
                                        </button>
                                        &nbsp;
                                        <a title="Delete" href="<?= base_url('tiket/delete_kapasitas/' . $k['id']); ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" type="button" class="btn-link d-delete">
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
                    <h4 class="modal-title">Kapasitas & Harga Tiket</h4>
                </div>
                <?php
                echo form_open_multipart('tiket/kapasitas');
                ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="usr">Jenis Tiket :</label>
                        <select name="jenis_tiket" id="jenis_tiket" class="form-control" required>
                            <option value="">Pilih Jenis Tiket</option>
                            <option value="TIKETEVN">Tiket Event</option>
                            <option value="TIKETPTN">Tiket Pertandingan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="usr">Kegiatan :</label>
                        <select name="id_tiket_event" id="id_tiket_event" class="form-control">
                            <option value="">Pilih Kegiatan</option>
                            <?php foreach ($event as $e) : ?>
                                <option value="<?= $e['id']; ?>"><?= $e['nama_event']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <select name="id_tiket_pertandingan" id="id_tiket_pertandingan" class="form-control">
                            <option value="">Pilih Kegiatan</option>
                            <?php foreach ($pertandingan as $p) : ?>
                                <option value="<?= $p['id']; ?>"><?= $p['nama_pertandingan']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="usr">Tipe Tiket :</label>
                        <select name="tipe_tiket" id="tipe_tiket" class="form-control" required>
                            <option value="">Pilih Tipe Tiket</option>
                            <option value="VVIP">VVIP</option>
                            <option value="VIP">VIP</option>
                            <option value="Tribune Timur">Tribune Timur</option>
                            <option value="Tribune Utara">Tribune Utara</option>
                            <option value="Tribune Selatan">Tribune Selatan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="usr">Banyak Tiket :</label>
                        <input type="text" class="form-control" id="banyak_tiket" name="banyak_tiket" required>
                    </div>
                    <div class="form-group">
                        <label for="usr">Harga Tiket :</label>
                        <input type="text" class="form-control" id="harga_tiket" name="harga_tiket" required>
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

    <?php foreach ($kapasitas as $k) { ?>
        <div id="modal_edit_kapasitas_<?= $k['id'] ?>" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit Kapasitas & Harga Tiket</h4>
                    </div>
                    <?php
                        echo form_open_multipart('tiket/edit_kapasitas');
                        ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="usr">Jenis Tiket :</label>
                            <input type="hidden" class="form-control" id="id" name="id" value="<?= $k['id']; ?>" required>
                            <select name="jenis_tiket_<?= $k['id']; ?>" id="jenis_tiket_<?= $k['id']; ?>" class="form-control" required>
                                <option value="">Pilih Jenis Tiket</option>
                                <option <?php if ($k['jenis_tiket_cd'] == "TIKETEVN") {
                                                echo "selected=selected";
                                            } ?> value="TIKETEVN">Tiket Event</option>
                                <option <?php if ($k['jenis_tiket_cd'] == "TIKETPTN") {
                                                echo "selected=selected";
                                            } ?> value="TIKETPTN">Tiket Pertandingan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="usr">Kegiatan :</label>
                            <select name="id_tiket_event_<?= $k['id']; ?>" id="id_tiket_event_<?= $k['id']; ?>" class="form-control">
                                <option value="">Pilih Kegiatan</option>
                                <?php foreach ($event as $e) : ?>
                                    <option <?php if ($k['id_tiket'] == $e['id']) {
                                                        echo "selected=selected";
                                                    } ?> value="<?= $e['id']; ?>"><?= $e['nama_event']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <select name="id_tiket_pertandingan_<?= $k['id']; ?>" id="id_tiket_pertandingan_<?= $k['id']; ?>" class="form-control">
                                <option value="">Pilih Kegiatan</option>
                                <?php foreach ($pertandingan as $p) : ?>
                                    <option value="<?= $p['id']; ?>"><?= $p['menu']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="usr">Tipe Tiket :</label>
                            <select name="tipe_tiket" id="tipe_tiket" class="form-control" required>
                                <option value="">Pilih Tipe Tiket</option>
                                <option <?php if ($k['tipe_tiket'] == "VVIP") {
                                                echo "selected=selected";
                                            } ?> value="VVIP">VVIP</option>
                                <option <?php if ($k['tipe_tiket'] == "VIP") {
                                                echo "selected=selected";
                                            } ?> value="VIP">VIP</option>
                                <option <?php if ($k['tipe_tiket'] == "Tribune Timur") {
                                                echo "selected=selected";
                                            } ?> value="Tribune Timur">Tribune Timur</option>
                                <option <?php if ($k['tipe_tiket'] == "Tribune Utara") {
                                                echo "selected=selected";
                                            } ?> value="Tribune Utara">Tribune Utara</option>
                                <option <?php if ($k['tipe_tiket'] == "Tribune Selatan") {
                                                echo "selected=selected";
                                            } ?> value="Tribune Selatan">Tribune Selatan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="usr">Banyak Tiket :</label>
                            <input type="text" class="form-control" id="banyak_tiket" name="banyak_tiket" value="<?= $k['kapasitas']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="usr">Harga Tiket :</label>
                            <input type="text" class="form-control" id="harga_tiket" name="harga_tiket" value="<?= $k['harga']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="usr">Status :</label>
                            <select name="status_id" id="status_id" class="form-control" required>
                                <option value="">Pilih Status</option>
                                <option <?php if ($k['is_active'] == 0) {
                                                echo "selected=selected";
                                            } ?> value="0">Non Active</option>
                                <option <?php if ($k['is_active'] == 1) {
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