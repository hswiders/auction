
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
                        <h4 class="d-flex justify-content-between">SocialLinks management: </h4>
                        <?= $this->session->getFlashdata('msg'); ?>
                        <div style="float:right;margin-bottom:10px;margin-right:10px;">
                          <button class="btn btn-info" data-toggle="modal" data-target="#myModal" id="add_btns">Add Social</button>&emsp;<button class="btn btn-warning" data-toggle="modal" data-target="#myModal2" id="add_btns"> Update Footer about</button><br>
                        </div>
    <div class="modal" id="myModal">                 
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add SocialLinks</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <form id="add_social_links" method="post" action="#" onsubmit="return add_social_links()" >
            <div class="col-md-12 py-3">
                <div>
                    <label>Title</label>
                    <input type="text" class="form-control" id="reason" name="title" required>
                </div>
               <div>
                    <label>Link</label>
                    <input type="url" class="form-control" id="link" name="link" required>
                </div>
                 <div>
                    <label>Icon</label>
                    <input type="file" class="form-control" id="link" name="image" required>
                </div>
               
                <div class="mt-3 text-center">
                    <button type="submit" id="add_btn"  class="btn btn-success">Add</button>
                </div>
                
            </div>
        </form>
        </div>
        <!-- Modal body -->
        
        
        
      </div>
    </div>
  </div> 
  <div class="modal" id="myModal2">                 
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Update Footer About</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
              <div class="modal-body">
                  <form id="social_update" action="#", method="post", onsubmit="return social_update()">
                                <input class="form-control" type="hidden" name="id" value="<?= $social['id'] ?>">
                                
                                   
                                <div class="row forms">
                                    <div class="col-md-12">
                                        <label>Footer About</label> 
                                        <div><textarea class="form-control" name="footer_about" placeholder="Footer About" required=""><?= $social['footer_about'] ?></textarea></div>
                                    </div>
                                </div>
                                
                                <div class="form-group mb-4"> 
                              <div class="col-md-12 text-center">
                                <button type="submit" id="sub_btn" class="btn btn-primary btn-lg w-100">Update Footer </button>
                              </div>
                            </div>

                            </form>  
              </div>
        
      </div>
    </div>
  </div>
</div>
                   
                    <div id="result"></div>
                
                    <div class="table-responsive">      
                        <table id="example3" class="display dataTable dataTables_wrapper" style="width:100%">
                            <thead>     

                                <tr>
                                    <th>S. No.</th>
                                    <th>Title</th>
                                    <th>Link</th>
                                    <th>Icon</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($social_links)) { 
                                    $i=1; 
                                    foreach ($social_links as $key => $value) { ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $value['title']?></td>
                                    <td><?= $value['link']?></td>
                                    <td><?php if(!empty($value["image"])) { ?>
                                 <img style="height: 100px;width: 100px;" src="<?php echo base_url($value["image"]);?>">&emsp;
                                  <?php } ?>
                                  </td>
                                    <td>
                                        <div style="display:flex"> 
                                            <button class="btn btn-success" data-toggle="modal" data-target="#editModal<?= $value['id']; ?>">Edit</button>
    <div class="modal" id="editModal<?= $value['id']; ?>">                 
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title p-0">Edit SocialLinks</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form id="edit_social_links" method="post" action="#" onsubmit="return edit_social_links(this , <?= $value['id']; ?>)" >
            <div class="col-md-12 py-3">
              <div>
                <label>Title</label>
                <input type="text" class="form-control" value="<?= $value['title']; ?>"  name="title"  >
                <input type="hidden" class="form-control" value="<?= $value['id']; ?>" name="id"  >
              </div>
               <div>
                    <label>Link</label>
                    <input type="url" class="form-control" id="link" name="link" value="<?= $value['link']; ?>" >
                </div>
                <div>
                    <label>Icon</label>
                    <input type="file" class="form-control" id="link" name="image" value="<?= $value['image']; ?>" >
                </div>
                 <?php if(!empty($value["image"])) { ?>
                   <img style="height: 100px;width: 100px;" src="<?php echo base_url($value["image"]);?>">&emsp;
                  <?php } ?>

              <div class="mt-3 text-center">
                  <button type="submit"  id="update<?= $value['id']; ?>" class="btn btn-success">Update</button>
              </div>
                
                  
                </div>
           
        </form>
        
      </div>
    </div>
  </div>
                                            <button class="btn btn-danger" id="delete_btns" onclick="delete_social_links(<?= $value['id'] ?>)">Delete</button>
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
</div>
<?php include ('include/footer.php') ?> 
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


function add_social_links() {
  $('.alert-danger').remove();
    
      $.ajax({
      url: '<?= base_url() ?>/Admin/SocialLinks/addSocialLinks',
      type: 'POST',
      cache:false,
      contentType: false,
      processData: false,
      data:new FormData($('#add_social_links')[0]),
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
function edit_social_links(el , id) {
    $('.alert-danger').remove();
      $.ajax({
      url: '<?= base_url() ?>/Admin/SocialLinks/editSocialLinks',
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

function delete_social_links(id) {
        // event.preventDefault();
    if(confirm('Are you sure ?'))
    {
        $.ajax({
      url: '<?= base_url() ?>/Admin/SocialLinks/deleteSocialLinks',
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
<script>
    

    function social_update() {
      $('.alert-danger').remove();
      $.ajax({
      url: '<?= base_url() ?>/Admin/Categories/update_social',
      type: 'POST',
      cache:false,
      contentType: false,
      processData: false,
      data:new FormData($('#social_update')[0]),
      dataType: 'json',
      beforeSend: function() {        
        $('#sub_btn').prop('disabled' , true);
        $('#sub_btn').text('Processing..');
      },
      success : function(res){
        $('#sub_btn').prop('disabled' , false);
        $('#sub_btn').text('Update');
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

</script>