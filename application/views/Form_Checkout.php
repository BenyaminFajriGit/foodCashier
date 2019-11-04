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

                <div class="card">
                <h3>Form Checkout</h3>
                    <form action="<?php echo site_url('C_Transact/checkout') ?>" method="post" enctype="multipart/form-data">
                        <h3>Alamat Pengiriman</h3>
                        <div class="form-group">
                            <label for="name">Fullname*</label>
                            <input type="text" class="form-control <?php echo form_error('name') ? 'is-invalid' : '' ?>" name="name" placeholder="Fullname" value="<?php echo $this->session->userdata('fullname');?>" >
                            <div class="invalid-feedback">
                                <?php
                                echo form_error('name');
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="province">province*</label>
                            <select class="form-control <?php echo form_error('name') ? 'is-invalid' : '' ?>" name="province" id="province">
                            <option value="">--province--</option>
                                <?php
                                foreach ($provinces as $province) :
                                    ?>
                                    <option value="<?php echo $province['province_id'] ?>"><?php echo $province['province'] ?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                            <div class="invalid-feedback">
                                <?php
                                echo form_error('name');
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" id="province_name" name="province_name" hidden readonly>

                        </div>
                        <div class="form-group">
                            <label for="city">City*</label>
                            <select class="form-control <?php echo form_error('name') ? 'is-invalid' : '' ?>" name="city" id="city">
                                <option value="<?php echo "-" ?>"><?php echo "-" ?></option>
                            </select>
                            <div class="invalid-feedback">
                                <?php
                                echo form_error('name');
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" id="city_name" name="city_name"  hidden >

                        </div>
                        <div class="form-group">
                            <label for="courirer">Courier*</label>
                            <select class="form-control <?php echo form_error('name') ? 'is-invalid' : '' ?>" name="courier" id="courier">
                            <option >-Courier-</option>
                                <option value="jne">JNE</option>
                                <option value="tiki">TIKI</option>
                                <option value="pos">POS INDONESIA</option>
                            </select>
                            <div class="invalid-feedback">
                                <?php
                                echo form_error('name');
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="street">Street address*</label>
                            <input type="text" class="form-control <?php echo form_error('name') ? 'is-invalid' : '' ?>" name="street_address" placeholder="district,street,number" id="street_address">
                            <div class="invalid-feedback">
                                <?php
                                echo form_error('name');
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Service">Service</label>
                            <select class="form-control <?php echo form_error('name') ? 'is-invalid' : '' ?>" name="cost" id="cost">
                                <option value="<?php echo "-" ?>"><?php echo "-" ?></option>
                            </select>
                            <div class="invalid-feedback">
                                <?php
                                echo form_error('name');
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" id="service" name="service" hidden readonly>

                        </div>
                        <div class="form-group">
                            <label for="Phone">Phone Number*</label>
                            <input type="text" class="form-control <?php echo form_error('name') ? 'is-invalid' : '' ?>" name="phone_number" placeholder="Phone Number" value="<?php echo $this->session->userdata('phone');?>">
                            <div class="invalid-feedback">
                                <?php
                                echo form_error('name');
                                ?>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-success" value="Checkout" id="#submit">
                    </form>
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
        $(document).ready(function() {
            $('#province').change(function() {

                var province_id = $('#province').val();
                $.get('<?php echo site_url('C_Transact/getCity/') ?>' + province_id, function(resp) {
                    $('#city').html(resp);
                    $('#province_name').val($('#province option:selected').text());
                });
            });
      
            $('#city').change(function() {
                
                    $('#city_name').val($('#city option:selected').text());
            });

            $('#courier').change(function() {
                
                var destination = $('#city').val();
                var courier =  $('#courier').val();
                $.get('<?php echo site_url('C_Transact/getCost/') ?>'  + destination + "/"  + courier, function(resp) {
                    $('#cost').html(resp);

                });



            });
            $('#cost').change(function() {
                var costSelected=$('#cost option:selected').text();
                $('#service').val(costSelected.substr(0,costSelected.indexOf('harga')-1));
            });
            $('form').submit(function() {
                
                
            })
            
        });
    </script>



</body>

</html>