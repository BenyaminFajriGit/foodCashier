<ul class="sidebar navbar-nav">
  <?php
  if ($this->session->userdata('type') == 'admin') :
    ?>
  
  <li class="nav-item dropdown <?php echo $this->uri->segment(2) == 'products' ? 'active' : '' ?>">
    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-fw fa-folder"></i>
      <span>Products</span>
    </a>
    <div class="dropdown-menu" aria-labelledby="pagesDropdown">
      <a class="dropdown-item" href="<?php echo site_url('C_Product/showFormAddProduct/') ?>">Add New Product</a>
      <a class="dropdown-item" href="<?php  echo  site_url('C_Product/')  ?>">List Product</a>
    </div>
  </li>
  
  <li class="nav-item">
    <a class="nav-link" href="<?php echo site_url('C_Transact/') ?>">
      <i class="fas fa-fw fa-table"></i>
      <span>List Invoice</span></a>
  </li>
  <?php
  else :
    ?>
  <li class="nav-item">
    <a class="nav-link" href="<?php echo site_url('C_Product/listForCostumer') ?>">
      <i class="fas fa-fw fa-table"></i>
      <span>Home</span></a>
  </li>
  <?php
    if ($this->session->userdata('type') == 'member') :
      ?>
  
  <li class="nav-item">
    <a class="nav-link" href="<?php echo site_url('C_Transact/listHistory/') ?>">
      <i class="fas fa-fw fa-table"></i>
      <span>History</span></a>
  </li>
  <?php
    endif;
    ?>
  <?php
  endif;
  ?>
</ul>