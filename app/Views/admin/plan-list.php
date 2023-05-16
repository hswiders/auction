

        
        
<!--**********************************
    Header start
***********************************-->
<?php include ('includes/header.php') ?>
            
<!--**********************************
    Header end ti-comment-alt
***********************************-->
<style type="text/css">
    .discript{width: 250px; white-space: nowrap; overflow: hidden;text-overflow: ellipsis;}
</style>
<!--**********************************
    Sidebar start
***********************************-->
<?php include ('includes/sidebar.php') ?>
    
<!--**********************************
    Sidebar end
***********************************-->

<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="container-fluid">
       
        <div class="row page-titles">
             <?= $this->session->getFlashdata('msg'); ?>   
        </div>
        
        <!-- row -->
        <div class="row">
            
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Membership List</h4>
                        <a href="javascript:void(0);" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#addmembershipModal">Add Membership</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <!-- <th></th> -->
                                        <th>S.N.</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Duration</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if(!empty($plan_list)){
                                        $i = 1;
                                        foreach ($plan_list as $key => $val) { ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><p><?= $val['title'] ?></p></td>
                                                <td><p><?= $val['description'] ?></p></td>
                                                <td><p><?php if(!empty($val["image"])) { ?>
                                                    <img style="height: 100px;width: 100px;" src="<?php echo base_url($val["image"]);?>">
                                                    <?php } ?></p></td>
                                                <td><p><?= $val['duration'] ?></p></td>
                                                <td><p><?= $val['price'] ?></p></td>
                                                
                                               <td>
                                                    <a href="javascript:;" class="btn btn-primary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target="#updatePlanModal<?= $val['id']; ?>"><i class="fas fa-pencil-alt"></i></a>
                                                    <a href="javascript:;" id="delbtn<?= $val['id']; ?>" onclick="deleteRow(<?= $val['id']; ?>)" class="btn btn-danger shadow btn-xs sharp me-1"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>



<div class="modal fade" id="updatePlanModal<?= $val['id']; ?>">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Membership</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="post" onsubmit="return updatPlan(this, event, <?= $val['id']; ?>)" id="updatPlan" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $val['id']; ?>">
                <div class="modal-body">
                    
                         <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label"><strong>Membership Name</strong></label>
                                <input type="text"  name="title" placeholder="Membership Name.." class="form-control" required value="<?= $val['title'] ?>">
                            </div>
                        </div>
                         <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label"><strong>Description</strong></label>
                              <!--   <input type="text"  name="description" placeholder="Description.." class="form-control" required value="<?= $val['description'] ?>"> -->

                              <textarea rows="8" name="description" placeholder="Description.." class="form-control" required><?php echo $val['description'] ?></textarea>
                            </div>
                        </div>
                         <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label"><strong>Membership Image</strong></label>
                               <input type="file"  name="image" placeholder="Membership Image.." accept="image/*" class="form-control">
                               <p>
                               <?php if(!empty($val["image"])) { ?>
                                <img style="height: 100px;width: 100px;" src="<?php echo base_url($val["image"]);?>">
                                <?php } ?></p>
                            </div>
                        </div>
                         <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label"><strong>Duration</strong></label>
                                <select class="form-control" name="duration" required="">
                                  <option value="<?= $val['duration'] ?>"><?= $val['duration'] ?></option>
                                  <option value="30">30 Days</option>
                                  <option value="60">60 Days</option>
                                  <option value="90">90 Days</option>
                                  <option value="120">120 Days</option>
                                  <option value="180">180 Days</option>

                                </select>
                            </div>
                        </div>
                         <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label"><strong>Price</strong></label>
                                <input type="text"  name="price" placeholder="Price" class="form-control" required value="<?= $val['price'] ?>">
                            </div>
                        </div>
                        <button class="btn btn-primary" id="upbtn<?= $val['id']; ?>" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php $i++; }

                                    }

                                    ?>
                                            
                                <tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
                    
        </div>
    </div>
</div>
        <!--**********************************
            Content body end
        ***********************************-->
<div class="modal fade" id="addmembershipModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Membership</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
                <div id="msgdiv"></div>
                <form method="post" onsubmit="return addplan(event)" id="addplan" enctype="multipart/form-data">
                    <div class="modal-body">
                    
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label"><strong>Membership Name</strong></label>
                                <input type="text"  name="title" placeholder="Membership Name.." class="form-control" required>
                            </div>
                        </div>
                         <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label"><strong>Description</strong></label>
                                <!-- <input type="text"  name="description" placeholder="Description.." class="form-control" required> -->
                                <textarea rows="8" name="description" placeholder="Description.." class="form-control" required></textarea>
                            </div>
                        </div>
                         <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label"><strong>Membership Image</strong></label>
                               <input type="file"  name="image" placeholder="Membership Image.." accept="image/*" class="form-control" required>
                            </div>
                        </div>
                         <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label"><strong>Duration</strong></label>
                                <select class="form-control" name="duration" required="">
                                  <option value="">----Select------</option>
                                  <option value="30">30 Days</option>
                                  <option value="60">60 Days</option>
                                  <option value="90">90 Days</option>
                                  <option value="120">120 Days</option>
                                  <option value="180">180 Days</option>

                                </select>
                            </div>
                        </div>
                         <div class="row">
                            <div class="mb-3 col-md-12">
                                <label class="form-label"><strong>Price</strong></label>
                                <input type="text"  name="price" placeholder="Price" class="form-control" required>
                            </div>
                        </div>
                    <button class="btn btn-primary" id="addbtn" type="submit">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>





        <!--**********************************
            Footer start
        ***********************************-->
        <?php include ('includes/footer.php') ?> 
        <!--**********************************
            Footer end
        ***********************************-->
<script type="text/javascript">
    function addplan(event) {
        event.preventDefault();
    $('.alert-danger').remove();
        var data = new FormData($('#addplan')[0]);

        $.ajax({
              url: '<?= base_url()?>/Admin/Plan_Management/add_plan',
              data: data,
              processData: false,
              contentType: false,
              type: 'POST',
        dataType:'json',
        beforeSend: function() {        
            $('#addbtn').prop('disabled' , true);
            $('#addbtn').text('Processing..');
          },
              success: function(result){
            $('#addbtn').prop('disabled' , false);
            $('#addbtn').text('Add');
            if(result.status == 1)
            {
              window.location.reload();
            }
            else
            {
              alert('failed');
              /*console.log(result.message);
              for (var err in result.message) {
            
              $("[name='" + err + "']").after("<div  class='label alert-danger'>" + result.message[err] + "</div>");
              }*/
            }
        }
        });
    return false;
  } 

  function updatPlan(el, event, id) {
    event.preventDefault();
    $('.alert-danger').remove();
    var data = new FormData($(el)[0]);

    $.ajax({
        url: '<?= base_url()?>/Admin/Plan_Management/update_plan',
        data: data,
        processData: false,
        contentType: false,
        type: 'POST',
        dataType:'json',
        beforeSend: function() {        
            $('#upbtn'+id).prop('disabled' , true);
            $('#upbtn'+id).text('Processing..');
          },
        success: function(result){
            $('#upbtn'+id).prop('disabled' , false);
            $('#upbtn'+id).text('Add');
            if(result.status == 1)
            {
              window.location.reload();
            }
            else
            {
              console.log(result.message);
              for (var err in result.message) {
            
              $("[name='" + err + "']").after("<div  class='label alert-danger'>" + result.message[err] + "</div>");
              }
            }
        }
    });
    return false;
  }



    function deleteRow(id) {
    if(confirm('Are you sure ?')){
      $.ajax ({
          url: '<?= base_url()?>/Admin/Plan_Management/delete_plan',
          data: {id:id},
          type: 'POST',
          dataType:'json',
          beforeSend: function() {        
              $('#delbtn'+id).prop('disabled' , true);
              $('#delbtn'+id).text('Processing..');
            },
          success: function(result){
              $('#delbtn'+id).prop('disabled' , false);
              $('#delbtn'+id).text('Add');
              if(result.status == 1)
              {
                window.location.reload();
              }
          }
          });
    }
}

</script>