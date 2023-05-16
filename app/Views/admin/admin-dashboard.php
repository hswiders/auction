
<?php include ('include/header.php') ?>

<style>
    .dashboard {
        background-color: #5662a6;
        height:500px;
    }
    span.nav-text {
        color: white;
    }
    .deznav {
        padding: 20px 5px 0px 5px !important;
    }
    li {
        padding-top: 5px;
        padding-bottom: 5px;
    }
    i.fa {
        color: white;
    }
    .display
    {
        display:flex;
    }
    .text-right {
        margin-left: 31px;
    }
    .card {
        min-height: 130px !important;
        border-radius: 10px;
    }
    button.card-button {
        background-color: #5662a6;
        color: white;
        font-size: 14px;
        border-radius: 0px 0px 10px 10px;
        width:100%;
    }
</style>
<div class="page-header">
	<div class="container">
		<div class="d-flex">
			<h1>Admin dashboard</h1>
		</div>
	</div>
</div>
<div class="admin-dash">
	<div class="container">
        <div class="row">
            <?php include ('include/sidebar.php') ?>
            <div class="col-md-9">
        		<div class="table-part">
        			<h4>Dashboard</h4>
                    <?php $user = $this->common_model->GetAllData('users') ?>
                    <?php $categories = $this->common_model->GetAllData('categories') ?>
                    <?php $currencies = $this->common_model->GetAllData('currency') ?>
                    <section class="wrapper bg-transparent">
                        <div class="container pb-14 pb-md-16">
                            <div class="row">
                                <div class="col-lg-4 col-xl-4 col-xxl-4 mt-n20">
                                    <div class="card" data-aos="zoom-in-down" data-aos-offset="400">
                                        <div class="card-body p-11 display">        
                                            <h5>Total Users</h5>
                                            <h2 class="text-right"><?= count($user) ?></h2>
                                        </div>
                                        <a href="<?= base_url() ?>/admin/user-management" ><button class="card-button">View More</button> </a> 
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xl-4 col-xxl-4 mt-n20">
                                    <div class="card" data-aos="zoom-in-down" data-aos-offset="400">
                                        <div class="card-body p-11 display">        
                                            <h5>Total Categories</h5>
                                            <h2 class="text-right"><?= count($categories) ?></h2>
                                        </div>
                                        <a href="<?= base_url() ?>/admin/categories-management" ><button class="card-button">View More</button> </a> 
                                    </div>
                                </div>
                               <!--  <div class="col-lg-4 col-xl-4 col-xxl-4 mt-n20">
                                    <div class="card" data-aos="zoom-in-down" data-aos-offset="400">
                                        <div class="card-body p-11 display">        
                                            <h5>Total Currencies</h5>
                                            <h2 class="text-right"><?= count($currencies) ?></h2>
                                        </div>
                                        <a href="<?= base_url() ?>/admin/currencies-management" ><button class="card-button">View More</button> </a>  
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </section>   
        	   </div>
            </div>
        </div>
    </div>
</div>
<?php include ('include/footer.php') ?> 
