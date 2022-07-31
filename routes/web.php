<?php

use App\Http\Livewire\Admin\AddAdminCategoryComponent;
use App\Http\Livewire\Admin\AdminAddCouponsComponent;
use App\Http\Livewire\Admin\AdminAddHomeSliderComponent;
use App\Http\Livewire\Admin\AdminAddProductComponent;
use App\Http\Livewire\Admin\AdminCategoriesComponent;
use App\Http\Livewire\Admin\AdminContactComponent;
use App\Http\Livewire\Admin\AdminCouponsComponent;
use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\Admin\AdminEditCategory;
use App\Http\Livewire\Admin\AdminEditCatgoryComponent;
use App\Http\Livewire\Admin\AdminEditCouponsComponent;
use App\Http\Livewire\Admin\AdminEditHomeSliderComponent;
use App\Http\Livewire\Admin\AdminEditProductComponent;
use App\Http\Livewire\Admin\AdminHomeCategoryComponent;
use App\Http\Livewire\Admin\AdminHomeSliderComponent;
use App\Http\Livewire\Admin\AdminOrderComponent;
use App\Http\Livewire\Admin\AdminOrderDetailsComponent;
use App\Http\Livewire\Admin\AdminProductComponent;
use App\Http\Livewire\Admin\AdminSaleComponent;
use App\Http\Livewire\Admin\AdminSettingComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\ContactComponent;
use App\Http\Livewire\DetailComponent;
use App\Http\Livewire\HomeComponents;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\ThankYouComponent;
use App\Http\Livewire\User\UserChangePasswordComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use App\Http\Livewire\User\UserOrderComponent;
use App\Http\Livewire\User\UserOrderDetailsComponent;
use App\Http\Livewire\User\UserReviewComponent;
use App\Http\Livewire\WishListComponent;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/',HomeComponents::class);
Route::get('/shop',ShopComponent::class);
Route::get('/checkout',CheckoutComponent::class);
Route::get('/cart',CartComponent::class)->name('product.cart');



// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

//forUser
Route::middleware(['auth:sanctum','verified'])->group(function(){
    Route::get('/user/dashboard',UserDashboardComponent::class)->name('user.dashboard');
    Route::get('/user/orders',UserOrderComponent::class)->name('user.order');
    Route::get('/user/orders/{order_id}',UserOrderDetailsComponent::class)->name('user.orderDetails');
    Route::get('/user/review/{order_item_id}',UserReviewComponent::class)->name('user.review');
    Route::get('/user/change-password',UserChangePasswordComponent::class)->name('user.changepassword');


});

//forAdmin
Route::middleware(['auth:sanctum','verified','authadmin'])->group(function(){
    Route::get('/admin/dashboard',AdminDashboardComponent::class)->name('admin.dashboard');
    Route::get('/admin/category',AdminCategoriesComponent::class)->name('admin.categories');
    Route::get('/admin/category/add',AddAdminCategoryComponent::class)->name('admin.addCategory');
    Route::get('/admin/category/edit/{category_slug}',AdminEditCategory::class)->name('category.edit');
    Route::get('/admin/product',AdminProductComponent::class)->name('admin.product');
    Route::get('/admin/product/add',AdminAddProductComponent::class)->name('adminproduct.add');
    Route::get('/admin/product/edit/{product_slug}',AdminEditProductComponent::class)->name('adminproduct.edit');
    Route::get('/admin/slider/',AdminHomeSliderComponent::class)->name('admin.slider');
    Route::get('/admin/slider/add',AdminAddHomeSliderComponent::class)->name('admin.sliderAdd');
    Route::get('/admin/slider/edit/{slide_id}',AdminEditHomeSliderComponent::class)->name('admin.sliderEdit');
    Route::get('/admin/home-categories',AdminHomeCategoryComponent::class)->name('admin.homecategories');
    Route::get('/admin/sale',AdminSaleComponent::class)->name('admin.sale');
    Route::get('/admin/coupon',AdminCouponsComponent::class)->name('admin.coupon');
    Route::get('/admin/coupon/add',AdminAddCouponsComponent::class)->name('admin.addCoupon');
    Route::get('/admin/coupon/edit/{coupon_id}',AdminEditCouponsComponent::class)->name('admin.editCoupon');
    Route::get('/admin/orders',AdminOrderComponent::class)->name('admin.order');
    Route::get('/admin/orders/{order_id}',AdminOrderDetailsComponent::class)->name('admin.orderDetails');
    Route::get('/admin/contact-us',AdminContactComponent::class)->name('admin.contact');
    Route::get('/admin/settings',AdminSettingComponent::class)->name('admin.setting');

});


Route::get('/product/{slug}', DetailComponent::class)->name('product.detail');
Route::get('/product-category/{category_slug}',CategoryComponent::class )->name('category.product');
Route::get('/search',SearchComponent::class)->name('search.product');
Route::get('/wishlist',WishListComponent::class)->name('product.wishlist');
Route::get('/thank-you',ThankYouComponent::class)->name('thankyou');
Route::get('/contact-us',ContactComponent::class)->name('contact');
