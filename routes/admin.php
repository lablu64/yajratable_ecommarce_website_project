<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChailController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\PickpointController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\WarehouesController;
use App\Http\Controllers\Admin\WebsiteSetting;
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


Route::group(['middleware'=>'is_admin'] ,function () { 
    Route::get('admin/home', [HomeController::class, 'admin'])->name('admin.home');
	Route::get('/admin/logout',[HomeController::class,'logout'])->name('admin.logout');

    Route::group(['prefix'=>'category'] ,function () {
        Route::get('/', [CategoryController::class, 'Index'])->name('category.index');
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/delete/{id}', [CategoryController::class, 'destory'])->name('category.delete');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit'); 
        Route::post('/update', [CategoryController::class, 'update'])->name('category.update'); 
     

     });

     //global route
     Route::get('/get-child-category/{id}', [CategoryController::class, 'getchilcategory']);
      
     Route::group(['prefix'=>'subcategory'] ,function () {
        Route::get('/', [SubCategoryController::class, 'Index'])->name('subcategory.index');
        Route::post('/store', [SubCategoryController::class, 'store'])->name('subcategory.store');
        Route::get('/delete/{id}', [SubCategoryController::class, 'destory'])->name('subcategory.delete');
        Route::get('/edit/{id}', [SubCategoryController::class, 'edit'])->name('subcategory.edit'); 
        Route::post('/update', [SubCategoryController::class, 'update'])->name('subcategory.update'); 
     

     });

     Route::group(['prefix'=>'chailcategory'] ,function () {
        Route::get('/', [ChailController::class, 'Index'])->name('chailcategory.index');
        Route::post('/store', [ChailController::class, 'store'])->name('chailcategory.store');
        Route::get('/delete/{id}', [ChailController::class, 'destory'])->name('chailcategory.delete');
        Route::get('/edit/{id}', [ChailController::class, 'edit'])->name('chailcategory.edit'); 
        Route::post('/update', [ChailController::class, 'update'])->name('chailcategory.update'); 
     

     });

     
     Route::group(['prefix'=>'warehoues'] ,function () {
        Route::get('/', [WarehouesController::class, 'Index'])->name('warehoues.index');
        Route::post('/store', [WarehouesController::class, 'store'])->name('warehoues.store');
        Route::get('/delete/{id}', [WarehouesController::class, 'destory'])->name('warehoues.delete');
        Route::get('/edit/{id}', [WarehouesController::class, 'edit'])->name('warehoues.edit'); 
        Route::post('/update', [WarehouesController::class, 'update'])->name('warehoues.update'); 
     

     });

     Route::group(['prefix'=>'pickpoint'] ,function () {
      Route::get('/', [PickpointController::class, 'Index'])->name('pickpoint.index');
      Route::post('/store', [PickpointController::class, 'store'])->name('pickpoint.store');
      Route::get('/delete/{id}', [PickpointController::class, 'destory'])->name('pickpoint.delete');
      Route::get('/edit/{id}', [PickpointController::class, 'edit'])->name('pickpoint.edit'); 
      Route::post('/update', [PickpointController::class, 'update'])->name('pickpoint.update'); 
   

   });

     Route::group(['prefix'=>'brand'] ,function () {
      Route::get('/', [BrandController::class, 'Index'])->name('brand.index');
      Route::post('/store', [BrandController::class, 'store'])->name('brand.store');
      Route::get('/delete/{id}', [BrandController::class, 'destory'])->name('brand.delete');
      Route::get('/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit'); 
      Route::post('/update', [BrandController::class, 'update'])->name('brand.update'); 
   

   });


   

   Route::group(['prefix'=>'product'] ,function () {
      Route::get('/', [ProductController::class, 'Index'])->name('product.index');
      Route::get('/create', [ProductController::class, 'create'])->name('product.create');
      Route::post('/store', [ProductController::class, 'store'])->name('product.store');
      Route::get('/delete/{id}', [ProductController::class, 'destory'])->name('product.delete');
      Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit'); 
      Route::post('/update', [ProductController::class, 'update'])->name('product.update'); 
      Route::get('/on-featured/{id}', [ProductController::class, 'onfeatured']); 
      Route::get('/active-featured/{id}', [ProductController::class, 'activefeatured']); 
      Route::get('/on-today/{id}', [ProductController::class, 'ontoday']); 
      Route::get('/active-today/{id}', [ProductController::class, 'activetoday']); 
      Route::get('/on-status/{id}', [ProductController::class, 'onstatus']); 
      Route::get('/active-status/{id}', [ProductController::class, 'activestatus']); 

   });

   //setting Routes
	Route::group(['prefix'=>'setting'], function(){
		//seo setting
		// Route::group(['prefix'=>'seo'], function(){
		// 	Route::get('/','SettingController@seo')->name('seo.setting');
		// 	Route::post('/update/{id}','SettingController@seoUpdate')->name('seo.setting.update');
	   //  });
	    //smtp setting
		// Route::group(['prefix'=>'smtp'], function(){
		// 	Route::get('/','SettingController@smtp')->name('smtp.setting');
		// 	Route::post('/update/','SettingController@smtpUpdate')->name('smtp.setting.update');
	   //  });

	    //website setting
		Route::group(['prefix'=>'website'], function(){
			Route::get('/',[WebsiteSetting::class,'website'])->name('website.setting');
			Route::post('/update/{id}',[WebsiteSetting::class,'WebsiteUpdate'])->name('website.setting.update');
	    });

	    //website setting
		// Route::group(['prefix'=>'payment-gateway'], function(){
		// 	Route::get('/','SettingController@PaymentGateway')->name('payment.gateway');
		// 	Route::post('/update-aamarpay','SettingController@AamarpayUpdate')->name('update.aamarpay');
		// 	Route::post('/update-surjopay','SettingController@SurjopayUpdate')->name('update.surjopay');
	   //  });

	    //Page setting
		// Route::group(['prefix'=>'page'], function(){
		// 	Route::get('/','PageController@index')->name('page.index');
		// 	Route::get('/create','PageController@create')->name('create.page');
		// 	Route::post('/store','PageController@store')->name('page.store');
		// 	Route::get('/delete/{id}','PageController@destroy')->name('page.delete');
		// 	Route::get('/edit/{id}','PageController@edit')->name('page.edit');
		// 	Route::post('/update/{id}','PageController@update')->name('page.update');
	   //  });


	    

	    //Ticket 
		Route::group(['prefix'=>'ticket'], function(){
			Route::get('/',[TicketController::class,'index'])->name('ticket.index');
			Route::get('/ticket/show/{id}',[TicketController::class,'show'])->name('admin.ticket.show');
			Route::post('/ticket/reply',[TicketController::class,'ReplyTicket'])->name('admin.store.reply');
			Route::get('/ticket/close/{id}',[TicketController::class,'CloseTicket'])->name('admin.close.ticket');
			Route::delete('/ticket/delete/{id}',[TicketController::class,'destroy'])->name('admin.ticket.delete');
			
	    });

		//Blog category
	   //  Route::group(['prefix'=>'blog-category'], function(){
		// 	Route::get('/','BlogController@index')->name('admin.blog.category');
		// 	Route::post('/store','BlogController@store')->name('blog.category.store');
		// 	Route::get('/delete/{id}','BlogController@destroy')->name('blog.category.delete');
		// 	Route::get('/edit/{id}','BlogController@edit');
		// 	Route::post('/update','BlogController@update')->name('blog.category.update');
		// });

	    //__role create__
	   //  Route::group(['prefix'=>'role'], function(){
		// 	Route::get('/','RoleController@index')->name('manage.role');
		// 	Route::get('/create','RoleController@create')->name('create.role');
		// 	Route::post('/store','RoleController@store')->name('store.role');
		// 	Route::get('/delete/{id}','RoleController@destroy')->name('role.delete');
		// 	Route::get('/edit/{id}','RoleController@edit')->name('role.edit');
		// 	Route::post('/update','RoleController@update')->name('update.role');
		// });

	    //__report routes__//
	   //  Route::group(['prefix'=>'report'], function(){
		// 	Route::get('/order','OrderController@Reportindex')->name('report.order.index');
		// 	Route::get('/order/print','OrderController@ReportOrderPrint')->name('report.order.print');
			
		// });

	});

	//Coupon Routes
	Route::group(['prefix'=>'coupon'], function(){
		Route::get('/',[CouponController::class,'index'])->name('coupon.index');
		Route::post('/store',[CouponController::class,'store'])->name('store.coupon');
		Route::delete('/delete/{id}',[CouponController::class,'destroy'])->name('coupon.delete');
		Route::get('/edit/{id}',[CouponController::class,'edit']);
		Route::post('/update',[CouponController::class,'update'])->name('update.coupon');
	});

	//Campaign Routes
	Route::group(['prefix'=>'campaign'], function(){
		Route::get('/',[CampaignController::class,'index'])->name('campaign.index');
		Route::post('/store',[CampaignController::class,'store'])->name('campaign.store');
		Route::get('/delete/{id}',[CampaignControlle::class,'destroy'])->name('campaign.delete');
		Route::get('/edit/{id}',[CampaignController::class,'edit']);
		Route::post('/update',[CampaignController::class,'update'])->name('campaign.update');
	});


   
   
   
    });