<?php 

use App\Models\Common_model;
$this->common_model = new Common_model();
$this->session = \Config\Services::session();
$this->user_id = 0;
$this->auth = [];
$this->currency = 'HKD';
if ($this->session->has('user_id')) {
  $this->user_id = $this->session->get('user_id');

  $this->auth = $this->common_model->GetSingleData('users' , array('id' =>$this->user_id));
  $this->currency = $this->auth['currency'];
  //print_r($this->auth);
}

 ?>
<div class="row">
  <!-- Loop -->
  <?php if ($products): ?>
    <?php foreach ($products as $key => $value): ?>
      <?php 
      $sales = $this->common_model->GetAllData("orders", array("product_id"=>$value['id'] , "status"=>1) , 'id' , 'desc'); 
      $exchange = $this->common_model->GetAllData("exchange_order", array("product_id"=>$value['id'] , "status"=>3) , 'id' , 'desc'); 
      $img = $this->common_model->GetSingleData('product_image' , array('product_id' => $value['id'] ));
      $check = false; 
      $check2 = false; 
      if($this->user_id){
            $check = $this->common_model->GetSingleData('wishlist' , array('product_id' => $value['id'],'user_id'=>$this->user_id)); 
            $check2 = $this->common_model->GetSingleData('exchange_list' , array('product_id' => $value['id'],'user_id'=>$this->user_id)); 
      }
      
      // $up['lowest_ask'] = get_hl_price($value['id'])['lowest'];
      // $up['conditions'] = get_hl_price($value['id'])['game_condition'];
      // $up['no_of_exchange'] = count($exchange);
      // $up['no_of_sales'] = count($sales);
      // $up['last_sale_price'] = ($sales) ? $sales[0]['grand_total'] : 0;

      // $this->common_model->UpdateData('product' , array('id' => $value['id']) , $up);
      

      ?>
      <div class="col-sm-<?= $col ?>">
        <div class="product-box">
          <span class="badge bg-danger text-white cnd"><?=$value['game_score']?></span>
          <div class="product-image">
           <a href="<?= (@$is_sell) ? get_product_sell_url($value) : get_product_url($value)  ?>"> <img src="<?= ($img) ? base_url($img['image']) : base_url('assets/uploads/default.jpg') ?>"></a>
            <span class="sold-count"><?= count($sales) ?> Sold</span>
            <span class="add-fav">
              <a href="javascript:;" onclick="return addToFav(<?php echo $value['id'] ?>)"><i class="fa <?= ($check) ? 'fa-heart' : 'fa-heart-o' ?> product_heart_<?= $value['id'] ?>"></i></a>

            </span>
            <?= gradeName($value['class_type']) ?>
            <?php if (@$is_sell): ?>
               <input type="checkbox" class="ex_remove" value="<?=  $value['id'] ?>" >
              <span class="add-fav" style="right: 40px;">

              <a href="javascript:;" onclick="return addToEx(<?php echo $value['id'] ?> , 'reload')">Remove</a>
            </span> 
            <?php endif ?>
            
          </div>
          <div class="product-detail">
            <h3><a href="<?= (@$is_sell) ? get_product_sell_url($value) : get_product_url($value)  ?>"><?= $value['title'] ?></a></h3>
            <h6>Lowest Ask</h6>
            <h2><?= (get_hl_price($value['id'])['lowest'] == 0) ? '--' : $this->currency.convert_currency(get_hl_price($value['id'])['lowest'] , $this->currency , 'HKD'); ?></h2>
            
            <span>Last sale : <?= ($sales) ? $this->currency.convert_currency($sales[0]['grand_total'] , $this->currency , 'HKD') : '--' ?></span>
          </div>
          
          <!--div class="product-overlay">
          <div class="set-centerp">
            <a href="" class="btn btn-primary">View Detail</a>
            <a href="" class="btn btn-primary">Add to wish list</a>
          </div>
        </div-->
      </div>
    </div>
    <?php endforeach ?>
  <?php else: ?>
    <div class="col-sm-12">
      <div class="alert alert-danger">No item found!</div>
    </div>
  <?php endif ?>
</div>