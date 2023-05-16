<?php 
use App\Models\Common_model;
$this->common_model = new Common_model();
$this->session = \Config\Services::session();
?>
<div class="modal" id="myviewModal<?= $prod['id']; ?>">
    <div class="modal-dialog">
        <div class="modal-content">

        <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Product Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

      <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">Title</div>
                    <div class="col-md-8"><b><?= $prod['title']; ?></b></div>
                </div>
                <hr>
                    <?php if($prod['user_id'] != 0) { ?>
                <div class="row">
                    <div class="col-md-4">User Name</div>
                    <div class="col-md-8"><b><?= getData('users' , $prod['user_id'] , 'first_name')." ".getData('users' , $prod['user_id'] , 'last_name') ?></b></div>
                </div>
                  
                <hr>
                    <?php } ?>
                  
                <div class="row">
                    <div class="col-md-4">Category</div>
                    <div class="col-md-8"><b><?= getData('categories' , $prod['category'] , 'title') ?></b></div>
                </div>
                  
                <hr>
                <div class="row">
                    <div class="col-md-4">SubCategory</div>
                    <div class="col-md-8"><b><?= getData('categories' , $prod['subcategory'] , 'title') ?></b></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4">Publisher</div>
                    <?php $b = $this->common_model->GetSingleData('brands', array('id'=>$value['brand']))?>
                    <div class="col-md-8"><b><?= getData('brands' , $prod['brand'] , 'title') ?></b></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4">Format</div>
                    <div class="col-md-8"><b><?= $prod['format']; ?></b></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4">Release Date</div>
                    <div class="col-md-8"><b><?= $prod['release_date']; ?></b></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4">Price</div>
                    <div class="col-md-8"><b>HKD<?= $prod['base_price']; ?></b></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4">Image</div>
                       
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php 
                            $product_image = productImages($prod['id']);
                            $i = 0;
                            foreach ($product_image as $key => $pimage) {
                            $i++;
                            ?>
                            <div class="carousel-item <?php echo $i == 1 ? 'active' : '' ?>">
                                <img style="height: 100px;width: 100px;" class="d-block" src="<?php echo base_url($pimage["image"]);?>" alt="">
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                        
                    </div>
                </div>
            </div>    
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="printData('#myviewModal<?= $prod['id']; ?>')">Print</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
