<?php include ('include/header.php') ?>
<style type="text/css">
    .d-flex h2 {
    font-size: 30px;
    font-weight: 700;
    color: #2e137d;
}
</style>
<div class="page-header">
	<div class="container">
		<div class="d-flex">
			<h2>GameX Products</h2>
		</div>
	</div>
</div>
<!-- banner section -->

<section class="about-2 pb-0 pt-4">
    <div class="container py-0 how-about">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-12 about-2-secs-left mt-lg-0 mt-sm-4 mt-2 " >
                <?= view('loop/product', ['products'=>$gamex_products , 'col'=>2]);  ?>
            </div>
        </div>
        
        
    </div>
</section>




<?php include ('include/footer.php') ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
