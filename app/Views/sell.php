<?php include('include/sellHeader.php') ?>
			<!-- Header-->
			<div class="pack-body">
				<div class="row">
					<div class="col-sm-4"></div>
					<div class="col-sm-4">
						<div class="search-wrapper mx-auto">
								<h5>Choose Product or <a href="<?=base_url()?>/create-product">Create Product</a></h5>
							<p>Find the product you're looking for to continue</p>
							<div class="input-group">
								<input type="text" placeholder="Search here" name="key" class="form-control search">
								<span class="input-group-btn">
								<!-- <a href="<?= base_url() ?>" class="btn btn-primary"><i class="fa fa-search"></i></a> -->
								</span>
							</div>
						</div><br/>
						<div class="datas"></div>
					</div>
					<div class="col-sm-4"></div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
<script src="<?= base_url() ?>/assets/js/jquery.min.js"></script>
<script src="<?= base_url() ?>/assets/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>/assets/js/owl.carousel.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.4/dist/sweetalert2.all.min.js"></script>
<script>
	$('.search').keyup(function(){
		var values = $('.search').val();
		var val = $.trim(values);
		if(val.length != 0) {
		 $.ajax({
		  url: '<?=base_url()?>/Sell/searchKey',
		  type: 'post',
		  data: {val: val},
		  dataType: 'json',
		  success: function(data){
		    $('.datas').html(data.html);
		  }
		})
		}	  
	})
</script>
			