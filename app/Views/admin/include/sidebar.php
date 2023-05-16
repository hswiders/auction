<style type="text/css">
    .dashboard{
        overflow-y: auto;
    }
</style>
<div class="col-md-3 dashboard">
    <div class="deznav">
        <div class="deznav-scroll">
            <ul class="metismenu" id="menu">
                <li>
                    <a class="nav-tab" href="<?= site_url('admin/dashboard'); ?>" aria-expanded="false">
                        <span>
                            <i class="fa fa-dashboard"></i>
                            <span class="nav-text">Dashboard</span>
                        </span>
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                </li>
                <li>
                    <a class="nav-tab" href="<?= site_url('admin/user-management'); ?>" aria-expanded="false">
                        <span>
                            <i class="fa fa-user"></i>
                            <span class="nav-text">User Management</span>
                        </span>
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                </li>
                <li>
                    <a class="nav-tab" href="<?= site_url('admin/product-group-management'); ?>" aria-expanded="false">
                        <span>
                            <i class="fa fa-users"></i>
                            <span class="nav-text">Product Group Management</span>
                        </span>
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                </li>
                <li>
                    <a class="nav-tab" href="<?= site_url('admin/categories-management'); ?>" aria-expanded="false">
                        <span>
                            <i class="fa fa-list-alt"></i>
                            <span class="nav-text">Categories Management</span>
                        </span>
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                </li>
                <li>
                    <a class="nav-tab" href="<?= site_url('admin/subcategory-management'); ?>" aria-expanded="false">
                        <span>
                            <i class="fa fa-list-alt"></i>
                            <span class="nav-text">SubCategories Management</span>
                        </span>
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                </li>
                <li>
                    <a class="nav-tab" href="<?= site_url('admin/currencies-management'); ?>" aria-expanded="false">
                        <span>
                            <i class="fa fa-money"></i>
                            <span class="nav-text">Currency Management</span>
                        </span>
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                </li>
                <li>             
                    <a class="nav-tab" data-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false">
                        <span>

                            <i class="fa fa-list-alt"></i>
                            <span class="nav-text">Wallet Management</span>
                        </span>
                        <i class="fa fa-angle-right" aria-hidden="false"></i>
                    </a>
                  

                    <div class="collapse" id="collapseExample1">
                        <a class="collapse-item nav-tab" href="<?= site_url('admin/my-wallet'); ?>" aria-expanded="false">
                            <span class="nav-text">- My wallet</span>
                        </a>
                        <a class="collapse-item nav-tab" href="<?= site_url('admin/withdrawal-requests'); ?>" aria-expanded="false">
                            <span class="nav-text">- Incoming Withdrawal requests</span><span class="badge bg-danger text-white"><?= get_withdrawal_count() ?></span>
                        </a>
                       
                        <a class="collapse-item nav-tab" href="<?= site_url('admin/completed-withdrawal-requests'); ?>" aria-expanded="false">
                            <span class="nav-text">- Completed Withdrawal requests</span>
                        </a>
                       <a class="collapse-item nav-tab" href="<?= site_url('admin/rejected-withdrawal-requests'); ?>" aria-expanded="false">
                            <span class="nav-text">- Rejected Withdrawal requests</span>
                        </a>
                       
                    </div>
                </li>
                <!-- <li>
                    <a class="nav-tab" href="<?= site_url('admin/grade-rates'); ?>" aria-expanded="false">
                        <span>
                            <i class="fa fa-graduation-cap"></i>
                            <span class="nav-text">Grade Rates</span>
                        </span>
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                </li> -->
                <li>
                    <a class="nav-tab" href="<?= site_url('admin/step-charges'); ?>" aria-expanded="false">
                        <span>
                            <i class="fa fa-graduation-cap"></i>
                            <span class="nav-text">Step Charges</span>
                        </span>
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                </li>
                <li>
                    <a class="nav-tab" href="<?= site_url('admin/grade-management'); ?>" aria-expanded="false">
                        <span>
                            <i class="fa fa-money"></i>
                            <span class="nav-text">Grade Management</span>
                        </span>
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                </li>
                <li>
                    <a class="nav-tab" href="<?= site_url('admin/social-management'); ?>" aria-expanded="false">
                        <span>
                            <i class="fa fa-share"></i>
                            <span class="nav-text">Social Management</span>
                        </span>
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                </li>

                <!-- <li>
                    <a class="nav-tab" href="<?= site_url('admin/product-sell'); ?>" aria-expanded="false">
                        <span>
                            <i class="fa fa-list-alt"></i>
                            <span class="nav-text">Product Sell Management</span>
                        </span>
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                </li> -->

                <li>             
                    <a class="nav-tab" data-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false">
                        <span>

                            <i class="fa fa-list-alt"></i>
                            <span class="nav-text">Product Ask Management</span>
                        </span>
                        <i class="fa fa-angle-right" aria-hidden="false"></i>
                    </a>
                  

                    <div class="collapse" id="collapseExample1">
                        <a class="collapse-item nav-tab" href="<?= site_url('admin/active_product'); ?>" aria-expanded="false">
                            <span class="nav-text">- Active Ask List</span>
                        </a>
                        <a class="collapse-item nav-tab" href="<?= site_url('admin/complete_product'); ?>" aria-expanded="false">
                            <span class="nav-text">- Completed Ask List</span>
                        </a>
                        <a class="collapse-item nav-tab" href="<?= site_url('admin/expired_product'); ?>" aria-expanded="false">
                            <span class="nav-text">- Expired Ask List</span>
                        </a>
                    </div>
                </li>

                <li>             
                    <a class="nav-tab" data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false">
                        <span>

                            <i class="fa fa-list-alt"></i>
                            <span class="nav-text">Product Bid Management</span>
                        </span>
                        <i class="fa fa-angle-right" aria-hidden="false"></i>
                    </a>
                  

                    <div class="collapse" id="collapseExample2">
                        <a class="collapse-item nav-tab" href="<?= site_url('admin/active_bid_product'); ?>" aria-expanded="false">
                            <span class="nav-text">- Active Bid List</span>
                        </a>
                        <a class="collapse-item nav-tab" href="<?= site_url('admin/complete_bid_product'); ?>" aria-expanded="false">
                            <span class="nav-text">- Completed Bid List</span>
                        </a>
                        <a class="collapse-item nav-tab" href="<?= site_url('admin/expired_bid_product'); ?>" aria-expanded="false">
                            <span class="nav-text">- Expired Bid List</span>
                        </a>
                    </div>
                </li>
                <li>
                    <a class="nav-tab" href="<?= site_url('admin/brand'); ?>" aria-expanded="false">
                        <span>
                            <i class="fa fa-drupal"></i>
                            <span class="nav-text">Brand Management</span>
                        </span>
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                </li>
                <li>
                    <a class="nav-tab" href="<?= site_url('admin/banner'); ?>" aria-expanded="false">
                        <span>
                            <i class="fa fa-drupal"></i>
                            <span class="nav-text">Banner Management</span>
                        </span>
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                </li>
                <li>
                    <a class="nav-tab" href="<?= site_url('admin/faq'); ?>" aria-expanded="false">
                        <span>
                            <i class="fa fa-drupal"></i>
                            <span class="nav-text">FAQ Management</span>
                        </span>
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                </li>
                <li>
                    <a class="nav-tab" href="<?= site_url('admin/footer-banner'); ?>" aria-expanded="false">
                        <span>
                            <i class="fa fa-drupal"></i>
                            <span class="nav-text">Footer Banner Management</span>
                        </span>
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                </li>
                <li>             
                    <a class="nav-tab" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false">
                        <span>

                            <i class="fa fa-list-alt"></i>
                            <span class="nav-text">Product Management</span>
                        </span>
                        <i class="fa fa-angle-right" aria-hidden="false"></i>
                    </a>
                  

                    <div class="collapse" id="collapseExample">
                        <a class="collapse-item nav-tab" href="<?= site_url('admin/admin_product'); ?>" aria-expanded="false">
                            <span class="nav-text">- Admin Product List</span>
                        </a>
                        <a class="collapse-item nav-tab" href="<?= site_url('admin/user_product'); ?>" aria-expanded="false">
                            <span class="nav-text">- User Product List</span>
                        </a>
                        <a class="collapse-item nav-tab" href="<?= site_url('admin/user__requested_product'); ?>" aria-expanded="false">
                            <span class="nav-text">- User Requested Product List</span>
                        </a>
                    </div>
                </li>

                <li>
                    <a class="nav-tab" href="<?= site_url('admin/subscription'); ?>" aria-expanded="false">
                        <span>
                            <i class="fa fa-drupal"></i>
                            <span class="nav-text">Subscription Management</span>
                        </span>
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                </li>

                <!-- <li>
                    <a class="nav-tab" href="<?= site_url('admin/order'); ?>" aria-expanded="false">
                        <span>
                            <i class="fa fa-drupal"></i>
                            <span class="nav-text">Order Management</span>
                        </span>
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                </li> -->

                <li>             
                    <a class="nav-tab" data-toggle="collapse" href="#collapseExample3" role="button" aria-expanded="false">
                        <span>

                            <i class="fa fa-list-alt"></i>
                            <span class="nav-text">Exchange Order Management</span>
                        </span>
                        <i class="fa fa-angle-right" aria-hidden="false"></i>
                    </a>
                  

                    <div class="collapse" id="collapseExample3">
                        <a class="collapse-item nav-tab" href="<?= site_url('admin/pending_exchange_order'); ?>" aria-expanded="false">
                            <span class="nav-text">- Pending Order List</span>
                        </a>
                        <a class="collapse-item nav-tab" href="<?= site_url('admin/approve_exchange_order'); ?>" aria-expanded="false">
                            <span class="nav-text">- Approved Order List</span>
                        </a>
                        <a class="collapse-item nav-tab" href="<?= site_url('admin/complete_exchange_order'); ?>" aria-expanded="false">
                            <span class="nav-text">- Complete Order List</span>
                        </a>
                        <a class="collapse-item nav-tab" href="<?= site_url('admin/reject_exchange_order'); ?>" aria-expanded="false">
                            <span class="nav-text">- Rejected Order List</span>
                        </a>
                    </div>
                </li>
            
            </ul>

        </div>
    </div>                 
</div>