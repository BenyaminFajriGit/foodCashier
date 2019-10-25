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
                        <h3>Form Edit Product</h3>
                            <form action="<?php echo site_url("C_Product/editProcess/$product->id_product")?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $product->id_product; ?>">
                                <div class="form-group">
                                    <label for="name">Name*</label>
                                    <input type="text" class="form-control <?php echo form_error('name')?'is-invalid':''?>" name="name" placeholder="Product Name" value="<?php echo $product->name?>">
                                    <div class="invalid-feedback">
                                        <?php
                                        echo form_error('name');
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="category">Category*</label>
                                    <input type="text" class="form-control <?php echo form_error('name')?'is-invalid':''?>" name="category" placeholder="Category Produk" value="<?php echo $product->category?>">
                                    <div class="invalid-feedback">
                                        <?php
                                        echo form_error('name');
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price*</label>
                                    <input type="number" class="form-control <?php echo form_error('name')?'is-invalid':''?>" name="price" placeholder="Product Price" min="0" value="<?php echo $product->price;?>">
                                    <div class="invalid-feedback">
                                        <?php
                                        echo form_error('name');
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="stock">Stock*</label>
                                    <input type="number" class="form-control <?php echo form_error('name')?'is-invalid':''?>" name="stock" placeholder="Product Price" min="0" value="<?php echo $product->stock;?>">
                                    <div class="invalid-feedback">
                                        <?php
                                        echo form_error('name');
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                <label for="weight">Weight*</label>
                                <input type="number" class="form-control <?php echo form_error('name') ? 'is-invalid' : '' ?>" name="weight" placeholder="weight product" min="0" value="<?php echo $product->weight;?>">
                                <div class="invalid-feedback">
                                    <?php
                                    echo form_error('name');
                                    ?>
                                </div>
                            </div>
                                <div class="form-group">
                                    <label for="photo">Photo</label>
                                    <input type="file" class="form-control <?php echo form_error('name')?'is-invalid':''?>" name="photo" value="<?php echo $product->photo;?>" >
                                    <input type="hidden" name="old_image" value="<?php echo $product->photo;?>" >
                                    <div class="invalid-feedback">
                                        <?php
                                        echo form_error('name');
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description">Deskription*</label>
                                    <textarea  class="form-control <?php echo form_error('name')?'is-invalid':''?>" name="description" placeholder="Deskription produk..." min="0"><?php echo $product->description;?></textarea>
                                    <div class="invalid-feedback">
                                        <?php
                                        echo form_error('name');
                                        ?>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-success" value="edit">
                            </form>
                        </div>
                        <div class="card-footer small text-muted">
                            *required fields
                        </div>
                    </div>   
            <!--/.container-fluid-->
            </div>
            <?php
            $this->load->view('admin/_partials/footer.php');
            ?>
        <!-- /#content-wrapper-->
        </div>
        <!-- /#wrapper-->
    </div>
    <?php
    $this->load->view('admin/_partials/scrolltop.php');
    $this->load->view('admin/_partials/js.php');
    ?>
</body>
</html>