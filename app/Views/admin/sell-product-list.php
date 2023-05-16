<?php include 'include/header.php'; ?>

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
            <?php include 'include/sidebar.php'; ?>
            <div class="col-md-9">
                <div class="table-part">
                    <div>
                        <h4 class="d-flex justify-content-between">Sell Product management:

                            <!-- <a href="<?php echo base_url('Admin/product/productform'); ?>" class="btn btn-info">Add</a></h4>
 -->
                    </div>

                    <div id="result"></div>
                    <?php
                    $export = true;
                    ?>
                    <?php if($status == 'active'): ?>
                    <div class="table-responsive">
                        <table id="myTable" class="display dataTable dataTables_wrapper" style="width:100%">
                            <thead>

                                <tr>
                                    <th>S. No.</th>
                                    <th>User Details</th>
                                    <th>Created Date & Time</th>
                                    <th>Product Name</th>
                                    <th>Expiry(Days)</th>
                                    <th>Trade Details</th>
                                    <?php if($status == 'active')
                                      {
                                        ?>
                                    <th>Ask Price</th>
                                    <?php
                                      }else{
                                        ?>
                                    <th>Price</th>
                                    <?php
                                      }
                                    ?>
                                    <th>Status</th>

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($product_list)) { 
                                    $i=1; 
                                    foreach ($product_list as $key => $value) { ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?php
                                    $userdata = $this->common_model->GetSingleData('users', ['id' => $value['user_id']]);
                                    
                                    echo $userdata['first_name'] . ' ' . $userdata['last_name']; ?></td>
                                    <td><?= date('d F Y h:i A', strtotime($value['created_at'])) ?></td>
                                    <td><?php
                                    $product = $this->common_model->GetSingleData('product', ['id' => $value['product_id']]);
                                    
                                    echo $product['title']; ?></td>

                                    
                                    <td><?= get_expired_days($value['exp_date']) ?></td>
                                    <td>
                                        <ul>

                                            <li style="white-space: nowrap;"><b>New & Unworn : </b>
                                                <?= $value['is_new'] == 1 ? '<i class="fa fa-check text-success" ></i>' : '<i class="fa fa-times text-danger" ></i>' ?>
                                            </li>
                                            <li style="white-space: nowrap;"><b>Ship in 2 business days : </b>
                                                <?= $value['is_ship_in_2_days'] == 1 ? '<i class="fa fa-check text-success" ></i>' : '<i class="fa fa-times text-danger" ></i>' ?>
                                            </li>
                                            <li style="white-space: nowrap;"><b>Game Condition : </b>
                                                <?= $value['game_condition'] ?>% New</li>

                                        </ul>
                                    </td>
                                    <td>HKD<?= $value['price'] ?></td>
                                    <td>

                                        <?php
                                        if ($value['sold_status'] == 0) {
                                            echo "<span Class='badge badge-info'>Active</span>";
                                        } elseif ($value['sold_status'] == 2) {
                                            echo "<span Class='badge badge-success'>Completed</span>";
                                        } elseif ($value['sold_status'] == 3) {
                                            echo "<span Class='badge badge-danger'>Expired</span>";
                                        }
                                        ?>
                                    </td>


                                    <td>
                                        <div style="display:flex">
                                            <a style="display: none;" href="<?php echo base_url('Admin/Sell_Product/editproductform?id=' . $value['id']); ?>"
                                                class="btn btn-success">Edit</a>
                                           
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#myviewModal2<?= $value['id'] ?>">Delivery Details</button>
                                              <?php
                                                      if($value['sold_status'] == 0){
                                                      ?>
                                            <button class="btn btn-danger" id="delete_btns"
                                                onclick="delete_product(1 ,<?= $value['id'] ?>)">Delete</button>

                                            <!-- <a href="<?php echo base_url('Admin/Sell_Product/editproductform?id=' . $value['id']); ?>" class="btn btn-warning btn-sm">Edit</a> -->
                                            <?php
                                                      }
                                                      else{ ?>
                                                        <a href="<?php echo base_url('Admin/Sell_Product/viewsellproduct?id=' . $value['id']); ?>" class="btn btn-primary btn-sm">View</a>
                                                    <?php  }
                                                    ?>
                                        </div>
                                        <!-- View Modal -->
                                        <?= view('admin/modals/shipping_modal', ['ship' => $value]) ?>
                                        <!-- View Modal -->
                                        <!-- View Modal -->
                                         <!-- reject Modal -->
<div class="modal" id="delete_sell_modal<?= $value['id']; ?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Delete Ask</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
        
            <div class="col-md-12 py-3">
                <div>
                    <label>Reason</label>
                    <textarea class="form-control" id="delete_sell_reason<?= $value['id']; ?>" required></textarea>
                    
                </div>
               
                <div class="mt-3 text-center">
                    <button type="button" id="add_btn<?= $value['id'] ?>" onclick="delete_product(0 , <?= $value['id'] ?>)"  class="btn btn-danger">Delete</button>
                </div>
                
            </div>
    
    

    </div>
  </div>
</div>
<!-- reject Modal -->               
                                        <div class="modal" id="myviewModal2<?= $value['id'] ?>">

                                            <div class="modal-dialog">

                                                <div class="modal-content">



                                                    <!-- Modal Header -->

                                                    <div class="modal-header">

                                                        <h4 class="modal-title">Delivery Details</h4>

                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>

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

                                                            <div class="col-md-8"><b><?= get_admin()['address'] ?></b>
                                                            </div>

                                                        </div>



                                                    </div>



                                                    <!-- Modal footer -->

                                                    <div class="modal-footer">

                                                        <button type="button" class="btn btn-danger"
                                                            data-dismiss="modal">Close</button>

                                                    </div>



                                                </div>

                                            </div>

                                        </div>

                                        <!-- View Modal -->
                                    </td>
                                </tr>
                                <?php  $i++; }
                                    }?>

                            </tbody>
                        </table>
                    </div>

                    <?php elseif($status == 'complete'): ?>
                      <div class="table-responsive" id="completed">
                        <table id="myTable" class="display dataTable dataTables_wrapper" style="width:100%">
                            <thead>

                                <tr>
                                    <th>Order Id</th>
                                    <th>Buyer Details</th>
                                    <th>Seller Details</th>
                                    <th>Date of sold</th>
                                    <th>Product Name</th>
                                    
                                    <th>Trade Details</th>
                                    
                                    <th>Ask Price</th>
                                    
                                    <th>Status</th>

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($product_list)) { 
                                    $i=1; 
                                    foreach ($product_list as $key => $value) { 
                                        $order = $this->common_model->GetSingleData('orders', ['sell_product_id' => $value['id']]);  
                                        ?>
                                <tr>
                                    <td><?= $order['order_uniqueid'] ?></td>
                                    <td><?php
                                    $userdata = $this->common_model->GetSingleData('users', ['id' => $order['user_id']]);
                                    
                                    echo $userdata['first_name'] . ' ' . $userdata['last_name']; ?></td>
                                    <td><?php
                                    $userdata = $this->common_model->GetSingleData('users', ['id' => $value['user_id']]);
                                    
                                    echo $userdata['first_name'] . ' ' . $userdata['last_name']; ?></td>
                                    <td><?= date('d F Y h:i A', strtotime($order['created_at'])) ?></td>
                                    <td><?php
                                    $product = $this->common_model->GetSingleData('product', ['id' => $value['product_id']]);
                                    
                                    echo $product['title']; ?></td>

                                    <td>
                                        <ul>

                                            <li style="white-space: nowrap;"><b>New & Unworn : </b>
                                                <?= $value['is_new'] == 1 ? '<i class="fa fa-check text-success" ></i>' : '<i class="fa fa-times text-danger" ></i>' ?>
                                            </li>
                                            <li style="white-space: nowrap;"><b>Ship in 2 business days : </b>
                                                <?= $value['is_ship_in_2_days'] == 1 ? '<i class="fa fa-check text-success" ></i>' : '<i class="fa fa-times text-danger" ></i>' ?>
                                            </li>
                                            <li style="white-space: nowrap;"><b>Game Condition : </b>
                                                <?= $value['game_condition'] ?>% New</li>

                                        </ul>
                                    </td>
                                    <td>HKD<?= $value['price'] ?></td>
                                    <td>

                                        <?php
                                        if ($value['sold_status'] == 0) {
                                            echo "<span Class='badge badge-info'>Active</span>";
                                        } elseif ($value['sold_status'] == 2) {
                                            echo "<span Class='badge badge-success'>Completed</span>";
                                        } elseif ($value['sold_status'] == 3) {
                                            echo "<span Class='badge badge-danger'>Expired</span>";
                                        }
                                        ?>
                                    </td>


                                    <td>
                                        <div style="display:flex">
                                            <a style="display: none;" href="<?php echo base_url('Admin/Sell_Product/editproductform?id=' . $value['id']); ?>"
                                                class="btn btn-success">Edit</a>
                                           
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#myviewModal2<?= $value['id'] ?>">Delivery Details</button>
                                              <?php
                                                      if($value['sold_status'] == 0){
                                                      ?>
                                           

                                            <!-- <a href="<?php echo base_url('Admin/Sell_Product/editproductform?id=' . $value['id']); ?>" class="btn btn-warning btn-sm">Edit</a> -->
                                            <?php
                                                      }
                                                      else{ ?>
                                                        <a href="<?php echo base_url('Admin/Sell_Product/viewsellproduct?id=' . $value['id']); ?>" class="btn btn-primary btn-sm">View</a>
                                                    <?php  }
                                                    ?>
                                        </div>
                                        <!-- View Modal -->
                                        <?= view('admin/modals/shipping_modal', ['ship' => $value]) ?>
                                        <!-- View Modal -->
                                        <!-- View Modal -->

                                        <div class="modal" id="myviewModal2<?= $value['id'] ?>">

                                            <div class="modal-dialog">

                                                <div class="modal-content">



                                                    <!-- Modal Header -->

                                                    <div class="modal-header">

                                                        <h4 class="modal-title">Delivery Details</h4>

                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>

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

                                                            <div class="col-md-8"><b><?= get_admin()['address'] ?></b>
                                                            </div>

                                                        </div>



                                                    </div>



                                                    <!-- Modal footer -->

                                                    <div class="modal-footer">

                                                        <button type="button" class="btn btn-danger"
                                                            data-dismiss="modal">Close</button>

                                                    </div>



                                                </div>

                                            </div>

                                        </div>

                                        <!-- View Modal -->
                                    </td>
                                </tr>
                                <?php  $i++; }
                                    }?>

                            </tbody>
                        </table>
                    </div>
                    <?php elseif($status == 'expire'): ?>
                      <div class="table-responsive" id="expire">
                        <table id="myTable" class="display dataTable dataTables_wrapper" style="width:100%">
                            <thead>

                                <tr>
                                    <th>S. No.</th>
                                    <th>User Details</th>
                                    <th>Expired Date</th>
                                    <th>Product Name</th>
                                  
                                    <th>Trade Details</th>
                                   
                                    <th>Ask Price</th>
                                    
                                    <th>Status</th>

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($product_list)) { 
                                    $i=1; 
                                    foreach ($product_list as $key => $value) { ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?php
                                    $userdata = $this->common_model->GetSingleData('users', ['id' => $value['user_id']]);
                                    
                                    echo $userdata['first_name'] . ' ' . $userdata['last_name']; ?></td>
                                    <td><?= date('d F Y h:i A', strtotime($value['exp_date'])) ?></td>
                                    <td><?php
                                    $product = $this->common_model->GetSingleData('product', ['id' => $value['product_id']]);
                                    
                                    echo $product['title']; ?></td>

                                    <td>
                                        <ul>

                                            <li style="white-space: nowrap;"><b>New & Unworn : </b>
                                                <?= $value['is_new'] == 1 ? '<i class="fa fa-check text-success" ></i>' : '<i class="fa fa-times text-danger" ></i>' ?>
                                            </li>
                                            <li style="white-space: nowrap;"><b>Ship in 2 business days : </b>
                                                <?= $value['is_ship_in_2_days'] == 1 ? '<i class="fa fa-check text-success" ></i>' : '<i class="fa fa-times text-danger" ></i>' ?>
                                            </li>
                                            <li style="white-space: nowrap;"><b>Game Condition : </b>
                                                <?= $value['game_condition'] ?>% New</li>

                                        </ul>
                                    </td>
                                    <td>HKD<?= $value['price'] ?></td>
                                    <td>

                                        <?php
                                        if ($value['sold_status'] == 0) {
                                            echo "<span Class='badge badge-info'>Active</span>";
                                        } elseif ($value['sold_status'] == 2) {
                                            echo "<span Class='badge badge-success'>Completed</span>";
                                        } elseif ($value['sold_status'] == 3) {
                                            echo "<span Class='badge badge-danger'>Expired</span>";
                                        }
                                        ?>
                                    </td>


                                    <td>
                                        <div style="display:flex">
                                            <a style="display: none;" href="<?php echo base_url('Admin/Sell_Product/editproductform?id=' . $value['id']); ?>"
                                                class="btn btn-success">Edit</a>
                                           
                                            
                                              <?php
                                                      if($value['sold_status'] == 0){
                                                      ?>
                                            

                                            <!-- <a href="<?php echo base_url('Admin/Sell_Product/editproductform?id=' . $value['id']); ?>" class="btn btn-warning btn-sm">Edit</a> -->
                                            <?php
                                                      }
                                                      else{ ?>
                                                        <a href="<?php echo base_url('Admin/Sell_Product/viewsellproduct?id=' . $value['id']); ?>" class="btn btn-primary btn-sm">View</a>
                                                    <?php  }
                                                    ?>
                                        </div>
                                        <!-- View Modal -->
                                        <?= view('admin/modals/shipping_modal', ['ship' => $value]) ?>
                                        <!-- View Modal -->
                                        <!-- View Modal -->

                                        <div class="modal" id="myviewModal2<?= $value['id'] ?>">

                                            <div class="modal-dialog">

                                                <div class="modal-content">



                                                    <!-- Modal Header -->

                                                    <div class="modal-header">

                                                        <h4 class="modal-title">Delivery Details</h4>

                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>

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

                                                            <div class="col-md-8"><b><?= get_admin()['address'] ?></b>
                                                            </div>

                                                        </div>



                                                    </div>



                                                    <!-- Modal footer -->

                                                    <div class="modal-footer">

                                                        <button type="button" class="btn btn-danger"
                                                            data-dismiss="modal">Close</button>

                                                    </div>



                                                </div>

                                            </div>

                                        </div>

                                        <!-- View Modal -->
                                    </td>
                                </tr>
                                <?php  $i++; }
                                    }?>

                            </tbody>
                        </table>
                    </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'include/footer.php'; ?>


<script>
    function delete_product(show_modal , id) {
        // event.preventDefault();
        if(show_modal == 1)
        {
        $('#delete_sell_modal'+id).modal('show');
        return false;
        
        }
        reason = $('#delete_sell_reason'+id).val();
    // alert(reason);

        if(reason.trim() == '')
        {
            alert('reason can not be empty');
            return false;
        }
        if (confirm('Are you sure ?')) {
            $('#delete_sell_modal'+id).modal('hide');
            
            $.ajax({
                url: '<?= base_url() ?>/Admin/Sell_Product/delete_sellproduct',
                type: 'POST',
                cache: false,
                data: {
                    'id': id ,
                    'reason': reason
                },
                dataType: 'json',
                beforeSend: function() {
                    $('#delete_btns' + id).prop('disabled', true);
                    $('#delete_btns' + id).text('Processing..');
                },
                success: function(res) {
                    console.log(res);
                    $('#delete_btns' + id).prop('disabled', false);
                    if (res.status == 1) {
                        Swal.fire({
                            title: "Success",
                            text: res.message,
                            icon: "success"
                        }).then(function(result) {
                            location.reload();
                        })
                    }

                }
            });
        }

    }

    function delete_product_image(id) {
        // event.preventDefault();
        if (confirm('Are you sure ?')) {
            $.ajax({
                url: '<?= base_url() ?>/Admin/Product/remove_pimage',
                type: 'POST',
                cache: false,
                data: {
                    'id': id
                },
                dataType: 'json',
                beforeSend: function() {
                    $('#delete_btns' + id).prop('disabled', true);
                    $('#delete_btns' + id).text('Processing..');
                },
                success: function(res) {
                    console.log(res);
                    $('#delete_btns' + id).prop('disabled', false);
                    if (res.status == 1) {

                        //location.reload();

                    }

                }
            });
        }

    }
</script>

<script>
    $(document).ready(function() {
        //alert('hello');
        $('#category').on('change', function() {
            var category_id = this.value;
            $.ajax({
                url: '<?= base_url() ?>/Admin/Product/getsubcat',
                type: "POST",
                data: {
                    category_id: category_id
                },
                cache: false,
                success: function(dataResult) {
                    $("#sub_category").html(dataResult);
                }
            });


        });
    });
</script>

<script>
    function fetchsubcat(id) {
        //alert('hello');
        //alert(id)
        var category_id = id;
        $.ajax({
            url: '<?= base_url() ?>/Admin/Product/getsubcat',
            type: "POST",
            data: {
                category_id: category_id
            },
            cache: false,
            success: function(dataResult) {
                $("#editsub_category").html(dataResult);
            }
        });

    }
</script>
