
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
        			    <h4 class="d-flex justify-content-between">Grade List: <button class="btn btn-info" data-toggle="modal" data-target="#myModal" id="add_btns">Add</button></h4>
<div class="modal" id="myModal">                 
    <div class="modal-dialog">
        <div class="modal-content">
      
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Grade</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
        
            <!-- Modal body -->
            <form id="add_grade" method="post" action="#" onsubmit="return add_grade()" >
                <div class="col-md-12 py-3">
                    <div name="message"></div>
                    <div class="my-3">
                        <label>Class Name</label>
                        <input type="text" class="form-control" name="class_name" required>
                    </div>
                    <div class="my-3">
                        <label>Points</label>
                        <input type="number" class="form-control" min="0" name="points" required>
                    </div>
                    <div class="my-3">
                        <label>Background Color</label>
                        <input type="color" name="bg_color" class="form-control" required value="#000000 ">
                    </div>
                    <div class="my-3">
                        <label>Text Color</label>
                        <input type="color" name="text_color" class="form-control" required value="#f7f7f7">
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
                                    <th>Class Name</th>
                                    <th>Points</th>
                                    <th>Background Color</th>
                                    <th>Text Color</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($grade_list)) { 
                                    $i=1; 
                                    foreach ($grade_list as $key => $value) { ?>
                                <tr>
                                    <td><?= $i; ?></td>
                              
                                    <td><?= $value['class_name']; ?></td>
                                    <td><?= $value['points']; ?></td>
                                    <td><?= $value['bg_color']; ?></td>
                                    <td><?= $value['text_color']; ?></td>
                                    <td>
                                        <div style="display:flex"> 
                                            <button class="btn btn-success" data-toggle="modal" data-target="#editModal<?= $value['id']; ?>">Edit</button>
<div class="modal" id="editModal<?= $value['id']; ?>">                 
    <div class="modal-dialog">
        <div class="modal-content">
      
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title p-0">Edit Grade</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
        
            <!-- Modal body -->
            <form id="edit_grade" method="post" action="#" onsubmit="return edit_grade(this , <?= $value['id']; ?>)" >
                <div class="col-md-12 py-3">
                    <div name="message<?= $value['id']; ?>"></div>
                    <div class="my-3">
                        <label>Class Name</label>
                        <input type="text" class="form-control" name="class_name" required value="<?= $value['class_name'];?>">
                        <input type="hidden" name="id" value="<?= $value['id'];?>">
                    </div>
                    <div class="my-3">
                        <label>Points</label>
                        <input type="number" class="form-control" min="0" name="points" required value="<?= $value['points'];?>">
                    </div>
                    <div class="my-3">
                        <label>Background Color</label>
                        <input type="color" name="bg_color" class="form-control" required value="<?= $value['bg_color'];?>">
                    </div>
                    <div class="my-3">
                        <label>Text Color</label>
                        <input type="color" name="text_color" class="form-control" required value="<?= $value['text_color'];?>">
                    </div>
                    <div class="mt-3 text-center">
                        <button type="submit"  id="update<?= $value['id']; ?>" class="btn btn-success">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
                                            <button class="btn btn-danger" id="delete_btns" onclick="delete_grade(<?= $value['id'] ?>)">Delete</button>
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

 function add_grade() {
  $('.alert-danger').remove();
    
      $.ajax({
      url: '<?= base_url() ?>/Admin/Grades/add_grade',
      type: 'POST',
      cache:false,
      contentType: false,
      processData: false,
      data:new FormData($('#add_grade')[0]),
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
function edit_grade(el , id) {
    $('.alert-danger').remove();
      $.ajax({
      url: '<?= base_url() ?>/Admin/Grades/edit_grade',
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

function delete_grade(id) {
        // event.preventDefault();
    if(confirm('Are you sure ?'))
    {
        $.ajax({
      url: '<?= base_url() ?>/Admin/Grades/delete_grade',
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
$(document).on('change', '.grade_from', function(event) {
    event.preventDefault();
   val = $(this).val() 
   $(this).parent('div').siblings('div').find("select").val('');
   $(this).parent('div').siblings('div').find("select option").prop('disabled',false);
   $(this).parent('div').siblings('div').find("select option[value*='"+val+"']").prop('disabled',true);

});
</script>