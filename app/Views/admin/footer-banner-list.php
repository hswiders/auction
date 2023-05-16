
<?php include ('include/header.php') ?>

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
        			    <h4 class="d-flex justify-content-between">Footer Banner management: <!-- <button class="btn btn-info" data-toggle="modal" data-target="#myModal" id="add_btns">Add</button> --></h4>
<div class="modal" id="myModal">                 
    <div class="modal-dialog">
        <div class="modal-content">
      
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Banner</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
        
            <!-- Modal body -->
            <form id="addBanner" method="post" action="#" onsubmit="return addBanner()" enctype="multipart/form-data">
                <div class="col-md-12 py-3">
                    <div>
                        <label>Link</label>
                        <input type="url" class="form-control" id="reason" name="link"  >
                    </div>
                    <div>
                        <label>Image</label>
                        <input type="file" class="form-control" name="images"  >
                    </div>
               
                    <div class="mt-3 text-center">
                        <button type="submit" id="add_btn"  class="btn btn-success">Add</button>
                    </div>
                
                </div>
            </form>
        
        
        </div>
    </div>
</div>
                    </div>
                    <?= $this->session->getFlashdata('msg'); ?>
                    <div id="result"></div>
        		
        		    <div class="table-responsive">		
        		        <table id="example3" class="display dataTable dataTables_wrapper" style="width:100%">
                            <thead>     

                                <tr>
                                    <th>S. No.</th>
                                    <th>Banner Type</th>
                                    <th>Link</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($banner)) { 
                                    $i=1; 
                                    foreach ($banner as $key => $value) { ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?php  //$value['banner_type']
                                        if($value['banner_type'] == 1){
                                            echo "Large";
                                        }else
                                        {
                                            echo "Small";
                                        }

                                    ?></td>
                                    <td><?= $value['link']?></td>
                                    <td><img width="150px" src="<?=base_url().'/'.$value['image']?>"></td>
                                    <td>
                                        <div style="display:flex"> 
                                            <button class="btn btn-success" data-toggle="modal" data-target="#editModal<?= $value['id']; ?>">Edit</button>
<div class="modal" id="editModal<?= $value['id']; ?>">                 
    <div class="modal-dialog">
        <div class="modal-content">
      
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title p-0">Edit Banner</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
        
            <!-- Modal body -->
            <form id="editBanner" method="post" action="#" onsubmit="return editBanner(this , <?= $value['id']; ?>)" >
                <div class="col-md-12 py-3">
                    <div>
                        <label>Link</label>
                        <input type="url" class="form-control" value="<?= $value['link']; ?>"  name="link"  >
                        <input type="hidden" class="form-control" value="<?= $value['id']; ?>" name="id"  >
                    </div>
                    <div>
                        <label>Image</label>
                     
                        <input type="file" class="form-control" name="images"  >
                       <?php if($value['banner_type'] == 1){?>
                        <p style="color:red;">Recommended Size: (833 x 438)</p>
                        <?php
                        }else{
                         ?>
                          <p style="color:red;">Recommended Size: (402 x 435)</p>
                        <?php
                         }
                        ?>
                        <img width="150px" src="<?=base_url().'/'.$value['image']?>">
                    </div>
               
                    <div class="mt-3 text-center">
                        <button type="submit"  id="update<?= $value['id']; ?>" class="btn btn-success">Update</button>
                    </div>
                
                  
                </div>
           
            </form>
        
        </div>
    </div>
</div>
                                            <!-- <button class="btn btn-danger" id="delete_btns" onclick="deleteBanner(<?= $value['id'] ?>)">Delete</button> -->
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
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );


function addBanner() {
    $('.alert-danger').remove();
    
    $.ajax({
        url: '<?= base_url() ?>/Admin/Banner/addBanner',
        type: 'POST',
        cache:false,
        contentType: false,
        processData: false,
        data:new FormData($('#addBanner')[0]),
        dataType: 'json',
        beforeSend: function() {        
            $('#add_btn').prop('disabled' , true);
            $('#add_btn').text('Processing..');
        },
        success : function(res){
            $('#add_btn').prop('disabled' , false);
            $('#add_btn').text('Add');
            if (res.status == 1) {
                Swal.fire({
                title: "Success", 
                text: res.message, 
                icon: "success"
                }).then(function (result) {
                    location.reload();
                })         
            }
            else
            {
     
                $('#result').html(res.message);
                for (var err in res.validation) {            
                    $("[name='" + err + "']").after("<div  class='label alert-danger'>" + res.validation[err] + "</div>");
                }
            }
        }
    });
    return false;    
}
function editBanner(el , id) {
    $('.alert-danger').remove();
    $.ajax({
        url: '<?= base_url() ?>/Admin/Banner/editfooterBanner',
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
                Swal.fire({
                    title: "Success", 
                    text: res.message, 
                    icon: "success"
                }).then(function (result) {
                    window.location.reload();
                })         
            }
            else
            {
         
                $('#result').html(res.message);
                for (var err in res.validation) {
            
                    $("[name='" + err + "']").after("<div  class='label alert-danger'>" + res.validation[err] + "</div>");
                }
            }
        }
    });
    return false;    
}

function deleteBanner(id) {
        // event.preventDefault();
    if(confirm('Are you sure ?'))
    {
        $.ajax({
            url: '<?= base_url() ?>/Admin/Banner/deleteBanner',
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
                    Swal.fire({
                        title: "Success", 
                        text: res.message, 
                        icon: "success"
                    }).then(function (result) {
                        location.reload();
                    })
                }
        
            }
        });
    }
    
}

</script>