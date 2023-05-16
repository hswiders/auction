<?php include('include/sellHeader.php') ?>
<div class="pack-body">
	<div class="row">
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
        	<div class="box">
        	<h4 class="d-flex justify-content-between">Add Product:</h4>
          <a href="<?=base_url()?>/sell" class="btn btn-outline btn-lg">Back</a>
           </div>
          		<form id="add_product" method="post"  onsubmit="return add_product()" enctype="multipart/form-data">
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
                    <label>Brand</label>
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
	                    <label>Format</label>
	                    <input type="text" class="form-control" name="format" placeholder="Format">
	                </div>
	                 <div class="pb-2">
	                    <label>RAM</label>
	                    <input type="text" class="form-control" name="ram" placeholder="RAM">
	                </div>
	                

	                <div class="pb-2">
	                    <label>Image</label>
	                    <input type="file" accept="*image" class="form-control" name="images[]" multiple="" placeholder="Image" required>
	                </div><div class="pb-2">
                    <label>Video Type</label>
                    <select class="form-control" name="video_type" class="form-control" id="videotype" required>
                      <option value="0">Select video Type</option>
                       <option value="1">Custom Video</option>
                       <option value="2">YouTube Video</option>
                       <option value="3">Other Source</option>
                    </select>
                </div>
	                <div class="mt-3 pb-2" id="Vproduct_H">
                    <label>Product Video (optional)</label><br>
                    <span>Supported Format : MP4 , MOV, WMV ,AVI ,AVCHD, FLV, F4V, MKV and WEBM</span><br>
                    <span>MAX size : 4 MB</span>

                    <input type="file" class="form-control" name="product_video" id="productv_id"   accept="video/mp4,video/x-m4v,video/*">
                </div>
	                <div id="yout_URL" class="pb-2">
                    <label id="lblChng">YouTube URL</label>
                    <input type="url"  class="form-control" id="youtube_URLid" name="youtube_url" placeholder="YouTube URL">
                </div>
                <!-- <div class="inner-bis pb-2">
                    <label>Game condition</label>
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
<script src="<?= base_url() ?>/assets/js/jquery.min.js"></script>
<script src="<?= base_url() ?>/assets/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>/assets/js/owl.carousel.min.js"></script>
<script src="<?= base_url() ?>/assets/js/select2.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.4/dist/sweetalert2.all.min.js"></script>
<script>
function add_product() {
  $('.alert-danger').remove();
    
      $.ajax({
      url: '<?= base_url() ?>/Product/addproduct',
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
            window.location.href = res.redirect;
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

$(document).ready(function() {
   $("#Vproduct_H").hide();
    $("#yout_URL").hide();
    $("#youtube_URLid").attr("required", false);
     $("#productv_id").attr("required", false);

     
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
     $("#Vproduct_H").hide();
    $("#productv_id").attr("required", false);
    $("#youtube_URLid").attr("placeholder", 'YouTube URL');
    $("#lblChng").text('YouTube URL');
  }else if(videotype == 0){
    $("#yout_URL").hide();
     $("#Vproduct_H").hide();
     $("#youtube_URLid").attr("required", false);
     $("#productv_id").attr("required", false);
  }else if(videotype ==3){
    $("#yout_URL").show();
    $("#youtube_URLid").attr("required", true);
    $("#youtube_URLid").attr("placeholder", 'Other Source');
    $("#lblChng").text('Other Source');
    $("#Vproduct_H").hide();
    $("#productv_id").attr("required", false);
  }
})
  //alert('hello');
   $('.select2').select2();
  $('#category').on('change', function() {
      var category_id = this.value;
      $.ajax({
        url: '<?= base_url() ?>/Sell/getsubcat',
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