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
                    <div class="card-header">
                        <a href="<?php echo site_url('C_Product/showFormAddProduct/') ?>">
                            <i class="fas fa-plus"></i>
                            Add New Product
                        </a>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
                            <table class="table table-hover text-justify" id="dataTable" width='100%' cellspacing='0'>
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Weight</th>
                                        <th>Photo</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($products as $product) :
                                        ?>
                                        <tr id="<?php echo $product->id_product?>">
                                            <td width="150">
                                                <?php
                                                    echo $product->name;
                                                    ?>
                                            </td>
                                            <td>
                                                <?php
                                                    echo $product->category;
                                                    ?>
                                            </td>
                                            <td>
                                                <?php
                                                    echo $product->price;
                                                    ?>
                                            </td>
                                            <td>
                                                <?php
                                                    echo $product->stock;
                                                    ?>
                                            </td>
                                            <td>
                                                <?php
                                                    echo $product->weight;
                                                    ?>gram
                                            </td>
                                            <td>
                                                <img src="<?php echo base_url('upload/product/' . $product->photo) ?>" width="64">
                                            </td>
                                            <td class="small">
                                                <?php
                                                    echo substr($product->description, 0, 120);
                                                    if (strlen($product->description) >= 120) {
                                                        echo "...";
                                                    }
                                                    ?>
                                            </td>
                                            <td width="250">
                                                <a href="<?php echo site_url('C_Product/edit/' . $product->id_product) ?>" class="btn btn-small">
                                                    <i class="fas fa-edit">
                                                    </i>
                                                    edit
                                                </a>
                                                <a onclick="deleteConfirm('<?php echo site_url('C_Product/deleteProduct/' . $product->id_product) ?>')" href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i> Hapus</a>
                                            </td>
                                        </tr>
                                    <?php
                                    endforeach;
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