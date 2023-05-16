
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
        			    <h4 class="d-flex justify-content-between">FAQ management: <button class="btn btn-info" data-toggle="modal" data-target="#myModal" id="add_btns">Add</button></h4>
<div class="modal" id="myModal">                 
    <div class="modal-dialog">
        <div class="modal-content">
      
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add FAQ</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
        
            <!-- Modal body -->
            <form id="addFaq" method="post" action="#" onsubmit="return addFaq()" enctype="multipart/form-data">
                <div class="col-md-12 py-3">
                    <div>
                        <label>Question</label>
                        <input type="text" class="form-control" name="ques" placeholder="Question" required>
                    </div>
                    <div>
                        <label>Answer</label>
                        <textarea name="ans" class="form-control textarea" placeholder="Answer"></textarea>
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
                                    <th>Question</th>
                                    <th>Answer</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($faq_list)) { 
                                    $i=1; 
                                    foreach ($faq_list as $key => $value) { ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $value['ques']?></td>
                                    <td><?= $value['ans']?></td>
                                   
                                    <td>
                                        <div style="display:flex"> 
                                            <button class="btn btn-success" data-toggle="modal" data-target="#editModal<?= $value['id']; ?>">Edit</button>
<div class="modal" id="editModal<?= $value['id']; ?>">                 
    <div class="modal-dialog">
        <div class="modal-content">
      
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title p-0">Edit FAQS</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
        
            <!-- Modal body -->
            <form id="editFaq" method="post" action="#" onsubmit="return editFaq(this , <?= $value['id']; ?>)" >
                <div class="col-md-12 py-3">
                    <div>
                        <label>Question</label>
                        <input type="text" class="form-control" value="<?= $value['ques']; ?>"  name="ques" placeholder="Question" required>
                        <input type="hidden" class="form-control" value="<?= $value['id']; ?>" name="id">
                    </div>
                    <div>
                        <label>Answer</label>
                        <textarea name="ans" class="form-control textarea" placeholder="Answer"><?php echo $value['ans']; ?></textarea>
                    </div>
                    
               
                    <div class="mt-3 text-center">
                        <button type="submit"  id="update<?= $value['id']; ?>" class="btn btn-success">Update</button>
                    </div>
                
                  
                </div>
           
            </form>
        
        </div>
    </div>
</div>
                                            <button class="btn btn-danger" id="delete_btns" onclick="deleteFaq(<?= $value['id'] ?>)">Delete</button>
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


function addFaq() {
    $('.alert-danger').remove();
    
    $.ajax({
        url: '<?= base_url() ?>/Admin/Faq_Management/addFaq',
        type: 'POST',
        cache:false,
        contentType: false,
        processData: false,
        data:new FormData($('#addFaq')[0]),
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
                for (var err in res.message) {            
                    $("[name='" + err + "']").after("<div  class='label alert-danger'>" + res.message[err] + "</div>");
                }
            }
        }
    });
    return false;    
}
function editFaq(el , id) {
    $('.alert-danger').remove();
    $.ajax({
        url: '<?= base_url() ?>/Admin/Faq_Management/editFaq',
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
                for (var err in res.message) {
            
                    $("[name='" + err + "']").after("<div  class='label alert-danger'>" + res.message[err] + "</div>");
                }
            }
        }
    });
    return false;    
}

function deleteFaq(id) {
        // event.preventDefault();
    if(confirm('Are you sure?'))
    {
        $.ajax({
            url: '<?= base_url() ?>/Admin/Faq_Management/deleteFaq',
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