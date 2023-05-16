
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
        			    <h4 class="d-flex justify-content-between">Categories management: <button class="btn btn-info" data-toggle="modal" data-target="#myModal" id="add_btns">Add</button></h4>
    <div class="modal" id="myModal">                 
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Categories</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form id="add_categories" method="post" action="#" onsubmit="return add_categories()" >
            <div class="col-md-12 py-3">
                <div>
                    <label>Title</label>
                    <input type="text" class="form-control" id="reason" name="title"  >
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
                                    <th>Title</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="row-position" id="sortable">
                                <?php if(!empty($categories)) { 
                                    $i=1; 
                                    foreach ($categories as $key => $value) { ?>
                                <tr id="<?= $value['id'] ?>">
                                    <td class="cs_<?= $value['id'] ?>"><?= $i; ?></td>
                              
                                    <td><a href="<?= base_url('admin/admin_product') ?>?category=<?= $value['id']; ?>"><?= $value['title']?></a></td>
                                    <td>
                                        <div style="display:flex"> 
                                            <button class="btn btn-success" data-toggle="modal" data-target="#editModal<?= $value['id']; ?>">Edit</button>
    <div class="modal" id="editModal<?= $value['id']; ?>">                 
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title p-0">Edit Categories</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form id="edit_categories" method="post" action="#" onsubmit="return edit_categories(this , <?= $value['id']; ?>)" >
            <div class="col-md-12 py-3">
              <div>
                <label>Title</label>
                <input type="text" class="form-control" value="<?= $value['title']; ?>"  name="title"  >
                <input type="hidden" class="form-control" value="<?= $value['id']; ?>" name="id"  >
              </div>
               
              <div class="mt-3 text-center">
                  <button type="submit"  id="update<?= $value['id']; ?>" class="btn btn-success">Update</button>
              </div>
                
                  
                </div>
           
        </form>
        
      </div>
    </div>
  </div>
                                            <button class="btn btn-danger" id="delete_btns" onclick="delete_categories(<?= $value['id'] ?>)">Delete</button>
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
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );

// var table = $("#example").DataTable({ order: [[2, "desc"]] });
// $(".btn").click(function() {
//   r2 = $(".r2").find(".order");
//   r3 = $(".r3").find(".order");

//   table.cell(r2).data(parseInt(table.cell(r2).data()) + 1).draw();
//   table.cell(r3).data(parseInt(table.cell(r3).data()) - 1).draw();
// });


function add_categories() {
  $('.alert-danger').remove();
    
      $.ajax({
      url: '<?= base_url() ?>/Admin/Categories/addCategories',
      type: 'POST',
      cache:false,
      contentType: false,
      processData: false,
      data:new FormData($('#add_categories')[0]),
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
function edit_categories(el , id) {
    $('.alert-danger').remove();
      $.ajax({
      url: '<?= base_url() ?>/Admin/Categories/editCategories',
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

function delete_categories(id) {
        // event.preventDefault();
    if(confirm('Are you sure ?'))
    {
        $.ajax({
      url: '<?= base_url() ?>/Admin/Categories/deleteCategories',
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
$( "#sortable" ).sortable({
    
      axis: 'y',
    update: function (event, ui) {
        var data = $("#sortable").sortable("toArray");
        $.each(data, function(index, val) {
             index = index +1;
             $('.cs_'+val).text(index);
        });
        
        form_data = new FormData();
        form_data.append('data' , data)
        // POST to server using $.post or $.ajax
        $.ajax({
            url: '<?php echo base_url(); ?>/Admin/Categories/Sorting',
            cache:false,
          contentType: false,
          processData: false,
            data: form_data,
            type: 'POST',
        
        });
      
    
    }
});
</script>