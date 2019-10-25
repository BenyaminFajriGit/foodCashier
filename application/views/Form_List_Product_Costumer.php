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
				<!-- Card-->
				<div class="row">
					<?php
					foreach ($products as $product) :
						if($product->stock<=0 )continue;
						?>
						<a class="card col-md-3 col-sm-6 text-justify text-dark bg-light" href="<?php echo site_url('C_Product/detailProduct/'.$product->id_product);?>" style="text-decoration:none;">
							<div class=" m-1 ">
								<img src="<?php echo base_url('upload/product/') . $product->photo ?>" class="card-img-top" alt="..." style="max-width:100%;height:200px">
								<div class="card-body">
									<h5 class="card-title"><?php
																echo $product->name;
																?></h5>
									<p class="card-text">
										<p>Jenis : <?php echo $product->category ?></p>
										<?php
											echo substr($product->description, 0, 50);
											if (strlen($product->description) > 50) echo '...';
											?>
										<p>Harga: Rp.<?php echo $product->price ?></p>
										<p>Berat: <?php echo $product->weight ?>gram</p>
									</p>
									<!--<a href="<?php// echo site_url('welcome/add_to_cart/' . $product->id_product) ?>" class="buy btn btn-primary"><i class="fas fa-shopping-cart"></i> Buy</a>-->
								</div>
							</div>

						
						</a>
					<?php
					endforeach;
					?>

				</div>
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
	<script>
		function deleteConfirm(url) {
			$('#btn-delete').attr('href', url);
			$('#deleteModal').modal();

		}
		$('.buy').click(function(event) {
			event.preventDefault();
			$.ajax({
				url: $(this).attr('href'),
				success: function(response) {
					if(response=="http://localhost/latihan_toko/index.php/welcome"){
						window.location = response;
					}else{
						$('#counter').text(response);
					}
					
				}
			});
			return false; // for good measure
		});
	</script>
</body>

</html>