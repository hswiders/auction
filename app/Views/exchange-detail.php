<?php include ('include/header.php') ?>
<div class="middle detail-page">
  <div class="row">
    <div class="col-sm-6"> 
      <div class="left-detail-image">       
        <div class="outer">
          <div id="big" class="owl-carousel owl-theme">
            <?php
              if ($product_image) {
               foreach ($product_image as $keyp => $product_imageV) {
                 ?>
                        <div class="item">
                        <img src="<?= base_url($product_imageV["image"]) ?>">
                        </div> 

                 <?php
               }
             } ?>  
          </div>
          <div id="thumbs" class="owl-carousel owl-theme">
             <?php
              if ($product_image) {
               foreach ($product_image as $keyp => $product_imageV) {
                 ?>
                  <div class="item">
                  <img src="<?= base_url($product_imageV["image"]) ?>">
                  </div>
                 <?php
               }
             } ?>   
             
          </div>
        </div>
      </div>
      <div class="right-detail-text"> 
        <h3><?= $product["title"]; ?>
          <span class="add-fav">
            <i class="fa fa-heart-o"></i>
          </span>
        </h3>
        <ul>
          <li><b>FORMATE:</b> <?= $product["format"]; ?><br></li>

          <li><?php
        $category = $this->common_model->GetSingleData("categories", array("id"=>$product["category"]));
        $sub_category = $this->common_model->GetSingleData("categories", array("id"=>$product["subcategory"]));
           echo $category["title"].' '.$sub_category["title"]; ?></li>
           <li>RAM: <?= $product["ram"]; ?></li>
         </ul>
        <p><?= $product["description"]; ?></p>
       
      </div>
    </div>
    <div class="col-sm-6"> 
        <div class="search-wrapper mx-auto">
              <p>Find the product you're looking  to Exchange</p>
              <div class="input-group">
                <input type="text" placeholder="Search here" name="key" class="form-control search">
                <span class="input-group-btn">
                
                </span>
              </div>
            </div><br/>
            <div class="datas"></div>
    </div>
  </div>
</div>
<?php include ('include/footer.php') ?>
<script>
  $('.search').keyup(function(){
    var values = $('.search').val();
    var val = $.trim(values);
    if(val.length != 0) {
     $.ajax({
      url: '<?=base_url()?>/Sell/searchKey',
      type: 'post',
      data: {val: val},
      dataType: 'json',
      success: function(data){
        $('.datas').html(data.html);
      }
    })
    }   
  })
</script>
<script>
$(document).ready(function() {
  var bigimage = $("#big");
  var thumbs = $("#thumbs");
  //var totalslides = 10;
  var syncedSecondary = true;

  bigimage
    .owlCarousel({
    items: 1,
    slideSpeed: 2000,
    nav: true,
    autoplay: true,
    dots: false,
    loop: true,
    responsiveRefreshRate: 200,
    navText: [
      '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
      '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
    ]
  })
    .on("changed.owl.carousel", syncPosition);

  thumbs
    .on("initialized.owl.carousel", function() {
    thumbs
      .find(".owl-item")
      .eq(0)
      .addClass("current");
  })
    .owlCarousel({
    items: 4,
    dots: false,
    nav: false,
  margin:10,
    navText: [
      '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
      '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
    ],
    smartSpeed: 200,
    slideSpeed: 500,
    slideBy: 4,
    responsiveRefreshRate: 100
  })
    .on("changed.owl.carousel", syncPosition2);

  function syncPosition(el) {
    //if loop is set to false, then you have to uncomment the next line
    //var current = el.item.index;

    //to disable loop, comment this block
    var count = el.item.count - 1;
    var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

    if (current < 0) {
      current = count;
    }
    if (current > count) {
      current = 0;
    }
    //to this
    thumbs
      .find(".owl-item")
      .removeClass("current")
      .eq(current)
      .addClass("current");
    var onscreen = thumbs.find(".owl-item.active").length - 1;
    var start = thumbs
    .find(".owl-item.active")
    .first()
    .index();
    var end = thumbs
    .find(".owl-item.active")
    .last()
    .index();

    if (current > end) {
      thumbs.data("owl.carousel").to(current, 100, true);
    }
    if (current < start) {
      thumbs.data("owl.carousel").to(current - onscreen, 100, true);
    }
  }

  function syncPosition2(el) {
    if (syncedSecondary) {
      var number = el.item.index;
      bigimage.data("owl.carousel").to(number, 100, true);
    }
  }

  thumbs.on("click", ".owl-item", function(e) {
    e.preventDefault();
    var number = $(this).index();
    bigimage.data("owl.carousel").to(number, 300, true);
  });
});

</script> 



<!-- Modal -->
<div class="modal fade" id="view-asks" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
    <div class="">
        <h5 class="modal-title" id="exampleModalLabel">All Asks</h5>
    <p class="m-0">The data below is global and does not include applicable fees calculated at checkout.</p>
    </div>  
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="">
    <div class="table-responsive">
      <table class="table">
        <tr>
          <th>Quantity</th>
          <th>Ask Price</th>
        </tr>
        <?php foreach ($asks as $key => $value): ?>
          <tr>
          <td>1</td>
          <td>$<?= $value['price'] ?></td>
        </tr>
        <?php endforeach ?>
        
        
      </table>
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="view-bids" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
    <div class="">
        <h5 class="modal-title" id="exampleModalLabel">All Bids</h5>
    <p class="m-0">The data below is global and does not include applicable fees calculated at checkout.</p>
    </div>  
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="">
    <div class="table-responsive">
      <table class="table">
        <tr>
          <th>Quantity</th>
          <th>Bid Price</th>
        </tr>
        <tr>
          <td>2</td>
          <td>$150</td>
        </tr>
        <tr>
          <td>2</td>
          <td>$150</td>
        </tr>
        <tr>
          <td>2</td>
          <td>$150</td>
        </tr>
        <tr>
          <td>2</td>
          <td>$150</td>
        </tr>
        <tr>
          <td>2</td>
          <td>$150</td>
        </tr>
        <tr>
          <td>2</td>
          <td>$150</td>
        </tr>
        <tr>
          <td>2</td>
          <td>$150</td>
        </tr>
      </table>
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="view-sales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
    <div class="">
        <h5 class="modal-title" id="exampleModalLabel">All Sales</h5>
    <p class="m-0">The data below is global and does not include applicable fees calculated at checkout.</p>
    </div>  
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="">
    <div class="table-responsive">
      <table class="table">
        <tr>
          <th>Date</th>
          <th>Time</th>
          <th>Sale Price</th>
        </tr>
         <?php foreach ($sales as $key => $value): ?>
          <tr>
          <td><?= date('M d, Y' , strtotime($value['created_at'])) ?></td>
          <td><?= date('H:i A' , strtotime($value['created_at'])) ?></td>
          <td>$<?= $value['price'] ?></td>
        </tr>
        <?php endforeach ?>
        
      </table>
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="info-shopping" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
    <div class="">
        <h5 class="modal-title" id="exampleModalLabel">Shipping</h5>
    <p class="m-0">Please provide your shipping info</p>
    </div>  
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

    <!-- Text input-->
    <div class="form-group">
      <label class="control-label">Shipping Info</label>  
      <div class="">
      <input type="text" placeholder="First Name" class="form-control"> 
      </div>
    </div> 
    <!-- Text input-->
    <div class="form-group">    
      <input type="text" placeholder="Last Name" class="form-control">  
    </div> 
    <!-- Text input-->
    <div class="form-group">    
      <select class="form-control">  
        <option>India</option>
      </select>
    </div>  
    <!-- Text input-->
    <div class="form-group">    
      <input type="text" placeholder="Address" class="form-control">  
    </div> 
    <!-- Text input-->
    <div class="form-group">    
      <input type="text" placeholder="Address 2" class="form-control">  
    </div> 
    <!-- Text input-->
    <div class="form-group">    
      <input type="text" placeholder="City" class="form-control">  
    </div> 
    <!-- Text input-->
    <div class="form-group">  
      <div class="row">
        <div class="col-sm-6">
        <input type="text" placeholder="State/Province/Region" class="form-control"> 
        </div>
        <div class="col-sm-6">
        <input type="text" placeholder="Zip/Postal Code" class="form-control"> 
        </div>
      </div>
    </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
        <button type="button" class="btn btn-primary">Save Shopping</button> 
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="payment-meth" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
    <div class="">
        <h5 class="modal-title" id="exampleModalLabel">Billing/Shipping</h5>
    <p class="m-0">Use Credit Card for Billing</p>
    </div>  
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    <form class="form-new">
      <!-- Text input-->
      <div class="form-group">
        <label class="control-label">Credit Card</label>  
        <div class="">
        <input type="text" placeholder="Card Number" class="form-control"> 
        </div>
      </div>
      <!-- Text input-->
      <div class="form-group">  
        <div class="row">
          <div class="col-sm-3">
          <input type="text" placeholder="Expire" class="form-control"> 
          </div>
          <div class="col-sm-3">
          <input type="text" placeholder="CVV" class="form-control"> 
          </div>
        </div>
        </div>
        <br>
       <div class="row">
        <div class="col-sm-6">
          <!-- Text input-->
          <div class="form-group">
            <label class="control-label">Billing Info</label>  
            <div class="">
            <input type="text" placeholder="First Name" class="form-control"> 
            </div>
          </div> 
          <!-- Text input-->
          <div class="form-group">    
            <input type="text" placeholder="Last Name" class="form-control">  
          </div> 
          <!-- Text input-->
          <div class="form-group">    
            <select class="form-control">  
              <option>India</option>
            </select>
          </div>  
          <!-- Text input-->
          <div class="form-group">    
            <input type="text" placeholder="Address" class="form-control">  
          </div> 
          <!-- Text input-->
          <div class="form-group">    
            <input type="text" placeholder="Address 2" class="form-control">  
          </div> 
          <!-- Text input-->
          <div class="form-group">    
            <input type="text" placeholder="City" class="form-control">  
          </div> 
          <!-- Text input-->
          <div class="form-group">  
            <div class="row">
              <div class="col-sm-6">
              <input type="text" placeholder="State/Province/Region" class="form-control"> 
              </div>
              <div class="col-sm-6">
              <input type="text" placeholder="Zip/Postal Code" class="form-control"> 
              </div>
            </div>
          </div> 
        </div>
        <div class="col-sm-6">
                  <!-- Text input-->
          <div class="form-group">
            <label class="control-label">Shipping Info</label>  
            <div class="">
            <input type="text" placeholder="First Name" class="form-control"> 
            </div>
          </div> 
          <!-- Text input-->
          <div class="form-group">    
            <input type="text" placeholder="Last Name" class="form-control">  
          </div> 
          <!-- Text input-->
          <div class="form-group">    
            <select class="form-control">  
              <option>India</option>
            </select>
          </div>  
          <!-- Text input-->
          <div class="form-group">    
            <input type="text" placeholder="Address" class="form-control">  
          </div> 
          <!-- Text input-->
          <div class="form-group">    
            <input type="text" placeholder="Address 2" class="form-control">  
          </div> 
          <!-- Text input-->
          <div class="form-group">    
            <input type="text" placeholder="City" class="form-control">  
          </div> 
          <!-- Text input-->
          <div class="form-group">  
            <div class="row">
              <div class="col-sm-6">
              <input type="text" placeholder="State/Province/Region" class="form-control"> 
              </div>
              <div class="col-sm-6">
              <input type="text" placeholder="Zip/Postal Code" class="form-control"> 
              </div>
            </div>
          </div> 

        </div>
       </div>
    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
        <button type="button" class="btn btn-primary">Submit Card</button> 
      </div>
    </div>
  </div>
</div>