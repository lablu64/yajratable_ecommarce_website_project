<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Brand;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ChailCategory;
use App\Models\Wbreview;

class IndexController extends Controller
{
    public function index(){
        $category = DB::table('categories')->get();
        $brand = DB::table('brands')->inRandomOrder()->limit(12)->get();
        $bannarproduct= Product::where('status',1)->where('product_slider',1)->orderBy('id', 'desc')->first();
        //  $bannarproduct = DB::table('products')->where('product_slider',1)->latest()->first();
         $featured_product = DB::table('products')->where('status',1)->where('featured',1)->orderBy('id','DESC')->take(8)->get();
         $popular_product = DB::table('products')->where('status',1)->orderBy('product_view','DESC')->take(8)->get();
         $trendy_product = Product::where('status',1)->where('trendy',1)->orderBy('id','DESC')->take(10)->get();
         $today_deal_product = Product::where('status',1)->where('today_deal',1)->orderBy('id','DESC')->take(10)->get();
          //reviews customar
          $custorm_reviews = Wbreview::where('status',1)->orderBy('id','DESC')->take(12)->get();
         //home page category show
         $home_category= Category::where('home_page',1)->orderBy('category_name','ASC')->take(3)->get();
		 $random_product = DB::table('products')->where('status',1)->inRandomOrder()->take(16)->get();
        			
        
         return view('frontend.index',compact('category','today_deal_product','random_product','brand','bannarproduct','custorm_reviews','featured_product','popular_product','trendy_product','home_category'));
        
        
    }

    public function productDetails($slug){
        $category = DB::table('categories')->get();
        $product = Product::where('slug',$slug)->first();
                   Product::where('slug',$slug)->increment('product_view');
        $relational_product= Product::where('subcategory_id',$product->subcategory_id)->orderBy('id', 'desc')->take(10)->get();
        $review =Review::where('product_id',$product->id)->orderBy('id','DESC')->get();    
      
        return view('frontend.product.product_detail',compact('product','category','relational_product','review'));
    }

       //product quick view
       public function ProductQuickView($id)
       {
           $product=Product::where('id',$id)->first();
           return view('frontend.product.quick_view',compact('product'));
       }

       //categorywish product
       public function categoryWishProduct($id){
        $category = Category::where('id',$id)->first();
         $subcategory = SubCategory::where('category_id',$id)->get();
         $products = Product::where('category_id',$id)->paginate(20);
         $brand = DB::table('brands')->get();
         return view('frontend.product.categorywish_product',compact('category','subcategory','products','brand'));
        
       }

        //subcategorywish product
        public function subcategoryWishProduct($id){
            $subcategory = SubCategory::where('id',$id)->first();
             $chailcategory = ChailCategory::where('subcategory_id',$id)->get();
             $products = Product::where('subcategory_id',$id)->paginate(20);
             $brand = DB::table('brands')->get();
             return view('frontend.product.subcategorywish_product',compact('chailcategory','subcategory','products','brand'));
            
           }

             //chailcategorywish product
        public function chailcategoryWishProduct($id){
            $chailcategory = ChailCategory::where('id',$id)->first();
             $category = DB::table('categories')->get();
             $products = Product::where('childcategory_id',$id)->paginate(20);
             $brand = DB::table('brands')->get();
             return view('frontend.product.chailcategorywish_product',compact('chailcategory','category','products','brand'));
            
           }

                //brand wish product
        public function brandWishProduct($id){
            $brand = Brand::where('id',$id)->first();
             $category = DB::table('categories')->get();
             $products = Product::where('brand_id',$id)->paginate(20);
             $brands = DB::table('brands')->get();
             return view('frontend.product.brandwish_product',compact('brands','category','products','brand'));
            
           }
 //store newsletter
 public function storeNewsletter(Request $request)
 {
     $email=$request->email;
     $check=DB::table('newletters')->where('email',$email)->first();
     if ($check) {
         return response()->json('Email Already Exist!');
     }else{
           $data=array();
           $data['email']=$request->email;
           DB::table('newletters')->insert($data);
           return response()->json('Thanks for subscribe us!');  
     }
    

 }


 //__order tracking page
 public function OrderTracking()
 {
     return view('frontend.order_tracking');
 }


 //__check orer
 public function CheckOrder(Request $request)
 {
     $check=DB::table('orders')->where('order_id',$request->order_id)->first();
     if ($check) {
         $order=DB::table('orders')->where('order_id',$request->order_id)->first();
         $order_details=DB::table('order_details')->where('order_id',$order->id)->get();
         return view('frontend.order_details',compact('order','order_details'));
     }else{
         $notification=array('messege' => 'Invalid OrderID! Try again.', 'alert-type' => 'error');
         return redirect()->back()->with($notification);
     }
 }

 //constact page
 public function Contact()
 {
     return view('frontend.contact');
 }

 //__blog page
 public function Blog()
 {
     return view('frontend.blog');
 }

 //__campaign products__//
 public function CampaignProduct($id)
 {
     $products=DB::table('campaign_product')->leftJoin('products','campaign_product.product_id','products.id')
                 ->select('products.name','products.code','products.thumbnail','products.slug','campaign_product.*')
                 ->where('campaign_product.campaign_id',$id)
                 ->paginate(32);          
     return view('frontend.campaign.product_list',compact('products'));
 }

 //__campaign product details__//
 public function CampaignProductDetails($slug)
 {
     $product=Product::where('slug',$slug)->first();
              Product::where('slug',$slug)->increment('product_views');
     $product_price=DB::table('campaign_product')->where('product_id',$product->id)->first();         
     $related_product=DB::table('campaign_product')->leftJoin('products','campaign_product.product_id','products.id')
                 ->select('products.name','products.code','products.thumbnail','products.slug','campaign_product.*')
                 ->inRandomOrder(12)->get();
     $review=Review::where('product_id',$product->id)->orderBy('id','DESC')->take(6)->get();
     return view('frontend.campaign.product_details',compact('product','related_product','review','product_price'));

 }





}
