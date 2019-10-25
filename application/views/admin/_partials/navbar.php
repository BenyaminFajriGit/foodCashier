<nav class="navbar navbar-expand navbar-dark bg-dark fixed-top ">

  <a class="navbar-brand mr-1" href="<?php if($this->session->userdata('type')=='admin')echo site_url('C_Product/');else echo site_url('C_Product/listForCostumer')?>"><?php echo SITE_NAME ?></a>

  <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
    <i class="fas fa-bars"></i>
  </button>

  <!-- Navbar Search -->

  <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-'2' my-md-0" method="get" action="<?php echo site_url('C_Product/search/')?>">
  <?php
  if($this->session->userdata('type')=='member'):
  ?>
    <div class="input-group">
      <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" name="search" value="<?php if(isset($_GET['search']))echo $_GET['search'];?>">
      <div class="input-group-append">
        <button class="btn btn-primary" type="submit">
          <i class="fas fa-search"></i>
        </button>
      </div>
    </div>
    <?php
  endif;
  ?>
  </form>
  
  <!-- Navbar -->
  <ul class="navbar-nav ml-auto ml-md-0">
  <?php
  if($this->session->userdata('type')=='member'):
  ?>
    <li class="nav-item dropdown no-arrow mx-1">
      <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span id="counter" class="badge badge-danger"><?php echo $this->cart->total_items(); ?>
        </span>
        <i class="fas fa-shopping-cart"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="<?php echo site_url('C_Cart/')?>">Lihat isi keranjang</a>
      </div>
    </li>
<?php
endif;
?>
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-user-circle fa-fw"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
        <?php
        if($this->session->userdata('username')):
        ?>
        <a class="dropdown-item bg-success text-light text-bold" href="#!">you're <?php echo $this->session->userdata('username') ?></a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" onclick="logout('<?php echo site_url('C_User/logout/') ?>')" data-toggle="modal" data-target="#logoutModal">Logout</a>
        <?php
        else:
        ?>
        <a class="dropdown-item" href="<?php echo site_url('C_User/login')?>"  >Login</a>
        <a class="dropdown-item" href="<?php echo site_url('C_User/')?>"  >Registration</a>
        <?php
        endif;
        ?>
      </div>
    </li>
  </ul>

</nav>