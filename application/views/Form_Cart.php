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
                if (validation_errors() || $this->session->flashdata('error')) : ?>
                <div class="alert alert-danger">

                    <?php
                        echo validation_errors();
                        echo $this->session->flashdata('error');
                        ?>
                </div>
                <?php endif; ?>

                <!-- DataTable-->
                <div class="card mb-3">
                    <div class="card-header">
                        <a href="<?php echo site_url('C_Product/listForCostumer') ?>" class="btn btn-success">
                            <i class="fas fa-plus"></i>
                            Buy Other
                        </a>
                        <a href="<?php echo site_url('C_Cart/destroyCart') ?>" class="btn btn-success">
                            <i class="fas fa-trash"></i>
                            delete cart
                        </a>
                        <a href="<?php echo site_url('C_Transact/showFormCheckout') ?>" class="btn btn-success float-sm-right">
                            <i class="fas fa-money-check-alt"></i>
                            checkout
                        </a>
                    </div>
                    <div class="card-header">
    <h3>Daftar barang belanja</h3>
</div>
<div class="card-body">
    <div class="table-responsive">

        <table class="table table-hover" id="dataTable" width='100%' cellspacing='0'>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Weight</th>
                    <th>Note</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($items as $item) :
                    $i++;
                    ?>
                <tr>
                    <td><?php
                            echo $i;
                            ?></td>
                    <td width="150">
                        <?php
                            echo $item['name'];
                            ?>
                    </td>
                    <td>
                        <?php
                            echo $item['qty'];
                            ?>
                    </td>
                    <td>
                        <?php
                            echo $item['weight'];
                            ?>
                            gram
                    </td>
                    <td>
                        <?php
                            echo $item['options']['note'];
                            ?>
                    </td>
                    <td>
                        <?php
                            echo 'Rp ' . number_format($item['price'], 0, '.', '.');
                            ?>
                    </td>
                    <td>
                        <?php
                            echo 'Rp ' . number_format($item['subtotal'], 0, '.', '.');
                            ?>
                    </td>
                    <td>
                        <a href="<?php echo site_url('C_Cart/delete_cart_item/').$item['rowid']?>" class="btn btn-danger">delete</a>
                    </td>

                </tr>
                <?php
                endforeach;
                ?>

            </tbody>
            <tfoot>
                <tr>
                    <td align="right" colspan="6">Total</td>
                    <td>
                        <?php
                        echo 'Rp ' . number_format($this->cart->total(), 0, '.', '.');
                        
                        ?>
                    </td>
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