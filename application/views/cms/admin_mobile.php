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
                        <span>Admin Mobile</span>
                    </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <?= $this->session->flashdata('message'); ?>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_add_admins">Tambah Admin Mobile</button>
                    <br /><br />
                    <table id="dataMobAdmins" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($mobadmin as $ma) { ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $ma['name']; ?></td>
                                    <td><?= $ma['username']; ?></td>
                                    <td><?= $ma['email']; ?></td>
                                    <td><?= $ma['phone']; ?></td>
                                    <?php if ($ma['is_active'] == 0) {
                                            echo "<td align='center'><span class='label label-warning'>Not Active</span></td>";
                                        } else if ($ma['is_active'] == 1) {
                                            echo "<td align='center'><span class='label label-success'>Active</span></td>";
                                        } else if ($ma['is_active'] == 2) {
                                            echo "<td align='center'><span class='label label-danger'>Block</span></td>";
                                        } ?>
                                    <td align="center">
                                        <button class="btn-link d-edit" data-toggle="modal" data-target="#modal_edit_admins_<?= $ma['id']; ?>" title="Edit">
                                            <i class="fa fa-edit" style="color:green"></i>
                                        </button>
                                        &nbsp;
                                        <a title="Delete" href="delete_mob_admins/<?= $ma['id']; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')" type="button" class="btn-link d-delete">
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
    <div id="modal_add_admins" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Admin Mobile</h4>
                </div>
                <form action="<?= base_url('cms/mob_admins'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="usr">Name :</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="usr">Username :</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="usr">Email :</label>
                            <input type="text" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="usr">Password :</label>
                            <input type="text" class="form-control" id="password" name="password" value="">
                        </div>
                        <div class="form-group">
                            <label for="usr">Phone :</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
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

    <?php foreach ($mobadmin as $ma) { ?>
        <div id="modal_edit_admins_<?= $ma['id'] ?>" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Admin Mobile</h4>
                    </div>
                    <form action="<?= base_url('cms/edit_mob_admins'); ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="usr">Name :</label>
                                <input type="text" id="id" name="id" value="<?= $ma['id']; ?>" hidden>
                                <input type="text" class="form-control" id="name" name="name" value="<?= $ma['name']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="usr">Username :</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?= $ma['username']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="usr">Email :</label>
                                <input type="text" class="form-control" id="email" name="email" value="<?= $ma['email']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="usr">Password :</label>
                                <input type="text" class="form-control" id="password" name="password" value="">
                            </div>
                            <div class="form-group">
                                <label for="usr">Phone :</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="<?= $ma['phone']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="usr">Status :</label>
                                <select name="status_id" id="status_id" class="form-control" required>
                                    <option value="">Pilih Status</option>
                                    <option <?php if ($ma['is_active'] == 0) {
                                                    echo "selected=selected";
                                                } ?> value="0">Non Active</option>
                                    <option <?php if ($ma['is_active'] == 1) {
                                                    echo "selected=selected";
                                                } ?> value="1">Active</option>
                                    <option <?php if ($ma['is_active'] == 2) {
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