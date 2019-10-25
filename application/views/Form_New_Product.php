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


                <div class="card mb-3">
                    <?php
                    $this->load->view('admin/_partials/alert.php');
                    ?>
                    <div class="card-header">
                        <a href="<?php echo site_url('C_Product/') ?>">
                            <i class="fas fa-arrow-left"></i>
                            back
                        </a>
                    </div>
                    <div class="card-body">
                    <h3>Form New Product</h3>
                        <form action="<?php echo site_url('C_Product/add/') ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name">Name*</label>
                                <input type="text" class="form-control <?php echo form_error('name') ? 'is-invalid' : '' ?>" name="name" placeholder="Name Barang">
                                <div class="invalid-feedback">
                                    <?php
                                    echo form_error('name');
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="category">Category*</label>
                                <input type="text" class="form-control <?php echo form_error('name') ? 'is-invalid' : '' ?>" name="category" placeholder="Jenis Barang">
                                <div class="invalid-feedback">
                                    <?php
                                    echo form_error('name');
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="price">Price*</label>
                                <input type="number" class="form-control <?php echo form_error('name') ? 'is-invalid' : '' ?>" name="price" placeholder="Price Barang" min="0">
                                <div class="invalid-feedback">
                                    <?php
                                    echo form_error('name');
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="stock">Stock*</label>
                                <input type="number" class="form-control <?php echo form_error('name') ? 'is-invalid' : '' ?>" name="stock" placeholder="Stock product" min="0">
                                <div class="invalid-feedback">
                                    <?php
                                    echo form_error('name');
                                    ?>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="weight">Weight*</label>
                                <input type="number" class="form-control <?php echo form_error('name') ? 'is-invalid' : '' ?>" name="weight" placeholder="weight product" min="0">
                                <div class="invalid-feedback">
                                    <?php
                                    echo form_error('name');
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="photo">Photo</label>
                                <input type="file" class="form-control <?php echo form_error('name') ? 'is-invalid' : '' ?>" name="photo">
                                <div class="invalid-feedback">
                                    <?php
                                    echo form_error('name');
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">Description*</label>
                                <textarea class="form-control <?php echo form_error('name') ? 'is-invalid' : '' ?>" name="description" placeholder="Description Produk..."></textarea>
                                <div class="invalid-feedback">
                                    <?php
                                    echo form_error('name');
                                    ?>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-success" value="add">
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