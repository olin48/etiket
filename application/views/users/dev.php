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
                        <span>User Management</span>
                    </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <?= $this->session->flashdata('message'); ?>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Tambah User Web</button>
                    <br /><br />
                    <table id="data" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Image</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($user as $u) { ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $u['name']; ?></td>
                                    <td><?= $u['email']; ?></td>
                                    <td><?= $u['image']; ?></td>
                                    <td><?= $u['role']; ?></td>
                                    <?php if ($u['is_active'] == 0) {
                                            echo "<td align='center'><span class='label label-warning'>Not Active</span></td>";
                                        } else if ($u['is_active'] == 1) {
                                            echo "<td align='center'><span class='label label-success'>Active</span></td>";
                                        } else if ($u['is_active'] == 2) {
                                            echo "<td align='center'><span class='label label-danger'>Block</span></td>";
                                        } ?>
                                    <td align="center">
                                        <button class="btn-link d-edit" data-toggle="modal" data-target="#modal_edit_user_<?= $u['id']; ?>" title="Edit">
                                            <i class="fa fa-edit" style="color:green"></i>
                                        </button>
                                        &nbsp;
                                        <a title="Delete" href="<?= base_url('dev/delete_users/' . $u['id']); ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" type="button" class="btn-link d-delete">
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
                    <h4 class="modal-title">User Management</h4>
                </div>
                <form action="<?= base_url('dev/users'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="usr">Name :</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="usr">Email :</label>
                            <input type="text" class="form-control" id="email" name="email" required>
                        </div>
                        <label for="usr">Password :</label>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control" id="password1" name="password1" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control" id="password2" name="password2" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="usr">Role :</label>
                            <select name="role_id" id="role_id" class="form-control" required>
                                <option value="">Pilih Nama Role</option>
                                <?php foreach ($role as $r) : ?>
                                    <option value="<?= $r['id']; ?>"><?= $r['role']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="usr">Status :</label>
                            <select name="status_id" id="status_id" class="form-control" required>
                                <option value="">Pilih Status</option>
                                <option value="0">Non Active</option>
                                <option value="1">Active</option>
                                <option value="2">Block</option>
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

    <?php foreach ($user as $u) { ?>
        <div id="modal_edit_user_<?= $u['id'] ?>" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">User Management</h4>
                    </div>
                    <form action="<?= base_url('dev/edit_users'); ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="usr">Name :</label>
                                <input type="text" id="id" name="id" value="<?= $u['id']; ?>" hidden>
                                <input type="text" class="form-control" id="name" name="name" value="<?= $u['name']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="usr">Email :</label>
                                <input type="text" class="form-control" id="email" name="email" value="<?= $u['email']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="usr">Role :</label>
                                <select name="role_id" id="role_id" class="form-control" required>
                                    <option value="">Pilih Nama Role</option>
                                    <?php foreach ($role as $r) : ?>
                                        <option <?php if ($u['role_id'] == $r['id']) {
                                                            echo "selected=selected";
                                                        } ?> value="<?= $r['id']; ?>"><?= $r['role']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="usr">Status :</label>
                                <select name="status_id" id="status_id" class="form-control" required>
                                    <option value="">Pilih Status</option>
                                    <option <?php if ($u['is_active'] == 0) {
                                                    echo "selected=selected";
                                                } ?> value="0">Non Active</option>
                                    <option <?php if ($u['is_active'] == 1) {
                                                    echo "selected=selected";
                                                } ?> value="1">Active</option>
                                    <option <?php if ($u['is_active'] == 2) {
                                                    echo "selected=selected";
                                                } ?> value="2">Block</option>
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