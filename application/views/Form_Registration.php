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
                <!-- Card-->
                <?php
                $this->load->view('admin/_partials/alert.php');
                ?>
                <h3>Form Registration</h3>
                <form action="<?php echo site_url('C_User/registration') ?>" method="post">
                    <div class="form-group" action="<?php echo site_url('login/check_user')?>" >
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" aria-describedby="username" placeholder="Enter username" name="username">
                        
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password"
                        name="password"
                        >
                    </div>
                    <div class="form-group">
                        <label for="fullname">Fullname</label>
                        <input type="text" class="form-control" id="fullname" placeholder="fullname"
                        name="fullname"
                        >
                    </div>
                    <div class="form-group">
                        <label for="phone">phone number</label>
                        <input type="text" class="form-control" id="phone" placeholder="phone number"
                        name="phone"
                        >
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                    <a href="<?php echo site_url('login/')?>" class="btn btn-success">Login</a>
                </form>
                <!-- /Card-->
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
    
</body>

</html>