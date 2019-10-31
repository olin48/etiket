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
                        <span>Data Sub Menu</span>
                    </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <?= $this->session->flashdata('message'); ?>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Tambah Sub Menu</button>
                    <br /><br />
                    <table id="dataSubmenu" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Menu</th>
                                <th>Sub Menu</th>
                                <th>URL</th>
                                <th>Icon</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($submenu as $sm) { ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $sm['menu']; ?></td>
                                    <td><?= $sm['title']; ?></td>
                                    <td><?= $sm['url']; ?></td>
                                    <td><i class="<?= $sm['icon']; ?>"></i>&nbsp;&nbsp;&nbsp;<?= $sm['icon']; ?></td>
                                    <?php if ($sm['is_active'] == 0) {
                                            echo "<td align='center'><span class='label label-warning'>Disable</span></td>";
                                        } else if ($sm['is_active'] == 1) {
                                            echo "<td align='center'><span class='label label-success'>Active</span></td>";
                                        } ?>
                                    <td align="center" width="10%">
                                        <button class="btn-link d-edit" data-toggle="modal" data-target="#modal_edit_submenu_<?= $sm['id']; ?>" title="Edit">
                                            <i class="fa fa-edit" style="color:green"></i>
                                        </button>
                                        &nbsp;
                                        <a title="Delete" href="<?= base_url('dev/delete_submenu/' . $sm['id']); ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" type="button" class="btn-link d-delete">
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
                    <h4 class="modal-title">Sub Menu</h4>
                </div>
                <form action="<?= base_url('dev/submenu'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="usr">Menu :</label>
                            <select name="menu_id" id="menu_id" class="form-control" required>
                                <option value="">Pilih Menu</option>
                                <?php foreach ($menu as $m) : ?>
                                    <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="submenu">Sub Menu :</label>
                            <input type="text" class="form-control" id="submenu" name="submenu" required>
                        </div>
                        <div class="form-group">
                            <label for="url">URL :</label>
                            <input type="text" class="form-control" id="url" name="url" required>
                        </div>
                        <div class="form-group">
                            <label for="icon">Icon :</label>
                            <input type="text" class="form-control" id="icon" name="icon" required>
                        </div>
                        <div class="form-group">
                            <label for="usr">Status :</label>
                            <select name="status_id" id="status_id" class="form-control" required>
                                <option value="">Pilih Status</option>
                                <option value="0">Disabled</option>
                                <option value="1">Active</option>
                            </select>
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

    <?php foreach ($submenu as $sm) { ?>
        <div id="modal_edit_submenu_<?= $sm['id'] ?>" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">User Management</h4>
                    </div>
                    <form action="<?= base_url('dev/edit_submenu'); ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="usr">Menu :</label>
                                <input type="text" id="id" name="id" value="<?= $sm['id']; ?>" hidden>
                                <select name="menu_id" id="menu_id" class="form-control" required>
                                    <option value="">Pilih Menu</option>
                                    <?php foreach ($menu as $m) : ?>
                                        <option <?php if ($sm['menu_id'] == $m['id']) {
                                                            echo "selected=selected";
                                                        } ?> value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="submenu">Sub Menu :</label>
                                <input type="text" class="form-control" id="submenu" name="submenu" value="<?= $sm['title']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="url">URL :</label>
                                <input type="text" class="form-control" id="url" name="url" value="<?= $sm['url']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="icon">Icon :</label>
                                <input type="text" class="form-control" id="icon" name="icon" value="<?= $sm['icon']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="usr">Status :</label>
                                <select name="status_id" id="status_id" class="form-control" required>
                                    <option value="">Pilih Status</option>
                                    <option <?php if ($sm['is_active'] == 0) {
                                                    echo "selected=selected";
                                                } ?> value="0">Disabled</option>
                                    <option <?php if ($sm['is_active'] == 1) {
                                                    echo "selected=selected";
                                                } ?> value="1">Active</option>
                                </select>
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