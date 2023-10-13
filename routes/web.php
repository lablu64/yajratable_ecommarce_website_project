<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\Frontend\ChackoutController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('frontend.index');
// });

Auth::routes();

Route::get('/login',function(){
  return redirect()->to('/');
})->name('login');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/customar/logout',[HomeController::class,'logout'])->name('customar.logout');
Route::group([] ,function () { 
   

    Route::get('/',[IndexController::class,'index']);
    Route::get('/product-details/{slug}',[IndexController::class,'productDetails'])->name('product.details');
   //review
    Route::post('/review/store',[ReviewController::class,'store'])->name('review.store');
    Route::get('/write-review/store',[ReviewController::class,'writereview'])->name('write.review');
    Route::post('/website-review/store',[ReviewController::class,'storewebsitereview'])->name('store.website.review');
   
   //wishlist 
    Route::get('/add-wishlist/{id}',[CartController::class,'AddWishlist'])->name('add.wishlist');
    Route::get('/wishlist',[CartController::class,'wishlist'])->name('wishlist');
    Route::get('/clear/wishlist',[CartController::class,'clearwishlist'])->name('clear.wishlist');
    Route::get('/wishlistproduct/delete/{id}',[CartController::class,'wishlistproductdelete'])->name('wishlistproduct.delete');
    Route::get('/product-quick-view/{id}',[IndexController::class,'ProductQuickView']);
    Route::post('/add-to-cart',[CartController::class,'addtocart'])->name('add.to.cart.quickview');
   //cart
    Route::get('/all-cart',[CartController::class,'AllCart'])->name('all.cart'); //ajax request for subtotal
   
   Route::get('/my-cart',[CartController::class,'MyCart'])->name('cart'); 
   Route::get('/enpty-cart',[CartController::class,'EnptyCart'])->name('cart.empty');
   Route::get('/cartproduct/remove/{rowId}',[CartController::class,'RemoveProduct']);
   Route::get('/cartproduct/updateqty/{rowId}/{qty}',[CartController::class,'UpdateQty']);
   Route::get('/cartproduct/updatecolor/{rowId}/{color}',[CartController::class,'UpdateColor']);
   Route::get('/cartproduct/updatesize/{rowId}/{size}',[CartController::class,'UpdateSize']);
 //chackout 

 Route::get('/chackout',[ChackoutController::class,'Checkout'])->name('checkout'); //ajax request for subtotal
  Route::get('/apply-coupon',[ChackoutController::class,'ApplyCoupon'])->name('apply.coupon'); //ajax request for subtotal
  Route::get('/remove/coupon',[ChackoutController::class,'RemoveCoupon'])->name('coupon.remove');
  Route::post('/order/place',[ChackoutController::class,'OrderPlace'])->name('order.place');
 
 
   //categorywish product
 Route::get('/category/product/{id}',[IndexController::class,'categoryWishProduct'])->name('categorywish.product');
  //subcategorywish product
  Route::get('/subcategory/product/{id}',[IndexController::class,'subcategoryWishProduct'])->name('subcategorywish.product');
    //chailcategorywish product
 Route::get('/chailcategory/product/{id}',[IndexController::class,'chailcategoryWishProduct'])->name('chailcategorywish.product');
  //brandwish product
  Route::get('/brand/product/{id}',[IndexController::class,'brandWishProduct'])->name('brandwish.product');
  
  //customar setting
  Route::get('/home/setting',[ProfileController::class,'setting'])->name('customer.setting');
  Route::post('/home/setting',[ProfileController::class,'ChangePassword'])->name('customer.password.change');
 //news latter
 Route::get('/my/order',[ProfileController::class,'MyOrder'])->name('my.order'); 
 Route::get('/view/order/{id}',[ProfileController::class,'ViewOrder'])->name('view.order'); 
 
 Route::post('/news-latter/store',[IndexController::class,'storeNewsletter'])->name('store.newsletter');
 


    //support ticket
    Route::get('/open/ticket',[ProfileController::class,'ticket'])->name('open.ticket');
    Route::get('/new/ticket',[ProfileController::class,'NewTicket'])->name('new.ticket');
    Route::post('/store/ticket',[ProfileController::class,'StoreTicket'])->name('store.ticket');
    Route::get('/show/ticket/{id}',[ProfileController::class,'ticketShow'])->name('show.ticket');
    Route::post('/reply/ticket',[ProfileController::class,'ReplyTicket'])->name('reply.ticket');

    //order tracking
    Route::get('/order/tracking',[IndexController::class,'OrderTracking'])->name('order.tracking');
    Route::post('/check/order',[IndexController::class,'CheckOrder'])->name('check.order');

    //__payment gateway
    // Route::post('/success','CheckoutController@success')->name('success');
    // Route::post('/fail','CheckoutController@fail')->name('fail');
    // Route::get('/success',function(){
    //     return redirect()->to('/');
    // })->name('cancel');

    
    // Route::get('/contact-us','IndexController@Contact')->name('contact');
    // Route::get('/our-blog','IndexController@Blog')->name('blog');
    
    //__campaign__//

});


