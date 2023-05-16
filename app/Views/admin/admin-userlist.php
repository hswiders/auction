
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
        			<h4>User management:</h4> 
                    <?= $this->session->getFlashdata('msg'); ?>
                    <div id="result"></div>
        		
        		    <?php
              $export = true;
            ?>
                    <div class="table-responsive">      
                        <!-- <table id="example3" class="display dataTable dataTables_wrapper" style="width:100%"> -->
    <table  id="myTable" class="display dataTable dataTables_wrapper" style="width:100%">
                            <thead>     

                                <tr>
                                    <th>S. No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Email Verification</th>
                                    <th>Currency</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($data)) { 
                                    $i=1; 
                                    foreach ($data as $key => $value) { ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $value['first_name'].' '.$value['last_name'] ?></td>
                                    <td><?= $value['email'] ?></td>
                                    
                                    <td>
                                        <?php if($value['email_verified'] == 0) { ?>
                                        <div class="alert alert-info">Not Verified</div>
                                    <?php } elseif($value['email_verified'] == 1) { ?>
                                        <div class="alert alert-success">Verified</div>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        
                                        <?= $value['currency'] ?>
                                    </td>
                                    <td>
                                        <?php if($value['status'] == 1) { ?>
                                        <div class="alert alert-success">Enabled</div>
                                    <?php } else { ?>
                                        <div class="alert alert-danger">Disabled</div>
                                        <?php } ?>
                                    </td>
                                    <td>

                                        <div style="display:flex">
                                            <?php if($value['status'] == 1) { ?>
                                            <button class="btn btn-danger" onclick="enable_user(<?= $value['id'] ?>)">Disable</button>
                                        <?php } else { ?>
                                            <button class="btn btn-success" onclick="enable_user(<?= $value['id'] ?>)">Enable</button>
                                        <?php } ?>
                                            <a href="<?= site_url('admin/user-view/'.$value["id"]); ?>"  ><button class="btn btn-info">View</button></a>
                                            <a href="<?= site_url('admin/user-edit/'.$value["id"]); ?>"  ><button class="btn btn-success">Edit</button></a>
                                            <button class="btn btn-danger" id="delete_btns" onclick="delete_user(<?= $value['id'] ?>)">Delete</button>
                                             <a class="btn btn-primary"  href="<?= site_url('admin/account-settings/'.$value["id"]); ?>">Account Setting</a>
                                        </div>
                                    </td>
                                </tr>
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


<script>

// var table = $("#example").DataTable({ order: [[2, "desc"]] });
// $(".btn").click(function() {
//   r2 = $(".r2").find(".order");
//   r3 = $(".r3").find(".order");

//   table.cell(r2).data(parseInt(table.cell(r2).data()) + 1).draw();
//   table.cell(r3).data(parseInt(table.cell(r3).data()) - 1).draw();
// });


function enable_user(id) {
        // event.preventDefault();
    if(confirm('Are you sure ?'))
    {
        $.ajax({
          url: '<?= base_url() ?>/Admin/Users/enableUser',
          type: 'POST',
          cache:false,
          data:{'id':id},
          dataType: 'json',
          beforeSend: function() {
            $('#del_btn').prop('disabled' , true);
            // $('#del_btn').text('Processing..');
          },
          success : function(res){
            if (res.status == 1) {
              window.location.reload();
            }
            else
            {
              $('#result').html(res.msgs)
            }
          }
        });
    }
}

function delete_user(id) {
        // event.preventDefault();
    if(confirm('Are you sure ?'))
    {
        $.ajax({
      url: '<?= base_url() ?>/Admin/Users/deleteUser',
      type: 'POST',
      cache:false,
      data:{'id':id},
      dataType: 'json',
      beforeSend: function() {
        $('#delete_btns'+id).prop('disabled' , true);
        $('#delete_btns'+id).text('Processing..');
      },
      success : function(res){
        console.log(res);
        $('#delete_btns'+id).prop('disabled' , false);
        if (res.status == 1) {
            alert(res.message)
          window.location.reload();
        }
        else
        {
          $('#result').html(res.msgs)
        }
      }
    });
    }
    
}

</script>