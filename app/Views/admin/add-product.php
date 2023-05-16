
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
        			<h4 class="d-flex justify-content-between">Add Product: 
                    
                      <!-- <a href="<?php echo base_url('Admin/product/productform'); ?>" class="btn btn-info" id="add_btns">Add</a> --></h4>

          <form id="add_product" method="post"  onsubmit="return add_product()" enctype="multipart/form-data">
            <div class="col-md-12 py-3">
              <div class="pb-2">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Title">
                </div>
                <div class="pb-2">
                    <label>Description</label>
                   <!--  <input type="text" class="form-control" name="title" placeholder="Title"> -->
                   <textarea class="form-control textarea" name="description" placeholder="Description"></textarea>
                </div>
                <div class="pb-2">
                    <label>Product Group</label>
                    <?php
                    $product_group = $this->common_model->GetAllData('product_group','','id','desc');
                    
                    
                    foreach ($product_group as $key => $cval) { ?>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="<?php echo $cval['id']; ?>" name="product_group[]" id="flexCheckDefault<?php echo $cval['id']; ?>">
                      <label class="form-check-label" for="flexCheckDefault<?php echo $cval['id']; ?>">
                        <?php echo $cval['title']; ?>
                      </label>
                    </div>
                     <?php
                      }
                      ?>
                   
                    
                </div>
                <div class="pb-2">
                    <label>Category</label>
                    <select class="form-control" name="category" required id="category">
                      <option value="">Select</option>
                    <?php
                      foreach ($categories as $key => $cval) {
                       ?>
                        <option value="<?php echo $cval['id']; ?>"><?php echo $cval['title']; ?></option>
                       <?php
                      }
                    ?>

                    </select>
                </div>
                <div class="pb-2">
                    <label>SubCategory</label>
                    <select class="form-control" name="subcategory" required  id="sub_category">
                     
                   </select>
                </div>
                <div class="pb-2">
                    <label>Publisher</label>
                    <select class="form-control" name="brand" required id="category">
                      <option value="">Select</option>
                    <?php $brand = $this->common_model->GetAllData('brands','','id','desc');
                      foreach ($brand as $key => $cval) {
                       ?>
                        <option value="<?php echo $cval['id']; ?>"><?php echo $cval['title']; ?></option>
                       <?php
                      }
                    ?>

                    </select>
                </div>
                <div class="pb-2">
                    <label>Game Class</label>
                    <select class="form-control" name="class_type" required id="class_type">
                      <option value="">Select</option>
                    <?php $class_type = $this->common_model->GetAllData('class_type','','class_name','asc');
                        $selected = '';
                      foreach ($class_type as $key => $cval) {
                    ?>
                        <option  value="<?php echo $cval['id']; ?>"><?php echo $cval['class_name']; ?></option>
                       <?php
                      }
                    ?>

                    </select>
                </div>
                <div class="pb-2">
                    <label>Available Stock</label>
                    <input type="number" min="0" class="form-control" name="stock" placeholder="Available Stock">
                </div>
                <div class="pb-2">
                    <label>Format</label>
                    <input type="text" class="form-control" name="format" placeholder="Format">
                </div>
                 <div class="pb-2">
                <label>Realease Date</label>
                <input type="date" class="form-control" name="release_date" placeholder="Realease Date"  >
                <input type="hidden" name="ram" placeholder="RAM" value="0">
              </div>
                 <div class="pb-2">
                    <label>Price (HKD)</label>
                    <input type="number" step="0.1" class="form-control" name="price" placeholder="Price">
                </div>
                 <div class="pb-2">
                    <label>Market Price (HKD)</label>
                    <input type="number" step="0.1" class="form-control" name="mkt_price" placeholder="Mkt Price">
                </div>
                 <div class="pb-2">
                    <label>Meta Score</label>
                    <input type="number" step="0.1" class="form-control" name="meta_score" placeholder="Meta Score">
                </div>
                 <div class="pb-2">
                    <label>Game Score</label>
                    <input type="number" step="0.1" class="form-control" name="game_score" placeholder="Game Score">
                </div>
                 <div class="pb-2">
                    <label>Factor X</label>
                    <input type="number" step="0.1" class="form-control" name="factor_x" placeholder="Factor X">
                </div>
                 <div class="pb-2">
                    <label>Factor Y</label>
                    <input type="number" step="0.1" class="form-control" name="factor_y" placeholder="Factor Y">
                </div>
                 <div class="pb-2">
                    <label>Factor Z</label>
                    <input type="number" step="0.1" class="form-control" name="factor_z" placeholder="Factor Z">
                </div>
                <div class="pb-2">
                    <label>Video Type</label>
                    <select class="form-control" name="video_type" class="form-control" id="videotype" required>
                      <option value="0">Select video Type</option>
                       <option value="1">Upload Video</option>
                       <option value="2">YouTube Video</option>
                       <option value="3">Other Source</option>
                    </select>
                </div>
               
                <div class="pb-2">
                    <label>Image</label>
                    <input type="file" class="form-control" name="images[]" multiple="" placeholder="Image" required>
                </div>
                 
                <div class="mt-3 pb-2" id="Vproduct_H">
                    <label>Product Video (optional)</label><br>
                    <span>Supported Format : MP4 , MOV, WMV ,AVI ,AVCHD, FLV, F4V, MKV and WEBM</span><br>
                    <span>MAX size : 4 MB</span>
                    <input type="file" class="form-control" name="product_video" id="productv_id"  accept="video/mp4,video/x-m4v,video/*">
                </div>
                 <div id="yout_URL" class="pb-2">
                    <label id="lblChng">YouTube URL</label>
                    <input type="url"  class="form-control" id="youtube_URLid" name="youtube_url" placeholder="YouTube URL">
                </div>
                <!-- <div class="inner-bis pb-2">
                    <p>Game condition</p>
                      <div class="ml-auto">
                       <input type="range" onchange="initrangeslider()" min="1" max="100" value="50" class="slider" name="conditions" id="myRange">
                       <div class="badge badge-danger"><span id="slide_output">50</span><span>% New</span></div>
                     </div>
                </div> -->
               
                <div class="mt-3 text-center">
                    <button type="submit" id="add_btn"  class="btn btn-success">Add</button>
                </div>
                
            </div>
        </form>
    
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
    $("#Vproduct_H").hide();
    $("#yout_URL").hide();
    $("#youtube_URLid").attr("required", false);
     $("#productv_id").attr("required", false);
} );

$("#videotype").on('change',function(){

  var videotype = $("#videotype").val();
  if(videotype == 1){
    $("#Vproduct_H").show();
   $("#productv_id").attr("required", true);
    $("#yout_URL").hide();
     $("#youtube_URLid").attr("required", false);
  }else if(videotype ==2){
    $("#yout_URL").show();
    $("#youtube_URLid").attr("required", true);
    $("#youtube_URLid").attr("placeholder", 'YouTube URL');
    $("#lblChng").text('YouTube URL');
    $("#Vproduct_H").hide();
    $("#productv_id").attr("required", false);
  }else if(videotype ==3){
    $("#yout_URL").show();
    $("#youtube_URLid").attr("required", true);
    $("#youtube_URLid").attr("placeholder", 'Other Source');
    $("#lblChng").text('Other Source');
    $("#Vproduct_H").hide();
    $("#productv_id").attr("required", false);
  }else if(videotype == 0){
    $("#yout_URL").hide();
     $("#Vproduct_H").hide();
     $("#youtube_URLid").attr("required", false);
     $("#productv_id").attr("required", false);
  }
})
function add_product() {
  $('.alert-danger').remove();
    
      $.ajax({
      url: '<?= base_url() ?>/Admin/Product/addproduct',
      type: 'POST',
      cache:false,
      contentType: false,
      processData: false,
      data:new FormData($('#add_product')[0]),
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
function edit_product(el , id) {
    $('.alert-danger').remove();
      $.ajax({
      url: '<?= base_url() ?>/Admin/Product/updateproduct',
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

function delete_product(id) {
        // event.preventDefault();
    if(confirm('Are you sure ?'))
    {
        $.ajax({
      url: '<?= base_url() ?>/Admin/Product/deleteproduct',
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

function delete_product_image(id) {
        // event.preventDefault();
    if(confirm('Are you sure ?'))
    {
     $.ajax({
      url: '<?= base_url() ?>/Admin/Product/remove_pimage',
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
         
         //location.reload();

        }
        
      }
    });
    }
    
}

function initrangeslider() 
  {
    var slider = document.getElementById("myRange");
            var output = document.getElementById("slide_output");
            output.innerHTML = slider.value; // Display the default slider value

            // Update the current slider value (each time you drag the slider handle)
            slider.oninput = function() {
              output.innerHTML = this.value;
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
        success: function(dataResult){
          $("#sub_category").html(dataResult);
        }
      });
    
    
  });
});
</script>

<script>
function fetchsubcat(id)
{
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
        success: function(dataResult){
          $("#editsub_category").html(dataResult);
        }
      });
    
}
  
</script>
