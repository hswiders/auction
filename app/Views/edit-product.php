<?php include('include/sellHeader.php') ?>
<div class="pack-body">
	<div class="row">
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
        	<h4 class="d-flex justify-content-between">Edit Product:</h4>

          		<form id="editProduct" method="post"  onsubmit="return editProduct()" enctype="multipart/form-data">
	      			<div class="pb-2">
	                    <label>Title</label>
	                    <input type="text" class="form-control" name="title" placeholder="Title" required value="<?= $product["title"]; ?>">
	                    <input type="hidden" name="product_id" value="<?= $product["id"]; ?>">
	                </div>
	                <div class="pb-2">
	                    <label>Description</label>
	                   <!--  <input type="text" class="form-control" name="title" placeholder="Title"> -->
	                   <textarea class="form-control textarea" name="description" placeholder="Description"><?= $product["description"]; ?></textarea>
	                </div>
	                
	                <div class="pb-2">
	                    <label>Category</label>
	                    <select class="form-control" name="category" required id="category">
	                      <option value="">Select</option>
	                    <?php
	                      foreach ($categories as $key => $cval) {
	                       ?>
	                        <option value="<?php echo $cval['id']; ?>" <?= ($product["category"] == $cval['id']) ? "selected":""; ?> ><?php echo $cval['title']; ?></option>
	                       <?php
	                      }
	                    ?>

	                    </select>
	                </div>
	                <div class="pb-2">
	                    <label>SubCategory</label>
	                    <select class="form-control" name="subcategory" required  id="sub_category">
	                     <?php
	                     $subCategory = $this->common_model->GetAllData('categories',array('parent'=>$product["category"]),'id','desc');
	                     if ($subCategory) {
	                     	foreach ($subCategory as $key => $value) {
	                     		 ?>
	                     		 	<option value="<?= $value["id"]; ?>" <?= ($product["subcategory"] == $value['id']) ? "selected":""; ?> ><?= $value["title"]; ?></option>
	                     		 <?php
	                     	}
	                     }
	                     ?>
	                   </select>
	                </div>
	                <div class="pb-2">
                    <label>Brand</label>
                    <select class="form-control" name="brand" required id="category">
                      <option value="">Select</option>
                    <?php $brand = $this->common_model->GetAllData('brands','','id','desc');
                        $selected = '';
                      foreach ($brand as $key => $cval) {
                    if($cval['id'] == $product['brand']) 
                        {
                            $selected = 'selected';
                        } else {
                            $selected = '';
                        }?>
                        <option <?=$selected?> value="<?php echo $cval['id']; ?>"><?php echo $cval['title']; ?></option>
                       <?php
                      }
                    ?>

                    </select>
                </div>
                
	                <div class="pb-2">
	                    <label>Format</label>
	                    <input type="text" class="form-control" name="format" placeholder="Format" value="<?= $product["format"]; ?>">
	                </div>
	                 <div class="pb-2">
	                    <label>RAM</label>
	                    <input type="text" class="form-control" name="ram" placeholder="RAM" value="<?= $product["ram"]; ?>" >
	                </div>
	                 

	                <div class="pb-2">
	                    <label>Image</label><br>
	                    <div class="row">
	                    	<?php
	                    	if ($product_image) {
	                    	 foreach ($product_image as $keyp => $product_imageV) {
	                    	 	 ?>
	                    	 	 	<div class="col-sm-4">
	                    	 	 	<img src="<?= base_url($product_imageV["image"]); ?>" style="height: 100px; width: 100px;"><br>
	                    	 	 	<button class="btn btn-danger btn-sm removeImage" type="button" data-id="<?= $product_imageV["id"]; ?>">Delete</button>
	                    			</div>	                    	 	 	
	                    	 	 <?php
	                    	 }
	                    	}
	                    	?>
	                    </div>
	                    <br>
	                    <input type="file" class="form-control" name="images[]" multiple="" placeholder="Image" >
	                </div>
	                <div class="pb-2">
                    <label>Video Type</label>
                    <select class="form-control" name="video_type" class="form-control" id="videotype" required>
                       <option value="0">Select video Type</option>
                        <option value="1" <?php if($product['video_type'] == 1){echo "selected";} ?>>Custom Video</option>
                         <option value="2" <?php if($product['video_type'] == 2){echo "selected";} ?>>YouTube Video</option>
                         <option value="3" <?php if($product['video_type'] == 3){echo "selected";} ?>>Other Source</option>
                   
                    </select>
                </div>
                 <div id="yout_URL" class="pb-2">
                    <label id="lblChng">YouTube URL</label>
                    <input type="url"  class="form-control" id="youtube_URLid" value="<?php if(!empty($product['youtube_url'])){echo $product['youtube_url'];} ?>" name="youtube_url" placeholder="YouTube URL">
                </div>
	                <div class="mt-3 pb-2" id="Vproduct_H">
                <?php if ($product["product_video"]): ?>
                  <?php 
                  $vidname = explode('.', $product["product_video"]);
                  $ext = end($vidname);
                   ?>
                  <div>
                  <video width="320" height="240" controls>
                    <source src="<?php echo base_url($product["product_video"]);?>" type="video/<?= $ext ?>">
                  Your browser does not support the video tag.
                  </video>
                </div>

                <?php endif ?>
                
                    <label>Product Video (optional)</label><br>
                    <span>Supported Format : MP4 , MOV, WMV ,AVI ,AVCHD, FLV, F4V, MKV and WEBM</span><br>
                    <span>MAX size : 4 MB</span>
                    <input type="file" class="form-control" name="product_video" id="productv_id"  accept="video/mp4,video/x-m4v,video/*">
                </div>
                <!-- <div class="inner-bis pb-2">
                    <p>Game condition</p>
                      <div class="ml-auto">
                       <input type="range" onchange="initrangeslider()" min="1" max="100" value="<?=$product['conditions']?>" class="slider" name="conditions" id="myRange">
                       <div class="badge badge-danger"><span id="slide_output"><?=$product['conditions']?></span><span>% New</span></div>
                     </div>
                </div> -->
	               
	                <div class="mt-3 text-center">
	                    <button type="submit" id="submitBtn" class="btn btn-success">Submit</button>
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
	 var selected =[];
	  var customvideo = '<?= $product["product_video"]?>';
  $('#product_group option:selected').each(  function() {
      selected.push($(this).val()) 
    });
$(document).ready(  function () {
	$('.select2').select2();
    $("#product_group").val(selected).trigger('change');
    $('#videotype').trigger('change');
    $("#youtube_URLid").attr("required", false);
     $("#productv_id").attr("required", false);

     var videotype_val = $("#videotype").val();
      if(videotype_val == 0){
        $("#Vproduct_H").hide();
      $("#yout_URL").hide();
      }
     if(videotype_val ==1){
        $("#productv_id").attr("required", true);
        $("#youtube_URLid").attr("required", false);
     }else if(videotype_val == 2){

      $("#youtube_URLid").attr("required", true);
       $("#productv_id").attr("required", false);
       $("#youtube_URLid").attr("placeholder", 'YouTube URL');
        $("#lblChng").text('YouTube URL');
     }
     else if(videotype_val == 3){

      $("#youtube_URLid").attr("required", true);
       $("#productv_id").attr("required", false);
       $("#youtube_URLid").attr("placeholder", 'Other Source');
        $("#lblChng").text('Other Source');
     }
} );


$("#videotype").on('change',function(){
  var videotype = $("#videotype").val();
  if(videotype == 1){
    if(!customvideo){

          $("#productv_id").attr("required", true);
          $("#youtube_URLid").attr("required", false);
        }else{

           $("#productv_id").attr("required", false);
           $("#youtube_URLid").attr("required", false);
        }
     $("#Vproduct_H").show();
      $("#yout_URL").hide();
  }else if(videotype == 2){

    $("#youtube_URLid").attr("required", true);
     $("#productv_id").attr("required", false);
    $("#yout_URL").show();
    $("#Vproduct_H").hide();
    $("#youtube_URLid").attr("placeholder", 'YouTube URL');
        $("#lblChng").text('YouTube URL');

  } else if(videotype == 3){

    $("#youtube_URLid").attr("required", true);
     $("#productv_id").attr("required", false);
    $("#yout_URL").show();
    $("#Vproduct_H").hide();
    $("#youtube_URLid").attr("placeholder", 'Other Source');
        $("#lblChng").text('Other Source');

  }
 
})
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
$(document).on("click",".removeImage", function () {
	 var image_id = $(this).attr("data-id");
	 var thisss = $(this);
		 if (confirm('Are your sure ?')) { 
			 $.ajax({
			 			url : "<?= base_url('Product/removeImage') ?>",
			 			method : "POST",
			 			data : {image_id:image_id},
			 			beforeSend : function () {
			 				 $(thisss).prop('disabled', true);
			 			},
			 			success : function (data) {
			 				 $(thisss).prop('disabled', false);
			 				 if (data == 1) {
			 				 		$(thisss).closest(".col-sm-4").remove();
			 				 } else {
			 				 	Swal.fire({
									  icon: 'error',
									  title: 'Oops...',
									  text: 'Something went wrong!',
									})
			 				 }
			 			}
			 });
		}
})
function editProduct() {
  $('.alert-danger').remove();
    
      $.ajax({
      url: '<?= base_url() ?>/Product/editProductAction',
      type: 'POST',
      cache:false,
      contentType: false,
      processData: false,
      data:new FormData($('#editProduct')[0]),
      dataType: 'json',
      beforeSend: function() {        
        $('#submitBtn').prop('disabled' , true);
        $('#submitBtn').text('Processing..');
      },
      success : function(res){
      	$('#submitBtn').prop('disabled' , false);
		        $('#submitBtn').text('Submit');
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

$(document).ready(function() {
  //alert('hello');
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