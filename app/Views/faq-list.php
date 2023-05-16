<?php include ('include/header.php') ?>
<br/>
<style>
  /* Custom style */
    .accordion-button::after {
      background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='%23333' xmlns='http://www.w3.org/2000/svg'%3e%3cpath fill-rule='evenodd' d='M8 0a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2H9v6a1 1 0 1 1-2 0V9H1a1 1 0 0 1 0-2h6V1a1 1 0 0 1 1-1z' clip-rule='evenodd'/%3e%3c/svg%3e");
      transform: scale(.7) !important;
    }
    .accordion-button:not(.collapsed)::after {
      background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='%23333' xmlns='http://www.w3.org/2000/svg'%3e%3cpath fill-rule='evenodd' d='M0 8a1 1 0 0 1 1-1h14a1 1 0 1 1 0 2H1a1 1 0 0 1-1-1z' clip-rule='evenodd'/%3e%3c/svg%3e");
    }
    div#myAccordion {
    width: 100%;
    float: left;
    box-sizing: border-box;
    margin-bottom: 60px;
}

.accordion-item {
    width: 80%;
    margin: 0 auto;
}

.page-header .d-flex {justify-content: space-around;}

.accordion-header button.accordion-button.collapsed {
    font-size: 24px;
    font-weight: 600;
    color: #5662a6;
}

.kno-rdesc {
    font-weight: 500;
    font-size: 18px;
    color: #5662a6;
}

.accordion-button:not(.collapsed) {
    font-size: 20px;
    font-weight: 600;
    color: #5662a6!important;
}
.d-flex h2 {
    font-size: 30px;
    font-weight: 700;
    color: #2e137d;
}
.card-body p {
    font-weight: 500;
    font-size: 18px;
    color: #5662a6;
}
</style> 
<div class="page-header">
	<div class="container">
		<div class="d-flex">
			<h2>FAQ</h2>
		</div>
	</div>
</div>
<!-- banner section -->

<section class="about-2 pb-0 pt-4">
    <div class="container   py-0 how-about">
        <div class="row align-items-center justify-content-between"> 
 <div class="col-lg-12 about-2-secs-left mt-lg-0 mt-sm-4 mt-2 " > 
    <div class="accordion" id="myAccordion">
     <?php
            $i=0;
          foreach ($faq_list as $key => $value) {
            $i++;
           ?>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseOne<?php echo $i; ?>"><?php echo $value['ques']; ?></button>                  
            </h2>
            <div id="collapseOne<?php echo $i; ?>" class="accordion-collapse collapse" data-bs-parent="#myAccordion">
                <div class="card-body">
                    <p><?php echo $value['ans']; ?></p>
                </div>
            </div>
        </div>
    <?php } ?>
    </div>

   
     </div>
        </div>
		
        
    </div>
</section>




<?php include ('include/footer.php') ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
