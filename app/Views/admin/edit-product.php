
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
        			<h4 class="d-flex justify-content-between">Update Product:</h4>

          <form id="edit_product" method="post" action="#" onsubmit="return edit_product(this , <?= $product['id']; ?>)"  enctype="multipart/form-data">
            <div class="col-md-12 py-3">

              <div class="pb-2">
                <label>Title</label>
                <input type="text" class="form-control" value="<?= $product['title']; ?>"  name="title" required placeholder="Title">
                <input type="hidden" class="form-control" value="<?= $product['id']; ?>" name="id"  >
              </div>
               <div class="pb-2">
                    <label>Description</label>
                   <textarea class="form-control textarea" name="description" placeholder="Description"><?= $product['description']; ?></textarea>
                </div>
                
                <div class="mt-3 pb-2">
                    <h5>Product Group</h5>
                    <?php
                    $product_group = $this->common_model->GetAllData('product_group','','id','desc');

                    foreach ($product_group as $key => $cval) { 
                      $s_pg = explode(',', $product['product_group']);
                      ?>
                    <div class="form-check">
                      <input <?= (in_array($cval['id'], $s_pg)) ? 'checked' : '' ?> class="form-check-input" type="checkbox" value="<?php echo $cval['id']; ?>" name="product_group[]" id="flexCheckDefault<?php echo $cval['id']; ?>">
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
                    <select class="form-control" onchange="return fetchsubcat(this.value)" name="category" required id="">
                      <option value="">Select</option>
                    <?php
                      foreach ($categories as $key => $cval) {
                       ?>
                        <option <?= ($product['category'] == $cval['id']) ? 'selected' : '' ?> value="<?php echo $cval['id']; ?>"><?php echo $cval['title']; ?></option>
                       <?php
                      }
                    ?>

                    </select>
                </div>
                    <div class="pb-2">
                    <label>SubCategory</label>
                    <select class="form-control" name="subcategory" required id="editsub_category">
                    <?php
                     $subcategories = $this->common_model->GetAllData('categories',array('parent'=>$product['category']),'id','desc');
                      foreach ($subcategories as $key => $cval) {
                       ?>
                        <option <?= $product['subcategory']?> <?= ($product['subcategory'] == $cval['id']) ? 'selected' : '' ?> value="<?php echo $cval['id']; ?>"><?php echo $cval['title']; ?></option>
                       <?php
                      }
                    ?>

                    </select>
                </div>
                <div class="pb-2">
                    <label>Publisher</label>
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
                    <label>Game Class</label>
                    <select class="form-control" name="class_type" required id="class_type">
                      <option value="">Select</option>
                    <?php $class_type = $this->common_model->GetAllData('class_type','','class_name','asc');
                        $selected = '';
                      foreach ($class_type as $key => $cval) {
                    if($cval['id'] == $product['class_type']) 
                        {
                            $selected = 'selected';
                        } else {
                            $selected = '';
                        }?>
                        <option <?=$selected?> value="<?php echo $cval['id']; ?>"><?php echo $cval['class_name']; ?></option>
                       <?php
                      }
                    ?>

                    </select>
                </div>
                <div class="pb-2">
                    <label>Available Stock</label>
                    <input type="number" min="0" value="<?= $product['stock']; ?>" class="form-control" name="stock" placeholder="Available Stock">
                </div>
                <div class="pb-2">
                <label>Format</label>
                <input type="text" class="form-control" name="format" placeholder="Format" value="<?= $product['format']; ?>" required>
              </div>
               <div class="pb-2">
                <label>Realease Date</label>
                <input type="date" class="form-control" name="release_date" placeholder="Realease Date" value="<?= $product['release_date']; ?>" >
                <input type="hidden" name="ram" placeholder="RAM" value="0" >
              </div>
              <div class="pb-2">
                <label>Price (HKD)</label>
                <input type="text" class="form-control" name="price" placeholder="Price" value="<?= $product['base_price']; ?>" required>
              </div>
              <div class="pb-2">
                    <label>Market Price (HKD)</label>
                    <input type="number" step="0.1" class="form-control" value="<?= $product['mkt_price']; ?>" name="mkt_price" placeholder="Mkt Price">
                </div>
                 <div class="pb-2">
                    <label>Meta Score</label>
                    <input type="number" step="0.1" class="form-control" value="<?= $product['meta_score']; ?>" name="meta_score" placeholder="Meta Score">
                </div>
                 <div class="pb-2">
                    <label>Game Score</label>
                    <input type="number" step="0.1" class="form-control" value="<?= $product['game_score']; ?>" name="game_score" placeholder="Game Score">
                </div>
                 <div class="pb-2">
                    <label>Factor X</label>
                    <input type="number" step="0.1" class="form-control" value="<?= $product['factor_x']; ?>" name="factor_x" placeholder="Factor X">
                </div>
                 <div class="pb-2">
                    <label>Factor Y</label>
                    <input type="number" step="0.1" class="form-control" value="<?= $product['factor_y']; ?>" name="factor_y" placeholder="Factor Y">
                </div>
                 <div class="pb-2">
                    <label>Factor Z</label>
                    <input type="number" step="0.1" class="form-control" value="<?= $product['factor_z']; ?>" name="factor_z" placeholder="Factor Z">
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
               <div class="pb-2">
                <label>Image</label>
                <input type="file" class="form-control" name="images[]" multiple="" placeholder="Image">
                <span>
                <?php 
                 $product_image = $this->common_model->GetAllData('product_image',array('product_id'=>$product['id']));
                  foreach ($product_image as $key => $pimage) {
                    ?>
                      <p><?php if(!empty($pimage["image"])) { ?>
                          <img style="height: 100px;width: 100px;" src="<?php echo base_url($pimage["image"]);?>">
                            <a class="btn btn-info btn-sm" id="delete_btns" onclick="delete_product_image(<?= $pimage['id'] ?>)">Remone</a>
                          <?php } ?>
                        </p>

                    <?php
                  }
              ?>

            </span>
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
                  
              
                  <div id="yout_URL" class="pb-2">
                    <label id="lblChng">YouTube URL</label>
                    <input type="url"  class="form-control" id="youtube_URLid" value="<?php if(!empty($product['youtube_url'])){echo $product['youtube_url'];} ?>" name="youtube_url" placeholder="YouTube URL">
                </div>

                <!-- <div class="inner-bis pb-2">
                    <p>Game condition</p>
                      <div class="ml-auto">
                       <input type="range" onchange="initrangeslider()" min="1" max="100" value="<?=$product['conditions']?>" class="slider" name="conditions" id="myRange">
                       <div class="badge badge-danger"><span id="slide_output"><?=$product['conditions']?></span><span>% New</span></div>
                     </div>
                </div> -->
                
               
              <div class="mt-3 text-center">
                  <button type="submit"  id="updateBtn<?= $product['id']; ?>" class="btn btn-success">Update</button>
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
  var selected =[];
  var customvideo = '<?= $product["product_video"]?>';
  $('#product_group option:selected').each(  function() {
      selected.push($(this).val()) 
    });
$(document).ready(  function () {
    $('#myTable').DataTable();
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
     }else if(videotype_val == 3){

      $("#youtube_URLid").attr("required", true);
       $("#productv_id").attr("required", false);
       $("#youtube_URLid").attr("placeholder", 'Other Source');
        $("#lblChng").text('Other Source');
     }
   // $("#yout_URL").hide();
    //$("#Vproduct_H").hide();
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

  }else if(videotype == 3){

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
        $('#updateBtn'+id).prop('disabled' , true);
        $('#updateBtn'+id).text('Processing..');
      },
      success : function(res){
        $('#updateBtn'+id).prop('disabled' , false);
        $('#updateBtn'+id).text('Update');
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
         
         location.reload();

        }
        
      }
    });
    }
    
}

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
