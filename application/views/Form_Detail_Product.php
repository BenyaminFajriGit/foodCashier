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
                <div class="card mb-3 row">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="<?php echo base_url('upload/product/') . $product->photo ?>" . class="card-img" alt="Products photo">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php
                                    echo  $product->name
                                    ?>
                                </h5>
                                <p class="card-text">Category :
                                    <?php
                                    echo  $product->category;
                                    ?>
                                </p>
                                <p class="card-text">Price :
                                    <?php
                                    echo  $product->price;
                                    ?>
                                </p>
                                <p class="card-text">stock :
                                    <?php
                                    echo  $product->stock;
                                    ?>
                                </p>
                                <p class="card-text">Description :
                                    <?php
                                    echo  $product->description;
                                    ?>
                                </p>


                            </div>
                            <form action="<?php echo site_url('C_Cart/addItem/' ) ?>" class="col-lg-6 col-sm-8" method="post">
                                <div class="form-group">
                                    <input type="number" class="form-control" id="quantity" placeholder="quantity" max="100" min="1" name="quantity">
                                </div>
                                <div class="form-group">
                                    <textarea type="text" class="form-control" name="note" id="note" placeholder="Catatan seperti ukuran/warna sepuh"></textarea>
                                </div>
                                <input type="text" name="id_product" id="id_product" value="<?php echo $product->id_product?>" hidden>
                                <input type="submit" value="buy" class="btn btn-success col-4">
                            </form>
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