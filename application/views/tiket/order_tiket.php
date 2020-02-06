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
                        <span>Order Tiket</span>
                    </h3>
                </div>
                <div class="box-body table-responsive">
                    <ul class="nav nav-tabs">
                        <li <?php if ($tab == "event" || $tab == null) {
                                echo "class='active'";
                            } ?>><a data-toggle="tab" href="#event">Data Order Tiket Event</a></li>
                        <li <?php if ($tab == "pertandingan") {
                                echo "class='active'";
                            } ?>><a data-toggle="tab" href="#pertandingan">Data Order Tiket Pertandingan</a></li>
                    </ul>
                    <div class="tab-content">
                        <!-- /.box-header -->
                        <div id="event" class="tab-pane fade <?php if ($tab == "event" || $tab == null) {
                                                                    echo "in active";
                                                                } ?>">
                            <br />
                            <?= $this->session->flashdata('message'); ?>
                            <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Tambah Tiket Event</button>
                    <br /><br /> -->
                            <table id="dataBerita" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Jenis Tiket</th>
                                        <th>Tipe Tiket</th>
                                        <th>Jadwal Tiket</th>
                                        <th>User Order</th>
                                        <th>Invoice</th>
                                        <th>Qty Order</th>
                                        <th>Total Bayar</th>
                                        <th>Payment Method</th>
                                        <th>Status Bayar</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($order_tiket_event as $ote) { ?>
                                        <tr>
                                            <td width="5%"><?= $i++; ?></td>
                                            <td><?= $ote['jenis_tiket']; ?></td>
                                            <td><?= $ote['tipe_tiket']; ?></td>
                                            <td><?= $ote['tanggal_event']; ?> - <?= $ote['waktu_event']; ?></td>
                                            <td><?= $ote['name']; ?></td>
                                            <td><?= $ote['invoice_code']; ?></td>
                                            <td align="center"><?= $ote['qty_order']; ?></td>
                                            <td><?= $ote['total_bayar']; ?></td>
                                            <td><?= $ote['payment_method']; ?></td>
                                            <?php if ($ote['status_order'] == 0) {
                                                echo "<td align='center'><span class='label label-danger'>Belum Bayar</span></td>";
                                            } else if ($ote['status_order'] == 1) {
                                                echo "<td align='center'><span class='label label-default'>Diproses</span></td>";
                                            } else if ($ote['status_order'] == 2) {
                                                echo "<td align='center'><span class='label label-success'>Sudah Bayar</span></td>";
                                            } else if ($ote['status_order'] == 3) {
                                                echo "<td align='center'><span class='label label-danger'>Dibatalkan</span></td>";
                                            } ?>
                                            <td align="center" width="8%">
                                                <a title="Approve" href="<?= base_url('tiket/update_status_bayar/' . $ote['id'] . '/' . $ote['id_kapasitas'] . '/' . $ote['qty_order'] . '/' . $ote['kapasitas'] . '/' . $ote['jenis_tiket'] . '-' . $ote['id'] . '-' . $ote['tipe_tiket']); ?>" onclick="return confirm('Anda yakin ingin menyetujui data ini?')" type="button" class="btn-link d-delete">
                                                    <?php if ($ote['status_order'] == 1) {
                                                        echo "<i class='fa fa-check' style='color:green'></i>";
                                                    } else if ($ote['status_order'] == 3) {
                                                        echo "<i class='fa fa-check' style='color:green'></i>";
                                                    } ?>
                                                </a>
                                                <?php if ($ote['status_order'] == 1) {
                                                    echo "&nbsp;&nbsp;&nbsp;&nbsp;";
                                                } else if ($ote['status_order'] == 1) {
                                                    echo "&nbsp;&nbsp;&nbsp;&nbsp;";
                                                } ?>
                                                <a title="Cancle" href="<?= base_url('tiket/cancle_status_bayar/' . $ote['id']); ?>" onclick="return confirm('Anda yakin ingin membatalkan data ini?')" type="button" class="btn-link d-delete">
                                                    <?php if ($ote['status_order'] == 1) {
                                                        echo "<i class='fa fa-times' style='color:red'></i>";
                                                    } else if ($ote['status_order'] == 2) {
                                                        echo "<i class='fa fa-times' style='color:red'></i>";
                                                    } ?>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div id="pertandingan" class="tab-pane fade <?php if ($tab == "pertandingan") {
                                                                        echo "in active";
                                                                    } ?>">
                            <br />
                            <?= $this->session->flashdata('message'); ?>
                            <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Tambah Tiket Event</button>
                    <br /><br /> -->
                            <table id="dataBerita" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Jenis Tiket</th>
                                        <th>Tipe Tiket</th>
                                        <th>Jadwal Tiket</th>
                                        <th>User Order</th>
                                        <th>Invoice</th>
                                        <th>Qty Order</th>
                                        <th>Total Bayar</th>
                                        <th>Payment Method</th>
                                        <th>Status Bayar</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($order_tiket_pertandingan as $otp) { ?>
                                        <tr>
                                            <td width="5%"><?= $i++; ?></td>
                                            <td><?= $otp['jenis_tiket']; ?></td>
                                            <td><?= $otp['tipe_tiket']; ?></td>
                                            <td><?= $otp['tgl_tanding']; ?> - <?= $otp['jam_tanding']; ?></td>
                                            <td><?= $otp['name']; ?></td>
                                            <td><?= $otp['invoice_code']; ?></td>
                                            <td align="center"><?= $otp['qty_order']; ?></td>
                                            <td><?= $otp['total_bayar']; ?></td>
                                            <td><?= $otp['payment_method']; ?></td>
                                            <?php if ($otp['status_order'] == 0) {
                                                echo "<td align='center'><span class='label label-danger'>Belum Bayar</span></td>";
                                            } else if ($otp['status_order'] == 1) {
                                                echo "<td align='center'><span class='label label-default'>Diproses</span></td>";
                                            } else if ($otp['status_order'] == 2) {
                                                echo "<td align='center'><span class='label label-success'>Sudah Bayar</span></td>";
                                            } else if ($otp['status_order'] == 3) {
                                                echo "<td align='center'><span class='label label-danger'>Dibatalkan</span></td>";
                                            } ?>
                                            <td align="center" width="8%">
                                                <a title="Approve" href="<?= base_url('tiket/update_status_bayar/' . $otp['id'] . '/' . $otp['id_kapasitas'] . '/' . $otp['qty_order'] . '/' . $otp['kapasitas'] . '/' . $otp['jenis_tiket'] . '-' . $otp['id'] . '-' . $otp['tipe_tiket']); ?>" onclick="return confirm('Anda yakin ingin menyetujui data ini?')" type="button" class="btn-link d-delete">
                                                    <?php if ($otp['status_order'] == 1) {
                                                        echo "<i class='fa fa-check' style='color:green'></i>";
                                                    } else if ($otp['status_order'] == 3) {
                                                        echo "<i class='fa fa-check' style='color:green'></i>";
                                                    } ?>
                                                </a>
                                                <?php if ($otp['status_order'] == 1) {
                                                    echo "&nbsp;&nbsp;&nbsp;&nbsp;";
                                                } else if ($otp['status_order'] == 1) {
                                                    echo "&nbsp;&nbsp;&nbsp;&nbsp;";
                                                } ?>
                                                <a title="Cancle" href="<?= base_url('tiket/cancle_status_bayar/' . $otp['id']); ?>" onclick="return confirm('Anda yakin ingin membatalkan data ini?')" type="button" class="btn-link d-delete">
                                                    <?php if ($otp['status_order'] == 1) {
                                                        echo "<i class='fa fa-times' style='color:red'></i>";
                                                    } else if ($otp['status_order'] == 2) {
                                                        echo "<i class='fa fa-times' style='color:red'></i>";
                                                    } ?>
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
        </div>
        <!-- #/paper bg -->
    </div>
    <!-- ./wrap-sidebar-content -->

    <!-- / END OF CONTENT -->