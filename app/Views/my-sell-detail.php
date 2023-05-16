<?php include ('include/header.php') ?> 
<div class="account-page">
	<div class="row">
		<div class="col-sm-3">
			<?php include ('include/sidebar.php') ?> 
		</div>
		<div class="col-sm-9">
			<div class="right-side">
				<div class="rightjhead">
					<h1>Selling Details</h1>
 				</div>
				<div class="infoaccount">
					<div class="row">
						<?= $this->session->getFlashdata('msg');  ?>
						</div>

						<div class="row">
                        <div class="col-md-6">Product Name</div>
                        <div class="col-md-6"><b><?= $product["title"]; ?></b></div>
                  		</div>
	                  	<hr>

	                  	<div class="row">
                        <div class="col-md-6">Product Description</div>
                        <div class="col-md-6"><b><?= $product["description"]; ?></b></div>
                  		</div>
	                  	<hr>
	                  	<div class="row">
                        <div class="col-md-6">Product Category</div>
                        <div class="col-md-6"><b><?php
                         $category = $this->common_model->GetSingleData("categories", array("id"=>$product["category"]));
                         if ($category) {
                         	echo $category["title"];
                         } ?></b></div>
                  		</div>
	                  	<hr>
	                  	<div class="row">
                        <div class="col-md-6">Product Sub Category</div>
                        <div class="col-md-6"><b> 
                   		<?php
                         $subcategory = $this->common_model->GetSingleData("categories", array("id"=>$product["subcategory"]));
                         if ($subcategory) {
                         	echo $subcategory["title"];
                         } ?>
                     </b></div>
                  		</div>
	                  	<hr>

	                  	<div class="row">
                        <div class="col-md-6">Product Formate</div>
                        <div class="col-md-6"><b><?= $product["format"]; ?></b></div>
                  		</div>
	                  	<hr>
	                  	<div class="row">
                        <div class="col-md-6">Product RAM</div>
                        <div class="col-md-6"><b><?= $product["ram"]; ?></b></div>
                  		</div>
	                  	<hr> 

	                   <div class="row">
	                        <div class="col-md-6">Product Owner</div>
	                        <div class="col-md-6"><b><?php 
	                            $userdata = $this->common_model->GetSingleData('users',array('id'=>$sell_data['product_owner']));
	                           //print_r($userdata);
	                            echo $userdata['first_name']." ".$userdata['last_name']?></b></div>
	                   </div>
	                  <hr>
	                  <div class="row">
                        <div class="col-md-6">Status</div>
                        <div class="col-md-6"><b><?php
                            //echo $sell_data['status'];
                           if($sell_data['status'] == 1) {
                            echo "<span Class='badge badge-success'>Ask Price</span>";
                           }else
                           {
                            echo "<span Class='badge badge-primary'>Original Price</span>";
                           }
                        ?></b></div>
                   	</div>
                  	<hr>
                    <div class="row">
                        <div class="col-md-6">Sold Status</div>
                        <div class="col-md-6"><b><?php
                           if($sell_data['sold_status'] == 1) {
                            echo "<span Class='badge badge-success'>Sold</span>";
                           }else
                           {
                            echo "<span Class='badge badge-warning'>Pending</span>";
                           }
                        ?></b></div>
                    </div>
                    <hr>

                  	<div class="row">
                    <div class="col-md-6">Price</div>
                    <div class="col-md-6"><b><?= $this->currency ?><?= convert_currency($sell_data['price'] , $this->currency , 'HKD'); ?></b></div>
                   </div>
	                <hr>
	                 <div class="row">
	                    <div class="col-md-6">Total Payout</div>
	                    <div class="col-md-6"><b><?= $this->currency ?><?= convert_currency($sell_data['dis_price'] , $this->currency , 'HKD'); ?></b></div>
	                   </div>
	                <hr>
                    <?php
                    if ($sell_data['status'] == 1) {
                        ?>
	                 <div class="row">
	                    <div class="col-md-6">Expiry Date</div>
	                    <div class="col-md-6"><b><?= $sell_data['exp_date']; ?></b></div>
	                   </div>
	                <hr>

                        <?php
                    }
                    ?>
	                <h4 >Billing Detail:</h4>
	                <div class="row">
                    <div class="col-md-6"><label>Card Number</label></div>
                    <div class="col-md-6"><b><?= $sell_data['card_number']; ?></b></div>
                   </div>
                <hr>
                  <div class="row">
                    <div class="col-md-6"><label>Card CVV Number</label></div>
                    <div class="col-md-6"><b><?= $sell_data['card_cvv']; ?></b></div>
                   </div>
                <hr>
                <div class="row">
                    <div class="col-md-6"><label>Billing First Name</label></div>
                    <div class="col-md-6"><b><?= $sell_data['billing_first']; ?></b></div>
                   </div>
                <hr>
                 <div class="row">
                    <div class="col-md-6"><label>Billing Last Name</label></div>
                    <div class="col-md-6"><b><?= $sell_data['billing_last']; ?></b></div>
                   </div>
                <hr>
                 <div class="row">
                    <div class="col-md-6"><label>Billing Country</label></div>
                    <div class="col-md-6"><b><?= $sell_data['billing_country']; ?></b></div>
                   </div>
                <hr>
                  <div class="row">
                    <div class="col-md-6"><label>Billing State</label></div>
                    <div class="col-md-6"><b><?= $sell_data['billing_state']; ?></b></div>
                   </div>
                <hr>
                  <div class="row">
                    <div class="col-md-6"><label>Billing City</label></div>
                    <div class="col-md-6"><b><?= $sell_data['billing_city']; ?></b></div>
                   </div>
                <hr>
                <div class="row">
                    <div class="col-md-6"><label>Billing Address</label></div>
                    <div class="col-md-6"><b><?= $sell_data['billing_address']; ?></b></div>
                   </div>
                <hr>
                <div class="row">
                    <div class="col-md-6"><label>Alternate Billing Address</label></div>
                    <div class="col-md-6"><b><?= $sell_data['billing_address2']; ?></b></div>
                   </div>
                <hr>
                <div class="row">
                    <div class="col-md-6"><label>Billing Zipcode</label></div>
                    <div class="col-md-6"><b><?= $sell_data['billing_zip']; ?></b></div>
                   </div>
                <hr>




				</div>
			</div>
		</div>
	</div>
</div>
<?php include ('include/footer.php') ?>
<script type="text/javascript">
 
</script>