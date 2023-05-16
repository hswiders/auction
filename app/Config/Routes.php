<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
$routes->set404Override(function(){
    return view('404');
});
/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('product/(:any)', 'Shop::product_detail/$1');
$routes->get('edit-bid/(:any)', 'Shop::edit_bid/$1');
$routes->get('shop', 'Shop::index');
$routes->get('shop/(:any)', 'Shop::index/$1');
$routes->get('order-details/(:num)', 'Shop::orderDetails/$1');
$routes->get('terms-conditions', 'Pages::terms');
$routes->get('warrenty-and-refund', 'Pages::warrenty_refund');
$routes->get('login', 'Login::index');
$routes->get('signup', 'Signup::index');
$routes->get('dashboard', 'User::index');
$routes->get('account-settings', 'User::account_settings');
$routes->get('edit-buyer-info', 'User::edit_buyer_info');
$routes->get('edit-seller-info', 'User::edit_seller_info');
$routes->get('payout-info', 'Wallet::payout_info');
$routes->get('edit-currency', 'User::edit_currency');
$routes->get('edit-shipping', 'User::edit_shipping');
$routes->get('auth_cancel', 'User::auth_cancel');
$routes->get('auth_return', 'User::auth_return');
$routes->get('profile', 'User::profile');
$routes->get('sell', 'Sell::index');
$routes->post('add-sell', 'Sell::addSell');
$routes->get('create-product', 'Sell::create_product');
$routes->get('sell/(:any)/(:any)', 'Sell::sell_product/$1/$2');
$routes->get('my-products', 'Product::myProducts');
$routes->get('edit-product/(:num)', 'Product::editProduct/$1');

$routes->get('my-orders', 'Order::myOrder');
$routes->get('my-wallet', 'Wallet::myWallet');

$routes->get('buy-orders', 'Order::BuyOrder');
$routes->get('wishlist', 'User::wish_list');
$routes->get('exchange-list', 'User::exchange_list');
$routes->get('lowest_ask', 'Mail::lowest_ask');
// $routes->get('change-password', 'User::change_password');
/*Sell Products*/
$routes->get('my-selling', 'Product::mySelling');
$routes->get('my-sell-detail/(:num)', 'Product::mySellingDetail/$1');
$routes->get('edit-my-sell/(:num)', 'Product::mySellingEdit/$1');


// New Module Trade
$routes->get('trade-detail/(:any)', 'Trade::trade_detail/$1');

$routes->get('trade-exchange', 'Trade::index');
$routes->get('trade-exchange/(:any)', 'Trade::index/$1');
$routes->get('add-exchange', 'Trade::add_exchange');


$routes->get('logout', 'Home::logout');
$routes->get('forgot', 'Login::forgot');
$routes->get('verify-email/(:any)/(:any)', 'Home::verify_email/$1/$2');
$routes->get('reset-password/(:any)/(:any)', 'Home::reset_password/$1/$2');
$routes->get('verification-pending-screen', 'Home::verify_pending');
$routes->get('sendVerificationMail/(:any)' , 'Home::sendEmail_veification');

$routes->get('faq', 'Home::faq_list');
$routes->get('gamex-products', 'Home::gamex_products');

$routes->get('exchange-order', 'Order::exchange_order_list');
/*$routes->get('approve_exchange_order', 'Order::approve_order_list');
$routes->get('reject_exchange_order', 'Order::reject_order_list');*/


/*Admin Routes========================*/
$routes->get('admin', 'Admin/Admin::login');
$routes->get('admin/forgot', 'Admin/Admin::Forgot');
$routes->get('admin/forgot', 'Admin/Admin::Forgot');
$routes->get('admin/do_forgot', 'Admin/Admin::do_forgot');
$routes->get('admin/dashboard', 'Admin/AdminDashboard::adminDashboard');
$routes->get('admin/profile', 'Admin/AdminDashboard::adminProfile');
$routes->get('admin/change-password', 'Admin/AdminDashboard::changePassword');
$routes->get('admin/logout', 'Admin/AdminDashboard::Logout');
$routes->get('admin/account-settings/(:any)', 'Admin\Users::account_settings/$1');
$routes->get('admin/user-edit-seller-info/(:any)', 'Admin\Users::edit_seller_info/$1');
$routes->get('admin/user-edit-currency/(:any)', 'Admin\Users::edit_currency/$1');
$routes->get('admin/user-edit-shipping/(:any)', 'Admin\Users::edit_shipping/$1');

/*Currency=============================*/
$routes->get('admin/currency-management', 'Admin/Currency::currency_management');
$routes->get('admin/my-wallet', 'Admin/AdminWallet::my_wallet');
$routes->get('admin/withdrawal-requests', 'Admin/AdminWallet::withdrawal_requests');
$routes->get('admin/completed-withdrawal-requests', 'Admin/AdminWallet::completed_withdrawal');
$routes->get('admin/rejected-withdrawal-requests', 'Admin/AdminWallet::rejected_withdrawal');

/*Users=============================*/
$routes->get('admin/user-management', 'Admin/Users::user_management');
$routes->get('admin/user-view/(:any)', 'Admin\Users::user_view/$1');
$routes->get('admin/user-edit/(:any)', 'Admin\Users::user_edit/$1');

/*Products management===============*/

$routes->get('admin/products-management', 'Admin/Products::products_management');
$routes->get('admin/categories-management', 'Admin/Categories::categories_management');
$routes->get('admin/grade-rates', 'Admin/Grades::grade_rates');
$routes->get('admin/step-charges', 'Admin/Grades::step_charges');
$routes->get('admin/product-group-management', 'Admin/ProductGroup::product_group_management');

$routes->get('admin/subcategory-management', 'Admin/Categories::subcategories_management');
$routes->get('admin/currencies-management', 'Admin/Currencies::currencies_management');

$routes->get('admin/admin_product', 'Admin/Product::admin_product_list');
$routes->get('admin/user_product', 'Admin/Product::user_product_list');
$routes->get('admin/user__requested_product', 'Admin/Product::user_requested_product_list');

$routes->get('admin/social-management', 'Admin/SocialLinks::social_links_management');




//$routes->get('admin/product-selwl', 'Admin/Sell_Product::sell_product_list');
$routes->get('admin/active_product', 'Admin/Sell_Product::active_sell_product_list');
$routes->get('admin/complete_product', 'Admin/Sell_Product::complete_sell_product_list');
$routes->get('admin/expired_product', 'Admin/Sell_Product::expired_sell_product_list');

$routes->get('admin/active_bid_product', 'Admin/Order_Management::active_bid_product_list');
$routes->get('admin/complete_bid_product', 'Admin/Order_Management::complete_bid_product_list');
$routes->get('admin/expired_bid_product', 'Admin/Order_Management::expired_bid_product_list');

$routes->get('admin/brand', 'Admin/Brand::brand_list');
$routes->get('admin/banner', 'Admin/Banner::banner_list');

$routes->get('admin/faq', 'Admin/Faq_Management::faq_list');

$routes->get('admin/footer-banner', 'Admin/Banner::footer_banner_list');

$routes->get('admin/subscription', 'Admin/AdminDashboard::subscription_list');

$routes->get('admin/order', 'Admin/Order_Management::order_list');

$routes->get('admin/complete_exchange_order', 'Admin/Order_Management::complete_order_list');
$routes->get('admin/pending_exchange_order', 'Admin/Order_Management::pending_order_list');
$routes->get('admin/approve_exchange_order', 'Admin/Order_Management::approve_order_list');
$routes->get('admin/reject_exchange_order', 'Admin/Order_Management::reject_order_list');

$routes->get('admin/grade-management', 'Admin/Grades::grade_list');

/*News management===============*/
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
