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
                <!-- /.box-header -->
                <div class="box-body table-responsive">
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
                            <?php foreach ($order_tiket as $ot) { ?>
                                <tr>
                                    <td width="5%"><?= $i++; ?></td>
                                    <td><?= $ot['jenis_tiket']; ?></td>
                                    <td><?= $ot['tipe_tiket']; ?></td>
                                    <td><?= $ot['tgl_tanding']; ?> - <?= $ot['jam_tanding']; ?></td>
                                    <td><?= $ot['name']; ?></td>
                                    <td><?= $ot['invoice_code']; ?></td>
                                    <td align="center"><?= $ot['qty_order']; ?></td>
                                    <td><?= $ot['total_bayar']; ?></td>
                                    <td><?= $ot['payment_method']; ?></td>
                                    <?php if ($ot['status_order'] == 0) {
                                            echo "<td align='center'><span class='label label-danger'>Belum Bayar</span></td>";
                                        } else if ($ot['status_order'] == 1) {
                                            echo "<td align='center'><span class='label label-default'>Diproses</span></td>";
                                        } else if ($ot['status_order'] == 2) {
                                            echo "<td align='center'><span class='label label-success'>Sudah Bayar</span></td>";
                                        } else if ($ot['status_order'] == 3) {
                                            echo "<td align='center'><span class='label label-danger'>Dibatalkan</span></td>";
                                        } ?>
                                    <td align="center" width="8%">
                                        <a title="Approve" href="<?= base_url('tiket/update_status_bayar/' . $ot['id'] . '/' . $ot['id_kapasitas'] . '/' . $ot['qty_order'] . '/' . $ot['kapasitas']); ?>" onclick="return confirm('Anda yakin ingin menyetujui data ini?')" type="button" class="btn-link d-delete">
                                            <?php if ($ot['status_order'] == 1) {
                                                    echo "<i class='fa fa-check' style='color:green'></i>";
                                                } else if ($ot['status_order'] == 3) {
                                                    echo "<i class='fa fa-check' style='color:green'></i>";
                                                } ?>
                                        </a>
                                        <?php if ($ot['status_order'] == 1) {
                                                echo "&nbsp;&nbsp;&nbsp;&nbsp;";
                                            } else if ($ot['status_order'] == 1) {
                                                echo "&nbsp;&nbsp;&nbsp;&nbsp;";
                                            } ?>
                                        <a title="Cancle" href="<?= base_url('tiket/cancle_status_bayar/' . $ot['id']); ?>" onclick="return confirm('Anda yakin ingin membatalkan data ini?')" type="button" class="btn-link d-delete">
                                            <?php if ($ot['status_order'] == 1) {
                                                    echo "<i class='fa fa-times' style='color:red'></i>";
                                                } else if ($ot['status_order'] == 2) {
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