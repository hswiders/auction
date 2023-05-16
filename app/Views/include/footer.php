	<!-- Footer-->
        	<div class="footer">
        		<div class="row">
        			<?php $foot_cat = $this->common_model->GetAllData('categories' , "id IN (select category from product where status = 1 group by category order by no_of_sales desc ) AND parent = 0" , 'id' , 'desc' ); ?>
             
              <?php foreach ($foot_cat as $key => $value): ?>
                <?php $foot_product = $this->common_model->GetAllData('product' , "category = ".$value['id']."  " , 'no_of_sales' , 'desc' , 5); ?>
                <div class="col">
                  <div class="foot-link">
                    <h4><?= $value['title'] ?></h4>
                    <?php foreach ($foot_product as $key => $value): ?>
                      <p><a href="<?= get_product_url($value) ?>"><?= $value['title'] ?></a></p>
                    <?php endforeach ?>
                    
                  </div>
              </div>
              <?php endforeach ?>
        			
        			
              
        		</div>
        	</div> 
            <!-- Footer-->
          <div class="footer">
            <div class="row">
              <div class="col-sm-4">
                <div class="foot-logo">
                  <img src="<?= base_url() ?>/assets/img/logo.png">
                  <?php $social = $this->common_model->GetSingleData('social', array('id'=>1)); ?>
                  <p><?= $social['footer_about']; ?></p>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="foot-link">
                  <h4>INFORMATION</h4>
                  <p><a href="<?= base_url()?>/terms-conditions">Terms & Conditions</a></p>
                  <p><a href="<?= base_url()?>/warrenty-and-refund">Warranty and Refund Policy</a></p>
                  <p><a href="#" onclick="return alert('comming soon')">Where do i find my order</a></p>
                  <!-- <p><a href="#">sitemap</a></p> -->
                </div>
              </div>
              <div class="col-sm-2">
                <div class="foot-link">
                  <h4>SOCIAL MEDIA</h4>
                  <?php $social_links = $this->common_model->GetAllData('social_links' , '' , 'id' , 'desc'); ?>
                  <?php foreach ($social_links as $key => $value): ?>
                      <p>
                        <?php if(!empty($value["image"])) { ?>
                        <img style="height: 30px;width: 30px;" src="<?php echo base_url($value["image"]);?>">&nbsp;
                        <?php } ?>
                        <a target="_blank" href="<?=$value['link']?>"><?=$value['title']?></a></p> 
                  <?php endforeach ?>
                
                </div>
              </div>
              <div class="col-sm-3">
                <div class="subsc-link">
                  <h4>RECEIVE OFFERS AND NEWS!!</h4>
                  <form class="form" id="do_subscribe" action="#" method="post" onsubmit="return do_subscribe(event)">
                    <input type="text" name="email" class="form-control" placeholder="Enter your email">
                    <button type="submit" class="btn btn-primary" id="nsub_btn">Subscribe</button>
                  </form>
                  
                </div>
              </div>
            </div>
          </div>
      <!-- Footer-->
			<!-- Footer-->
			<!-- coyp -->
			<div class="copyright">
				© Copyright 2022 GameXchange. All Rights Reserved.
			</div>
			<!-- coyp -->
		</div>
	</div>
</div>
</body> 
<!-- javascript -->

	<script src="<?= base_url() ?>/assets/js/jquery.min.js"></script>
	<script src="<?= base_url() ?>/assets/js/bootstrap.min.js"></script>
	<script src="<?= base_url() ?>/assets/js/owl.carousel.min.js"></script>
  <script src="<?= base_url() ?>/assets/js/select2.min.js"></script> 
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.4/dist/sweetalert2.all.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" ></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"  />

  <script src="<?= base_url() ?>/assets/js/jquery.dataTables.min.js"></script> 


<script>

    $(document).ready(function () {
       $('.select2').select2();
$('.navbar-dark .dmenu').hover(function () {
        $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
    }, function () {
        $(this).find('.sm-menu').first().stop(true, true).slideUp(105)
    });
}); 
 
    $(document).ready(function() {
	$(".megamenu").on("click", function(e) {
		e.stopPropagation();
	});
});

$(function($) {
 let url = window.location.href;
  $('.menu .navbar-dark .navbar-nav .nav-link').each(function() {
   if (this.href === url) {
   $(this).addClass('active');
  }
 });


});
</script>
<script type="text/javascript">
	function do_search_page()
	{
		$('.search_err').remove()
		search_key = $('#search_key').val();
		// if (search_key.trim() == '') 
		// {
		// 	$("#search_group").after("<div  class='label search_err alert-danger'>Search field is required</div>");
		// 	return false;
		// }
		window.location.href = '<?= base_url() ?>/shop?search='+search_key 
  	
  	}
</script>
<script>
  function do_subscribe (e) 
  {
    e.preventDefault();
      $('.alert-danger').remove();
      $.ajax({
      url: '<?= base_url() ?>/Home/do_subscribe',
      type: 'POST',
      cache:false,
      contentType: false,
      processData: false,
      data:new FormData($('#do_subscribe')[0]),
      dataType: 'json',
      beforeSend: function() {        
        $('#nsub_btn').prop('disabled' , true);
        $('#nsub_btn').text('Processing..');
      },
      success : function(res){
        $('#nsub_btn').prop('disabled' , false);
        $('#nsub_btn').text('Submit');
        if (res.status == 1) 
        {
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
          for (var err in res.message) {
            
            $("[name='" + err + "']").after("<div  class='label alert-danger'>" + res.message[err] + "</div>");
          }
        }
      }
    });
return false;
}
</script>
<script type="text/javascript" id="add_to_fav_script_js">
     function addToFav(id) {
      //alert(id);
      var formData = new FormData();
      formData.append('product_id', id);
      $.ajax({
        url: "<?php echo base_url('Home/add_to_fav');?>",
        method: "POST",
        data: formData,
        datatype:'json',
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $.blockUI();
        },
        success: function (data) {
          $.unblockUI();
           obj = JSON.parse(data);
           console.log(data);
          if (obj.status == 1)
          {
            $('.product_heart_'+id).addClass('fa-heart')
            $('.product_heart_'+id).removeClass('fa-heart-o')
            toastr['success'](obj.msg, 'Success!!', {
                    closeButton: true,
                    positionClass: 'toast-top-right',
                    progressBar: true,
                    newestOnTop: true,
                });
          }
          else if(obj.status == 0)
          {
            $('.product_heart_'+id).addClass('fa-heart-o')
            $('.product_heart_'+id).removeClass('fa-heart')
              toastr['success'](obj.msg, 'Success!!', {
                    closeButton: true,
                    positionClass: 'toast-top-right',
                    progressBar: true,
                    newestOnTop: true,
                });
          }
          else{
               $.unblockUI();
              toastr['error'](obj.msg, 'Oops..!!', {
                      closeButton: true,
                      positionClass: 'toast-top-right',
                      progressBar: true,
                      newestOnTop: true,
                  });
              window.location.href = '<?php echo base_url('login'); ?>';
          }
          
        }
      });
    }
 </script>
<script type="text/javascript" id="add_to_ex_script_js">
     function addToEx(id , reload=false) {
      //alert(id);
      var formData = new FormData();
      formData.append('product_id', id);
      $.ajax({
        url: "<?php echo base_url('Home/add_to_ex');?>",
        method: "POST",
        data: formData,
        datatype:'json',
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $.blockUI();
        },
        success: function (data) {
          $.unblockUI();
           obj = JSON.parse(data);
           console.log(obj);
          if (obj.status == 1)
          {
            $('.product_ex_'+id).html('Remove')
             $('.product_ex_'+id).removeClass("btn-primary").addClass("btn-danger")
            toastr['success'](obj.msg, 'Success!!', {
                    closeButton: true,
                    positionClass: 'toast-top-right',
                    progressBar: true,
                    newestOnTop: true,
                });
          }
          else if(obj.status == 0)
          {
           
            $('.product_ex_'+id).html('add to list')
            $('.product_ex_'+id).removeClass("btn-danger").addClass("btn-primary")
              toastr['success'](obj.msg, 'Success!!', {
                    closeButton: true,
                    positionClass: 'toast-top-right',
                    progressBar: true,
                    newestOnTop: true,
                });
          }
          else{
               $.unblockUI();
              toastr['error'](obj.msg, 'Oops..!!', {
                      closeButton: true,
                      positionClass: 'toast-top-right',
                      progressBar: true,
                      newestOnTop: true,
                  });
              window.location.href = '<?php echo base_url('login'); ?>';
          }
          if (reload) {
            location.reload()
          }
        }
      });
    }
 </script>
<script type="text/javascript">
    $('.example3').dataTable();
    $(document).ready(function() {
      $(document).on('click' , '.make_read' , function() {
      var url = $(this).data('url')
      markAsRead('0' , url);
      })
    });

    $('[data-toggle="collapse"] , [data-toggle="dropdown"]').on('dblclick' , function(){
  url =  $(this).attr('href');
    window.location.href = url;
})

    function blockui(action='show') {
          if (action == 'show') 
          {
            $.blockUI({message:'<div class="spinner-border text-primary" role="status"></div>',css:{backgroundColor:"transparent",border:"0"},overlayCSS:{backgroundColor:"#fff",opacity:.8}})
          }
          else
          {
             $.unblockUI()
          }
        }
 </script>
 <script>
  
   async function  deleteData (fun , id) 
  {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
       
      form = new FormData();
      form.append('id' , id);
      $.ajax({
      url: '<?= base_url() ?>/'+fun+'/do_delete',
      type: 'POST',
      cache:false,
      contentType: false,
      processData: false,
      data:form,
      dataType: 'json',
      beforeSend: function() 
      {        
        blockui('show')
      },
      success : function(res){
        blockui('hide')
        if (res.status == 1) 
        {
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
      else
      {
        return false;
      }
    })
      
}
</script>