<?php 

use App\Models\Common_model;
$this->common_model = new Common_model();
$this->session = \Config\Services::session();
$this->auth_id = 0;
$this->auth = [];
if ($this->session->has('user_id')) {
	$this->auth_id = $this->session->get('user_id');

	$this->auth = $this->common_model->GetSingleData('users' , array('id' =>$this->auth_id));
	//print_r($this->auth);
}

 ?>

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
    <link href="<?= base_url() ?>/assets/css/owl.carousel.css" rel="stylesheet">  <!-- Fonts -->
    <link href="<?= base_url() ?>/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>/assets/css/select2.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Archivo&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
	<style>
		.bottom-border {
		  	border-bottom: 1px solid #cfcfcf;
		}
	</style>
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
	</style>
	
</head>
<body> 
<div class="fix-box">
	<div class="container">
		<div class="white-wrapper">
			<!-- Header-->
			<div class="header">
				<div class="d-flex align-items-center bottom-border">
					<div class="head-logo">
						<a href="<?= base_url() ?>">
							<img src="<?= base_url() ?>/assets/img/logo.png">
						</a>
					</div><!-- 
					<div class="search-wrapper mx-auto">
						<div class="input-group">
							<input type="text" placeholder="Search here" class="form-control">
							<span class="input-group-btn">
							<a href="<?= base_url() ?>" class="btn btn-primary"><i class="fa fa-search"></i></a>
							</span>
						</div>
					</div> -->
					<div class="head-btn ml-auto">
						<a href="<?= base_url('faq') ?>" class="btn btn-outline btn-lg">FAQ</a>
						
						<?php
					if ($this->session->get('user_id')) {
						?>
 						<a href="<?= base_url('dashboard') ?>" class="btn btn-outline btn-lg btn-primary">DASHBOARD</a>
 						<?php
					}
					?>
					</div>
					
				</div>
			</div>