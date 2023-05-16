
<?php include ('include/header.php') ?>

<style>
    .dashboard {
        background-color: #5662a6;
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
        			<h4>Order management:</h4> 
                    <?= $this->session->getFlashdata('msg'); ?>
                    <div id="result"></div>
        		
        		    <div class="table-responsive">		
        		        <table id="example3" class="display dataTable dataTables_wrapper" style="width:100%">
                            <thead>     

                                <tr>
                                    <th>S. No.</th>
                                    <th>User Name</th>
                                    <th>Product Name</th>
                                    <th>Seller Details</th>
                                    <th>Payment Details</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($order_list)) { 
                                    $i=1; 
                                    foreach ($order_list as $key => $value) { ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?php 
                                        $userdata = $this->common_model->GetSingleData('users',array('id'=>$value['user_id']));
                                        echo "<b>Name</b>: ".$userdata['first_name']."".$userdata['last_name'];echo "<br>";
                                        echo "<b>Email</b>: ".$userdata['email'];

                                    ?></td>
                                    <td><?php 
                                    $product = $this->common_model->GetSingleData('product',array('id'=>$value['product_id']));
                                        echo "<a href='". get_product_url($product) ."' target='_blank'>".$product['title']."</a>";
                                    ?></td>
                                    <td><?php 
                                      $seller = $this->common_model->GetSingleData('users',array('id'=>$value['seller_id']));
                                        echo "<b>Name</b>: ".$seller['first_name']."".$seller['last_name'];echo "<br>";
                                         echo "<b>Email</b>: ".$seller['email'];

                                    ?></td>
                                    <td><?php 
                                        echo "<b>Amount</b>: $".$value['grand_total'];echo "<br>";
                                        echo "<b>Payment Method</b>: ".$value['payment_method'];echo "<br>";
                                        echo "<b>Payment Id</b>: ".$value['payment_id'];echo "<br>";
                                    ?></td>
                                    <td><?php
                                        if($value['status'] == 0){
                                            echo "<span class='badge badge-warning'>Pending</span>";
                                        }elseif($value['status'] == 1){
                                            echo "<span class='badge badge-success'>Delivered</span>";
                                        }else{
                                            echo "<span class='badge badge-danger'>Cancelled</span>";
                                        }
                                    ?></td>
                                   
                                   <td>
                                       <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myviewModal<?= $value['id']; ?>">Shipping Details</button>
                                    </td>
                                </tr>
<!-- View Modal -->
<div class="modal" id="myviewModal<?= $value['id']; ?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Shipping Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
            <div class="row">
                  <div class="col-md-4">Name</div>
                  <div class="col-md-8"><b><?= $value['f_name']."".$value['l_name']; ?></b></div>
            </div>
            <hr>

              <div class="row">
                    <div class="col-md-4">Country</div>
                    <div class="col-md-8"><b><?= $value['country']; ?></b></div>
               </div>
              <hr>

              <div class="row">
                    <div class="col-md-4">City</div>
                    <div class="col-md-8"><b><?= $value['city']; ?></b></div>
               </div>
              <hr>
               <div class="row">
                    <div class="col-md-4">State</div>
                    <div class="col-md-8"><b><?= $value['state']; ?></b></div>
               </div>
              <hr>
               <div class="row">
                    <div class="col-md-4">Address 1</div>
                    <div class="col-md-8"><b><?= $value['address']; ?></b></div>
               </div>
              <hr>
              <div class="row">
                    <div class="col-md-4">Address 2</div>
                    <div class="col-md-8"><b><?= $value['address2']; ?></b></div>
               </div>
              <hr>
              <div class="row">
                    <div class="col-md-4">Zipcode</div>
                    <div class="col-md-8"><b><?= $value['zipcode']; ?></b></div>
               </div>
              
          </div>
    
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!-- View Modal -->
        <?php  $i++; }  }?>
                                
                            </tbody> 
                        </table>
        	       </div>
        	   </div>
            </div>
        </div>
    </div>
</div>
<?php include ('include/footer.php') ?> 
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

