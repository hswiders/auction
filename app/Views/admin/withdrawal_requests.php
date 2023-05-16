
<?php include ('include/header.php') ?>

<style>
     tbody#sortable {
    cursor: all-scroll;
}
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
     .open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup form - hidden by default */
.form-popup {
    width: 500px;
    position: absolute;
    bottom: 0%;
    right: 0%;
    left: 0%;
    border: 3px solid #f1f1f1;
    z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}

/* button#reject {
    margin-right: 50px;
    margin-bottom: 15px;
    margin-top:20px;
    margin-left:20px;
} */
/* button#update {
    margin-right: 50px;
    margin-bottom: 15px;
    margin-top:20px;
    margin-left:20px;
} */

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
                    <div>
        			    <h4 class="d-flex justify-content-between">Withdrawal Requests:</h4>
                    </div>
                    <?= $this->session->getFlashdata('msg'); ?>
                    <div id="result"></div>
        		
        		    <div class="table-responsive">		
        		        <table id="myTable" class="display dataTable dataTables_wrapper" style="width:100%">
                            <thead>     

                                <tr>
                                    <th>S. No.</th>
                                    <th>User Details</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Purpose</th>
                                    <th>Transfer to</th>
                                    <?php if($status == 0): ?>
                                        <th>Action</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody class="row-position" id="sortable">
                                <?php if(!empty($withdrawal_requests)) { 
                                    $i=1; 
                                    foreach ($withdrawal_requests as $key => $value) { 
                                       $user =  getUserById($value['user_id']);
                                       $payout_method =  getData('hw_users' , $value['payout_id'] );
                                       $transferRes = [];
                                       if($value['transfer_response'])
                                       {
                                            $transfer_response = json_decode($value['transfer_response']);
                                             //print_r($transfer_response);
                                            $data3['api_url'] = "transfers/".$transfer_response->token;
                                            
                                            $res3 = runCurl($data3 , "GET" );
                                            // print_r($data3);
                                             //print_r($res3);
                                            if($res3['httpcode'] == 200)
                                            {   
                                                $transferRes = $res3['response'];
                                            }
                                            
                                            
                                       } 
                                        ?>
                                    <tr id="<?= $value['id'] ?>">
                                    <td class="cs_<?= $value['id'] ?>"><?= $i; ?></td>
                              
                                    <td>
                                        <span><b>ID : </b>#<?= $user['id']?></span><br/>
                                        <span><b>Name : </b><?= $user['first_name']?> <?= $user['last_name']?></span><br/>
                                        <span><b>User name : </b><?= $user['email']?></span><br/>
                                    </td>
                                    <td><?php
                                        if($value['t_type'] == 1){
                                            echo "<span class='badge badge-info'>Credit</span>";
                                        }else{
                                            echo "<span class='badge badge-info'>Debit</span>";
                                        }
                                    ?></td>
                                    <td>HKD<?= $value['amount']?></td>
                                     <td><?php  //$value['user_id']
                                        if($value['status'] == 0){
                                            echo "<span class='badge badge-warning'>Pending</span>";
                                        }elseif($value['status'] == 1){
                                            echo "<span class='badge badge-success'>Complete</span>";
                                        }else{
                                            echo "<span class='badge badge-danger'>Rejected</span>";
                                        }
                                        
                                    ?></td>
                                     <td><?= $value['purpose']?></td>
                                     <td style="white-space:nowrap">
                                        <?php if($payout_method['payout_type'] == 'paypal'): ?>
                                            <?php 
                                            $full_paypal_response = json_decode($payout_method['full_paypal_response']);
                                            //print_r($full_paypal_response);
                                            ?>
                                            <span><b>Profile Type : </b><?= $payout_method['profileType']?></span><br/>
                                            <span><b>Name : </b><?= $payout_method['firstName']?> <?= $payout_method['lastName']?></span><br/>
                                            <span><b>Address : </b><?= $payout_method['addressLine1']?> <?= $payout_method['city']?> <?= $payout_method['stateProvince']?> <?= $payout_method['country']?> </span><br/>
                                            <span><b>Paypal ID : </b><?= $payout_method['accountId']?> </span><br/>
                                        <?php else: ?>
                                            <?php 
                                            $full_bank_response = json_decode($payout_method['full_bank_response']);
                                            
                                            ?>
                                            <span><b>Profile Type : </b><?= $payout_method['profileType']?></span><br/>
                                            <span><b>Name : </b><?= $payout_method['firstName']?> <?= $payout_method['lastName']?></span><br/>
                                            <span><b>Address : </b><?= $payout_method['addressLine1']?> <?= $payout_method['city']?> <?= $payout_method['stateProvince']?> <?= $payout_method['country']?> </span><br/>
                                            <span><b>Bank Name : </b><?= $full_bank_response->bankName?> </span><br/>
                                            <span><b>Bank A/c ID : </b><?= $payout_method['bankAccountId']?> </span><br/>
                                            <span><b>Brach ID : </b><?= $payout_method['branchId']?> </span><br/>
                                            <span><b>Bank Account Purpose : </b><?= $payout_method['bankAccountPurpose']?> </span><br/>
                                        <?php endif; ?>
                                     </td>
                                     <?php if($status == 0): ?>
                                    <td>
                                        <div style="display:flex"> 
                                            <?php if($value['status'] == 0){ ?>
                                                <?php if($transferRes && ($transferRes->status == 'IN_PROGRESS' || $transferRes->status == 'SCHEDULED')){ ?> 
                                                    <span class='badge badge-success'>In Progress</span>
                                                <?php } ?>
                                                <?php if($transferRes && $transferRes->status == 'VERIFICATION_REQUIRED'){ ?> 
                                                    <span class='badge badge-warning'>VERIFICATION REQUIRED</span>
                                                <?php } ?> 
                                                <?php if($transferRes && ($transferRes->status == 'CANCELLED'|| $transferRes->status == 'RETURNED'  || $transferRes->status == 'FAILED'  || $transferRes->status == 'EXPIRED')){ ?> 
                                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#editModal<?= $value['id']; ?>">Delete</button>
                                                <?php } ?>    
                                                <?php if(!$transferRes){ ?> 
                                                    <button class="btn btn-success btn-sm" onclick="change_status(<?php echo $value['id']; ?>,1,<?php echo $value['user_id']; ?>,<?php echo $value['amount']; ?>)" id="update<?= $value['id']; ?>">Accept</button> 

                                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#editModal<?= $value['id']; ?>">Reject</button>
                                               
                                                <?php } ?>
                                            <?php } ?>
                                            
                                        </div> 
                                    </td>
                                    <?php endif; ?>
                                </tr>

<div class="modal" id="editModal<?= $value['id']; ?>">                 
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
                
            <!-- Modal Header -->
            <div class="modal-header bg-light p-3">
                <h4 class="modal-title p-0">Reject Reason</h4>
                
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
                  
            <!-- Modal body -->
            <form id="reject_reason" method="post" action="#" onsubmit="return reject_reason(this , <?= $value['id']; ?>)" >
                <div class="modal-body">
                    <div class="col-md-12 py-3">
                        <div>
                            <label>Reason</label>
                            <textarea  class="form-control"   name="reason"  required></textarea>
                             <input type="hidden" class="form-control" value="<?= $value['id']; ?>" name="id">
                             <input type="hidden" class="form-control" value="<?= $value['user_id']; ?>" name="user_id">
                             <input type="hidden" class="form-control" value="<?= $value['amount']; ?>" name="amount">
                            <p id="result1"></p>
                        </div>

                        <div class="mt-3 modal-footer">
                            <button type="submit"  id="update<?= $value['id']; ?>" class="btn btn-success">Update</button>
                        </div>
                          
                    </div>
                </div>
            </form>
                  
        </div>
    </div>
</div>
        
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
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>


// var table = $("#example").DataTable({ order: [[2, "desc"]] });
// $(".btn").click(function() {
//   r2 = $(".r2").find(".order");
//   r3 = $(".r3").find(".order");

//   table.cell(r2).data(parseInt(table.cell(r2).data()) + 1).draw();
//   table.cell(r3).data(parseInt(table.cell(r3).data()) - 1).draw();
// });

function change_status(id,status,user_id,amount)
   {
    if(confirm('Are you sure?'))
    {
    $.ajax({
          type: "POST",
          url: "<?php echo base_url('Admin/AdminWallet/accept_status'); ?>",
          data: {id:id,status:status,user_id:user_id,amount:amount},
          dataType: "json",
          beforeSend:function(){
            $('#update'+id).prop('disabled' , true);
            $('#update'+id).text('Processing..');
        },
          success: function(data){
            if(data.status == 1)  //json status return by controller
            {
                Swal.fire({
               title: "Success", 
               text: data.message, 
               icon: "success"
                }).then(function (result) {
                    location.reload();
                })
            }
            else
            {
                Swal.fire({
               title: "Oops", 
               text: data.message, 
               icon: "error"
                }).then(function (result) {
                    location.reload();
                })
            }
            
              
          },
          
     });
    }

   }

   function reject_reason(el , id) {
    $('.alert-danger').remove();
      $.ajax({
      url: '<?= base_url() ?>/Admin/AdminWallet/reject_reason',
      type: 'POST',
      cache:false,
      contentType: false,
      processData: false,
      data:new FormData($(el)[0]),
      dataType: 'json',
      beforeSend: function() {        
        $('#update'+id).prop('disabled' , true);
        $('#update'+id).text('Processing..');
      },
      success : function(res){
        $('#update'+id).prop('disabled' , false);
        $('#update'+id).text('Update');
        if (res.status == 1) {
            
            window.location.reload();
            
        }
        else
        {
         
          $('#result1').html(res.message);
          for (var err in res.message) {
            
            $("[name='" + err + "']").after("<div  class='label alert-danger'>" + res.message[err] + "</div>");
          }
        }
      }
    });
return false;    
}


</script>