<?php include ('include/header.php') ?>
<style type="text/css">
  #loading {
    text-align: center;
    background: url(<?= base_url('assets') ?>/img/loader.gif) no-repeat center;
    height: 150px;
    width: 100%;
}
</style>
  <div class="middle">
  <div class="row">
    <div class="col-sm-3">
      <form action="#" method="post" id="search_product" onsubmit=" return search_product(e)">
        <input type="hidden" name="token" value="0">
      <div class="middle-left">
        <div class="left-filter">
          <h1>Categories</h1>
          <div class="left-body">
            <div id="accordion">
              <?php foreach ($categories as $key => $value):
               $subcat = $this->common_model->GetAllData("categories", 'parent='.$value['id'] , 'id' , 'desc'); 
               $active = '';
               ?>
                <div class="card">
                  <div id="heading<?= $value['id'] ?>" class="normal-head <?= ($subcat) ? 'collpas' : '' ?>">
                    <?php if ($active_cat == $value['id']): ?>
                        <input type="hidden" name="category" value="<?= $value['id'] ?>" >
                        <?php $active = 'active'; ?> 
                      <?php endif ?>
                    <a  <?= ($subcat) ? 'class="collapsed" data-toggle="collapse" data-target="#collapse'.$value['id'].'" aria-expanded="true" aria-controls="collapse'.$value['id'].'"' : 'class="'.$active .'" href="'.base_url('shop/'.slugify($value['title']).'-'.$value['id']).'"' ?>>
                      <?= $value['title'] ?>
                      
                      
                    </a>
                  </div>
                  <?php if ($subcat): ?>
                    
                  
                  <div id="collapse<?= $value['id'] ?>" class="collapse" aria-labelledby="heading<?= $value['id'] ?>" data-parent="#accordion">
                    <div class="card-body">
                      <?php foreach ($subcat as $key => $s): 
                           $active = '';
                        if ($active_cat == $s['id']): 
                           $active = 'active'; 
                          ?>
                        <input type="hidden" name="category" value="<?= $s['id'] ?>"> 
                      <?php endif ?>
                        <p><a class="<?= $active ?>" href="<?= base_url('shop/'.slugify($s['title']).'-'.$s['id']) ?>"><?= $s['title'] ?></a></p>
                        
                      <?php endforeach ?>
                    </div>
                  </div>
                  <?php endif ?>
              </div>
              <?php endforeach ?>
              
            </div>
          </div>
        </div>
        <!-- Left Filter-->
        
        
        <div class="left-filter">
          <h1>Brands</h1>
          <div class="left-body">
            <!-- Filter-box-->
          <?php foreach ($brands as $key => $value): 
            $p_count = $this->common_model->GetCountData("product", 'id IN  (SELECT product_id 
     FROM sell_product) AND brand='.$value['id']); 
            ?>
            <div class="filter-box">        
              <div class="checkbox">
                <label for="<?= slugify($value['title']).'-'.$value['id'] ?>">
                  <input <?= (($_GET['brand']) ? ($_GET['brand'] == $value['id']) ? 'checked' : '' : '') ?> type="checkbox" name="brand[]" id="<?= slugify($value['title']).'-'.$value['id'] ?>" value="<?= $value['id'] ?>" onchange="search_product()">        
                  <span class="ac-span"><?= $value['title'] ?></span>
                  <span class="labelspa"><?= $p_count ?></span>
                </label>
              </div>
            </div>
          <?php endforeach ?>
           
          </div> 
        </div>
        <!-- Left Filter-->
        
        
        <div class="left-filter">
          <h1>Price</h1>
          <div class="left-body">
            <div class="card-body" >
              <input type="hidden"  class="js-range-slider irs-hidden-input" name="base_price" value="" tabindex="-1" readonly="">
            </div>

          </div>
          <div class="p-3 text-right">
            <a href="javascript:;" class="btn btn-primary" onclick="search_product()">Filter</a>
          </div>
        </div>
        
  
        <!-- Left Filter-->
      </div>
    </form>
      

    </div>
    <div class="col-sm-9">
      <div class="middle-right">
        <div class="right-top">
          <h4 id="total_product">
            <!-- Product count display here  -->
          </h4>
          <!-- <div class="sort-right">
            <label>Sort by</label>
            <select>
              <option>Price: lowest first</option>
            </select>
          </div> -->
        </div>
        
        <div class="middle-product" id="filter_data">
          <!-- Filtered product will be display here -->
        </div>
        
        <!-- pagination -->
        <div class="pro-pagination" >
            <div class="inner-pagi" id="pagination_link">
            <a href="">1</a>
            <a href="">2</a>
            <a href="">3</a>
            <a href="">4</a>
          </div>
        </div>
        <!-- pagination -->
      </div>
    </div>
  </div>
</div>
<?php include ('include/footer.php') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.4/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>      
<script>
$(".js-range-slider").ionRangeSlider({
    skin: "round",
    step: 50,
    type: "double",
    grid: true,
    min: 0,
    max: 1000,
    from: 0,
    to: 800,
    prefix: "$"
});
</script>
<script type="text/javascript">
/*Filter Search Function START =========================*/

  function search_product(e=null , page=1)
    {
      if(e){ e.preventDefault() }
      
        $('#filter_data').html('<div id="loading" style="" ></div>');
        //$.blockUI();
        form_data = new FormData($('#search_product')[0]);
        search = $('#search_key').val();
        form_data.append('search' , search);
        $.ajax({
            url:"<?= base_url() ?>/Shop/fetch_data/"+page,
            method:"POST",
            dataType:"JSON",
            cache:false,
          contentType: false,
          processData: false,
            data:form_data,
            
            success:function(data)
            {
               //$.unblockUI();
              console.log(data)
                $('#filter_data').html(data.product_list);
                $('#pagination_link').html(data.pagination_link);
                $('#total_product').html(data.total);
            }
        })
    }

   $(document).on('click', '.pagination li a', function(event){
      event.preventDefault();
      var page = $(this).data('ci-pagination-page');
      search_product(event , page);
  });
$(document).ready(function() {
  search_product(null , 1);
});
$(document).on('keyup', '#search_key', function(event) {
  if($(this).val().length > 3)
  {
    search_product(null , 1);
  }
  if($(this).val() == '')
  {
    search_product(null , 1);
  }
});
/*Filter Search Function END =========================*/
</script>
