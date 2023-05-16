<?php include('include/sellHeader.php') ?>
			<!-- Header-->
			<div class="pack-body">
				<div class="row">
					<div class="col-sm-4"></div>
					<div class="col-sm-4">

      <div class="search-wrapper mx-auto">
              <div class="go-back">
                <div style="width: 79%;"><h5>Search Game to exchange</h5>
              <p>Find the product you're looking for to Exchange</p></div>
              <button class="btn btn-primary" onclick="history.back()">Go Back</button>
              </div>
              <div class="input-group">
                <input type="text" placeholder="Search here" name="key" class="form-control search">
                <span class="input-group-btn">
               
                </span>

              </div>
              <?php if ($this->auth): ?>
                <p>Didn't found your game ?<a href="javascript:;" data-toggle="modal" data-target="#myModal">add a request</a> </p>
              <?php else: ?>
                <p>Didn't found your game ?<a href="<?= base_url('login') ?>" >add a request</a> </p>
              <?php endif ?>
              
      </div><br/>
      <div class="datas">
      </div>
      
      
      </div>
					<div class="col-sm-4"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal" id="myModal">                 
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Product Request</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        <!-- Modal body -->
        <form id="add_product" method="post"  onsubmit="return add_product()" enctype="multipart/form-data">
                    <div>
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Title">
                    </div>
                    <!-- <div>
                        <label>Description</label>
                        <input type="text" class="form-control" name="title" placeholder="Title">
                       <textarea class="form-control textarea" name="description" placeholder="Description"></textarea>
                    </div> -->
                
                    <div>
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
                    <div>
                        <label>SubCategory</label>
                        <select class="form-control" name="subcategory" required  id="sub_category">
                         
                       </select>
                    </div>
                  <!-- <div>
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
                </div> -->
               
                    <!-- <div>
                        <label>Format</label>
                        <input type="text" class="form-control" name="format" placeholder="Format" value="0">
                    </div> -->
                     <div>
                        <label>Release Year</label>
                        <input type="hidden" class="form-control" name="description" placeholder="Format" value="0">
                        <input type="hidden" class="form-control" name="format" placeholder="Format" value="0">
                        <input type="hidden" class="form-control" name="brand" placeholder="Format" value="<?php echo $cval['id']; ?>">
                        <input type="hidden" class="form-control" name="ram" placeholder="Format" value="0">
                        <input type="hidden" class="form-control" name="is_requested" placeholder="Format" value="1">
                        <input type="text" class="form-control" name="release_year" placeholder="Release Year">
                    </div>
                    

                    <div>
                        <label>Image</label>
                        <input type="file" accept="*image" class="form-control" name="images[]" multiple="" placeholder="Image" required>
                    </div>
                   <!--  <div class="mt-3">
                    <label>Product Video (optional)</label><br>
                    <span>Supported Format : MP4 , MOV, WMV ,AVI ,AVCHD, FLV, F4V, MKV and WEBM</span><br>
                    <span>MAX size : 4 MB</span>

                    <input type="file" class="form-control" name="product_video"  accept="video/mp4,video/x-m4v,video/*">
                    <input type="hidden" class="form-control" name="is_requested"  value="1">
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
</body>
<?php include ('include/footer.php') ?>
<script>
	 $('.search').keyup(function(){
    var values = $('.search').val();
    var val = $.trim(values);
    var product_id = 0;
    var class_type = 0;
    ids = [0];
    $('.ex_checked').each(function(index, el) {
      id = $(el).data('id');
      ids.push(id)
    });
    if(val.length != 0) {
     $.ajax({
      url: '<?=base_url()?>/Trade/searchKey',
      type: 'post',
      data: {val: val , product_id: product_id ,class_type: class_type , checked: ids},
      dataType: 'json',
      success: function(data){
        $('.datas').html(data.html);
      }
    })
    }
    else 
    {
      $('.datas').html('');
    }   
  })
</script>
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
               text: 'Your Product request has been sent to admin. Please come back after an hour until we review your request', 
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