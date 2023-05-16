<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Game Xchange</title> 
	<link rel="shortcut icon" href="img/favi.png" type="image/x-icon" />

    <link href="<?= base_url() ?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/css/style.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/css/select2.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/css/owl.carousel.css" rel="stylesheet">  <!-- Fonts -->
    <link href="<?= base_url() ?>/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>/assets/css/jquery.dataTables.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Archivo&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">


   <style type="text/css">
   	a[disabled] {
			cursor: not-allowed!important;   
		}

		.sub-menu.dropdown-menu {
    		width: 100%;
			left: auto;
			min-width: 600px;
			right: -20px;
			box-shadow: 0 0 12px 0px #0000004a;
			column-count: 2;
			padding: 25px 15px;
		}
		
		.sub-menu.dropdown-menu > div > a h3 {
			font-size: 20px;
			color: #000;
			font-weight: 600;
			margin: 0 !important;
			color: #000;
		}

		.sub-menu.dropdown-menu > div > a p {
			color: #c4c4c4;
			font-size: 14px;
			margin: 0;
		}

		.sub-menu.dropdown-menu > div > a {
			background: #fff !important;
			padding: 0 !important;
			height: auto !important;
		}

		.sub-menu.dropdown-menu > div {
			margin-bottom: 15px;
		}

		.sub-menu.dropdown-menu > div > a span {
		   font-size: 24px;
    		color: #000;
    		width: 25px;
		   text-align: center;
		}

		.sub-menu.dropdown-menu > div > a {
			display: flex;
			align-items: flex-start;
			column-gap: 10px;
		}

.navbar-nav .megamenu-li a{
    width: 100%;
    word-break: break-word;
    text-align: center;
}
ul.navbar-nav {
    display: inline-block;
}

li.nav-item {
    display: inline-block;
    align-items: center;
}


i.fa.fa-exchange.o {
    background: #007bff;
    color: #fff;
    padding: 3px;
    font-size: 10px;
}
a.btn.btn-outline.btn-sm {
    font-size: 14px;
    padding: 5px;
    margin: 2px;
}
ul.top_menu
{
    margin:5px
}
ul.top_menu li a {
    font-size: 14px;
    padding: 5px;
    /* margin: 2px; */
}
ul.top_menu li {
 
    margin: 0px 1px; 
}
   </style>
	
</head>
<?php 

use App\Models\Common_model;
$this->common_model = new Common_model();
$this->session = \Config\Services::session();
$this->auth_id = 0;
$this->auth = [];
$this->currency = 'HKD';
if ($this->session->has('user_id')) {
	$this->auth_id = $this->session->get('user_id');

	$this->auth = $this->common_model->GetSingleData('users' , array('id' =>$this->auth_id));
	$this->currency = $this->auth['currency'];
	//print_r($this->auth);
}

 ?>
<body> 
<div class="fix-box">
	<div class="container">
		<div class="white-wrapper">
			<!-- Header-->
			<div class="header">
				<div class="header-top">
					<div class="head-logo mb-4">
						<a href="<?= base_url() ?>">
							<img src="<?= base_url() ?>/assets/img/logo.png">
						</a>
					</div>
					<div class="search-wrapper mx-auto mb-4">
					    <form action="<?= base_url('shop') ?>" onsubmit="return do_search_page()">
						<div class="input-group" id="search_group">
							<input type="text" id="search_key" name="search" placeholder="Search here" class="form-control" value="<?= ($_GET['search']) ? $_GET['search'] : '' ?>">
							<span class="input-group-btn">
							<a href="javascript:;" class="btn btn-primary" onclick="do_search_page()"><i class="fa fa-search"></i></a>
							</span>
							</form>
						</div>
					</div>
					<div class="head-btn mb-4">
						<div>
							<ul class="top_menu">
							<li class="nav-item">
								<a class="nav-link btn" href="#">News</a>
							</li>
							<li class="nav-item dmenu dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								About
								</a>
								<div class="dropdown-menu sm-menu" aria-labelledby="navbarDropdown" >
									<a class="dropdown-item" href="#">HOW TO INSTALL A PS3 GAME</a>							
									<a class="dropdown-item" href="#">HOW TO INSTALL A PS4 GAME</a>							
									<a class="dropdown-item" href="#">How to pay with MACH</a>							
									<a class="dropdown-item" href="#">ADVISE PAYMENT</a>							
									<a class="dropdown-item" href="#">CHECK STATUS OF MY ORDER</a>							
									<a class="dropdown-item" href="#">Where do I find my order</a>					
									<a class="dropdown-item" href="#">PS5 INSTALLATION INSTRUCTIONS</a>							
								</div>
							</li>
							<li class="nav-item">
								<a class="nav-link btn" href="#">Help</a>
							</li>
						</ul>
						</div>
						<a href="<?= base_url('wishlist') ?>" class="btn btn-outline btn-lg"><i class="fa fa-heart"></i></a>
						<a  href="<?= base_url('exchange-list') ?>" class="btn btn-outline btn-sm">Exchange list</a>
					</div>
				</div>
			</div>
			<!-- Header-->
			
			<!-- Menu -->
			<div class="menu">
			          
			             				
				<nav class="navbar navbar-expand-lg navbar-dark sticky-top"> 
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobile_nav" aria-controls="mobile_nav" aria-expanded="false" aria-label="Toggle navigation">
						 <span class="navbar-toggler-icon"></span> 
						</button>
						<div class="collapse navbar-collapse" id="mobile_nav">
						<ul class="navbar-nav mr-auto mt-2 mt-lg-0 float-md-left col-lg-9">

							<li class="nav-item"><a class="nav-link" href="<?= base_url() ?>">Start</a></li>
							<!--========-->
							<?php $category = $this->common_model->GetAllData('categories', array('parent'=>0) , 'sorting','asc') ?>
							<?php foreach($category as $cat) : ?>
							<li class="nav-item dropdown megamenu-li dmenu">
								<?php $sub_category = $this->common_model->GetAllData('categories', array('parent'=>$cat['id'])); ?>
								<?php if($sub_category) { ?>
								<a class="nav-link dropdown-toggle" href="<?= base_url('shop/'.slugify($cat['title']).'-'.$cat['id']) ?>" id="dropdown01" data-toggle="dropdown" ><?= $cat['title'] ?></a>
								
								
								<div class="dropdown-menu megamenu sm-menu border-top" aria-labelledby="dropdown01">
									
									
									
									<div class="row">
										<?php foreach ($sub_category as $key => $value) { ?>
										<div class="col-sm-6 col-lg-4 border-right mb-4"> 
											
											<a class="dropdown-item" href="<?= base_url('shop/'.slugify($value['title']).'-'.$value['id']) ?>"><?= $value['title'] ?></a>
											
										</div>
									<?php } ?>
									</div>
								
									 
								</div>
							<?php } else { ?>
							<a class="nav-link" href="<?= base_url('shop') ?>" ><?= $cat['title'] ?></a>
						<?php } ?>
							</li>
							<?php endforeach ?> 
			       
							<!--========--> 
							<!-- <li class="nav-item dmenu dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								PSN PLUS
								</a>
								<div class="dropdown-menu sm-menu" aria-labelledby="navbarDropdown" >
									<a class="dropdown-item" href="<?= base_url('shop') ?>">PLAYSTATION</a>							
								</div>
							</li> -->
							<!--========-->
							<!-- <li class="nav-item dropdown megamenu-li dmenu">
								<a class="nav-link dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Xbox</a>
								<div class="dropdown-menu megamenu sm-menu border-top" aria-labelledby="dropdown01">
									<div class="row">
										<div class="col-sm-6 col-lg-4 border-right mb-4"> 
											<a class="dropdown-item" href="<?= base_url('shop') ?>"> ACTION</a>
											<a class="dropdown-item" href="<?= base_url('shop') ?>"> SPORTS</a>
											<a class="dropdown-item" href="<?= base_url('shop') ?>"> FAMILY</a>
											<a class="dropdown-item" href="<?= base_url('shop') ?>"> SIMULATION</a> 
										</div>
									   <div class="col-sm-6 col-lg-4 border-right mb-4"> 
											<a class="dropdown-item" href="<?= base_url('shop') ?>">ADVENTURE</a> 
											<a class="dropdown-item" href="<?= base_url('shop') ?>">SHOTS</a> 
											<a class="dropdown-item" href="<?= base_url('shop') ?>">FIGHT</a> 
											<a class="dropdown-item" href="<?= base_url('shop') ?>">TERROR</a> 
										</div>
										<div class="col-sm-6 col-lg-4 border-right mb-4"> 
											<a class="dropdown-item" href="<?= base_url('shop') ?>">CAREERS</a>
											<a class="dropdown-item" href="<?= base_url('shop') ?>">ROLE STRATEGY</a>
											<a class="dropdown-item" href="<?= base_url('shop') ?>">RPG</a>  
										</div>
									</div>
								</div>
							</li> --> 
			         
							<!--========-->
							<!-- <li class="nav-item dropdown megamenu-li dmenu">
								<a class="nav-link" href="<?= base_url('gamex-products') ?>">GameX Products</a>
							</li> -->
							<!--=========-->
						<!-- 	<li class="nav-item dmenu dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								AID
								</a>
								<div class="dropdown-menu sm-menu" aria-labelledby="navbarDropdown" >
									<a class="dropdown-item" href="#">HOW TO INSTALL A PS3 GAME</a>							
									<a class="dropdown-item" href="#">HOW TO INSTALL A PS4 GAME</a>							
									<a class="dropdown-item" href="#">How to pay with MACH</a>							
									<a class="dropdown-item" href="#">ADVISE PAYMENT</a>							
									<a class="dropdown-item" href="#">CHECK STATUS OF MY ORDER</a>							
									<a class="dropdown-item" href="#">Where do I find my order</a>					
									<a class="dropdown-item" href="#">PS5 INSTALLATION INSTRUCTIONS</a>							
								</div>
							</li> -->
							<!--li class="nav-item dmenu dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								ACCOUNTS AND CODES
								</a>
								<div class="dropdown-menu sm-menu" aria-labelledby="navbarDropdown" style="display: none;">
									<a class="dropdown-item" href="#">Software Development</a>
									<a class="dropdown-item" href="#">Web Designing &amp; Development</a>
									<a class="dropdown-item" href="#">Mobile Application</a>
									<a class="dropdown-item" href="#">Business Solutions &amp; Business Process</a>
									<a class="dropdown-item" href="#">Digital Marketing &amp; SEO Services</a>
									<a class="dropdown-item" href="#">Web Hosting &amp; Maintenance</a>
									<a class="dropdown-item" href="#">Cyber Security</a>
									<a class="dropdown-item" href="#">Block Chain Implementation</a>
									<a class="dropdown-item" href="#">Big Data</a>
								</div>
							</li--> 
				   
						</ul>
						<ul class="navbar-nav ml-auto navbar-light login-button col-lg-3 text-right">
							<li class="nav-item">
								<a class="nav-link btn" href="<?= base_url('shop') ?>">Browse</a>
							</li>
						
							<li class="nav-item">
								<a class="nav-link btn" href="<?= base_url('sell') ?>">Sell</a>
							</li>
							<?php if ($this->auth): ?>
								<!-- <li class="nav-item menu-item dropdown menu-item-has-children">
									<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="menu-link-21" aria-haspopup="true" aria-expanded="true"><?= $this->auth['first_name'] ?></a>
									<div class="sub-menu dropdown-menu" aria-labelledby="menu-link-21">
										<a href="<?= base_url() ?>/dashboard" class=" nav-link dropdown-item">Dashboard</a>
										<a href="<?= base_url('profile') ?>" class=" nav-link dropdown-item">Edit Profile</a>
										<a href="<?= base_url('logout') ?>" class=" nav-link dropdown-item">Logout</a>
									</div>
								</li> -->

								<li class="nav-item menu-item dropdown menu-item-has-children">
									<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="menu-link-21" aria-haspopup="true" aria-expanded="true"><?= $this->auth['first_name'] ?></a>

									<ul class="sub-menu dropdown-menu mr-2" aria-labelledby="menu-link-21">
										<li class="">
											<a href="<?= base_url('profile') ?>">
												<span><i class="fa fa-user-o" aria-hidden="true"></i></span>
												<div>
													<h3>Profile</h3>
													<p>Learn what's unique to you</p>
												</div>
											</a>
										</li>

										<li class="">
											<a href="<?= base_url('buy-orders') ?>">
												<span><i class="fa fa-money" aria-hidden="true"></i></span>
												<div>
													<h3>Buying</h3>
													<p>Active Bids, In-Progress, Completed Orders</p>
												</div>
											</a>
										</li>

										<li class="">
											<a href="<?= base_url('my-selling') ?>">
												<span><i class="fa fa-usd" aria-hidden="true"></i></span>
												<div>
													<h3>Selling</h3>
													<p>Active Asks, In-Progress, Completed Sales</p>
												</div>
											</a>
										</li>
										<li class="">
											<a href="<?= base_url('exchange-order') ?>">
												<span><i class="fa fa-recycle" aria-hidden="true"></i></span>
												<div>
													<h3>Exchange Orders</h3>
													<p>Active Orders, In-Progress, Completed Exchange</p>
												</div>
											</a>
										</li>

										<li class="">
											<a href="<?= base_url('my-products') ?>">
												<span><i class="fa fa-square-o" aria-hidden="true"></i></span>

												<div>
													<h3>My Product</h3>
													<p>List of your products</p>
												</div>
											</a>
										</li>

										<li class="">
											<a href="<?= base_url('wishlist') ?>">
												<span><i class="fa fa-star-o" aria-hidden="true"></i></span>
												<div>
													<h3>Wishlist</h3>
													<p>List of your wishlist</p>
												</div>
											</a>
										</li>
										<li class="">
											<a href="<?= base_url('my-wallet') ?>">
												<span><i class="fa fa-money" aria-hidden="true"></i></span>
												<div>
													<h3>My wallet</h3>
													<p>List of your earnings</p>
												</div>
											</a>
										</li>
										<li class="">
											<a href="<?= base_url('account-settings') ?>">
												<span><i class="fa fa-cog" aria-hidden="true"></i></span>
												<div>
													<h3>Settings</h3>
													<p>Learn about yourself</p>
												</div>
											</a>
										</li>

										<li class="">
											<a href="<?= base_url('logout') ?>">
												<span><i class="fa fa-sign-out" aria-hidden="true"></i></span>
												<div>
													<h3>Logout</h3>
													<p>Let's logout</p>
												</div>
											</a>
										</li>
							        </ul>
								</li>

							<?php else: ?>
							<li class="nav-item">
								<a class="nav-link btn btn-dark" href="<?= base_url('login') ?>">Login</a>
							</li>
							<?php endif ?>
						
						</ul> 
					</div>
				</nav>
			</div>
			<!-- Menu -->



</body>