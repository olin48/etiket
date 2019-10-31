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
                        <span>Data Role Akses Menu</span>
                    </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <?= $this->session->flashdata('message'); ?>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Tambah Role Akses Menu</button>
                    <br /><br />
                    <table id="data" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Role</th>
                                <th>Menu</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($role as $r) { ?>
                                <tr>
                                    <td width="5%"><?= $i++; ?></td>
                                    <td><?= $r['role']; ?></td>
                                    <td><?= $r['menu']; ?></td>
                                    <td align="center" width="10%">
                                        <button class="btn-link d-edit" data-toggle="modal" data-target="#modal_edit_rolemenu_<?= $r['id']; ?>" title="Edit">
                                            <i class="fa fa-edit" style="color:green"></i>
                                        </button>
                                        &nbsp;
                                        <a title="Delete" href="<?= base_url('dev/delete_role_menu/' . $r['id']); ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" type="button" class="btn-link d-delete">
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
                    <h4 class="modal-title">Role Akses Menu</h4>
                </div>
                <form action="<?= base_url('dev/role_menu'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="usr">Role :</label>
                            <select name="role_id" id="role_id" class="form-control" required>
                                <option value="">Pilih Role</option>
                                <?php foreach ($role_name as $rn) : ?>
                                    <option value="<?= $rn['id']; ?>"><?= $rn['role']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="usr">Role :</label>
                            <select name="menu_id" id="menu_id" class="form-control" required>
                                <option value="">Pilih Menu</option>
                                <?php foreach ($menu_name as $mn) : ?>
                                    <option value="<?= $mn['id']; ?>"><?= $mn['menu']; ?></option>
                                <?php endforeach; ?>
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

    <?php foreach ($role as $r) { ?>
        <div id="modal_edit_rolemenu_<?= $r['id'] ?>" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Role Akses Menu</h4>
                    </div>
                    <form action="<?= base_url('dev/edit_role_menu'); ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="usr">Role :</label>
                                <input type="text" id="id" name="id" value="<?= $r['id']; ?>" hidden>
                                <select name="role_id" id="role_id" class="form-control" required>
                                    <option value="">Pilih Role</option>
                                    <?php foreach ($role_name as $rn) : ?>
                                        <option <?php if ($r['role_id'] == $rn['id']) {
                                                            echo "selected=selected";
                                                        } ?> value="<?= $rn['id']; ?>"><?= $rn['role']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="usr">Menu :</label>
                                <input type="text" id="id" name="id" value="<?= $r['id']; ?>" hidden>
                                <select name="menu_id" id="menu_id" class="form-control" required>
                                    <option value="">Pilih Menu</option>
                                    <?php foreach ($menu_name as $mn) : ?>
                                        <option <?php if ($r['menu_id'] == $mn['id']) {
                                                            echo "selected=selected";
                                                        } ?> value="<?= $mn['id']; ?>"><?= $mn['menu']; ?></option>
                                    <?php endforeach; ?>
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