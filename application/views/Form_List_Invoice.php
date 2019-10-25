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
                <!-- DataTable-->
                <div class="card mb-3">
                    <?php
                    $this->load->view('admin/_partials/alert.php');
                    ?>
                    <?php
                    if ($this->session->userdata('type') == 'admin') :
                        ?>
                        <div class="card-header">
                            <a href="<?php echo site_url('C_Transact/checkExpired') ?>" class="btn btn-success">check expired</a>
                        </div>
                    <?php
                    endif;
                    ?>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="dataTable" width='100%' cellspacing='0'>
                                <thead>
                                    <tr>
                                        <th>ID Invoice</th>
                                        <th>Date</th>
                                        <th>Due Date</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($invoices)) :
                                        foreach ($invoices as $invoice) :
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php
                                                            echo $invoice->id_invoice;
                                                            ?>
                                                </td>
                                                <td>
                                                    <?php
                                                            echo $invoice->date;
                                                            ?>
                                                </td>
                                                <td>
                                                    <?php
                                                            echo $invoice->due_date;
                                                            ?>
                                                </td>

                                                <td>
                                                    <?php
                                                            echo $invoice->status;
                                                            ?>
                                                </td>
                                                <td>
                                                    <?php
                                                            echo 'Rp ' . number_format($invoice->total, 0, '.', '.');
                                                            ?>
                                                </td>
                                                <td width="250">
                                                    <a href="<?php echo site_url('C_Transact/showDetailInvoice/' . $invoice->id_invoice) ?>" class="btn btn-small">
                                                        <i class="fas fa-edit">
                                                        </i>
                                                        Detail
                                                    </a>
                                                    <?php
                                                            if ($this->session->userdata('type') == 'member' && ($invoice->status != 'paid' && $invoice->status != 'expired')) :
                                                                ?>
                                                        <a href="<?php echo site_url('C_Transact/showFormProof/' . $invoice->id_invoice) ?>" class="btn btn-small btn-primary">
                                                            <i class="fas fa-edit">
                                                            </i>
                                                            Upload Proof
                                                        </a>
                                                    <?php
                                                            endif;
                                                            ?>
                                                </td>
                                            </tr>
                                    <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </tbody>
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