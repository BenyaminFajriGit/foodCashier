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
    <div id="wrapper">
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

                <div class="card mb-3">
                    <div class="card-header">
                        <a href="<?php echo site_url('admin/products/') ?>">
                            <i class="fas fa-arrow-left"></i>
                            back
                        </a>
                    </div>
                    <div class="card-body">
                    <h3>Form Upload Proof</h3>
                        <form action="<?php echo site_url('C_Transact/uploadProof/'); ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name">Invoice Id</label>
                                <input type="text" class="form-control <?php echo form_error('name') ? 'is-invalid' : '' ?>" name="id_invoice" value="<?php   if(!empty($id_invoice))echo $id_invoice!=0?$id_invoice:'';
                                if(!empty($invoice))echo $invoice->id_invoice;?>">
                                <div class="invalid-feedback">
                                    <?php
                                    echo form_error('name');
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="bukti_transfer">Transfer Proof*</label>
                                <small class="alert alert-warning">photo</small>
                                <input type="file" class="form-control <?php echo form_error('name') ? 'is-invalid' : '' ?>" name="proof" >
                                <div class="invalid-feedback">
                                    <?php
                                    echo form_error('name');
                                    ?>
                                </div>
                            </div>
                           
                            <input type="submit" class="btn btn-success" value="save">
                        </form>
                    </div>
                    <div class="card-footer small text-muted">
                        *required fields
                    </div>
                    
                </div>
                <!--/.container-fluid-->
                <?php
                $this->load->view('admin/_partials/footer.php');
                ?>
            </div>
            <!-- /#content-wrapper-->
        </div>
        <p class="text-light">test</p>
        <!-- /#wrapper-->
    </div>
    <?php
    $this->load->view('admin/_partials/scrolltop.php');
    $this->load->view('admin/_partials/modal.php');
    $this->load->view('admin/_partials/js.php');
    ?>
</body>

</html>