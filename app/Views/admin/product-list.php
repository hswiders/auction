
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
    .blockUI.blockOverlay , .blockUI.blockMsg.blockPage{
    z-index: 999999!important;
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
                      
        			    <h4 class="d-flex justify-content-between"><?php echo $type; ?> Products
                            <div class="d-flex justify-content-between">
                                <a href="<?php echo base_url('Admin/product/productform'); ?>" class="btn btn-info mx-2">Add</a>
                                <a href="javascript:;" class="btn btn-primary" data-toggle="modal" data-target="#myimportModal">Import</a>
                                <!-- <button class="btn btn-danger mx-3" onclick="window.print()">Print</button> -->
                            </div>
                        </h4>


                    </div>
                    
                    <div class="error"></div>
        		      <div class="table-responsive">
        		    
                    <div class="d-flex">
                        <div class="py-3">
                            <label class="px-2">
                                Sort By <select data-type="<?=$type?>" name="example3_length" aria-controls="myTable1" id="sort_grade"><option value="">Sort By</option><option value="1">Grade to high</option><option value="0">Grade to low</option></select>
                            </label>
                        </div> 
                        <?php if($type != 'User'){?>
                        <div class="py-3">
                            <label class="px-2">
                                Filter BY : <select  name="example3_length" aria-controls="myTable1" id="filter_by"><option value="">--choose--</option><option <?= (@$_GET['filter_by'] == "all" ) ? 'selected' : '' ?> value="all">All Admin products</option><option <?= (@$_GET['filter_by'] == "available_stocks" ) ? 'selected' : '' ?> value="available_stocks">Available Stocks</option></select>
                            </label>
                        </div>
                        <?php }?>
                    </div>
                    <div class="data_tables">
    <table id="myTable1" class="display dataTable dataTables_wrapper" style="width:100%">
        <thead>     
            <tr>
                <th>S. No.</th>
                <?php if($type == 'User'){?>
                    <th>User Name</th>
                <?php } ?>
                <th>ProductId</th>
                <th>Title</th>
                <th style="display:none">Description</th>
                <th>Product Group</th>
                <th>Market Price</th>
                <th>Grade</th>
                <th>Game Score</th>
                <th>Meta Score</th>
                <th>Stocks</th>
                <th>Category</th>
                <th>SubCategory</th>
                <th>format</th>
                <th>Release Date</th>
                <th>Publishers</th>
                <th>Base Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody> 
    </table>
</div>

               </div>
        	   </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="myimportModal">
    <div class="modal-dialog">
        <div class="modal-content">

        <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Import Products</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

      <!-- Modal body --> 
        <form id="import_csv" method="post"  onsubmit="return import_csv(event , this)" enctype="multipart/form-data">
            <div class="modal-body">
               
                    <div class="col-md-12 py-3">
                        <div id="import_csvresult"></div>
                      <div>
                            <label>Choose CSV file</label>
                            <input type="file" class="form-control" name="image" required>
                        </div>
                    </div>
            </div>    
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" >Import</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </form>
        </div>
    </div>
</div>
<?php include ('include/footer.php') ?> 


<script>
$(document).ready( function () {
    initailDatatable();
});

function initailDatatable(){
   
    <?php if (@$export): ?>
      $(document).ready(function() {
    $('#myTable1').DataTable( {
      
        dom: 'Bfrtip',
        buttons: [
       {
           extend: 'pdf',
           footer: true,
           exportOptions: {
            columns: ':not(:last-child)',
          }
           // exportOptions: {
           //      columns: [1,2,3,4,5]
           //  }
       },
       
       {
           extend: 'csv',
           footer: true,
           exportOptions: {
            columns: ':not(:last-child)',
          }

           // exportOptions: {
           //      columns: [1,2,3,4,5]
           //  }
       },
       {
           extend: 'print',
           footer: true,
           exportOptions: {
            columns: ':not(:last-child)',
          }

           // exportOptions: {
           //      columns: [1,2,3,4,5]
           //  }
       }         
    ]  ,
    
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "<?php echo base_url('Admin/Product/admin_ajax_product_list') ?>",
            "type": "GET"
        },
        "columns": [
    {"data": "sno"},
    <?php if($type == 'User'){?>
        {"data": "user_name"},
    <?php } ?>
    {"data": "id"},
    {"data": "title"},
    {"data": "description", "visible": false},
    {"data": "product_group"},
    {"data": "mkt_price"},
    {"data": "class_type"},
    {"data": "game_score"},
    {"data": "meta_score"},
    {"data": "stock"},
    {"data": "category"},
    {"data": "subcategory"},
    {"data": "format"},
    {"data": "release_date"},
    {"data": "brand"},
    {"data": "base_price"},
    {"data": "action"}
],

    });
});

  

<?php else : ?>
    $('#myTable1').dataTable();
<?php endif ?>
};

function import_csv(e , form) {
      ajxurl = '<?= base_url() ?>/Admin/Product/ImportProducts';
      //ajxurl = '<?= base_url() ?>/Admin/Product/ImportProducts_new';
      $.ajax({
      url: ajxurl,
      type: 'POST',
      cache:false,
      contentType: false,
      processData: false,
      data:new FormData(form),
      dataType: 'json',
      beforeSend: function() {        
        blockui('show')
      },
      success : function(res){
       blockui('hide')
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
         
          $('#import_csvresult').html(res.message);
          
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



function markCheck(el,id) {
    
    if($(el).is(":checked")) {
        var is_featured = 1;
    } else {
        is_featured = 0;
    }
    $.ajax({
        url: '<?= base_url() ?>/Admin/Product/markFeature',
        type: "POST",
        data: {
            is_featured: is_featured,
            id : id
        },
        cache: false,
        dataType : 'json',
        success: function(result){
            if(result.status == 1)
            {
                toastr.success(result.message)
            } else 
            {
                toastr.error(result.message)
            }
        }
    });
           
}

  function accept_product(id)
   {
    if(confirm('Are you sure?'))
    {
    $.ajax({
          type: "POST",
          url: "<?= base_url() ?>/Admin/Product/accept_product",
          data: {id:id},
          dataType: "json",
          beforeSend:function(){
          $('#submit'+id).prop('disabled',true);
          $('#btn_load'+id).show();
        },
          success: function(res){
            if(res.status == 1)  //json status return by controller
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
              $('.error-msg').html(data.message);
              $('#submit'+id).prop('disabled',false);
              $('#btn_load'+id).hide();
            }
              
          },
          
     });
    }

   }


   $('#sort_grade').change(function(){
        var sort_by = this.value;
        var type = $('#sort_grade').data('type');

        window.location.href = '<?= base_url('admin/admin_product') ?>?sort_by='+sort_by;
   })

   $('#filter_by').change(function(){
        var filter_by = this.value;
        window.location.href = '<?= base_url('admin/admin_product') ?>?filter_by='+filter_by;
   })
</script>
