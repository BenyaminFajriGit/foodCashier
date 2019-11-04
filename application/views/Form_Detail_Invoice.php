<html lang="en">

<head>

    <?php
    $this->load->view('admin/_partials/head.php');
    ?>
</head>

<body id="page-top">
    <?php
    $this->load->view('admin/_partials/navbar.php');
    ?>
    <div id='wrapper'>
        <?php
        $this->load->view('admin/_partials/sidebar.php');
        ?>
        
        <div id="content-wrapper">
            <div class="container-fluid">
            
                <?php
                $this->load->view('admin/_partials/breadcrumb.php');
                ?>
                    <?php
                $this->load->view('admin/_partials/alert.php');
                ?>
                <!-- DataTable-->
                <div class="card mb-3">
                    <div class="card-header">
                        <h3>Invoice Detail</h3>

                        <?php
                        if($this->session->userdata('type')=='admin' && $invoice->status =='waiting confirmation'):
                        ?>
                        <a href="<?= site_url('C_Transact/setStatusPaid/' . $invoice->id_invoice) ?>" class="btn btn-success btn-sm float-right m-2">Confirm Payment Proof</a> 
                        <a href="<?= site_url('C_Transact/setStatusRejected/' . $invoice->id_invoice) ?>" class="btn btn-warning btn-sm float-right m-2">Reject Payment Proof</a> 
                        <?php
                        endif;
                        ?>
                        
                    </div>
                    <div class="card-body row justify-content-center ">

                        <div class="card bg-dark text-light p-3 text-uppercase col-md-4" >
                            <h4>bukti pembayaran</h4>
                            <img src="<?php echo base_url('upload/payment/').$invoice->proof?>" class="card-img-top" alt="upload bukti pembayaran">
                            <div class="card-body " >
                                <div class="card-text ">
                                    Date     : <br><?php echo $invoice->date?><hr>
                                    Due Date :<br><?php echo $invoice->due_date?><hr>
                                    Status   :<br><?php echo $invoice->status?><hr>
                                    Pemesan  :<br><?php echo $invoice->fullname?><hr>
                                    Jalan,gg,no,kelurahan,kecamatan:<br><?php echo $invoice->street_address?><hr>
                                    Kota     :<br><?php echo $invoice->city?><hr>
                                    Provinsi :<br><?php echo $invoice->province?><hr>
                                    Telepon  :<br><?php echo $invoice->phone_number?><hr>
                                    Kurir  :<br><?php echo $invoice->courier?><hr>
                                    Layanan  :<br><?php echo $invoice->service?><hr>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive col-md-8">
                            <h3>
                                Barang yang dipesan dari invoice #<?php echo $invoice->id_invoice ?>
                            </h3>
                            <table class="table table-hover" id="dataTable" width='100%' cellspacing='0'>
                                <thead>
                                    <tr>
                                    <th>No</th>
                                        <th>ID Order</th>
                                        <th>Name Product</th>
                                        <th>Note</th>
                                        <th>Qty</th>
                                        <th>Weight</th>
                                        <th>Price</th>
                                        <th>Subtotal</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total = 0;
                                    $count=0;
                                    foreach ($orders as $order) :
                                        ?>
                                        <tr>
                                        <td>
                                                <?php
                                                    echo ++$count;
                                                    ?>
                                            </td>
                                            <td>
                                                <?php
                                                    echo $order->id_order;
                                                    ?>
                                            </td>
                                            <td>
                                                <?php
                                                    echo $order->name;
                                                    ?>
                                            </td>
                                            <td>
                                                <?php
                                                    echo $order->note;
                                                    ?>
                                            </td>
                                            <td>
                                                <?php
                                                    echo $order->qty;
                                                    ?>
                                            </td>
                                            <td>
                                                <?php
                                                    echo $order->weight;
                                                    ?>
                                            </td>
                                            <td>
                                                <?php
                                                    echo 'Rp ' . number_format($order->price, 0, '.', '.');

                                                    ?>
                                            </td>

                                            <td>
                                                <?php
                                                    echo 'Rp ' . number_format($order->price * $order->qty, 0, '.', '.');
                                                    ?>
                                            </td>

                                        </tr>
                                    <?php
                                        $total += $order->price * $order->qty;
                                    endforeach;
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="7" align="right">Ongkos Kirim </td>
                                        <td><?php
                                            echo 'Rp ' . number_format($invoice->shipping_charge, 0, '.', '.');

                                            $total += $invoice->shipping_charge;
                                            ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" align="right">Total</td>
                                        <td><?php
                                            echo 'Rp ' . number_format($total, 0, '.', '.');

                                            ?></td>
                                    </tr>

                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--/.Container-fluid -->
            <?php
            $this->load->view("admin/_partials/footer.php")
            ?>
        </div>
        <!--  /.content-wrapper  -->

    </div>
    <!--  /#wrapper  -->


    <?php
    $this->load->view("admin/_partials/scrolltop.php");
    $this->load->view('admin/_partials/modal.php');
    $this->load->view('admin/_partials/js.php');
    ?>
    <script>
        function deleteConfirm(url) {
            $('#btn-delete').attr('href', url);
            $('#deleteModal').modal();

        }
    </script>
</body>

</html>