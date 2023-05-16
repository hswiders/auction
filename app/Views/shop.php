<?php include ('include/header.php') ?>
<style type="text/css">
  #loading {
    text-align: center;
    background: url(<?= base_url('assets') ?>/img/loader.gif) no-repeat center;
    height: 150px;
    width: 100%;
}
.products-sort-order .display-select {
    font-size: 18px;
    margin: 0;
    background: #fff;
    padding: 0px 2px;
    border: 1px solid #c7c7c7;
    border-radius: 5px;
}
.products-sort-order .display-select a {
    color: #555;
}
.products-sort-order .display-select a.selected {
    color: #5662A6;
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
                    <a href="<?= base_url('shop/'.slugify($value['title']).'-'.$value['id']) ?>" <?= ($subcat) ? 'class="collapsed" data-toggle="collapse" data-target="#collapse'.$value['id'].'" aria-expanded="true" aria-controls="collapse'.$value['id'].'"' : 'class="'.$active .'" href="'.base_url('shop/'.slugify($value['title']).'-'.$value['id']).'"' ?>>
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
        
        <?php $subcat = $this->common_model->GetAllData('categories' , array('parent' => $active_cat,'parent !='=>0 ));  ?>
        <?php if($subcat) { ?>
        <div class="left-filter" >
          <h1>Subcategories</h1>
          <div class="left-body" id="subcat">
            <!-- Filter-box-->
            
          <?php foreach ($subcat as $key => $value): 
            $p_count = $this->common_model->GetCountData("product", 'subcategory='.$value['id']); 
            ?>
            <div class="filter-box">        
              <div class="checkbox">
                <label for="<?= slugify($value['title']).'-'.$value['id'] ?>">
                  <input <?= (($_GET['subcat']) ? ($_GET['subcat'] == $value['id']) ? 'checked' : '' : '') ?> type="checkbox" name="brand[]" data-title="<?= $value['title'] ?>" id="<?= slugify($value['title']).'-'.$value['id'] ?>" value="<?= $value['id'] ?>" onchange="search_product(event , 1 , isbrand=1)">        
                  <span class="ac-span"><?= $value['title'] ?></span>
                  <span class="labelspa"><?= $p_count ?></span>
                </label>
              </div>
            </div>
          <?php endforeach ?>
           
          </div> 
        </div>
      <?php } ?>
        <!-- Left Filter-->
        
        
        <div class="left-filter">
          <h1>Ask Price</h1>
          <div class="left-body">
            <div class="card-body" >
              <input type="hidden"  class="js-range-slider irs-hidden-input" name="base_price" value="" tabindex="-1" readonly="">
            </div>

          </div>
          
        </div>

        <div class="left-filter">
          <h1>Last Sale Price</h1>
          <div class="left-body">
            <div class="card-body" >
              <input type="hidden"  class="js-range-slider irs-hidden-input" name="sale_price" value="" tabindex="-1" readonly="">
            </div>

          </div>
          <div class="p-3 text-right d-flex justify-content-between">
            <a href="<?= base_url('shop') ?>" class="btn btn-danger" >Clear filter</a>
            <a href="javascript:;" class="btn btn-primary" onclick="search_product()">Filter</a>
          </div>
        </div>
        
  
        <!-- Left Filter-->
      </div>
      <input type="hidden" name="currency" value="<?= $this->currency ?>">
    </form>
      

    </div>
    <div class="col-sm-9">
      <div class="middle-right">
        <h3><?= $title  ?></h3>
        <div id="active_filter"></div>
        <div class="right-top">

          <h4 id="total_product">
            <!-- Product count display here  -->
          </h4>
          <div class="sort-right">
            <label>Sort by</label>
            <select class="" id="sortby" onchange="search_product(null , 1)">
              <option value="">select</option>
              <option value="no_of_sales-desc">Bestsellers</option>
              <option value="no_of_exchange-desc">Exchange Frequency</option>
              <option value="title-asc">Name: A to Z</option>
              <option value="title-desc">Name: Z to A</option>
              <option value="last_sale_price-desc">Last Sale: High to Low</option>
              <option value="last_sale_price=0-asc">Last Sale: Low to High</option>
              <option value="game_score-desc">Game Score: High to Low</option>
              <option value="game_score=0-asc">Game Score: Low to High</option>
              <option value="lowest_ask-desc">Lowest Ask: High to Low</option>
              <option value="lowest_ask=0-asc">Lowest Ask: Low to High</option>
            </select>
          </div>
          <div class="sort-right">
            <div class="d-flex products-sort-order">
              <label class="form-control-label display-label d-none d-lg-block mr-2 mt-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">View</font></font></label>
              <ul class="display-select" id="product_display_control">
                <li class="d-flex justify-content-between">
                  <a data-view="grid" href="#grid" title="Grid" data-toggle="tooltip" data-placement="top" class="selected view_ mx-1">
                    <i class="fa fa-columns"></i>
                  </a>
                  <a data-view="list" href="#list" title="list" data-toggle="tooltip" data-placement="top" class="mx-1 view_">
                   <i class="fa fa-list"></i>
                  </a>
                  
                </li>
              </ul>
            </div>
          </div>
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
    step: 10,
    type: "double",
    grid: true,
    min: 0,
    <?php if ($this->currency == 'HKD'): ?>
      max: 5000,
    <?php else: ?>
      max: 1000,
    <?php endif ?>
    
    from: 0,
    to: 0,
    prefix: "<?= $this->currency ?>"
});
</script>
<script type="text/javascript">
/*Filter Search Function START =========================*/
  function uncheck(elem) {
    $(elem).prop('checked', false);
    $(elem).trigger('change');
  }
  function search_product(e=null , page=1 , is_brand=0)
    {
      if(e){ e.preventDefault() }
      
        $('#filter_data').html('<div id="loading" style="" ></div>');
        //$.blockUI();
        // if (is_brand) {
        //   $('[name="category"]').val('')
        //    var href = window.location.href,
        //     newUrl = href.substring(0, href.indexOf('shop'))
        //     window.history.replaceState({}, '', newUrl+'shop');
          
        // }
      $('#active_filter').html('')
        if (is_brand) {
          $('[name="brand[]"]:checked').each(function(index, el) {
              cat_title = $(el).data('title');
              cat_id = $(el).attr('id');
              $('#active_filter').append('<span class="badge bg-danger text-white mx-2" id="remo_'+index+'">'+cat_title+' <button class="btn btn-danger btn-sm" onclick="uncheck(\'#'+cat_id+'\')">X</button></span>')
          });
        }
        form_data = new FormData($('#search_product')[0]);
        search = $('#search_key').val();
        viewby = $('.view_.selected').data('view');
        sortby = $('#sortby').val();
        form_data.append('search' , search);
        form_data.append('viewby' , viewby);
        form_data.append('sortby' , sortby);
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

$(document).on('click', '.view_', function(event) {
    
    $('.view_').removeClass('selected')
    $(this).addClass('selected')
    search_product(null , 1);
  
});
/*Filter Search Function END =========================*/
</script>
