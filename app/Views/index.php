<?php include ('include/header.php') ?>			
<style>
.fix-box{
	padding:0px;
}
body{
	background:#fff;
}
.fix-box>.container{
	max-width:100%;
	width:100%;
	padding:0px;
}

@media (min-width: 1300px) and (max-width:5000px){
.container, .container-lg, .container-md, .container-sm, .container-xl {
    max-width: 1296px;
}
.footer{
	background:#555;
}
.footer .row {
    max-width: 1260px;
    margin-left: auto;
    margin-right: auto;
    width: 100%;
}
.footer h4{
	color:#fff;
}
.footer .foot-link a{
	color:#ccc;
} 
.footer p{
	color:#ccc;
}
.footer .foot-link a:hover{
	color:#fff;
}
.copyright{
	background:#333;
}
#owl-demo .item img {
    height: 430px;
    object-fit: contain;
}
#owl-demo .item{
	height: 430px;
}
}
@media (min-width: 380px) and (max-width:1000px){
#owl-demo .item img {
    height: 235px;
    object-fit: contain;
}
#owl-demo .item{
	height: 235px;
}

}
</style>

<div class="slider-home">
<div class="container">
<div id="owl-demo" class="owl-carousel home-main">
	<?php $banner = $this->common_model->GetAllData('banner','','id','desc');?>
	<?php foreach($banner as $ban) { ?>
	<div class="item" style="background: url(<?= base_url('').'/'.$ban['image'] ?>) no-repeat center/cover;"><a href="<?=$ban['link']?>" style="backdrop-filter: blur(25px);" target=_blank><img src="<?= base_url('').'/'.$ban['image'] ?>"></a></div>
<?php } ?>
</div>
</div>
</div>

<!-- Pack loop -->
<?php foreach ($product_group as $key => $value): ?>
<?php if (!$value['products']){ continue; } ?>
<div class="pro-pack six-item">
	<div class="container">
		<div class="pack-head">
			<h4><?= $value['title'] ?></h4>
			<a href="<?= base_url('shop') ?>">See all</a>
		</div>
		<div class="pack-body">
			<?php if($value['title'] == "Recently Viewed") {?>
			
			<?= view('loop/product', ['products'=>get_recent_viewed_products(0) , 'col'=>2]);  ?>
			<?php }else{ ?>
				<?= view('loop/product', ['products'=>$value['products'] , 'col'=>2]);  ?>
			<?php } ?>
		</div>
	</div>
</div>
<?php endforeach ?>
<!-- Pack loop -->
<!-- Pack loop -->
<div class="pro-pack brand-img">
<div class="container">
	<div class="pack-head">
		<h4>Popular Brands</h4>
		<a href="<?= base_url('shop') ?>">See all</a>
	</div>
	<div class="pack-body">
		<div class="row">
			<!-- loop -->
			<?php $brands = $this->common_model->GetAllData("brands", '' , 'id' , 'desc' , 6); ?>
			<?php foreach ($brands as $key => $value): ?>
				<div class="col-sm-3">
					<a href="<?= base_url('shop').'?brand='.$value['id'] ?>">
				<div class="product-box" style="min-height:0;">
					<div class="product-image">
						<img src="<?= base_url($value['image']) ?>"> 
					</div> 								 
				</div></a>
			</div>
			<?php endforeach ?>
			
			
			<!-- loop -->
		</div>
	</div>
</div>
</div>


<!-- ad -->
<div class="ad-pro-pack">
<div class="container">
	<div class="row">
		<?php 
			foreach ($footer_banner as $key => $value) {

			if($value['banner_type'] == 1){
			?>
		   <div class="col-sm-8">
			 <a href="<?= ($value['link']) ?>" target="_blank"><img src="<?= base_url($value['image']) ?>"></a>
		  </div>
		<?php
		}else
		{
		?>
		 <div class="col-sm-4">
			<a href="<?= ($value['link']) ?>" target="_blank"><img src="<?= base_url($value['image']) ?>"></a>
		  </div>

		<?php
			}
		?>
		
		  
		<?php
		  }
		?>
		<!-- <div class="col-sm-8">
			<img src="<?= base_url('assets') ?>/img/ad1.webp">
		</div>
		<div class="col-sm-4">
			<img src="<?= base_url('assets') ?>/img/ad2.webp">
		</div> -->
	</div>
</div>
</div>
<!-- ad -->


<!-- Pack loop -->
<div class="pro-pack six-item"></div>
<!-- Pack loop -->
<!-- Pack loop -->
<div class="pro-pack six-item"></div>
<!-- Pack loop --> 
<!-- ad -->
<!-- <div class="ad-pro-pack">
<div class="container">
	<div class="row">
		<div class="col-sm-4">
			<img src="<?= base_url('assets') ?>/img/ad3.webp">
		</div>
		<div class="col-sm-8">
			<img src="<?= base_url('assets') ?>/img/ad4.webp">
		</div>
	</div>
</div>
</div> -->
<!-- ad -->
<!-- Pack loop -->
<div class="pro-pack six-item"></div>
<!-- Pack loop --> 
<!-- Pack loop -->
<div class="pro-pack six-item"></div>
<!-- Pack loop --> 
<?php include ('include/footer.php') ?>
<script>
$(document).ready(function() {
  $(".home-main").owlCarousel({
	  navigation : true,
	  nav: true,
	  items : 1,
	  loop:true,
	  autoplay:true,
      autoplayTimeout:3000,
      autoplayHoverPause:true
	  
  });
  $( ".owl-prev").html('<i class="fa fa-chevron-left"></i>');
 $( ".owl-next").html('<i class="fa fa-chevron-right"></i>');
});
	
</script>
