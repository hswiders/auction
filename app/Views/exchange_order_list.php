<?php include ('include/header.php');



$this->user_id =  $this->session->get('user_id');

 ?> 



<style>



/* Style the tab */

.tab {

  overflow: hidden;

  border: 1px solid #ccc;

  background-color: #f1f1f1;

}



/* Style the buttons inside the tab */

.tab button {

  background-color: inherit;

  float: left;

  border: none;

  outline: none;

  cursor: pointer;

  padding: 14px 16px;

  transition: 0.3s;

  font-size: 17px;

}



/* Change background color of buttons on hover */

.tab button:hover {

  background-color: #ddd;

}



/* Create an active/current tablink class */

.tab button.active {

  background-color: #ccc;

}



/* Style the tab content */

.tabcontent {

  display: none;

  padding: 6px 12px;

  border: 1px solid #ccc;

  border-top: none;

}

</style>

<div class="account-page">

	<div class="row">

		<div class="col-sm-3">

			<?php include ('include/sidebar.php') ?> 

		</div>

		<div class="col-sm-9">

			<div class="right-side">

				<div class="rightjhead">

					<h1>My Exchange Order List</h1>

 				</div>

				<div class="infoaccount">

					<div class="row">

						<?= $this->session->getFlashdata('msg'); 

						//print_r($product); ?>

<div class="tab">

  <button class="tablinks" onclick="openorder(event, 'active')" id="defaultOpen">Pending</button>

  <button class="tablinks" onclick="openorder(event, 'completed')">Approved</button>

  <button class="tablinks" onclick="openorder(event, 'completed1')">Completed</button>

  <button class="tablinks" onclick="openorder(event, 'expire')">Reject</button>

</div>

<div class="table-responsive tabcontent" id="active">
  <table class="table table-bordered example3">
    <thead>
      <tr>
        <th>Product</th>
        
        <th>Product In</th>
        <th>Products Out</th>
        <th>Trade Details</th>
        <th>Create Date</th>
        <th>Payment Details</th>
        
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $x = 1;
        if ($pending_order_list) {
          foreach ($pending_order_list as $key => $Pvalue) {
            $product = $this->common_model->GetSingleData('product',array('id'=>$Pvalue['product_id']));
      ?>
      <tr>
        <td><img src="<?= get_product_img_url($product) ?>" class="img-thumbnail"></td>
        
        <td><?php
          
          echo "<a href='". get_product_url($product) ."' target='_blank'>".$product['title']."</a> ".gradeName($product['class_type'])."";
        ?></td>

        <td><?php
          $ex = explode(',', $Pvalue['exchnage_product_id']);
          foreach ($ex as $key => $exes) {
          $Exproduct = $this->common_model->GetSingleData('product',array('id'=>$exes));
          echo "<a href='". get_product_url($Exproduct) ."' target='_blank'>".$Exproduct['title']."</a> ".gradeName($Exproduct['class_type']).", ";
          }
          
        ?></td>
        <td>Order ID : <?= $Pvalue['order_uniqueid'] ?></td>
        <td><?= date('d, F Y h:i A' , strtotime($Pvalue['created_at']) ) ?></td>
         <td><p>Step Charge : <?= $this->currency ?><?= convert_currency($Pvalue['price'], $this->currency , 'HKD'); ?> </p>
        <p>Service Fee : <?= $this->currency ?><?= convert_currency($Pvalue['service_fee'], $this->currency , 'HKD'); ?> </p>
        <p>Shipping Fee : <?= $this->currency ?><?= convert_currency($Pvalue['shipping_fee'], $this->currency , 'HKD'); ?> </p>
        <p>Total : <?= $this->currency ?><?= convert_currency($Pvalue['grand_total'], $this->currency , 'HKD'); ?></p>
        </td>
        
        <td><span class='badge badge-warning'>Pending</span></td>
        <td>
          <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myviewModal<?= $Pvalue['id']; ?>">Shipping Details</button>
          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myviewModal2<?= $Pvalue['id']; ?>">Post Details</button>
          <!-- <button type="button" class="btn btn-danger btn-sm" onclick="deleteData('Trade' , <?= $Pvalue['id'] ?>)">Delete</button> -->
        </td>
        <div class="modal" id="myviewModal2<?= $Pvalue['id']; ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Post Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- Modal body -->
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-4">Name</div>
                  <div class="col-md-8"><b>Gamex</b></div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-4">Address </div>
                  <div class="col-md-8"><b><?= get_admin()['address']; ?></b></div>
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
        <div class="modal" id="myviewModal<?= $Pvalue['id']; ?>">
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
                  <div class="col-md-8"><b><?= $Pvalue['f_name']." ".$Pvalue['l_name']; ?></b></div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-4">Country</div>
                  <div class="col-md-8"><b><?= $Pvalue['country']; ?></b></div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-4">City</div>
                  <div class="col-md-8"><b><?= $Pvalue['city']; ?></b></div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-4">State</div>
                  <div class="col-md-8"><b><?= $Pvalue['state']; ?></b></div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-4">Address 1</div>
                  <div class="col-md-8"><b><?= $Pvalue['address']; ?></b></div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-4">Address 2</div>
                  <div class="col-md-8"><b><?= $Pvalue['address2']; ?></b></div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-4">Zipcode</div>
                  <div class="col-md-8"><b><?= $Pvalue['zipcode']; ?></b></div>
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
      </tr>
      <?php
      $x++;
      }
      }
      ?>
    </tbody>
  </table>
</div>

<div class="table-responsive tabcontent" id="completed">
  <table class="table table-bordered example3">
    <thead>
      <tr>
        <th>Product</th>
       
        <th>Product IN</th>
        <th>Product OUT</th>
        <th>Trade Details</th>
        <th>Approval Date</th>
        <th>Payment Details</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $x = 1;
        if ($approve_order_list) {
          //print_r($approve_order_list);
      foreach ($approve_order_list as $key => $Avalue) {
        $product = $this->common_model->GetSingleData('product',array('id'=>$Avalue['product_id']));
      ?>
      <tr>
        <td><img src="<?= get_product_img_url($product) ?>" class="img-thumbnail"></td>
       
        <td><?php
          
          echo "<a href='". get_product_url($product) ."' target='_blank'>".$product['title']."</a>".gradeName($product['class_type'])."";
        ?></td>
        <td><?php
          $Exproduct = $this->common_model->GetAllData('product','id IN('.$Avalue['exchnage_product_id'].')');
          foreach ($Exproduct as $key => $Exvalue) {
            echo "<a href='". get_product_url($Exvalue) ."' target='_blank'>".$Exvalue['title']."</a>  ".gradeName($Exvalue['class_type'])." , ";
          }
        ?></td>
        <td>Order ID :<?= $Avalue['order_uniqueid'] ?></td>
        <td><?= date('d F Y h:i A' , strtotime($Avalue['approval_date'])) ?></td>
         <td><p>Step Charge : <?= $this->currency ?><?= convert_currency($Avalue['price'], $this->currency , 'HKD'); ?> </p>
        <p>Service Fee : <?= $this->currency ?><?= convert_currency($Avalue['service_fee'], $this->currency , 'HKD'); ?> </p>
        <p>Shipping Fee : <?= $this->currency ?><?= convert_currency($Avalue['shipping_fee'], $this->currency , 'HKD'); ?> </p>
        <p>Total : <?= $this->currency ?><?= convert_currency($Avalue['grand_total'], $this->currency , 'HKD'); ?></p>
        </td>
        <td><span class='badge badge-success'>In Progress</span></td>
        <td>
          <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myviewModal<?= $Avalue['id']; ?>">Shipping Details</button>
           <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myviewModal2<?= $Avalue['id']; ?>">Post Details</button>
        </td>
        <div class="modal" id="myviewModal2<?= $Avalue['id']; ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Post Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- Modal body -->
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-4">Name</div>
                  <div class="col-md-8"><b>Gamex</b></div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-4">Address </div>
                  <div class="col-md-8"><b><?= get_admin()['address']; ?></b></div>
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
        <div class="modal" id="myviewModal<?= $Avalue['id']; ?>">
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
                  <div class="col-md-8"><b><?= $Avalue['f_name']." ".$Avalue['l_name']; ?></b></div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-4">Country</div>
                  <div class="col-md-8"><b><?= $Avalue['country']; ?></b></div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-4">City</div>
                  <div class="col-md-8"><b><?= $Avalue['city']; ?></b></div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-4">State</div>
                  <div class="col-md-8"><b><?= $Avalue['state']; ?></b></div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-4">Address 1</div>
                  <div class="col-md-8"><b><?= $Avalue['address']; ?></b></div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-4">Address 2</div>
                  <div class="col-md-8"><b><?= $Avalue['address2']; ?></b></div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-4">Zipcode</div>
                  <div class="col-md-8"><b><?= $Avalue['zipcode']; ?></b></div>
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
      </tr>
      <?php
            $x++;
            }
          }
      ?>
    </tbody>
  </table>
</div>

<div class="table-responsive tabcontent" id="completed1">
  <table class="table table-bordered example3">
    <thead>
      <tr>
        <th>Product</th>
       
        <th>Product IN</th>
        <th>Product OUT</th>
        <th>Trade Details</th>
        <th>Completed Date</th>
        <th>Payment Details</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $x = 1;
        if ($complete_order_list) {
          //print_r($approve_order_list);
      foreach ($complete_order_list as $key => $Avalue) {
        $product = $this->common_model->GetSingleData('product',array('id'=>$Avalue['product_id']));
      ?>
      <tr>
        <td><img src="<?= get_product_img_url($product) ?>" class="img-thumbnail"></td>
       
        <td><?php
          
          echo "<a href='". get_product_url($product) ."' target='_blank'>".$product['title']."</a>".gradeName($product['class_type'])."";
        ?></td>
        <td><?php
          $Exproduct = $this->common_model->GetAllData('product','id IN('.$Avalue['exchnage_product_id'].')');
          foreach ($Exproduct as $key => $Exvalue) {
            echo "<a href='". get_product_url($Exvalue) ."' target='_blank'>".$Exvalue['title']."</a>  ".gradeName($Exvalue['class_type'])." , ";
          }
        ?></td>
        <td>Order ID :<?= $Avalue['order_uniqueid'] ?></td>
        <td><?= date('d F Y h:i A' , strtotime($Avalue['completed_date'])) ?></td>
         <td><p>Step Charge : <?= $this->currency ?><?= convert_currency($Avalue['price'], $this->currency , 'HKD'); ?> </p>
        <p>Service Fee : <?= $this->currency ?><?= convert_currency($Avalue['service_fee'], $this->currency , 'HKD'); ?> </p>
        <p>Shipping Fee : <?= $this->currency ?><?= convert_currency($Avalue['shipping_fee'], $this->currency , 'HKD'); ?> </p>
        <p>Total : <?= $this->currency ?><?= convert_currency($Avalue['grand_total'], $this->currency , 'HKD'); ?></p>
        </td>
        <td><span class='badge badge-success'>Delivered</span></td>
        <td>
          <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myviewModal<?= $Avalue['id']; ?>">Shipping Details</button>
           
        </td>
        
        <!-- View Modal -->
        <div class="modal" id="myviewModal<?= $Avalue['id']; ?>">
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
                  <div class="col-md-8"><b><?= $Avalue['f_name']." ".$Avalue['l_name']; ?></b></div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-4">Country</div>
                  <div class="col-md-8"><b><?= $Avalue['country']; ?></b></div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-4">City</div>
                  <div class="col-md-8"><b><?= $Avalue['city']; ?></b></div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-4">State</div>
                  <div class="col-md-8"><b><?= $Avalue['state']; ?></b></div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-4">Address 1</div>
                  <div class="col-md-8"><b><?= $Avalue['address']; ?></b></div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-4">Address 2</div>
                  <div class="col-md-8"><b><?= $Avalue['address2']; ?></b></div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-4">Zipcode</div>
                  <div class="col-md-8"><b><?= $Avalue['zipcode']; ?></b></div>
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
      </tr>
      <?php
            $x++;
            }
          }
      ?>
    </tbody>
  </table>
</div>

<div class="table-responsive tabcontent" id="expire">
  <table class="table table-bordered example3">
    <thead>
      <tr>
        <th>Product</th>
        <th>Product IN</th>
        <th>Product OUT</th>
        <th>Trade Details</th>
        <th>Reject Date</th>
        
        <th>Status</th>
        <th>Reject Reason</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $x = 1;
        if ($reject_order_list) {
          foreach ($reject_order_list as $key => $Rvalue) {

            $product = $this->common_model->GetSingleData('product',array('id'=>$Rvalue['product_id']));
      ?>
      <tr>
        <td><img src="<?= get_product_img_url($product) ?>" class="img-thumbnail" width="100"></td>
        
        <td><?php
          
          echo "<a href='". get_product_url($product) ."' target='_blank'>".$product['title']."</a> ".gradeName($product['class_type'])."";
        ?></td>
        <td><?php
         $Exproduct = $this->common_model->GetAllData('product','id IN('.$Rvalue['exchnage_product_id'].')');
          foreach ($Exproduct as $key => $Exvalue) {
            echo "<a href='". get_product_url($Exvalue) ."' target='_blank'>".$Exvalue['title']."</a> ".gradeName($Exvalue['class_type']).", ";
          }
        ?></td>
        <td>Order ID :<?= $Rvalue['order_uniqueid'] ?></td>
        <td><?= date('d F Y h:i A' , strtotime($Rvalue['reject_date'])) ?></td>
        <td>
          <span class='badge badge-danger'>Rejected</span></td>
        <td>
         <?= $Rvalue['reject_reason'] ?>
        </td>
        <!-- View Modal -->
        <div class="modal" id="myviewModal<?= $Rvalue['id']; ?>">
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
                  <div class="col-md-8"><b><?= $Rvalue['f_name']." ".$Rvalue['l_name']; ?></b></div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-4">Country</div>
                  <div class="col-md-8"><b><?= $Rvalue['country']; ?></b></div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-4">City</div>
                  <div class="col-md-8"><b><?= $Rvalue['city']; ?></b></div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-4">State</div>
                  <div class="col-md-8"><b><?= $Rvalue['state']; ?></b></div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-4">Address 1</div>
                  <div class="col-md-8"><b><?= $Rvalue['address']; ?></b></div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-4">Address 2</div>
                  <div class="col-md-8"><b><?= $Rvalue['address2']; ?></b></div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-4">Zipcode</div>
                  <div class="col-md-8"><b><?= $Rvalue['zipcode']; ?></b></div>
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
      </tr>
      <?php
      $x++;
      }
      }
      ?>
    </tbody>
  </table>
</div>




		</div>

				</div>

			</div>

		</div>

	</div>

</div>

<?php include ('include/footer.php') ?>

<script>

	<?php if (isset($_GET['completed'])): ?>

		openorder('' , 'progress');

	<?php endif ?>

function openorder(evt, cityName) {

  var i, tabcontent, tablinks;

  tabcontent = document.getElementsByClassName("tabcontent");

  for (i = 0; i < tabcontent.length; i++) {

    tabcontent[i].style.display = "none";

  }

  tablinks = document.getElementsByClassName("tablinks");

  for (i = 0; i < tablinks.length; i++) {

    tablinks[i].className = tablinks[i].className.replace(" active", "");

  }

  document.getElementById(cityName).style.display = "block";

  evt.currentTarget.className += " active";

}



// Get the element with id="defaultOpen" and click on it

document.getElementById("defaultOpen").click();

</script>